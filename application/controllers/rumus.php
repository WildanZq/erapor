<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('rumus_model');
		$this->load->model('service_model');
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			$data['title'] = 'Rumus';
			$data['main'] = 'admin/rumus/index';
			$this->load->view('template', $data);
		}
	}

	public function getAllRumus()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->rumus_model->getAllRumus();
		$r = array('data' => $data );

		echo json_encode($r);
	}

	public function getRumus()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->rumus_model->getRumus($this->input->get('id'));

		echo json_encode($r[0]);
	}


	public function editRumus()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nilai_kd' 		=> $this->input->post('nilai_kd'),
			'nilai_uts' 	=> $this->input->post('nilai_uts'),
			'nilai_uas' 	=> $this->input->post('nilai_uas')
		);

		if ($data['nilai_kd'] == '' || $data['nilai_uts'] == '' || $data['nilai_uas'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		if($data['nilai_kd'] + $data['nilai_uts'] + $data['nilai_uas'] != 100)
		{
			$r['error'] = 'Pastikan Nilai KD + Nilai UTS + Nilai UAS = 100';
			echo json_encode($r);
			return;
		}


		if ($this->rumus_model->editRumus($this->input->post('id'), $data)) {
			$r['status'] =true;
		} else {
			$r['error'] = 'Gagal mengedit rumus';
		}

		echo json_encode($r);
	}

}

/* End of file rumus.php */
/* Location: ./application/controllers/rumus.php */