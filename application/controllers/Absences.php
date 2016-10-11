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
    $this->load->model('Semestre');
    $this->load->model('Etudiant');
  }

  public function index()
  {
    $e = urldecode($this->input->get('e', TRUE)); // id_etudiant
    $d = urldecode($this->input->get('d', TRUE)); // date_debut
    $m = urldecode($this->input->get('m', TRUE)); // id_matiere
    $s = urldecode($this->input->get('s', TRUE)); // id_semestre
    $start = intval($this->input->get('start'));
    
    $active_semestre = $this->Semestre->get_active();
    $active_semestre = $active_semestre ? $active_semestre->id : NULL;
    
    if ( empty($s) ) $s = $active_semestre;
    else if ( $s === 'all' ) $s = '';
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('absences');
    $config['total_rows'] = $this->Absence->total_rows($e, $d, $m, $s);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $absences = $this->Absence->get_limit_data($this->per_page, $start, $e, $d, $m, $s);
    
    $this->load->view($this->layout, [
      'e' => $e,
      'd' => $d,
      'm' => $m,
      's' => $s,
      'start' => $start,
      'records' => $absences,
      'content_view' => 'absences/list',
      'total_rows' => $config['total_rows'],
      'active_semestre' => $active_semestre,
      'pagination' => $this->pagination->create_links(),
      
      'groupes' => $this->Groupe->get_list(),
      'matieres' => $this->Matiere->get_list(),
      'semestres' => $this->Semestre->get_list(),
      'etudiants' => $this->Etudiant->get_list(),
    ]);
  }
  
  public function recap() {
    $id_annee = $this->input->get('id_annee', TRUE);
    $id_group = $this->input->get('id_group', TRUE);
    
    $this->load->model('Annee');
    
    if ( empty($id_annee) ) {
      $active_year = $this->Annee->get_active();
      $id_annee = $active_year ? $active_year->id : $id_annee;
    }
    
    $semestres = $this->Annee->get_semestres_ids($id_annee);
    
    $this->load->view($this->layout, [
      'content_view' => 'absences/recap',
      
      'records' => $this->Absence->get_recap($semestres, $id_group),
      'classes' => $this->Groupe->get_annee_list($id_annee),
      'annees' => $this->Annee->get_list(),
      'id_annee' => $id_annee,
      'id_group' => $id_group,
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
  //     $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
  //     redirect(site_url('absences'));
  //   }
  // }

  public function create() 
  {
    $group_id = $this->input->get('id_group', TRUE);
    
    if (! $this->Groupe->exists($group_id) ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect('absences');
    }
    
    $active_semestre = $this->Semestre->get_active();
    $active_semestre = $active_semestre ? $active_semestre->id : NULL;
    
    $data = array(
      'create' => TRUE,
      'content_view' => 'absences/read',
      'action' => site_url('absences/create_action'),
      
      'id' => set_value('id'),
      'id_matiere' => set_value('id_matiere'),
      'id_semestre' => set_value('id_semestre', $active_semestre),
      'id_group' => set_value('id_group', $group_id),
      'date_debut' => set_value('date_debut'),
      'title' => set_value('title', "Séance 1"),
      
      'matieres' => $this->Matiere->get_list(),
      'semestres' => $this->Semestre->get_list(),
      'etudiants' => $this->Groupe->get_etudiants($group_id),
    );
    
    $this->load->view($this->layout, $data);
  }

  public function create_action() 
  { 
    $this->_rules();

    if ( $this->form_validation->run() == FALSE ) return $this->create();
    
    $data = $this->input->post([
      'id_matiere', 'id_group', 'date_debut', 'presence', 'id_semestre', 'title'
    ], TRUE);
    
    if ( $this->Seance->insert($data) )
      $this->session->set_flashdata('success', 'Création réussie');
      
    redirect(site_url('absences')); 
  }

  public function update($id_seance) 
  {
    $row = $this->Seance->get_by_id($id_seance);

    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('absences'));
    }
    
    $data = array(
      'create' => FALSE,
      'content_view' => 'absences/read',
      'action' => site_url('absences/update_action'),
      
      'id' => set_value('id', $row->id),
      'id_matiere' => set_value('id_matiere', $row->id_matiere),
      'id_semestre' => set_value('id_semestre', $row->id_semestre),
      'id_group' => set_value('id_group', $row->id_group),
      'date_debut' => set_value('date_debut', date('Y-m-d', strtotime($row->date_debut))),
      'title' => set_value('title', $row->title),
      
      'matieres' => $this->Matiere->get_list(),
      'semestres' => $this->Semestre->get_list(),
      'etudiants' => $this->Groupe->get_etudiants($row->id_group),
      'presence' => $this->Seance->get_presence($id_seance),
    );
    
    $this->load->view($this->layout, $data);
  }

  public function update_action() 
  {
    $this->_rules();
    
    $id = $this->input->post('id', TRUE);

    if ($this->form_validation->run() == FALSE) return $this->update($id);
    
    $data = $this->input->post([
      'id_matiere', 'id_group', 'date_debut', 'presence', 'id_semestre', 'title'
    ], TRUE);

    if ( $this->Seance->update($id, $data) )
      $this->session->set_flashdata('success', 'Modifications appliquées');
    
    redirect(site_url('absences'));
  }

  public function delete($id) 
  {
    $row = $this->Absence->get_by_id($id);
    
    if (! $row) $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
    else if ( $this->Absence->setPresent($id) ) $this->session->set_flashdata('success', 'Suppression réussie');
    
    redirect(site_url('absences'));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    // $this->form_validation->set_rules('date_fin', 'Date fin', 'trim');
    $this->form_validation->set_rules('title', 'Libellé', 'trim|required');
    $this->form_validation->set_rules('date_debut', 'Date début', 'trim|required');
    $this->form_validation->set_rules('id_group', 'Groupe', 'trim|required');
    $this->form_validation->set_rules('id_matiere', 'Matière', 'trim|required');
    $this->form_validation->set_rules('id_semestre', 'Semestre', 'trim|required');
    // $this->form_validation->set_rules('id_prof', 'Formateur', 'trim|required');
    
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}
