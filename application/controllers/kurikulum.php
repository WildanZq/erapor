<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('kurikulum_model');
	}

	public function index()
	{
		
	}

	public function getAllKurikulum()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->kurikulum_model->getAllKurikulum();
		$r = array('data' => $data );

		echo json_encode($r);
	}

}

/* End of file kurikulum.php */
/* Location: ./application/controllers/kurikulum.php */