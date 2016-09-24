<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Niveaux extends MY_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Niveau');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('niveaux');
    $config['total_rows'] = $this->Niveau->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $niveaux = $this->Niveau->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view($this->layout, [
      'q' => $q,
      'start' => $start,
      'records' => $niveaux,
      'total_rows' => $config['total_rows'],
      'content_view' => 'niveaux/niveaux_list',
      'pagination' => $this->pagination->create_links(),
    ]);
  }

  public function read($id) 
  {
    $row = $this->Niveau->get_by_id($id);
    
    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('niveaux'));
    }
    
    $this->load->view($this->layout, [
      'content_view' => 'niveaux/niveaux_read',
      'action' => site_url('niveaux/update_action'),
      
      'id' => set_value('id', $row->id),
      'label' => set_value('label', $row->label),
    ]);
  }

  // public function create() 
  // {
  //   $data = array(
  //     'button' => 'Créer',
  //     'content_view' => 'niveaux/niveaux_form',
  //     'action' => site_url('niveaux/create_action'),
  //     'id' => set_value('id'),
  //     'label' => set_value('label'),
  //   );
    
  //   $this->load->view($this->layout, $data);
  // }

  public function create_action() 
  {
    $this->_rules();

    if ( $this->form_validation->run() == FALSE ) return $this->index();
    
    $data = $this->input->post(['label'], TRUE);

    if ( $this->Niveau->insert($data) )
      $this->session->set_flashdata('success', 'Création réussie');
    
    redirect(site_url('niveaux'));
  }

  // public function update($id) 
  // {
  //   $row = $this->Niveau->get_by_id($id);

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
  //       'content_view' => 'niveaux/niveaux_form',
  //       'id' => set_value('id', $row->id),
  //       'label' => set_value('label', $row->label),
  //       );
      
  //     $this->load->view($this->layout, $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('niveaux'));
  //   }
  // }

  public function update_action() 
  {
    $this->_rules();
    
    $id = $this->input->post('id', TRUE);

    if ($this->form_validation->run() == FALSE) return $this->read($id);
    
    $data = $this->input->post(['label'], TRUE);

    if ( $this->Niveau->update($id, $data) )
      $this->session->set_flashdata('success', 'Modifications appliquées');
    
    redirect(site_url('niveaux'));
  }

  public function delete($id) 
  {
    $row = $this->Niveau->get_by_id($id);

    if (! $row ) $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
    else if ( $this->Niveau->delete($id) ) $this->session->set_flashdata('success', 'Suppression réussie');
    
    redirect(site_url('niveaux'));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('label', 'libellé', 'trim|required');
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}