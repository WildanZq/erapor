<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_mapel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('jenis_mapel_model');
	}

	public function index()
	{
		
	}

	public function getAllJenisMapel()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->jenis_mapel_model->getAllJenisMapel();
		$r = array('data' => $data );

		echo json_encode($r);
	}

}

/* End of file jenis_mapel.php */
/* Location: ./application/controllers/jenis_mapel.php */