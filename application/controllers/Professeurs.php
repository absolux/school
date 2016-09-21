<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Professeurs extends MY_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    
    $this->load->model('Professeur');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('professeurs');
    $config['total_rows'] = $this->Professeur->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $professeurs = $this->Professeur->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view($this->layout, [
      'q' => $q,
      'start' => $start,
      'records' => $professeurs,
      'total_rows' => $config['total_rows'],
      'content_view' => 'professeurs/professeurs_list',
      'pagination' => $this->pagination->create_links(),
    ]);
  }

  public function read($id) 
  {
    $row = $this->Professeur->get_by_id($id);
    
    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('professeurs'));
    }
    
    $this->load->view($this->layout, [
      'action' => site_url('professeurs/update_action'),
      'content_view' => 'professeurs/professeurs_read',
      
      'id' => set_value('id', $row->id),
      'nom' => set_value('nom', $row->nom),
      'prenom' => set_value('prenom', $row->prenom),
      'email' => set_value('email', $row->email),
      'tel' => set_value('tel', $row->tel),
      'cin' => set_value('cin', $row->cin),
      'sexe' => set_value('sexe', $row->sexe),
    ]);
  }

  // public function create() 
  // {
  //   $data = array(
  //     'button' => 'Créer',
  //     'action' => site_url('professeurs/create_action'),
  //     'id' => set_value('id'),
  //     'nom' => set_value('nom'),
  //     'email' => set_value('email'),
  //     'prenom' => set_value('prenom'),
  //     'tel' => set_value('tel'),
  //     'cin' => set_value('cin'),
  //     'sexe' => set_value('sexe'),
  //     'content_view' => 'professeurs/professeurs_form'
  //   );
    
  //   $this->load->view('template/layout', $data);
  // }

  public function create_action() 
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) return $this->index();
    
    $data = $this->input->post(['nom', 'prenom'], TRUE);
    
    if ( $this->Professeur->insert($data) )
      $this->session->set_flashdata('success', 'Création réussie');
    
    redirect(site_url('professeurs'));
  }

  // public function update($id) 
  // {
  //   $row = $this->Professeur->get_by_id($id);

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
        
  //       );
      
  //     $this->load->view('template/layout', $data);
  //   } else {
  //     $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
  //     redirect(site_url('professeurs'));
  //   }
  // }

  public function update_action() 
  {
    $this->_rules();
    
    $id = $this->input->post('id', TRUE);

    if ($this->form_validation->run() == FALSE) return $this->read($id);
    
    $data = $this->input->post(['nom', 'prenom', 'cin', 'email', 'tel', 'sexe'], TRUE);

    if ( $this->Professeur->update($id, $data) )
      $this->session->set_flashdata('success', 'Modifications appliquées');
    
    redirect(site_url("professeurs/read/{$id}"));
  }

  public function delete($id) 
  {
    $row = $this->Professeur->get_by_id($id);

    if (! $row ) $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
    else if ( $this->Professeur->delete($id) ) $this->session->set_flashdata('success', 'Suppression réussie');
    
    redirect(site_url('professeurs'));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('nom', 'nom', 'trim|required');
    $this->form_validation->set_rules('prenom', 'prénom', 'trim|required');
    $this->form_validation->set_rules('email', 'adresse e-mail', 'trim|valid_email');
    $this->form_validation->set_rules('tel', 'téléphone', 'trim');
    $this->form_validation->set_rules('cin', 'CIN', 'trim');
    $this->form_validation->set_rules('sexe', 'sexe', 'trim');
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}