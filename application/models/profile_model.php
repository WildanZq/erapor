<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

	public function editProfile($id,$data)
	{
		$this->db
		->where('id_admin', $this->db->escape_str($id))
		->update('admin', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getProfile($id)
	{
		return $this->db
		->where('id_admin', $this->db->escape_str($id))
		->get('admin')->result();
	}

	public function getProfileArray($id)
	{
		return $this->db
		->where('id_admin', $this->db->escape_str($id))
		->get('admin')->row_array();
	}

}

/* End of file profile_model.php */
/* Location: ./application/models/profile_model.php */