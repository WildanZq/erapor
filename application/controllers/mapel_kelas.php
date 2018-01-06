<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('mapel_kelas_model');
		$this->load->model('service_model');
	}

	public function getMapelByKelasId()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->mapel_kelas_model->getMapelByKelasId($this->input->get('id'));

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
		if ($this->input->post('id') == '') {
			$r['error'] = 'Isi semua data yang diperlukan!';
			echo json_encode($r);
			return;
		}

		$this->mapel_kelas_model->deleteMapelKelasByKelasId($this->input->post('id'));

		foreach ($this->input->post('mapel') as $mapel) {
			$data = array('id_mapel' => $mapel, 'id_kelas' => $this->input->post('id'));
			$data = $this->service_model->escape_array($data);
			if ($this->mapel_kelas_model->addMapelKelas($data)) {
				$r['status'] = true;
			} else {
				$r['error'] = 'Gagal menambahkan siswa';
			}
		}

		echo json_encode($r);
	}

}

/* End of file mapel_kelas.php */
/* Location: ./application/controllers/mapel_kelas.php */