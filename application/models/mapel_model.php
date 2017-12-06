<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_model extends CI_Model {

	public function getMapelGuru($idGuru)
	{
		return $this->db
		->select('mapel.id_mapel, mapel.nama_mapel, mapel.kkm, mapel_guru.jml_kd')
		->join('mapel', 'mapel.id_mapel = mapel_guru.id_mapel')
		->where('id_guru', $this->db->escape_str($idGuru))
		->get('mapel_guru')->result();
	}

}

/* End of file mapel_model.php */
/* Location: ./application/models/mapel_model.php */