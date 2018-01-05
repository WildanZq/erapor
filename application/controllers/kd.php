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
			'nama_kd' => $this->input->post('nama_kd')
		);

		if ($data['nama_kd'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->kd_model->editKD($this->input->post('id_kd'), $data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal mengedit KD';
		}

		echo json_encode($r);
	}

	public function deleteKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');

		if ($this->input->post('id') == '') {
			$r['error'] = 'Id tidak ada!';
			echo json_encode($r);
			return;
		}

		if ($this->kd_model->deleteKD($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus KD';
		}

		echo json_encode($r);
	}

	public function moveLeftKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');

		if ($this->input->post('id') == '') {
			$r['error'] = 'Id tidak ada!';
			echo json_encode($r);
			return;
		}

		$kd = $this->kd_model->getKDById($this->input->post('id'))[0];
		if ($kd->urutan == 1) {
			$r['error'] = 'Tidak bisa mamindahkan KD!';
			echo json_encode($r);
			return;
		}

		$dataBefore = array( 'urutan' => $kd->urutan );
		$data = array( 'urutan' => $kd->urutan-1 );
		if ($this->kd_model->moveKD($kd->semester,$kd->id_mapel,($kd->urutan-1),$dataBefore) && $this->kd_model->editKD($this->input->post('id'),$data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal mamindahkan KD!';
		}

		echo json_encode($r);
	}

	public function moveRightKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');

		if ($this->input->post('id') == '') {
			$r['error'] = 'Id tidak ada!';
			echo json_encode($r);
			return;
		}

		$kd = $this->kd_model->getKDById($this->input->post('id'))[0];
		if ($kd->urutan == $this->kd_model->getMaxUrutanKDBySemesterAndIdMapel($kd->semester,$kd->id_mapel)[0]->urutan) {
			$r['error'] = 'Tidak bisa mamindahkan KD!';
			echo json_encode($r);
			return;
		}

		$dataAfter = array( 'urutan' => $kd->urutan );
		$data = array( 'urutan' => $kd->urutan+1 );
		if ($this->kd_model->moveKD($kd->semester,$kd->id_mapel,($kd->urutan+1),$dataAfter) && $this->kd_model->editKD($this->input->post('id'),$data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal mamindahkan KD!';
		}

		echo json_encode($r);
	}

}

/* End of file kd.php */
/* Location: ./application/controllers/kd.php */