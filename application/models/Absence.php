<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absence extends CI_Model
{

  public $pk = 'id';
  public $table = 'absences';
  // public $view = "absences_details";
  public $search_columns = [ 'matieres.label', 'nom', 'prenom', 'code' ];


  function __construct()
  {
      parent::__construct();
      
      $this->load->model('Seance');
  }

  // get all
  function get_all($limit = 15, $start = 0, $q = null)
  {
      return $this->get_limit_data($limit, $start, $q);
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db->select([
      "{$this->table}.*",
      'matieres.label as matiere',
      'seances.date_debut', 'seances.date_fin',
      'etudiants.code', 'etudiants.nom', 'etudiants.prenom',
    ]);
    
    $this->db->join('seances', "seances.id = {$this->table}.id_seance");
    $this->db->join('matieres', 'matieres.id = seances.id_matiere');
    $this->db->join('etudiants', "etudiants.id = {$this->table}.id_etudiant");
    
    $this->db->where("{$this->table}.statut", FALSE);
    $this->db->where($this->table . '.' . $this->pk, $id);
    
    return $this->db->get($this->table)->row();
  }
  
  // get total rows
  function total_rows($q = NULL) {
    if ( $q ) {
      $this->db->group_start();
      foreach ( $this->search_columns as $col ) {
        $this->db->or_like($col, $q);
      }
      $this->db->group_end();
    }
    
    $this->db->join('seances', "seances.id = {$this->table}.id_seance");
    $this->db->join('matieres', 'matieres.id = seances.id_matiere');
    $this->db->join('etudiants', "etudiants.id = {$this->table}.id_etudiant");
    
    $this->db->where("{$this->table}.statut", FALSE);
     
    return $this->db->count_all_results($this->table);
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    if ( $q ) {
      $this->db->group_start();
      foreach ( $this->search_columns as $col ) {
        $this->db->or_like($col, $q);
      }
      $this->db->group_end();
    }
    
    $this->db->select([
      "{$this->table}.*",
      'matieres.label as matiere',
      'seances.date_debut', 'seances.date_fin',
      'etudiants.code', 'etudiants.nom', 'etudiants.prenom',
    ]);
    
    $this->db->join('seances', "seances.id = {$this->table}.id_seance");
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
  
}
