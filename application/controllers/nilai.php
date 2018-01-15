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

	public function editNilaiSikap()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => '', 'ns' => '-');

		if ($this->input->post('nilai') == '-') {
			$r['error'] = 'Masukkan nilai!';
			echo json_encode($r);
			return;
		}

		if ($this->nilai_model->getNilaiSikap($this->input->post('id_kelas_siswa'),$this->input->post('semester'))) {
			$data = array('nilai' => $this->input->post('nilai'));
			$data = $this->service_model->escape_array($data);
			if ($this->nilai_model->updateNilaiSikap($data,$this->input->post('id_kelas_siswa'),$this->input->post('semester'))) {
				$r['status'] = true;
			}
		} else {
			$data = array(
				'nilai' => $this->input->post('nilai'),
				'id_kelas_siswa' => $this->input->post('id_kelas_siswa'),
				'semester' => $this->input->post('semester')
			);
			$data = $this->service_model->escape_array($data);
			if ($this->nilai_model->addNilaiSikap($data,$this->input->post('id_kelas_siswa'),$this->input->post('semester'))) {
				$r['status'] = true;
			}
		}
		if ($r['status']) {
			$r['ns'] = $this->input->post('nilai');
		} else {
			$r['error'] = 'Gagal edit Nilai sikap';
		}

		echo json_encode($r);
	}

	public function getNilaiSikap()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getNilaiSikap($this->input->get('id_kelas_siswa'),$this->input->get('semester'));

		echo json_encode($r);
	}

	public function getAVGNilaiKelas()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getAVGNilaiKelas($this->input->get('id_kelas'),$this->input->get('semester'),$this->input->get('th_ajar'));

		echo json_encode($r);
	}

	public function getNilaiByKelasSiswaAndSemester()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getNilaiByKelasSiswaAndSemester($this->input->get('id_kelas_siswa'),$this->input->get('semester'));

		echo json_encode($r);
	}

	public function getNilaiKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getNilaiKD($this->input->get('id_kelas_siswa'),$this->input->get('id_mapel'),$this->input->get('semester'));

		echo json_encode($r);
	}

	public function getAllNilaiKD()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getAllNilaiKD($this->input->get('id_mapel'),$this->input->get('semester'));

		echo json_encode($r);
	}

	public function getAllNilai()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getAllNilai($this->input->get('id_mapel'),$this->input->get('semester'));

		echo json_encode($r);
	}

	public function getNilai()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = $this->nilai_model->getNilai($this->input->get('id_kelas_siswa'),$this->input->get('id_mapel'),$this->input->get('semester'));

		echo json_encode($r);
	}

	public function editNilai()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		$r = array('status' => false, 'error' => ''); $nilai = false; $kd = false;

		foreach ($this->input->post('kd') as $key) {
			if ($this->nilai_model->getNilaiKDById($this->input->post('id_kelas_siswa'),$key)) {
				$data = array('nilai' => $this->input->post($key) );
				$data = $this->service_model->escape_array($data);
				if ($this->nilai_model->updateNilaiKD($data,$this->input->post('id_kelas_siswa'),$key)) {
					$kd = true;
				}
			} else {
				$data = array(
					'nilai' => $this->input->post($key),
					'id_kd' => $key,
					'id_kelas_siswa' => $this->input->post('id_kelas_siswa')
				);
				$data = $this->service_model->escape_array($data);
				if ($this->nilai_model->addNilaiKD($data)) {
					$kd = true;
				}
			}
		}

		if ($this->nilai_model->getNilai($this->input->post('id_kelas_siswa'),$this->input->post('id_mapel'),$this->input->post('semester'))) {
			$data = array('nilai_uts' => $this->input->post('uts'), 'nilai_uas' => $this->input->post('uas') );
			$data = $this->service_model->escape_array($data);
			if ($this->nilai_model->updateNilai($data,$this->input->post('id_kelas_siswa'),$this->input->post('id_mapel'),$this->input->post('semester'))) {
				$nilai = true;
			}
		} else {
			$data = array(
				'nilai_uts' => $this->input->post('uts'),
				'nilai_uas' => $this->input->post('uas'),
				'id_mapel' => $this->input->post('id_mapel'),
				'semester' => $this->input->post('semester'),
				'id_kelas_siswa' => $this->input->post('id_kelas_siswa')
			);
			$data = $this->service_model->escape_array($data);
			if ($this->nilai_model->addNilai($data)) {
				$nilai = true;
			}
		}

		if ($nilai || $kd) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Gagal Edit Nilai';
		}

		echo json_encode($r);
	}

}

/* End of file nilai.php */
/* Location: ./application/controllers/nilai.php */