<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('dashboard_model');
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			$data['title'] = 'Dashboard';
			$data['main'] = 'admin/dashboard/index';
			$this->load->view('template', $data);
		}
		if ($this->session->userdata('role') == 'guru') {
			$data['title'] = 'Dashboard';
			$data['main'] = 'admin/dashboard/index';
			$this->load->view('template', $data);
		}
		if ($this->session->userdata('role') == 'siswa') {
			$data['title'] = 'Dashboard';
			$data['main'] = 'admin/dashboard/index';
			$this->load->view('template', $data);
		}	
	}

	public function countGuru()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->dashboard_model->countGuru();

		echo json_encode($r);
	}

	public function countKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->dashboard_model->countKelas();

		echo json_encode($r);
	}

	public function countMapel()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->dashboard_model->countMapel();

		echo json_encode($r);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */