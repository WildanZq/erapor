<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('kelas_model');
	}

	public function index()
	{
		
	}

	public function getAllKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->kelas_model->getAllKelas();
		$r = array('data' => $data );

		echo json_encode($r);
	}

}

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */