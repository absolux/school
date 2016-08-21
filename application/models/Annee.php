<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Annee extends CI_Model
{

  public $table = 'annee_scolaires';
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
      return $this->db->get_where($this->table, [$this->pk => $id])->row();
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
    
    $this->db->order_by('label');
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
  
  function get_list()
  {
    return $this->db->select(['id', 'label'])->get($this->table)->result();
  }

}