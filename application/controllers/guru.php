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
		$this->load->model('service_model');
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			$data['title'] = 'Guru';
			$data['main'] = 'admin/guru/index';
			$this->load->view('template', $data);
		}	
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

	public function getGuruById()
	{
		if (! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
			$this->load->view('error404_view', $data);
			return;
		}

		$r = $this->guru_model->getGuruById($this->input->get('id'));

		echo json_encode($r[0]);
	}

	public function addGuru()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '' );
		$data = array(
			'nik' 			=> $this->input->post('nik'), 
			'nama_guru'		=> $this->input->post('nama'),
			'jk_guru'		=> $this->input->post('jk_guru'),
			'password_guru'	=> $this->input->post('nik'),
			'telp_guru'		=> $this->input->post('telepon'),
			'alamat_guru'	=> $this->input->post('alamat')
		);

		if ($data['nama_guru'] == '' || $data['jk_guru'] == '' || $data['telp_guru'] == '' || $data['alamat_guru'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->guru_model->addGuru($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan guru';
		}

		echo json_encode($r);
	}

	public function editGuru()
	{
		if (! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
			$this->load->view('error404_view', $data);
			return;
		}

		$r = array('status' => false, 'error' => '' );
		$data = array(
			'nik' 			=> $this->input->post('nik'), 
			'nama_guru'		=> $this->input->post('nama'),
			'jk_guru'		=> $this->input->post('jk_guru'),
			'password_guru'	=> $this->input->post('nik'),
			'telp_guru'		=> $this->input->post('telepon'),
			'alamat_guru'	=> $this->input->post('alamat')
		);

		if ($this->input->post('id') == '' || $data['nik'] == '' || $data['nama_guru'] == '' || $data['jk_guru'] == '' || $data['telp_guru'] == '' || $data['alamat_guru'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->guru_model->editGuru($this->input->post('id'), $data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal mengedit guru';
		}

		echo json_encode($r);
	}

	public function deleteGuru()
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

		if ($this->guru_model->deleteGuru($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus guru';
		}

		echo json_encode($r);
	}
}

/* End of file guru.php */
/* Location: ./application/controllers/guru.php */