<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absence extends CI_Model
{

  public $pk = 'id';
  public $table = 'absences';
  // public $view = "absences_details";
  // public $search_columns = [ 'nom', 'prenom', 'code' ];


  function __construct()
  {
      parent::__construct();
      
      $this->load->model('Seance');
  }

  // get all
  function get_all($limit = 15, $start = 0, $e = NULL, $d = NULL, $m = NULL, $s = NULL)
  {
      return $this->get_limit_data($limit, $start, $e, $d, $m, $s);
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db->select([
      "{$this->table}.*",
      'matieres.label as matiere',
      'semestres.label as semestre',
      'seances.date_debut', 'seances.date_fin',
      'etudiants.code', 'etudiants.nom', 'etudiants.prenom',
    ]);
    
    $this->db->join('seances', "seances.id = {$this->table}.id_seance");
    $this->db->join('semestres', "seances.id_semestre = semestres.id", 'left');
    $this->db->join('matieres', 'matieres.id = seances.id_matiere');
    $this->db->join('etudiants', "etudiants.id = {$this->table}.id_etudiant");
    
    $this->db->where("{$this->table}.statut", 0);
    $this->db->where($this->table . '.' . $this->pk, $id);
    
    return $this->db->get($this->table)->row();
  }
  
  // get total rows
  function total_rows($e = NULL, $d = NULL, $m = NULL, $s = NULL) {
    if ( $e ) $this->db->where("{$this->table}.id_etudiant", $e);
    
    if ( $d ) $this->db->where('seances.date_debut', $d);
    
    if ( $m ) $this->db->where('seances.id_matiere', $m);
      
    if ( $s ) $this->db->where_in('seances.id_semestre', $s);
    
    $this->db->join('seances', "seances.id = {$this->table}.id_seance");
    
    $this->db->where("{$this->table}.statut", 0);
     
    return $this->db->count_all_results($this->table);
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $e = NULL, $d = NULL, $m = NULL, $s = NULL) {
    if ( $e ) $this->db->where("{$this->table}.id_etudiant", $e);
    
    if ( $d ) $this->db->where('seances.date_debut', $d);
    
    if ( $m ) $this->db->where('seances.id_matiere', $m);
      
    if ( $s ) $this->db->where_in('seances.id_semestre', $s);
    
    $this->db->select([
      "{$this->table}.*",
      'matieres.label as matiere',
      'semestres.label as semestre',
      'seances.title as seance_title',
      'seances.date_debut', 'seances.date_fin',
      'etudiants.code', 'etudiants.nom', 'etudiants.prenom',
    ]);
    
    $this->db->join('seances', "seances.id = {$this->table}.id_seance");
    $this->db->join('semestres', "seances.id_semestre = semestres.id", 'left');
    $this->db->join('matieres', 'matieres.id = seances.id_matiere');
    $this->db->join('etudiants', "etudiants.id = {$this->table}.id_etudiant");
    
    $this->db->where("{$this->table}.statut", FALSE);
    $this->db->order_by('seances.date_debut', 'DESC');
    
    return $this->db->limit($limit, $start)->get($this->table)->result();
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
  
  // change status to `present`
  function setPresent($id) {
    return $this->db->set('statut', 1)->where($this->pk, $id)->update($this->table);
  }
  
  function get_recap($semestres, $id_group = null) {
    $i = 0;
    $subQueries = [];
    $groupQuery = null;
    
    for ( $i = 1; $i <= count($semestres); $i++ ) {
      $this->db->select("count(*)");
      $this->db->from("{$this->table} as a");
      $this->db->join('seances as s', "s.id = a.id_seance");
      $this->db->where('a.statut', 0);
      $this->db->where('a.id_etudiant = etudiants.id');
      $this->db->where('s.id_semestre', $semestres[$i - 1]);
      
      $subQueries[] = "({$this->db->get_compiled_select()}) as s{$i}";
    }
    
    if ( $id_group ) {
      $this->db->select('id_etudiant');
      $this->db->from('etudiants_groups');
      $this->db->where('id_group', $id_group);
      
      $groupQuery = $this->db->get_compiled_select();
    }
    
    $this->db->select(array_merge(['etudiants.*'], $subQueries));
    $this->db->from('etudiants');
    $this->db->order_by('code');
    
    if ( $groupQuery ) $this->db->where_in('id', $groupQuery, FALSE);
    // var_dump($this->db->get_compiled_select());
    return $this->db->get()->result();
  }
  
}
