<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Matieres extends MY_Controller
{
  
  protected $per_page = 15;

  function __construct()
  {
    parent::__construct();
    $this->load->model('Matiere');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));
    
    $config['per_page'] = $this->per_page;
    $config['base_url'] = base_url('matieres');
    $config['total_rows'] = $this->Matiere->total_rows($q);
    
    $this->load->library('pagination');
    $this->pagination->initialize($config);
    
    $matieres = $this->Matiere->get_limit_data($this->per_page, $start, $q);
    
    $this->load->view($this->layout, [
      'q' => $q,
      'start' => $start,
      'records' => $matieres,
      'total_rows' => $config['total_rows'],
      'content_view' => 'matieres/matieres_list',
      'pagination' => $this->pagination->create_links(),
    ]);
  }

  public function read($id) 
  {
    $row = $this->Matiere->get_by_id($id);
    
    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
      return redirect(site_url('matieres'));
    }
    
    $this->load->view($this->layout, [
      'content_view' => 'matieres/matieres_read',
      'action' => site_url('matieres/update_action'),
      
      'id' => set_value('id', $row->id),
      'label' => set_value('label', $row->label),
      'description' => set_value('description', $row->description),
    ]);
  }

  // public function create() 
  // {
  //   $data = array(
  //     'button' => 'Créer',
  //     'content_view' => 'matieres/matieres_form',
  //     'action' => site_url('matieres/create_action'),
  //     'id' => set_value('id'),
  //     'label' => set_value('label'),
  //     'description' => set_value('description'),
  //   );
    
  //   $this->load->view('template/layout', $data);
  // }

  public function create_action() 
  {
    $this->_rules();

    if ( $this->form_validation->run() == FALSE ) return $this->index();
    
    $data = $this->input->post(['label'], TRUE);
    
    if ( $this->Matiere->insert($data) )
      $this->session->set_flashdata('success', 'Création réussie');
    
    redirect(site_url('matieres'));
  }

  // public function update($id) 
  // {
  //   $row = $this->Matiere->get_by_id($id);

  //   if ($row) {
  //     $data = array(
  //       'button' => 'Modifier',
  //       'content_view' => 'matieres/matieres_form',
  //       'action' => site_url('matieres/update_action'),
  //       'id' => set_value('id', $row->id),
  //       'label' => set_value('label', $row->label),
  //       'description' => set_value('description', $row->description),
  //       );
      
  //     $this->load->view('template/layout', $data);
  //   } else {
  //     $this->session->set_flashdata('message', 'Aucun résultat trouvé');
  //     redirect(site_url('matieres'));
  //   }
  // }

  public function update_action() 
  {
    $this->_rules();

    $id = $this->input->post('id', TRUE);
    
    if ($this->form_validation->run() == FALSE) return $this->read($id);
    
    $data = $this->input->post(['label', 'description'], TRUE);

    if ( $this->Matiere->update($id, $data) )
      $this->session->set_flashdata('success', 'Modifications appliquées');
    
    redirect(site_url('matieres'));
  }

  public function delete($id) 
  {
    $row = $this->Matiere->get_by_id($id);

    if (! $row ) {
      $this->session->set_flashdata('warning', 'Aucun résultat trouvé');
    } 
    else if ( $this->Matiere->delete($id) ) {
      $this->session->set_flashdata('success', 'Suppression réussie');
    }
    
    redirect(site_url('matieres'));
  }

  public function _rules() 
  {
    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('label', 'libellé', 'trim|required');
    $this->form_validation->set_rules('description', 'description', 'trim');
    $this->form_validation->set_rules('id', 'id', 'trim');
  }

}