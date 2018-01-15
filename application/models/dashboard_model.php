<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function countSiswa(){
		return $this->db->count_all_results('siswa');
	}

	public function countKelas(){
		return $this->db->count_all_results('kelas');
    }

    public function countGuru(){
		return $this->db->count_all_results('guru');
    }

    public function countMapel(){
		return $this->db->count_all_results('mapel');
    }

}

/* End of file dashboard_model.php */
/* Location: ./application/models/dashboard_model.php */