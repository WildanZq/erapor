<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('admin_model');
		$this->load->model('service_model');
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			$data['title'] = 'Admin';
			$data['main'] = 'admin/admin/index';
			$this->load->view('template', $data);
			return;
		}

		$data['title'] = '404 Page Not Found';
    	$this->load->view('error404_view',$data);
	}

	public function getAllAdmin()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$data = $this->admin_model->getAllAdmin();
		$r = array('data' => $data );

		echo json_encode($r);
	}

	public function addAdmin()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '');
		$data = array(
			'username' => $this->input->post('username'),
			'nama_admin' => $this->input->post('nama_admin'),
			'password' => $this->input->post('username')
		);

		if ($data['username'] == '' || $data['nama_admin'] == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		$data = $this->service_model->escape_array($data);
		if ($this->admin_model->addAdmin($data)) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menambahkan siswa';
		}

		echo json_encode($r);
	}

	public function deleteAdmin()
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

		if ($this->admin_model->deleteAdmin($this->input->post('id'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal menghapus Admin';
		}

		echo json_encode($r);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */