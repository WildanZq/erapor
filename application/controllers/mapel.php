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
		$data['title'] = 'Mapel';
		$data['main'] = 'admin/mapel/index';
		$this->load->view('template', $data);
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

	public function addMapel()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			//'id_mapel'		=> $this->input->post('id_mapel'),
			'id_kurikulum'		=> $this->input->post('id_kurikulum'),
			'id_jenis_mapel'	=> $this->input->post('id_jenis_mapel'),
			'nama_mapel'		=> $this->input->post('nama_mapel'),
			'kkm'				=> $this->input->post('kkm')
		);

		if (
			$data['nama_mapel'] == '' ||
			$data['kkm'] == '')
		{
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		if ($this->input->post('kurikulum')) {
			$data['id_kurikulum'] = $this->input->post('kurikulum');
		}

		if ($this->input->post('jenis_mapel')) {
			$data['id_jenis_mapel'] = $this->input->post('jenis_mapel');
		}

		//$data = $this->service_model->escape_array($data);
		if ($this->mapel_model->addMapel($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan mapel';
		}

		echo json_encode($r);
	}

	public function getAllMapel()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->mapel_model->getAllMapel();
		$r = array('data' => $data );

		echo json_encode($r);
	}

	public function editMapel()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'id_kurikulum' => $this->input->post('kurikulum'),
			'id_jenis_mapel' => $this->input->post('jenis_mapel'),
			'nama_mapel' => $this->input->post('nama_mapel'),
			'kkm' => $this->input->post('kkm')
		);

		if ($data['nama_mapel'] == '' || $data['kkm'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}
		if ($this->input->post('kurikulum')) {
			$data['id_kurikulum'] = $this->input->post('kurikulum');
		} else {
			$data['id_kurikulum'] = null;
		}
		if ($this->input->post('jenis_mapel')) {
			$data['id_jenis_mapel'] = $this->input->post('jenis_mapel');
		} else {
			$data['id_jenis_mapel'] = null;
		}

		if ($this->mapel_model->editMapel($this->input->post('id'), $data)) {
			$r['status'] =true;
		} else {
			$r['error'] = 'Gagal mengedit mapel';
		}

		echo json_encode($r);
	}

	public function getMapelById()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->mapel_model->getMapelById($this->input->get('id'));

		echo json_encode($r[0]);
	}

	public function deleteMapel()
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

		if ($this->mapel_model->deleteMapel($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus mapel';
		}

		echo json_encode($r);
	}
}

/* End of file mapel.php */
/* Location: ./application/controllers/mapel.php */