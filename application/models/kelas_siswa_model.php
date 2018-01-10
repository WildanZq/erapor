<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_siswa_model extends CI_Model {

	public function getThAjar()
	{
		return $this->db
		->distinct()
		->select('th_ajar')
		->order_by('th_ajar', 'desc')
		->get('kelas_siswa')->result();
	}

}

/* End of file kelas_siswa_model.php */
/* Location: ./application/models/kelas_siswa_model.php */