<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('service_model');
		$this->load->model('kelas_siswa_model');
	}

	public function getThAjar()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->kelas_siswa_model->getThAjar();

		echo json_encode($r);
	}
}

/* End of file kelas_siswa.php */
/* Location: ./application/controllers/kelas_siswa.php */