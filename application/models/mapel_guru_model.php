<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_guru_model extends CI_Model {

	public function cekMapelGuru($idMapel,$idGuru)
	{
		return $this->db
		->where('id_mapel', $idMapel)
		->where('id_guru', $idGuru)
		->get('mapel_guru')->result();
	}

	public function getMapelByGuruId($id)
	{
		return $this->db
		->where('id_guru', $this->db->escape_str($id))
		->get('mapel_guru')->result();
	}

	public function deleteMapelGuruByGuruId($id)
	{
		$this->db
		->where('id_guru', $this->db->escape_str($id))
		->delete('mapel_guru');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addMapelGuru($data)
	{
		$this->db->insert('mapel_guru', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file mapel_guru_model.php */
/* Location: ./application/models/mapel_guru_model.php */