<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Annees extends MY_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    $this->load->model('Annee');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('annees-scolaires');
    $config['total_rows'] = $this->Annee->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $annees = $this->Annee->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view('template/layout', [
      'q' => $q,
      'start' => $start,
      'records' => $annees,
      'total_rows' => $config['total_rows'],
      'content_view' => 'annees/annees_list',
      'pagination' => $this->pagination->create_links(),
    ]);
  }

  public function read($id) 
  {
    $row = $this->Annee->get_by_id($id);
    
    if ( $row ) {
      $this->load->view('template/layout', [
        'record' => $row,
        'content_view' => 'annees/annees_read',
      ]);
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('annees-scolaires'));
    }
  }

  public function create() 
  {
    $data = array(
      'button' => 'Créer',
      'content_view' => 'annees/annees_form',
      'action' => site_url('annees-scolaires/create_action'),
      'id' => set_value('id'),
      'active' => set_value('active'),
      'label' => set_value('label'),
      'date_debut' => set_value('date_debut'),
      'date_fin' => set_value('date_fin'),
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
        'active' => $this->input->post('active',TRUE),
        'label' => $this->input->post('label',TRUE),
        'date_debut' => $this->input->post('date_debut',TRUE),
        'date_fin' => $this->input->post('date_fin',TRUE),
      );

      $this->Annee->insert($data);
      $this->session->set_flashdata('message', 'Création réussie');
      redirect(site_url('annees-scolaires'));
    }
  }

  public function update($id) 
  {
    $row = $this->Annee->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Modifier',
        'content_view' => 'annees/annees_form',
        'action' => site_url('annees-scolaires/update_action'),
        'id' => set_value('id', $row->id),
        'active' => set_value('active', $row->active),
        'label' => set_value('label', $row->label),
        'date_debut' => set_value('date_debut', $row->date_debut),
        'date_fin' => set_value('date_fin', $row->date_fin),
        );
      
      $this->load->view('template/layout', $data);
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('annees-scolaires'));
    }
  }

  public function update_action() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id', TRUE));
    } else {
      $data = array(
        'active' => $this->input->post('active',TRUE),
        'label' => $this->input->post('label',TRUE),
        'date_debut' => $this->input->post('date_debut',TRUE),
        'date_fin' => $this->input->post('date_fin',TRUE),
      );

      $this->Annee->update($this->input->post('id', TRUE), $data);
      $this->session->set_flashdata('message', 'Modifications appliquées');
      redirect(site_url('annees-scolaires'));
    }
  }

  public function delete($id) 
  {
    $row = $this->Annee->get_by_id($id);

    if ($row) {
      $this->Annee->delete($id);
      $this->session->set_flashdata('message', 'Suppression réussie');
      redirect(site_url('annees-scolaires'));
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('annees-scolaires'));
    }
  }
  
  public function activate($id) {
    $row = $this->Annee->get_by_id($id);
    
    if ( $row ) {
      $this->Annee->activate($id);
      $this->session->set_flashdata('message', 'Modifications appliquées');
      redirect(site_url('annees-scolaires'));
    }
    else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('annees-scolaires'));
    }
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('active', 'active', 'trim|required');
    $this->form_validation->set_rules('label', 'label', 'trim|required');
    $this->form_validation->set_rules('date_debut', 'date début', 'trim');
    $this->form_validation->set_rules('date_fin', 'date fin', 'trim');
    
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}
