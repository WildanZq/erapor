<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_model extends CI_Model {

	public function getNilaiKD($idKelasSiswa)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->get('nilai_kd')->result();
	}

	public function getNilai($idKelasSiswa,$idMapel)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->get('nilai')->result();
	}

}

/* End of file nilai_model.php */
/* Location: ./application/models/nilai_model.php */