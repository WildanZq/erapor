<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getAllAdmin()
	{
		return $this->db->get('admin')
						->result();
	}

	public function addAdmin($data)
	{
		$this->db->insert('admin', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteAdmin($id)
	{
		$this->db
		->where('id_admin', $this->db->escape_str($id))
		->delete('admin');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */