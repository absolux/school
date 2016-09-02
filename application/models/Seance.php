<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Seance extends CI_Model
{

  public $pk = 'id';
  public $table = 'seances';
  public $search_columns = [  ];


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
    
    // $this->db->order_by('label');
    
    return $this->db->limit($limit, $start)->get($this->table)->result();
  }

  // insert data
  function insert($data)
  {
    $presence = $data['presence'];
    unset($data['presence']);
    
    if ( ($result = $this->db->insert($this->table, $data)) ) {
      $this->sync_presence($this->db->insert_id(), $presence);
    }
    
    return $result;
  }

  // update data
  function update($id, $data)
  {
    $presence = $data['presence'];
    unset($data['presence']);
    
    $this->db->where($this->pk, $id);
    
    if ( ($result = $this->db->update($this->table, $data)) ) {
      $this->sync_presence($id, $presence);
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
    $results = $this->db->select(['id', 'label'])->get($this->table)->result();
    
    return array_reduce($results, function ($memo, $item) {
      $memo[$item->id] = $item->label;
      
      return $memo;
    }, []);
  }
  
  function get_presence($id_seance) {
    
  }
  
  function sync_presence($id, $presence) {
    $this->db->where('id_seance', $id)->delete('absences');
    
    $data = array_map(function ($item) use ($id) {
      return [
        'id_seance' => $id,
        'statut' => $item['statut'],
        'id_etudiant' => $item['id_etudiant'],
      ];
    }, $presence);
    
    if ( empty($data) ) return FALSE;
    
    return $this->db->insert_batch('absences', $data);
  }

}