<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumus_model extends CI_Model {

	public function getAllRumus()
	{
		return $this->db->get('rumus')
						->result();
	}

	public function getRumus($rumus)
	{
		return $this->db
		->where('nilai_kd', $this->db->escape_str($rumus))
		->get('rumus')->result();
	}

	public function editRumus($id, $data)
	{
		$this->db
		->where('nilai_kd', $id)
		->update('rumus', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file rumus_model.php */
/* Location: ./application/models/rumus_model.php */