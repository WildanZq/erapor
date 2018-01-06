<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_kelas_model extends CI_Model {

	public function getMapelByKelasId($id)
	{
		return $this->db
		->where('id_kelas', $this->db->escape_str($id))
		->get('mapel_kelas')->result();
	}

	public function deleteMapelKelasByKelasId($id)
	{
		$this->db
		->where('id_kelas', $this->db->escape_str($id))
		->delete('mapel_kelas');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addMapelKelas($data)
	{
		$this->db->insert('mapel_kelas', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file mapel_kelas_model.php */
/* Location: ./application/models/mapel_kelas_model.php */