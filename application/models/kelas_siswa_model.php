<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_siswa_model extends CI_Model {

<<<<<<< HEAD
	public function cekKelasSiswa($idKelasSiswa,$idSiswa)
	{
		return $this->db
		->where('id_kelas_siswa', $idKelasSiswa)
		->where('id_siswa', $idSiswa)
		->get('kelas_siswa')->result();
	}

	public function getKelasBySiswaId($id)
	{
		return $this->db
		->where('id_siswa', $this->db->escape_str($id))
		->get('kelas_siswa')->result();
	}

	public function deleteKelasSiswaBySiswaId($id)
	{
		$this->db
		->where('id_siswa', $this->db->escape_str($id))
		->delete('kelas_siswa');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addKelasSiswa($data)
	{
		$this->db->insert('kelas_siswa', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

=======
	public function getThAjar()
	{
		return $this->db
		->distinct()
		->select('th_ajar')
		->order_by('th_ajar', 'desc')
		->get('kelas_siswa')->result();
	}

>>>>>>> 45260ee5ccc3e869d4fd3b3684d50b8749f077c3
}

/* End of file kelas_siswa_model.php */
/* Location: ./application/models/kelas_siswa_model.php */