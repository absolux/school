<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Groupe extends CI_Model
{

  public $table = 'groupes';
  public $view = "groupes_details";
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
    // $this->db->select(['groupes.*', 'annees.label as annee', 'filieres.label as filiere', 'niveaux.label as niveau']);
    // $this->db->order_by('groupes.label');
    // $this->db->join('annee_scolaires as annees', 'annees.id = groupes.id_annee');
    // $this->db->join('niveaux', 'niveaux.id = groupes.id_niveau');
    // $this->db->join('filieres', 'filieres.id = groupes.id_filiere');
    $this->db->where($this->view . '.' . $this->pk, $id);
    return $this->db->get($this->view)->row();
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
    
    return $this->db->limit($limit, $start)->get($this->view)->result();
  }

  // insert data
  function insert($data)
  {
      return $this->db->insert($this->table, $data);
  }

  // update data
  function update($id, $data)
  {
      return $this->db->where($this->pk, $id)->update($this->table, $data);
  }

  // delete data
  function delete($id)
  {
      return $this->db->where($this->pk, $id)->delete($this->table);
  }
  
  function get_list()
  {
    $results = $this->db->select(['id', 'label'])->get($this->table)->result();
    
    return array_reduce($results, function ($memo, $item) {
      $memo[$item->id] = $item->label;
      
      return $memo;
    }, []);
  }

}