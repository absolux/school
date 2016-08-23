<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Semestres extends CI_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    $this->load->model('Semestre');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('semestres');
    $config['total_rows'] = $this->Semestre->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $semestres = $this->Semestre->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view('template/layout', [
      'q' => $q,
      'start' => $start,
      'records' => $semestres,
      'total_rows' => $config['total_rows'],
      'content_view' => 'semestres/semestres_list',
      'pagination' => $this->pagination->create_links(),
    ]);
  }

  public function read($id) 
  {
    $row = $this->Semestre->get_by_id($id);
    
    if ( $row ) {
      $this->load->view('template/layout', [
        'record' => $row,
        'content_view' => 'semestres/semestres_read',
      ]);
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('semestres'));
    }
  }

  public function create() 
  {
    $data = array(
      'button' => 'Créer',
      'content_view' => 'semestres/semestres_form',
      'action' => site_url('semestres/create_action'),
      'id' => set_value('id'),
      'label' => set_value('label'),
    );
    
    $this->load->view('template/layout', $data);
  }

  public function create_action() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $data = array(
        'label' => $this->input->post('label',TRUE),
      );

      $this->Semestre->insert($data);
      $this->session->set_flashdata('message', 'Création réussie');
      redirect(site_url('semestres'));
    }
  }

  public function update($id) 
  {
    $row = $this->Semestre->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Modifier',
        'content_view' => 'semestres/semestres_form',
        'action' => site_url('semestres/update_action'),
        'id' => set_value('id', $row->id),
        'label' => set_value('label', $row->label),
        );
      
      $this->load->view('template/layout', $data);
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('semestres'));
    }
  }

  public function update_action() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'label' => $this->input->post('label', TRUE),
      );

      $this->Semestre->update($this->input->post('id', TRUE), $data);
      $this->session->set_flashdata('message', 'Modifications appliquées');
      redirect(site_url('semestres'));
    }
  }

  public function delete($id) 
  {
    $row = $this->Semestre->get_by_id($id);

    if ($row) {
      $this->Semestre->delete($id);
      $this->session->set_flashdata('message', 'Suppression réussie');
      redirect(site_url('semestres'));
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('semestres'));
    }
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('label', 'nom', 'trim|required');
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}