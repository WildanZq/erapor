<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['main'] = 'dashboard';
		$this->load->view('template', $data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */