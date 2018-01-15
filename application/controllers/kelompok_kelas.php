<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('kelompok_kelas_model');
		$this->load->model('service_model');
	}

	public function getAllKelompokKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->kelompok_kelas_model->getAllKelompokKelas();
		$r = array('data' => $data );

		echo json_encode($r);
	}

	public function addKelompokKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nama_kelompok_kelas'	=> $this->input->post('nama_kelompok_kelas')
		);

		if ($data['nama_kelompok_kelas'] == '')
		{
			$r['error'] = 'Isi data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->kelompok_kelas_model->addKelompokKelas($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan data kelompok kelas';
		}

		echo json_encode($r);
	}

	public function editKelompokKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nama_kelompok_kelas' => $this->input->post('nama_kelompok_kelas')
		);

		if ($data['nama_kelompok_kelas'] == '') {
			$r['error'] = 'Isi data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		if ($this->kelompok_kelas_model->editKelompokKelas($this->input->post('id'), $data)) {
			$r['status'] =true;
		} else {
			$r['error'] = 'Gagal mengedit kelompok kelas';
		}

		echo json_encode($r);
	}

	public function getKelompokKelasById()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kelompok_kelas_model->getKelompokKelasById($this->input->get('id'));

		echo json_encode($r[0]);
	}

	public function deleteKelompokKelas()
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

		if ($this->kelompok_kelas_model->deleteKelompokKelas($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus kelompok kelas';
		}

		echo json_encode($r);
	}

}

/* End of file kelompok_kelas.php */
/* Location: ./application/controllers/kelompok_kelas.php */
