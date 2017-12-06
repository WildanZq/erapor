<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		$data['title'] = 'Login';
		$this->load->view('login_view', $data);
	}

	public function login()
	{
		
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */