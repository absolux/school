<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Etudiants extends MY_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Etudiant');
  }
  
  public function json_list() {
    echo json_encode($this->Etudiant->to_json());
    exit;
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('etudiants');
    $config['total_rows'] = $this->Etudiant->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $etudiants = $this->Etudiant->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view($this->layout, [
      'q' => $q,
      'start' => $start,
      'records' => $etudiants,
      'total_rows' => $config['total_rows'],
      'content_view' => 'etudiants/etudiants_list',
      'pagination' => $this->pagination->create_links(),
      
      'code' => set_value('code'),
      'nom' => set_value('nom'),
      'prenom' => set_value('prenom'),
    ]);
  }

  public function read($id) 
  {
    $row = $this->Etudiant->get_by_id($id);
    
    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('etudiants'));
    }
    
    $this->load->view($this->layout, [
      'content_view' => 'etudiants/etudiants_read',
      'action' => site_url('etudiants/update_action'),
      
      'id' => set_value('id', $row->id),
      'code' => set_value('code', $row->code),
      'nom' => set_value('nom', $row->nom),
      'prenom' => set_value('prenom', $row->prenom),
      'email' => set_value('email', $row->email),
      'adresse' => set_value('adresse', $row->adresse),
      'zipcode' => set_value('zipcode', $row->zipcode),
      'ville' => set_value('ville', $row->ville),
      'tel' => set_value('tel', $row->tel),
      'tel_parent' => set_value('tel', $row->tel_parent),
      'cin' => set_value('cin', $row->cin),
      'date_naiss' => set_value('date_naiss', $row->date_naiss),
      'lieu_naiss' => set_value('lieu_naiss', $row->lieu_naiss),
      'sexe' => set_value('sexe', $row->sexe),  
    ]);
  }

  // public function create() 
  // {
  //   $data = array(
  //     'button' => 'Créer',
  //     'action' => site_url('etudiants/create_action'),
  //     'id' => set_value('id'),
  //     'code' => set_value('code'),
  //     'nom' => set_value('nom'),
  //     'email' => set_value('email'),
  //     'prenom' => set_value('prenom'),
  //     'adresse' => set_value('adresse'),
  //     'zipcode' => set_value('zipcode'),
  //     'ville' => set_value('ville'),
  //     'tel' => set_value('tel'),
  //     'cin' => set_value('cin'),
  //     'date_naiss' => set_value('date_naiss'),
  //     'lieu_naiss' => set_value('lieu_naiss'),
  //     'sexe' => set_value('sexe'),
  //     'created' => set_value('created'),
  //     'content_view' => 'etudiants/etudiants_form'
  //   );
  //   
  //   $this->load->view($this->layout, $data);
  // }

  public function create_action() 
  {
    $this->_rules();
    
    // apply is_unique validation rule only on student creation
    $this->form_validation->set_rules('code', 'code étudiant', 'trim|required|is_unique[etudiants.code]');

    if ($this->form_validation->run() == FALSE) return $this->index();
    
    $data = $this->input->post(['code', 'nom', 'prenom'], TRUE);

    if ( $this->Etudiant->insert($data) )
      $this->session->set_flashdata('success', 'Création réussie');
    
    redirect(site_url("etudiants"));
  }

  // public function update($id) 
  // {
  //   $row = $this->Etudiant->get_by_id($id);

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
          
  //       'content_view' => 'etudiants/etudiants_form'
  //       );
      
  //     $this->load->view($this->layout, $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('etudiants'));
  //   }
  // }

  public function update_action() 
  {
    $this->_rules();
    
    $id = $this->input->post('id', TRUE);

    if ($this->form_validation->run() == FALSE) return $this->read($id);
    
    $data = $this->input->post([
      'code', 'nom', 'prenom', 'adresse', 'zipcode', 'ville', 'tel_parent',
      'tel', 'cin', 'sexe', 'email', 'date_naiss', 'lieu_naiss',
    ], TRUE);

    if ( $this->Etudiant->update($id, $data) )
      $this->session->set_flashdata('success', 'Modifications appliquées');
    
    redirect(site_url("etudiants/read/{$id}"));
  }

  public function delete($id) 
  {
    $row = $this->Etudiant->get_by_id($id);

    if (! $row ) $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
    else if ( $this->Etudiant->delete($id) ) $this->session->set_flashdata('success', 'Suppression réussie');
    
    redirect(site_url('etudiants'));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('code', 'code étudiant', 'trim|required');
    $this->form_validation->set_rules('nom', 'nom', 'trim|required');
    $this->form_validation->set_rules('prenom', 'prénom', 'trim|required');
    $this->form_validation->set_rules('email', 'adresse e-mail', 'trim|valid_email');
    $this->form_validation->set_rules('adresse', 'adresse', 'trim');
    $this->form_validation->set_rules('zipcode', 'zipcode', 'trim');
    $this->form_validation->set_rules('ville', 'ville', 'trim');
    $this->form_validation->set_rules('tel', 'téléphone', 'trim');
    $this->form_validation->set_rules('tel_parent', 'téléphone du parent', 'trim');
    $this->form_validation->set_rules('cin', 'CIN', 'trim');
    $this->form_validation->set_rules('date_naiss', 'date de naissance', 'trim');
    $this->form_validation->set_rules('lieu_naiss', 'lieu de naissance', 'trim');
    $this->form_validation->set_rules('sexe', 'sexe', 'trim');
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}
