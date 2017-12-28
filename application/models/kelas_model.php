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