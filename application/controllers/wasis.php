<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wasis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('service_model');
		$this->load->model('siswa_model');
	}

	public function index()
	{
		if (! $this->session->userdata('role') == 'guru') {
			$data['title'] = '404 Page Not Found';
			$this->load->view('error404_view',$data);
			return;
		}

		$data['title'] = 'Wali Siswa';
		$data['main'] = 'guru/wasis/index';
		$this->load->view('template', $data);
	}

}

/* End of file wasis.php */
/* Location: ./application/controllers/wasis.php */