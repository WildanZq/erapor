<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_kelas_model extends CI_Model {

	
	public function getAllKelompokKelas()
	{
		return $this->db->get('kelompok_kelas')
						->result();
	}

	public function addKelompokKelas($data)
	{
		$this->db->insert('kelompok_kelas', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getKelompokKelasById($idKelompokKelas)
	{
		return $this->db
		->where('id_kelompok_kelas', $this->db->escape_str($idKelompokKelas))
		->get('kelompok_kelas')->result();
	}

	public function editKelompokKelas($id, $data)
	{
		$this->db
		->where('id_kelompok_kelas', $id)
		->update('kelompok_kelas', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteKelompokKelas($id)
	{
		$this->db
		->where('id_kelompok_kelas', $this->db->escape_str($id))
		->delete('kelompok_kelas');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file kelompok_kelas_model.php */
/* Location: ./application/models/kelompok_kelas_model.php */