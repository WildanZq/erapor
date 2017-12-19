<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_mapel_model extends CI_Model {

	public function getAllJenisMapel()
	{
		return $this->db->get('jenis_mapel')
						->result();
	}

}

/* End of file jenis_mapel_model.php */
/* Location: ./application/models/jenis_mapel_model.php */