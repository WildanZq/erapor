<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel_model extends CI_Model {

	public function getMapelGuru($idGuru)
	{
		return $this->db
		->join('mapel', 'mapel.id_mapel = mapel_guru.id_mapel')
		->join('kurikulum', 'kurikulum.id_kurikulum = mapel.id_kurikulum')
		->join('jenis_mapel', 'jenis_mapel.id_jenis_mapel = mapel.id_jenis_mapel')
		->where('id_guru', $this->db->escape_str($idGuru))
		->get('mapel_guru')->result();
	}

	public function getMapelSiswa($idSiswa)
	{
		return $this->db
		->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
		->join('mapel_kelas', 'mapel_kelas.id_kelas = kelas.id_kelas')
		->join('mapel', 'mapel.id_mapel = mapel_kelas.id_mapel')
		->join('kurikulum', 'kurikulum.id_kurikulum = mapel.id_kurikulum')
		->join('jenis_mapel', 'jenis_mapel.id_jenis_mapel = mapel.id_jenis_mapel')
		->where('id_siswa', $this->db->escape_str($idSiswa))
		->get('siswa')->result();
	}

}

/* End of file mapel_model.php */
/* Location: ./application/models/mapel_model.php */