<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kd extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('service_model');
		$this->load->model('kd_model');
	}

	public function index()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}		
	}

	public function getKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kd_model->getKDBySemesterAndIdMapel($this->input->get('semester'), $this->input->get('id_mapel'));

		echo json_encode($r);
	}

	public function getKDById()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kd_model->getKDById($this->input->get('id_kd'));

		echo json_encode($r[0]);
	}

	public function addKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nama_kd' => $this->input->post('nama_kd'),
			'semester' => $this->input->post('semester_kd'),
			'id_mapel' => $this->input->post('id_mapel')
		);

		if ($data['nama_kd'] == '' || $data['semester'] == '' || $data['id_mapel'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}
		if ($lastUrutan = $this->kd_model->getMaxUrutanKDBySemesterAndIdMapel($data['semester'], $data['id_mapel'])[0]->urutan) {
			$data['urutan'] = ++$lastUrutan;
		} else {
			$data['urutan'] = 1;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->kd_model->addKD($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan KD';
		}

		echo json_encode($r);
	}

	public function editKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => ''); $nama = false; $semester = false;
		$data = array(
			'nama_kd' => $this->input->post('nama_kd'),
			'semester' => $this->input->post('semester_kd')
		);

		if ($data['nama_kd'] == '' || $data['semester'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->kd_model->getKDById($this->input->post('id_kd'))[0]->semester != $data['semester']) {
			if ($lastUrutan = $this->kd_model->getMaxUrutanKDBySemesterAndIdMapel($data['semester'], $this->input->post('id_mapel'))[0]->urutan) {
				$data['urutan'] = ++$lastUrutan;
			} else {
				$data['urutan'] = 1 ;
			}
		}

		if ($this->kd_model->editKD($this->input->post('id_kd'), $data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal mengedit KD';
		}

		echo json_encode($r);
	}

}

/* End of file kd.php */
/* Location: ./application/controllers/kd.php */