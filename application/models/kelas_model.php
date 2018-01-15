<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {

	public function getAllKelas()
	{
		return $this->db
		->join('kelompok_kelas', 'kelompok_kelas.id_kelompok_kelas = kelas.id_kelompok_kelas')
		->order_by('nama_kelas', 'asc')
		->get('kelas')->result();
	}

	public function cekKelasSiswa($idKelasSiswa,$id)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_siswa', $this->db->escape_str($id))
		->count_all_results('kelas_siswa');
	}

	public function addKelas($data)
	{
		$this->db->insert('kelas', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getKelasById($idKelas)
	{
		return $this->db
		->where('id_kelas', $this->db->escape_str($idKelas))
		->get('kelas')->result();
	}

	public function getKelasByMapelId($id)
	{
		return $this->db
		->join('kelompok_kelas', 'kelompok_kelas.id_kelompok_kelas = kelas.id_kelompok_kelas')
		->join('mapel_kelas', 'kelompok_kelas.id_kelompok_kelas = mapel_kelas.id_kelompok_kelas')
		->where('id_mapel', $this->db->escape_str($id))
		->get('kelas')->result();
	}

	public function getKelasBySiswaId($id)
	{
		return $this->db
		->join('kelas_siswa', 'kelas_siswa.id_kelas = kelas.id_kelas')
		->where('id_siswa', $this->db->escape_str($id))
		->order_by('th_ajar', 'desc')
		->get('kelas')->result();
	}

	public function editKelas($id, $data)
	{
		$this->db
		->where('id_kelas', $id)
		->update('kelas', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteKelas($id)
	{
		$this->db
		->where('id_kelas', $this->db->escape_str($id))
		->delete('kelas');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file kelas_model.php */
/* Location: ./application/models/kelas_model.php */