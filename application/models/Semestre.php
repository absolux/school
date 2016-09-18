<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Semestre extends CI_Model
{

  public $table = 'semestres';
  public $pk = 'id';
  public $search_columns = [ 'label' ];


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
    $this->db->select(["{$this->table}.*", 'annees.label as annee']);
    
    $this->db->join('annee_scolaires as annees', "annees.id = {$this->table}.id_annee");
    
    return $this->db->get_where($this->table, ["{$this->table}.{$this->pk}" => $id])->row();
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
    
    $this->db->select(["{$this->table}.*", 'annees.label as annee']);
    
    $this->db->join('annee_scolaires as annees', "annees.id = {$this->table}.id_annee");
    
    // $this->db->order_by('label');
    
    return $this->db->limit($limit, $start)->get($this->table)->result();
  }

  // insert data
  function insert($data)
  {
    $this->deactivateAll();
    
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
    $this->db->join('annee_scolaires as annees', "annees.id = {$this->table}.id_annee and annees.active = 1");
    
    $this->db->select(["{$this->table}.id", "{$this->table}.label"]);
    
    $results = $this->db->get($this->table)->result();
    
    return array_reduce($results, function ($memo, $item) {
      $memo[$item->id] = $item->label;
      
      return $memo;
    }, []);
  }
  
  // activate the given semester id
  function activate($id) {
    $this->deactivateAll();
    
    return $this->update($id, ['active' => TRUE]);
  }
  
  // deactivate all semestres
  function deactivateAll() {
    return $this->db->set('active', FALSE)->update($this->table);
  }

}