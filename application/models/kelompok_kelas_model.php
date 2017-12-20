<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok_kelas_model extends CI_Model {

	
	public function getAllKelompokKelas()
	{
		return $this->db->get('kelompok_kelas')
						->result();
	}

}

/* End of file kelompok_kelas_model.php */
/* Location: ./application/models/kelompok_kelas_model.php */