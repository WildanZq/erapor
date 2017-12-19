<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_guru_model extends CI_Model {

	public function cekMapelGuru($idMapel,$idGuru)
	{
		return $this->db
		->where('id_mapel', $idMapel)
		->where('id_guru', $idGuru)
		->get('mapel_guru')->result();
	}

}

/* End of file mapel_guru_model.php */
/* Location: ./application/models/mapel_guru_model.php */