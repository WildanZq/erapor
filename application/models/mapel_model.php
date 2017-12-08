<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_model extends CI_Model {

	public function getMapelGuru($idGuru)
	{
		return $this->db
		->select('mapel.id_mapel, mapel.nama_mapel, mapel.kkm, kurikulum.nama_kurikulum')
		->join('mapel', 'mapel.id_mapel = mapel_guru.id_mapel')
		->join('kurikulum', 'kurikulum.id_kurikulum = mapel.id_kurikulum')
		->where('id_guru', $this->db->escape_str($idGuru))
		->get('mapel_guru')->result();
	}

	public function getMapelSiswa($idSiswa)
	{
		return $this->db
		->select('mapel.id_mapel, mapel.nama_mapel, mapel.kkm, kurikulum.nama_kurikulum')
		->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
		->join('mapel_kelas', 'mapel_kelas.id_kelas = kelas.id_kelas')
		->join('mapel', 'mapel.id_mapel = mapel_kelas.id_mapel')
		->join('kurikulum', 'kurikulum.id_kurikulum = mapel.id_kurikulum')
		->where('id_siswa', $this->db->escape_str($idSiswa))
		->get('siswa')->result();
	}

}

/* End of file mapel_model.php */
/* Location: ./application/models/mapel_model.php */