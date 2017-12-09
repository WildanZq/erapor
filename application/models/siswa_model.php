<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	public function getAllSiswa()
	{
		return $this->db
		->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
		->join('kelompok_kelas', 'kelompok_kelas.id_kelompok_kelas = kelas.id_kelompok_kelas')
		->get('siswa')->result();
	}

	public function getSiswaById($idSiswa)
	{
		return $this->db
		->where('id_siswa', $this->db->escape_str($idSiswa))
		->get('siswa')->result();
	}

	public function addSiswa($data)
	{
		$this->db->insert('siswa', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file siswa_model.php */
/* Location: ./application/models/siswa_model.php */