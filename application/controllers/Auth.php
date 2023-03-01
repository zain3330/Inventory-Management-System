<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_auth');
	}

	/* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{

		$this->logged_in();

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists == TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

           		if($login) {

           			$logged_in_sess = array(
           				'id' => $login['id'],
				        'username'  => $login['username'],
				        'email'     => $login['email'],
				        'logged_in' => TRUE
					);

					$this->session->set_userdata($logged_in_sess);
           			redirect('dashboard', 'refresh');
           		}
           		else {
           			$this->data['errors'] = 'Incorrect username/password combination';
           			$this->load->view('login', $this->data);
           		}
           	}
           	else {
           		$this->data['errors'] = 'Email does not exists';

           		$this->load->view('login', $this->data);
           	}	
        }
        else {
            // false case
            $this->load->view('login');
        }	
	}

	public function register()
{
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
	$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
	// $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

	if ($this->form_validation->run() == TRUE) {
		// true case
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);

		$new_user = $this->model_auth->register($data);

		if($new_user) {
			$logged_in_sess = array(
				'id' => $new_user['id'],
				'username'  => $new_user['username'],
				'email'     => $new_user['email'],
				'logged_in' => TRUE
			);

			$this->session->set_userdata($logged_in_sess);
			redirect('dashboard', 'refresh');
		}
		else {
			$this->data['errors'] = 'Registration failed';
			$this->load->view('register', $this->data);
		}
	}
	else {
		// false case
		$this->load->view('register');
	}
}


	/*
		clears the session and redirects to login page
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login', 'refresh');
	}

}
