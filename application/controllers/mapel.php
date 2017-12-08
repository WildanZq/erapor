<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('mapel_model');
	}

	public function index()
	{
		
	}

	public function getMapelGuru()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}
		if (! $this->input->post('userid')) {
			redirect('authorization/logout');
		}

		$r = array();

		if (! $data = $this->mapel_model->getMapelGuru($this->input->post('userid'))) {
			$r = array('error' => 'You don&#39;t have any mapel yet');
		} else {
			$r = $data;
		}

		echo json_encode($r);
	}

	public function getMapelSiswa()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}
		if (! $this->input->post('userid')) {
			redirect('authorization/logout');
		}

		$r = array();

		if (! $data = $this->mapel_model->getMapelSiswa($this->input->post('userid'))) {
			$r = array('error' => 'You don&#39;t have any mapel in your class');
		} else {
			$r = $data;
		}

		echo json_encode($r);
	}

}

/* End of file mapel.php */
/* Location: ./application/controllers/mapel.php */