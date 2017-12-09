<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

	public function getAllGuru()
	{
		return $this->db
		->get('guru')->result();
	}

}

/* End of file guru_model.php */
/* Location: ./application/models/guru_model.php */