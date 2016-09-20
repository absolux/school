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
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('annees-scolaires');
    $config['total_rows'] = $this->Annee->total_rows();
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $annees = $this->Annee->get_limit_data($this->per_page, $start);
    
    $this->load->view($this->layout, [
      'records' => $annees,
      'total_rows' => $config['total_rows'],
      'content_view' => 'annees/annees_list',
      'pagination' => $this->pagination->create_links(),
    ]);
  }

  public function read($id) 
  {
    $row = $this->Annee->get_by_id($id);
    
    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('annees-scolaires'));
    } 
    
    $this->load->view($this->layout, [
      'content_view' => 'annees/annees_read',
      'action' => site_url('annees-scolaires/update_action'),
      
      'id' => set_value('id', $row->id),
      'active' => set_value('active', $row->active),
      'label' => set_value('label', $row->label),
      'date_debut' => set_value('date_debut', $row->date_debut),
      'date_fin' => set_value('date_fin', $row->date_fin),
      
      'semestres' => $this->Annee->get_semestres($id),
    ]);
  }

  // public function create() 
  // {
  //   $data = array(
  //     'button' => 'Créer',
  //     'content_view' => 'annees/annees_form',
  //     'action' => site_url('annees-scolaires/create_action'),
  //     'id' => set_value('id'),
  //     'active' => set_value('active', 1),
  //     'label' => set_value('label'),
  //     'date_debut' => set_value('date_debut'),
  //     'date_fin' => set_value('date_fin'),
  //   );
    
  //   $this->load->view('template/layout', $data);
  // }

  public function create_action() 
  {
    $this->_rules();

    if ( $this->form_validation->run() == FALSE ) return $this->index();
    
    $data = $this->input->post(['label', 'active'], TRUE);
    
    if ( $id = $this->Annee->insert($data) )
      $this->session->set_flashdata('success', 'Création réussie');
    
    redirect(site_url("annees-scolaires/read/{$id}"));
  }

  // public function update($id) 
  // {
  //   $row = $this->Annee->get_by_id($id);

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
  //       'content_view' => 'annees/annees_form',
  //       'action' => site_url('annees-scolaires/update_action'),
  //       'id' => set_value('id', $row->id),
  //       'active' => set_value('active', $row->active),
  //       'label' => set_value('label', $row->label),
  //       'date_debut' => set_value('date_debut', $row->date_debut),
  //       'date_fin' => set_value('date_fin', $row->date_fin),
  //     );
      
  //     $this->load->view('template/layout', $data);
  //   } else {
  //     $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
  //     redirect(site_url('annees-scolaires'));
  //   }
  // }

  public function update_action() 
  {
    $id = $this->input->post('id', TRUE);
    
    $this->_rules();

    if ($this->form_validation->run() == FALSE) return $this->read($id);
    
    $data = $this->input->post(['label', 'date_debut', 'date_fin'], TRUE);

    if ( $this->Annee->update($id, $data) ) 
      $this->session->set_flashdata('success', 'Modifications appliquées');
    
    redirect(site_url("annees-scolaires/read/{$id}"));
  }

  public function delete($id) 
  {
    $row = $this->Annee->get_by_id($id);

    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('annees-scolaires'));
    }
    
    if ( $this->Annee->delete($id) )
      $this->session->set_flashdata('success', 'Suppression réussie');
    
    redirect(site_url('annees-scolaires'));
  }
  
  public function activate($id) {
    $row = $this->Annee->get_by_id($id);
    
    $back = $this->input->get('back-to-detail');
    
    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('annees-scolaires'));
    }
    
    if ( $this->Annee->activate($id) )
      $this->session->set_flashdata('success', 'Activation réussie');
    
    redirect(site_url("annees-scolaires" . ($back ? "/read/{$id}" : '')));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('active', 'statut', 'trim');
    $this->form_validation->set_rules('label', 'libellé', 'trim|required');
    $this->form_validation->set_rules('date_debut', 'date début', 'trim');
    $this->form_validation->set_rules('date_fin', 'date fin', 'trim');
    
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}
