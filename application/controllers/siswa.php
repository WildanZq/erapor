<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('service_model');
		$this->load->model('siswa_model');
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			$data['title'] = 'Dashboard';
			$data['main'] = 'admin/siswa/index';
			$this->load->view('template', $data);
		}
	}

	public function getAllSiswa()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->siswa_model->getAllSiswa();
		$r = array('data' => $data );

		echo json_encode($r);
	}

	public function getSiswaById()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->siswa_model->getSiswaById($this->input->get('id'));

		echo json_encode($r[0]);
	}

	public function getSiswaByKelasIdAndThAjar()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->siswa_model->getSiswaByKelasIdAndThAjar($this->input->get('id'), $this->input->get('th_ajar'));

		echo json_encode($r);
	}

	public function addSiswa()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nisn' => $this->input->post('nisn'),
			'nis' => $this->input->post('nis'),
			'nama_siswa' => $this->input->post('nama'),
			'jk' => $this->input->post('jk'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'password' => $this->input->post('nisn')
		);

		if ($data['nisn'] == '' || $data['nis'] == '' || $data['nama_siswa'] == '' || $data['jk'] == '' || $data['tempat_lahir'] == '' || $data['tgl_lahir'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}
		if ($this->input->post('guru')) {
			$data['id_guru'] = $this->input->post('guru');
		}

		$data = $this->service_model->escape_array($data);
		if ($this->siswa_model->addSiswa($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan siswa';
		}

		echo json_encode($r);
	}

	public function editSiswa()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nisn' => $this->input->post('nisn'),
			'nis' => $this->input->post('nis'),
			'nama_siswa' => $this->input->post('nama'),
			'jk' => $this->input->post('jk'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'password' => $this->input->post('nisn')
		);

		if ($this->input->post('id') == '' || $data['nisn'] == '' || $data['nis'] == '' || $data['nama_siswa'] == '' || $data['jk'] == '' || $data['tempat_lahir'] == '' || $data['tgl_lahir'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}
		if ($this->input->post('guru')) {
			$data['id_guru'] = $this->input->post('guru');
		} else {
			$data['id_guru'] = null;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->siswa_model->editSiswa($this->input->post('id'), $data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal mengedit siswa';
		}

		echo json_encode($r);
	}

	public function deleteSiswa()
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

		if ($this->siswa_model->deleteSiswa($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus siswa';
		}

		echo json_encode($r);
	}

}

/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */