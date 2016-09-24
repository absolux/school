<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Groupes extends MY_Controller
{
  
  protected $per_page = 15;
  
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Groupe');
    $this->load->model('Annee');
    // $this->load->model('Niveau');
    $this->load->model('Filiere');
    $this->load->model('Etudiant');
  }
  
  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('classes');
    $config['total_rows'] = $this->Groupe->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $groupes = $this->Groupe->get_limit_data($this->per_page, $start, $q);
    $active_year = $this->Annee->get_active();
    
    $this->load->view($this->layout, [
      'q' => $q,
      'start' => $start,
      'records' => $groupes,
      'total_rows' => $config['total_rows'],
      'content_view' => 'groupes/groupes_list',
      'pagination' => $this->pagination->create_links(),
      
      'filieres' => $this->Filiere->get_list(),
      'annees' => $this->Annee->get_list(),
      
      'label' => set_value('label'),
      'id_annee' => set_value('id_annee', $active_year ? $active_year->id : NULL),
      'id_filiere' => set_value('id_filiere'),
    ]);
  }
  
  public function read($id) 
  {
    $row = $this->Groupe->get_by_id($id);
    
    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('classes'));
    }
    
    $this->load->view($this->layout, [
      'content_view' => 'groupes/groupes_read',
      'action' => site_url('classes/update_action'),
      
      'id' => set_value('id', $row->id),
      'label' => set_value('label', $row->label),
      'id_annee' => set_value('id_annee', $row->id_annee),
      'id_filiere' => set_value('id_filiere', $row->id_filiere),
      
      'annees' => $this->Annee->get_list(),
      'filieres' => $this->Filiere->get_list(),
      'etudiants' => $this->Groupe->get_etudiants($id),
    ]);
  }
  
  // public function create() 
  // {
  //   $active_year = $this->Annee->get_active();
    
  //   $data = array(
  //     'button' => 'Créer',
  //     'action' => site_url('groupes/create_action'),
  //     'id' => set_value('id'),
  //     'label' => set_value('label'),
  //     'id_annee' => set_value('id_annee', $active_year ? $active_year->id : NULL),
  //     // 'id_niveau' => set_value('id_niveau'),
  //     'id_filiere' => set_value('id_filiere'),
  //     'content_view' => 'groupes/groupes_form',
  //     'annees' => $this->Annee->get_active_list(),
  //     // 'niveaux' => $this->Niveau->get_list(),
  //     'filieres' => $this->Filiere->get_list(),
  //     'list_etudiants' => $this->Etudiant->get_list(),
  //     'etudiants' => set_value('etudiants[]', [], FALSE),
  //   );
    
  //   $this->load->view($this->layout, $data);
  // }
  
  public function create_action() 
  {
    $this->_rules();
    
    if ( $this->form_validation->run() == FALSE ) return $this->index();
    
    $data = $this->input->post(['label', 'id_annee', 'id_filiere'], TRUE);
    
    if ( $this->Groupe->insert($data) )
      $this->session->set_flashdata('success', 'Création réussie');
    
    redirect(site_url('classes'));
  }

  // public function update($id) 
  // {
  //   $row = $this->Groupe->get_by_id($id);
    
  //   $etudiant_ids = array_map(function ($item) {
  //     return $item->id;
  //   }, $this->Groupe->get_etudiants($id));

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
        
  //       'content_view' => 'groupes/groupes_form',
  //       'list_etudiants' => $this->Etudiant->get_list(),
  //       'etudiants' => set_value('etudiants[]', $etudiant_ids, FALSE),
  //     );
      
  //     $this->load->view($this->layout, $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('classes'));
  //   }
  // }

  public function update_action() 
  {
    $this->_rules();
    
    $id = $this->input->post('id', TRUE);
    
    if ($this->form_validation->run() == FALSE) return $this->read($id);
    
    $data = $this->input->post(['label', 'id_annee', 'id_filiere'], TRUE);
    
    if ( $this->Groupe->update($id, $data) )
      $this->session->set_flashdata('success', 'Modifications appliquées');
    
    redirect(site_url("classes/read/{$id}"));
  }

  public function delete($id) 
  {
    $row = $this->Groupe->get_by_id($id);

    if (! $row ) $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
    else if ( $this->Groupe->delete($id) ) 
      $this->session->set_flashdata('success', 'Suppression réussie');
    
    redirect(site_url('classes'));
  }
  
  public function attach($id) {
    $row = $this->Groupe->get_by_id($id);
    
    if (! $row ) trigger_error("Not Found", E_USER_ERROR);
    
    $this->Groupe->attach_etudiant($id, $this->input->post('etudiant', TRUE));
  }
  
  public function detach($id) {
    $row = $this->Groupe->get_by_id($id);
    
    if (! $row ) trigger_error("Not Found", E_USER_ERROR);
    
    $this->Groupe->detach_etudiant($id, $this->input->post('etudiant', TRUE));
  }

  protected function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_rules('label', 'libellé', 'trim|required');
    // $this->form_validation->set_rules('etudiants[]', 'étudiants', 'required');
    // $this->form_validation->set_rules('id_niveau', 'niveau', 'trim|required');
    $this->form_validation->set_rules('id_filiere', 'filière', 'trim|required');
    $this->form_validation->set_rules('id_annee', 'Année scolaire', 'trim|required');
  }

}
