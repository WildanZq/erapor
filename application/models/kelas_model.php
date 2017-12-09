<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

	public function getAllKelas()
	{
		return $this->db
		->join('kelompok_kelas', 'kelompok_kelas.id_kelompok_kelas = kelas.id_kelompok_kelas')
		->get('kelas')->result();
	}

}

/* End of file kelas_model.php */
/* Location: ./application/models/kelas_model.php */