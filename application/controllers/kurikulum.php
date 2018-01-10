<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('kurikulum_model');
		$this->load->model('service_model');
	}

	public function getAllKurikulum()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->kurikulum_model->getAllKurikulum();
		$r = array('data' => $data );

		echo json_encode($r);
	}

	public function addKurikulum()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nama_kurikulum'	=> $this->input->post('nama_kurikulum')
		);

		if ($data['nama_kurikulum'] == '')
		{
			$r['error'] = 'Isi data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->kurikulum_model->addKurikulum($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan data kurikulum';
		}

		echo json_encode($r);
	}

	public function editKurikulum()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'nama_kurikulum' => $this->input->post('nama_kurikulum')
		);

		if ($data['nama_kurikulum'] == '') {
			$r['error'] = 'Isi data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		if ($this->kurikulum_model->editKurikulum($this->input->post('id'), $data)) {
			$r['status'] =true;
		} else {
			$r['error'] = 'Gagal mengedit kurikulum';
		}

		echo json_encode($r);
	}

	public function getKurikulumById()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kurikulum_model->getKurikulumById($this->input->get('id'));

		echo json_encode($r[0]);
	}

	public function deleteKurikulum()
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

		if ($this->kurikulum_model->deleteKurikulum($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus kurikulum';
		}

		echo json_encode($r);
	}

}

/* End of file kurikulum.php */
/* Location: ./application/controllers/kurikulum.php */