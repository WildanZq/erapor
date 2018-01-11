<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('nilai_model');
		$this->load->model('service_model');
	}

	public function getNilaiKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getNilaiKD($this->input->get('id_kelas_siswa'));

		echo json_encode($r);
	}

	public function getnilai()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getNilai($this->input->get('id_kelas_siswa'),$this->input->get('id_mapel'));

		echo json_encode($r[0]);
	}

}

/* End of file nilai.php */
/* Location: ./application/controllers/nilai.php */