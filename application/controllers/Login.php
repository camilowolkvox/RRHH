<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Empleados_model');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index()
	{
		$data["values"] = $this->Empleados_model->getEmployees();
		$this->load->view('login', $data);
	}

	public function validation()
	{
		// $this->load->view('admin');
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email');

		$this->form_validation->set_rules('user_password', 'Password', 'required');

		if ($this->form_validation->run()) {
			$result = $this->Empleados_model->can_login(
				$this->input->post('user_email'),
				$this->input->post('user_password')
			);

			if ($result == 'Wrong Email Address') {
				redirect('login');
			} else {
				redirect('admin');
			}
		} else {
			$this->index();
		}
	}
}
