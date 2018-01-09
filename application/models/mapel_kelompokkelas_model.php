<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_kelompokkelas_model extends CI_Model {

	public function getMapelByKelompokKelasId($id)
	{
		return $this->db
		->where('id_kelompok_kelas', $this->db->escape_str($id))
		->get('mapel_kelas')->result();
	}

	public function deleteMapelByKelompokKelasId($id)
	{
		$this->db
		->where('id_kelompok_kelas', $this->db->escape_str($id))
		->delete('mapel_kelas');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addMapelKelompokKelas($data)
	{
		$this->db->insert('mapel_kelas', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file mapel_kelompokkelas_model.php */
/* Location: ./application/models/mapel_kelompokkelas_model.php */