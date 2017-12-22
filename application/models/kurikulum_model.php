<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum_model extends CI_Model {

	public function getAllKurikulum()
	{
		return $this->db->get('kurikulum')
						->result();
	}

	public function addKurikulum($data)
	{
		$this->db->insert('kurikulum', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getKurikulumById($idKurikulum)
	{
		return $this->db
		->where('id_kurikulum', $this->db->escape_str($idKurikulum))
		->get('kurikulum')->result();
	}

	public function editKurikulum($id, $data)
	{
		$this->db
		->where('id_kurikulum', $id)
		->update('kurikulum', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteKurikulum($id)
	{
		$this->db
		->where('id_kurikulum', $this->db->escape_str($id))
		->delete('kurikulum');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file kurikulum_model.php */
/* Location: ./application/models/kurikulum_model.php */