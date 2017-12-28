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
		$this->load->model('service_model');
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

	public function addJenisMapel()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nama_jenis_mapel'	=> $this->input->post('nama_jenis_mapel')
		);

		if ($data['nama_jenis_mapel'] == '')
		{
			$r['error'] = 'Isi data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->jenis_mapel_model->addJenisMapel($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan data jenis mapel';
		}

		echo json_encode($r);
	}

	public function editJenisMapel()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nama_jenis_mapel' => $this->input->post('nama_jenis_mapel')
		);

		if ($data['nama_jenis_mapel'] == '') {
			$r['error'] = 'Isi data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		if ($this->jenis_mapel_model->editJenisMapel($this->input->post('id'), $data)) {
			$r['status'] =true;
		} else {
			$r['error'] = 'Gagal mengedit jenis mapel';
		}

		echo json_encode($r);
	}

	public function getJenisMapelById()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->jenis_mapel_model->getJenisMapelById($this->input->get('id'));

		echo json_encode($r[0]);
	}

	public function deleteJenisMapel()
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

		if ($this->jenis_mapel_model->deleteJenisMapel($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus jenis mapel';
		}

		echo json_encode($r);
	}

}

/* End of file jenis_mapel.php */
/* Location: ./application/controllers/jenis_mapel.php */