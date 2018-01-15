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
		$this->load->model('service_model');
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			$data['title'] = 'Kelas';
			$data['main'] = 'admin/kelas/index';
			$this->load->view('template', $data);
			return;
		}

		if ($this->session->userdata('role') == 'siswa') {
			if (! $this->kelas_model->cekKelasSiswa( $this->uri->segment(3), $this->session->userdata('userid') ) || $this->uri->segment(4) > 2 || $this->uri->segment(4) < 1) {
				$data['title'] = '404 Page Not Found';
    			$this->load->view('error404_view',$data);
				return;
			}

			$data['title'] = 'Kelas';
			$data['main'] = 'siswa/kelas/index';
			$this->load->view('template', $data);
			return;
		}

		$data['title'] = '404 Page Not Found';
    	$this->load->view('error404_view',$data);
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

	public function getKelasByMapelId()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kelas_model->getKelasByMapelId($this->input->get('id'));

		echo json_encode($r);
	}

	public function getKelasSiswa()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kelas_model->getKelasBySiswaId($this->input->get('id'));

		echo json_encode($r);
	}

	public function addKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'id_kelompok_kelas' => $this->input->post('id_kelompok_kelas'),
			'nama_kelas' 		=> $this->input->post('nama_kelas')
		);

		if ($data['nama_kelas'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		if ($this->input->post('kelompok_kelas')) {
			$data['id_kelompok_kelas'] = $this->input->post('kelompok_kelas');
		}

		$data = $this->service_model->escape_array($data);
		if ($this->kelas_model->addKelas($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan kelas';
		}

		echo json_encode($r);
	}

	public function editKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'id_kelompok_kelas' => $this->input->post('id_kelompok_kelas'),
			'nama_kelas' 		=> $this->input->post('nama_kelas')
		);

		if ($data['nama_kelas'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}
		if ($this->input->post('kelompok_kelas')) {
			$data['id_kelompok_kelas'] = $this->input->post('kelompok_kelas');
		} else {
			$data['id_kelompok_kelas'] = null;
		}

		if ($this->kelas_model->editKelas($this->input->post('id'), $data)) {
			$r['status'] =true;
		} else {
			$r['error'] = 'Gagal mengedit kelas';
		}

		echo json_encode($r);
	}

	public function getKelasById()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kelas_model->getKelasById($this->input->get('id'));

		echo json_encode($r[0]);
	}

	public function deleteKelas()
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

		if ($this->kelas_model->deleteKelas($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus kelas';
		}

		echo json_encode($r);
	}
}

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */