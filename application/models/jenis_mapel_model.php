<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_mapel_model extends CI_Model {

	public function getAllJenisMapel()
	{
		return $this->db->get('jenis_mapel')
						->result();
	}

	public function addJenisMapel($data)
	{
		$this->db->insert('jenis_mapel', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getJenisMapelById($idJenisMapel)
	{
		return $this->db
		->where('id_jenis_mapel', $this->db->escape_str($idJenisMapel))
		->get('jenis_mapel')->result();
	}

	public function editJenisMapel($id, $data)
	{
		$this->db
		->where('id_jenis_mapel', $id)
		->update('jenis_mapel', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteJenisMapel($id)
	{
		$this->db
		->where('id_jenis_mapel', $this->db->escape_str($id))
		->delete('jenis_mapel');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file jenis_mapel_model.php */
/* Location: ./application/models/jenis_mapel_model.php */