<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_siswa_model extends CI_Model {

	public function cekKelasSiswa($idKelasSiswa,$idSiswa)
	{
		return $this->db
		->where('id_kelas_siswa', $idKelasSiswa)
		->where('id_siswa', $idSiswa)
		->get('kelas_siswa')->result();
	}

	public function getAllKelasSiswa($id)
	{
		return $this->db
		->join('kelas', 'kelas.id_kelas = kelas_siswa.id_kelas')
		->where('id_siswa', $id)
		->order_by('th_ajar', 'asc')
		->get('kelas_siswa')->result();
	}

	public function deleteKelasSiswaBySiswaId($id)
	{
		$this->db
		->where('id_siswa', $this->db->escape_str($id))
		->delete('kelas_siswa');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addKelasSiswa($data)
	{
		$this->db->insert('kelas_siswa', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteKelasSiswa($id)
	{
		$this->db
		->where('id_kelas_siswa', $this->db->escape_str($id))
		->delete('kelas_siswa');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getThAjar()
	{
		return $this->db
		->distinct()
		->select('th_ajar')
		->order_by('th_ajar', 'desc')
		->get('kelas_siswa')->result();
	}

}

/* End of file kelas_siswa_model.php */
/* Location: ./application/models/kelas_siswa_model.php */