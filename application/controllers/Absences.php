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
    $this->load->model('Annee');
  }

  public function index()
  {
    $active_semestre = NULL;
    // $this->output->enable_profiler(TRUE);
    $e = urldecode($this->input->get('e', TRUE)); // id_etudiant - student id
    $d = urldecode($this->input->get('d', TRUE)); // date_debut - calendar day
    $m = urldecode($this->input->get('m', TRUE)); // id_matiere - course id
    $s = urldecode($this->input->get('s', TRUE)); // id_semestre - semestre id
    $a = urldecode($this->input->get('a', TRUE)); // id_annee - academic year id
    $start = intval($this->input->get('start', TRUE));
    $export = $this->input->get('export', TRUE);
    
    // we select the active year if not provided
    if ( empty($a) ) $a = $this->session->year;
    
    // we choose the active semestre of the active year as a default period
    if ( empty($s) ) {
      $active_semestre = $this->Semestre->get_active();
      $s = $active_semestre = $active_semestre ? $active_semestre->id : NULL;
    }
    
    // we select only the semestres of the selected year,
    // to prevent using all the semestres of the database
    if ( $s === 'all' ) $s = $this->Annee->get_semestres_ids($a);
    
    $absences = $this->Absence->get_limit_data($this->per_page, $start, $e, $d, $m, (array) $s);
    
    if ( $export === 'xls' ) return $this->to_excel($absences);
    
    // configure the pagination library
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('absences');
    $config['total_rows'] = $this->Absence->total_rows($e, $d, $m, (array) $s);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $this->load->view($this->layout, [
      'a' => $a,
      'e' => $e,
      'd' => $d,
      'm' => $m,
      's' => is_array($s) ? 'all' : $s,
      'start' => $start,
      'records' => $absences,
      'content_view' => 'absences/list',
      'total_rows' => $config['total_rows'],
      'active_semestre' => $active_semestre,
      'pagination' => $this->pagination->create_links(),
      
      'groupes' => $this->Groupe->get_list(),
      'matieres' => $this->Matiere->get_list(),
      'etudiants' => $this->Etudiant->get_list(),
      'semestres' => $this->Semestre->get_list($a),
    ]);
  }
  
  public function recap() {
    $records = [];
    $export = $this->input->get('export', TRUE);
    $id_annee = $this->input->get('id_annee', TRUE);
    $id_group = $this->input->get('id_group', TRUE);
    
    if ( empty($id_annee) ) $id_annee = $this->session->year;
    
    $semestres = $this->Annee->get_semestres_ids($id_annee);
    
    if ( $id_group ) $records = $this->Absence->get_recap($semestres, $id_group);
    
    if ( $export ) return $this->recap_to_excel($records);
    
    $this->load->view($this->layout, [
      'content_view' => 'absences/recap',
      
      'classes' => $this->Groupe->get_annee_list($id_annee),
      'annees' => $this->Annee->get_list(),
      'id_annee' => $id_annee,
      'id_group' => $id_group,
      'records' => $records,
    ]);
  }
  
  protected function to_excel($data)
  {
    $header = ['Code', 'Prénom', 'Nom', 'Séance', 'Matière', 'Date', 'Période'];
    $content = join("\t", $header) . "\n";
    
    foreach ( $data as $item ) {
      $content .= join("\t", [
        $item->code,
        $item->prenom,
        $item->nom,
        $item->seance_title,
        $item->matiere,
        date('d/m/Y', strtotime($item->date_debut)),
        $item->semestre,
      ]) . "\n";
    }
    
    $this->load->helper('download');
    force_download('detail-absences.xls', $content, TRUE);
  }
  
  protected function recap_to_excel($data)
  {
    $header = ['Code', 'Prénom', 'Nom', 'Semestre 1', 'Semestre 2', 'Total'];
    $content = join("\t", $header) . "\n";
    
    foreach ( $data as $item ) {
      $content .= join("\t", [
        $item->code,
        $item->prenom,
        $item->nom,
        $s1 = (int) $item->s1,
        $s2 = (int) $item->s2,
        $s1 + $s2,
      ]) . "\n";
    }
    
    $this->load->helper('download');
    force_download('recap-absences.xls', $content, TRUE);
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
