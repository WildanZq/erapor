<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum_model extends CI_Model {

	public function getAllKurikulum()
	{
		return $this->db->get('kurikulum')
						->result();
	}


}

/* End of file kurikulum_model.php */
/* Location: ./application/models/kurikulum_model.php */