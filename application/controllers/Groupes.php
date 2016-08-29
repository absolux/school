<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Groupes extends MY_Controller
{
  
  protected $per_page = 15;
  
  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Groupe');
    $this->load->model('Annee');
    $this->load->model('Niveau');
    $this->load->model('Filiere');
    $this->load->model('Etudiant');
  }
  
  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('groupes');
    $config['total_rows'] = $this->Groupe->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $groupes = $this->Groupe->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view('template/layout', [
      'q' => $q,
      'start' => $start,
      'records' => $groupes,
      'total_rows' => $config['total_rows'],
      'content_view' => 'groupes/groupes_list',
      'pagination' => $this->pagination->create_links(),
    ]);
  }
  
  public function read($id) 
  {
    $row = $this->Groupe->get_by_id($id);
    
    if ( $row ) {
      $this->load->view('template/layout', [
        'record' => $row,
        'content_view' => 'groupes/groupes_read',
        'etudiants' => $this->Groupe->get_etudiants($id),
      ]);
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('groupes'));
    }
  }
  
  public function create() 
  {
    $data = array(
      'button' => 'Créer',
      'action' => site_url('groupes/create_action'),
      'id' => set_value('id'),
      'label' => set_value('label'),
      'id_annee' => set_value('id_annee'),
      'id_niveau' => set_value('id_niveau'),
      'id_filiere' => set_value('id_filiere'),
      'content_view' => 'groupes/groupes_form',
      'annees' => $this->Annee->get_active_list(),
      'niveaux' => $this->Niveau->get_list(),
      'filieres' => $this->Filiere->get_list(),
      'list_etudiants' => $this->Etudiant->get_list(),
      'etudiants' => set_value('etudiants[]', [], FALSE),
    );
    
    $this->load->view('template/layout', $data);
  }
  
  public function create_action() 
  {
    $this->_rules();
    
    if ( $this->form_validation->run() == FALSE ) $this->create();
    else {
      $this->Groupe->insert($this->input->post([
        'label', 'id_annee', 'id_niveau', 'id_filiere', 'etudiants'
      ], TRUE));
      
      $this->session->set_flashdata('message', 'Création réussie');
      redirect(site_url('groupes'));
    }
  }

  public function update($id) 
  {
    $row = $this->Groupe->get_by_id($id);
    
    $etudiant_ids = array_map(function ($item) {
      return $item->id;
    }, $this->Groupe->get_etudiants($id));

    if ($row) {
      $data = array(
        'button' => 'Modifier',
        'action' => site_url('groupes/update_action'),
        'id' => set_value('id', $row->id),
        'label' => set_value('label', $row->label),
        'id_niveau' => set_value('id_niveau', $row->id_niveau),
        'id_annee' => set_value('id_annee', $row->id_annee),
        'id_filiere' => set_value('id_filiere', $row->id_filiere),
        'content_view' => 'groupes/groupes_form',
        'annees' => $this->Annee->get_active_list(),
        'niveaux' => $this->Niveau->get_list(),
        'filieres' => $this->Filiere->get_list(),
        'list_etudiants' => $this->Etudiant->get_list(),
        'etudiants' => set_value('etudiants[]', $etudiant_ids, FALSE),
      );
      
      $this->load->view('template/layout', $data);
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect(site_url('groupes'));
    }
  }

  public function update_action() 
  {
    $id = $this->input->post('id', TRUE);
    
    $this->_rules();
    
    if ($this->form_validation->run() == FALSE) $this->update($id);
    else {
      $data = $this->input->post([
        'label', 'id_annee', 'id_niveau', 'id_filiere', 'etudiants'
      ], TRUE);
      
      $this->Groupe->update($id, $data);
      
      $this->session->set_flashdata('message', 'Modifications appliquées');
      redirect(site_url('groupes'));
    }
  }

  public function delete($id) 
  {
    $row = $this->Groupe->get_by_id($id);

    if ($row) {
      $this->Groupe->delete($id);
      
      $this->session->set_flashdata('message', 'Suppression réussie');
    } else {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
    }
    
    redirect(site_url('groupes'));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_rules('label', 'nom', 'trim|required');
    $this->form_validation->set_rules('etudiants[]', 'étudiants', 'required');
    $this->form_validation->set_rules('id_niveau', 'niveau', 'trim|required');
    $this->form_validation->set_rules('id_filiere', 'filière', 'trim|required');
    $this->form_validation->set_rules('id_annee', 'Année scolaire', 'trim|required');
  }

}
