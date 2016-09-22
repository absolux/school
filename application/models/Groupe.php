<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Groupe extends CI_Model
{

  public $table = 'groupes';
  // public $view = "groupes_details";
  public $pk = 'id';
  public $search_columns = [ 'groupes.label' ];


  function __construct()
  {
      parent::__construct();
  }

  // get all
  function get_all($limit = 15, $start = 0, $q = null)
  {
      return $this->get_limit_data($limit, $start, $q);
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db->select(['groupes.*', 'annees.label as annee', 'filieres.label as filiere'/*, 'niveaux.label as niveau'*/]);
    $this->db->order_by('groupes.label');
    $this->db->join('annee_scolaires as annees', 'annees.id = groupes.id_annee');
    // $this->db->join('niveaux', 'niveaux.id = groupes.id_niveau');
    $this->db->join('filieres', 'filieres.id = groupes.id_filiere');
    $this->db->where($this->table . '.' . $this->pk, $id);
    return $this->db->get($this->table)->row();
  }
  
  // determine if a given group id exists
  function exists($id) {
    // TODO check also the active year
    return $this->db->where($this->pk, $id)->count_all_results($this->table) == 1;
  }
  
  // get total rows
  function total_rows($q = NULL) {
    if ( $q ) {
      foreach ( $this->search_columns as $col ) {
        $this->db->or_like($col, $q);
      }
    }
     
    return $this->db->count_all_results($this->table);
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    if ( $q ) {
      foreach ( $this->search_columns as $col ) {
        $this->db->or_like($col, $q);
      }
    }
    
    $this->db->select(['groupes.*', 'annees.label as annee', 'filieres.label as filiere'/*, 'niveaux.label as niveau'*/]);
    $this->db->order_by('groupes.label');
    $this->db->join('annee_scolaires as annees', 'annees.id = groupes.id_annee');
    // $this->db->join('niveaux', 'niveaux.id = groupes.id_niveau');
    $this->db->join('filieres', 'filieres.id = groupes.id_filiere');
    return $this->db->limit($limit, $start)->get($this->table)->result();
  }

  // insert data
  function insert($data)
  {
    $etudiants = $data['etudiants'];
    unset($data['etudiants']);
    
    if ( ($result = $this->db->insert($this->table, $data)) ) {
      // $this->sync_etudiants($this->db->insert_id(), $etudiants);
    }
    
    return $result;
  }

  // update data
  function update($id, $data)
  {
    $etudiants = $data['etudiants'];
    unset($data['etudiants']);
    
    if ( ($result = $this->db->where($this->pk, $id)->update($this->table, $data)) ) {
      // $this->sync_etudiants($id, $etudiants);
    }
    
    return $result;
  }

  // delete data
  function delete($id)
  {
      return $this->db->where($this->pk, $id)->delete($this->table);
  }
  
  function get_list()
  {
    $this->db->join('annee_scolaires as annees', "annees.id = {$this->table}.id_annee and annees.active = 1");
    
    $this->db->select(["{$this->table}.id", "{$this->table}.label"]);
    
    $results = $this->db->get($this->table)->result();
    
    return array_reduce($results, function ($memo, $item) {
      $memo[$item->id] = $item->label;
      
      return $memo;
    }, []);
  }
  
  // function get_list_with_niveaux() {
  //   $this->db->select(["{$this->table}.id", "{$this->table}.label", 'niveaux.label as niveau']);
  //   $this->db->join('niveaux', 'niveaux.id = groupes.id_niveau');
  //   // TODO set the current year criteria
  //   $results = $this->db->get($this->table)->result();
    
  //   return array_reduce($results, function ($memo, $item) {
  //     if (! isset($memo[$item->niveau]) ) $memo[$item->niveau] = array();
      
  //     $memo[$item->niveau][$item->id] = $item->label;
      
  //     return $memo;
  //   }, []);
  // }
  
  function get_etudiants($group_id) {
    $this->db->select('etudiants.*')->from('etudiants');
    $this->db->join('etudiants_groups as eg', 'eg.id_etudiant = etudiants.id');
    $this->db->where('eg.id_group', $group_id);
    return $this->db->get()->result();
  }
  
  function sync_etudiants($group, $etudiants = []) {
    // detach the previous students
    $this->db->where('id_group', $group)->delete('etudiants_groups');
    
    // create pivot table records
    $data = array_map(function ($id) use($group) {
      return ['id_group' => $group, 'id_etudiant' => $id];
    }, $etudiants);
    
    if ( empty($data) ) return false;
    
    // attach the new students
    return $this->db->insert_batch('etudiants_groups', $data);
  }
  
}
