<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('guru_model');
	}

	public function index()
	{
		
	}

	public function getAllGuru()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->guru_model->getAllGuru();
		$r = array('data' => $data );

		echo json_encode($r);
	}

}

/* End of file guru.php */
/* Location: ./application/controllers/guru.php */