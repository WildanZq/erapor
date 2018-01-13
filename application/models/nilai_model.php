<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_model extends CI_Model {

	public function getNilaiKD($idKelasSiswa,$idMapel,$semester)
	{
		return $this->db
		->join('kd', 'kd.id_kd = nilai_kd.id_kd')
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai_kd')->result();
	}

	public function getNilaiKDById($idKelasSiswa,$id)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_kd', $this->db->escape_str($id))
		->get('nilai_kd')->result();
	}

	public function getAllNilaiKD($idMapel,$semester)
	{
		return $this->db
		->join('kd', 'kd.id_kd = nilai_kd.id_kd')
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai_kd')->result();
	}

	public function updateNilaiKD($data,$idKelasSiswa,$id)
	{
		$this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_kd', $this->db->escape_str($id))
		->update('nilai_kd', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addNilaiKD($data)
	{
		$this->db->insert('nilai_kd', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getAllNilai($idMapel,$semester)
	{
		return $this->db
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai')->result();
	}

	public function getNilai($idKelasSiswa,$idMapel,$semester)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai')->result();
	}

	public function updateNilai($data,$idKelasSiswa,$idMapel,$semester)
	{
		$this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->update('nilai', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addNilai($data)
	{
		$this->db->insert('nilai', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file nilai_model.php */
/* Location: ./application/models/nilai_model.php */