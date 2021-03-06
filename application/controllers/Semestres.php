<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Semestres extends MY_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Semestre');
    $this->load->model('Annee');
  }

  // public function index()
  // {
  //   $q = urldecode($this->input->get('q', TRUE));
  //   $start = intval($this->input->get('start'));
    
  //   $config['per_page'] = $this->per_page;
  //   $config['base_url'] = base_url('semestres');
  //   $config['total_rows'] = $this->Semestre->total_rows($q);
    
  //   $this->load->library('pagination');
  //   $this->pagination->initialize($config);
    
  //   $semestres = $this->Semestre->get_limit_data($this->per_page, $start, $q);
    
  //   $this->load->view('template/layout', [
  //     'q' => $q,
  //     'start' => $start,
  //     'records' => $semestres,
  //     'total_rows' => $config['total_rows'],
  //     'content_view' => 'semestres/semestres_list',
  //     'pagination' => $this->pagination->create_links(),
  //   ]);
  // }

  // public function read($id) 
  // {
  //   $row = $this->Semestre->get_by_id($id);
    
  //   if ( $row ) {
  //     $this->load->view('template/layout', [
  //       'record' => $row,
  //       'content_view' => 'semestres/semestres_read',
  //     ]);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('semestres'));
  //   }
  // }

  // public function create() 
  // {
  //   $active_year = $this->Annee->get_active();
    
  //   $data = array(
  //     'button' => 'Créer',
  //     'content_view' => 'semestres/semestres_form',
  //     'action' => site_url('semestres/create_action'),
  //     'id' => set_value('id'),
  //     'label' => set_value('label'),
  //     'id_annee' => set_value('id_annee', $active_year ? $active_year->id : NULL),
      
  //     'annees' => $this->Annee->get_active_list(),
  //   );
    
  //   $this->load->view('template/layout', $data);
  // }

  // public function create_action() 
  // {
  //   $this->_rules();

  //   if ($this->form_validation->run() == FALSE) {
  //     $this->create();
  //   } else {
  //     $data = [
  //       'active' => TRUE,
  //       'label' => $this->input->post('label',TRUE),
  //       'id_annee' => $this->input->post('id_annee', TRUE),
  //     ];

  //     $this->Semestre->insert($data);
  //     $this->session->set_flashdata('message', 'Création réussie');
  //     redirect(site_url('semestres'));
  //   }
  // }

  // public function update($id) 
  // {
  //   $row = $this->Semestre->get_by_id($id);

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
  //       'content_view' => 'semestres/semestres_form',
  //       'action' => site_url('semestres/update_action'),
  //       'id' => set_value('id', $row->id),
  //       'label' => set_value('label', $row->label),
  //       'id_annee' => set_value('id_annee', $row->id_annee),
        
  //       'annees' => $this->Annee->get_active_list(),
  //     );
      
  //     $this->load->view('template/layout', $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('semestres'));
  //   }
  // }

  // public function update_action() 
  // {
  //   $this->_rules();

  //   if ($this->form_validation->run() == FALSE) {
  //     $this->update($this->input->post('id', TRUE));
  //   } else {
  //     $data = array(
  //       'label' => $this->input->post('label', TRUE),
  //       'id_annee' => $this->input->post('id_annee', TRUE),
  //     );

  //     $this->Semestre->update($this->input->post('id', TRUE), $data);
  //     $this->session->set_flashdata('message', 'Modifications appliquées');
  //     redirect(site_url('semestres'));
  //   }
  // }

  // public function delete($id) 
  // {
  //   $row = $this->Semestre->get_by_id($id);

  //   if ($row) {
  //     $this->Semestre->delete($id);
  //     $this->session->set_flashdata('message', 'Suppression réussie');
  //     redirect(site_url('semestres'));
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('semestres'));
  //   }
  // }
  
  public function activate($id) 
  {
    $row = $this->Semestre->get_by_id($id);

    if (! $row ) {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('semestres'));
    }
    
    if ( $this->Semestre->activate($id, $row->id_annee) )
      $this->session->set_flashdata('success', 'Activation réussie');
    
    redirect(site_url("annees-scolaires/read/{$row->id_annee}"));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('label', 'nom', 'trim|required');
    $this->form_validation->set_rules('id_annee', 'Année scolaire', 'trim|required');
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}