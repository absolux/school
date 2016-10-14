<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    
		$this->load->model('User');
    $this->load->modal('Annee');
	}

	public function login()
	{
		
		$this->load->view('auth/login');

	}

	public function do_login()
	{

		$this->load->library('form_validation');

		// form validation
		$this->form_validation->set_rules("email", "Email", "trim|required");
		$this->form_validation->set_rules("password", "Mot de passe", "trim|required");
		
		if ($this->form_validation->run() == FALSE)
    {
			// validation fail
			$this->load->view('auth/login');
		}
		else
		{
			// check for user credentials
		  $email = $this->input->post("email");
      $password = $this->input->post("password");
			$uresult = $this->User->get_user($email, $password);
			
      if (count($uresult) > 0)
			{
				// set session
				$this->session->set_userdata([
          'login' => TRUE,
          'uid' => $uresult[0]->id,
          'name' => $uresult[0]->name,
          'year' => $this->Annee->get_activ()->id,
        ]);
				
        $this->session->set_flashdata('login-success', 'Welcome');
				redirect("/");
			}
			else
			{
				$this->session->set_flashdata('login-error', 'E-mail ou mot de passe invalides');
				redirect('auth/login');
			}
		}
	}

  
	public function logout()
	{
		$this->session->sess_destroy();
    
    $this->session->set_flashdata('logout-success', 'Logged out');
		$this->login();
	}
  
}