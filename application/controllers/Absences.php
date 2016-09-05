<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Absences extends MY_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Matiere');
    $this->load->model('Absence');
    $this->load->model('Seance');
    $this->load->model('Groupe');
    // $this->load->model('Annee');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('absences');
    $config['total_rows'] = $this->Absence->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $absences = $this->Absence->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view('template/layout', [
      'q' => $q,
      'start' => $start,
      'records' => $absences,
      'total_rows' => $config['total_rows'],
      'content_view' => 'absences/list',
      'pagination' => $this->pagination->create_links(),
      
      'groupes' => $this->Groupe->get_list_with_niveaux(),
    ]);
  }

  // public function read($id) 
  // {
  //   $row = $this->Absence->get_by_id($id);
    
  //   if ( $row ) {
  //     $this->load->view('template/layout', [
  //       'record' => $row,
  //       'content_view' => 'absences/read',
  //     ]);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('absences'));
  //   }
  // }

  public function create() 
  {
    $group_id = $this->input->get('id_group', TRUE);
    
    if (! $this->Groupe->exists($group_id) ) {
      $this->session->set_flashdata('message', 'Aucun résultat trouvé');
      redirect('absences');
      return;
    }
    
    $data = array(
      'button' => 'Créer',
      'content_view' => 'absences/form',
      'action' => site_url('absences/create_action'),
      
      'id' => set_value('id'),
      'id_matiere' => set_value('id_matiere'),
      'id_group' => set_value('id_group', $group_id),
      'date_debut' => set_value('date_debut'),
      // 'date_fin' => set_value('date_fin'),
      // 'id_prof' => set_value('id_prof'),
      'matieres' => $this->Matiere->get_list(),
      'etudiants' => $this->Groupe->get_etudiants($group_id),
    );
    
    $this->load->view($this->layout, $data);
  }

  public function create_action() 
  { 
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $this->Seance->insert($this->input->post([
        'id_matiere', 'id_group', 'date_debut', 'presence'
      ], TRUE));

      $this->session->set_flashdata('message', 'Création réussie');
      redirect(site_url('absences'));
    }
  }

  // public function update($id_seance) 
  // {
  //   $row = $this->Seance->get_by_id($id_seance);

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
  //       'content_view' => 'absences/form',
  //       'action' => site_url('absences/update_action'),
  //       'id' => set_value('id', $row->id),
  //       'label' => set_value('label', $row->label),
  //       'description' => set_value('description', $row->description),
  //       );
      
  //     $this->load->view('template/layout', $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('absences'));
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
  //       'description' => $this->input->post('description', TRUE),
  //     );

  //     $this->Absence->update($this->input->post('id', TRUE), $data);
  //     $this->session->set_flashdata('message', 'Modifications appliquées');
  //     redirect(site_url('absences'));
  //   }
  // }

  // public function delete($id) 
  // {
  //   $row = $this->Absence->get_by_id($id);

  //   if ($row) {
  //     $this->Absence->delete($id);
  //     $this->session->set_flashdata('message', 'Suppression réussie');
  //     redirect(site_url('absences'));
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('absences'));
  //   }
  // }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    // $this->form_validation->set_rules('date_fin', 'Date fin', 'trim');
    // $this->form_validation->set_rules('label', 'nom', 'trim|required');
    $this->form_validation->set_rules('date_debut', 'Date début', 'trim|required');
    $this->form_validation->set_rules('id_group', 'Groupe', 'trim|required');
    $this->form_validation->set_rules('id_matiere', 'Matière', 'trim|required');
    // $this->form_validation->set_rules('id_prof', 'Formateur', 'trim|required');
    
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}
