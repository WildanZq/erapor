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

	public function addMapel($data)
	{
		$this->db->insert('mapel', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getAllMapel()
	{
		return $this->db->get('mapel')
						->result();
	}

	public function getMapelById($idMapel)
	{
		return $this->db
		->where('id_mapel', $this->db->escape_str($idMapel))
		->get('mapel')->result();
	}

	public function editMapel($id, $data)
	{
		$this->db
		->where('id_mapel', $id)
		->update('mapel', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteMapel($id)
	{
		$this->db
		->where('id_mapel', $this->db->escape_str($id))
		->delete('mapel');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file mapel_model.php */
/* Location: ./application/models/mapel_model.php */