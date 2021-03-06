<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

	public function getAllSiswa()
	{
		return $this->db
		->join('guru', 'guru.id_guru = siswa.id_guru', 'left')
		->get('siswa')->result();
	}

	public function getSiswaById($id)
	{
		return $this->db
		->where('id_siswa', $this->db->escape_str($id))
		->get('siswa')->result();
	}

	public function getSiswaByKelasIdAndThAjar($idKelas,$thAjar)
	{
		return $this->db
		->join('kelas_siswa', 'kelas_siswa.id_siswa = siswa.id_siswa')
		->where('id_kelas', $this->db->escape_str($idKelas))
		->where('th_ajar', $this->db->escape_str($thAjar))
		->order_by('siswa.nama_siswa', 'asc')
		->get('siswa')->result();
	}

	public function getSiswaByGuruId($idGuru)
	{
		return $this->db
		->where('id_guru', $this->db->escape_str($idGuru))
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

	public function editSiswa($id, $data)
	{
		$this->db
		->where('id_siswa', $this->db->escape_str($id))
		->update('siswa', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteSiswa($id)
	{
		$this->db
		->where('id_siswa', $this->db->escape_str($id))
		->delete('siswa');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file siswa_model.php */
/* Location: ./application/models/siswa_model.php */