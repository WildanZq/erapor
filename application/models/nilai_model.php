<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_model extends CI_Model {

	public function addNilaiSikap($data,$idKelasSiswa,$semester)
	{
		$this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('semester', $this->db->escape_str($semester))
		->insert('nilai_sikap', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function updateNilaiSikap($data,$idKelasSiswa,$semester)
	{
		$this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('semester', $this->db->escape_str($semester))
		->update('nilai_sikap', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getNilaiSikap($idKelasSiswa,$semester)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai_sikap')->result();
	}

	public function getAVGNilaiKelas($idKelas,$semester,$thAjar)
	{
		return $this->db
		->select('id_mapel, (SELECT COUNT(*) FROM nilai JOIN kelas_siswa ON kelas_siswa.id_kelas_siswa = nilai.id_kelas_siswa JOIN kelas ON kelas.id_kelas = kelas_siswa.id_kelas WHERE nilai.nilai_akhir > n.nilai_akhir AND kelas.id_kelas = '.$this->db->escape_str($idKelas).' AND semester = '.$this->db->escape_str($semester).' AND kelas_siswa.th_ajar = ks.th_ajar)+1 AS position')
		->select_avg('nilai_akhir')
		->join('kelas_siswa AS ks', 'ks.id_kelas_siswa = n.id_kelas_siswa')
		->join('kelas', 'kelas.id_kelas = ks.id_kelas')
		->group_by('id_mapel')
		->where('kelas.id_kelas', $this->db->escape_str($idKelas))
		->where('semester', $this->db->escape_str($semester))
		->where('th_ajar', $this->db->escape_str($thAjar))
		->get('nilai AS n')->result();
	}

	public function getNilaiByKelasSiswaAndSemester($idKelasSiswa,$semester)
	{
		return $this->db
		->join('kelas_siswa', 'kelas_siswa.id_kelas_siswa = nilai.id_kelas_siswa')
		->where('kelas_siswa.id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai')->result();
	}

	public function getNilaiKD($idKelasSiswa,$idMapel,$semester)
	{
		return $this->db
		->join('kd', 'kd.id_kd = nilai_kd.id_kd')
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai_kd')->result();
	}

	public function getNilaiKDById($idKelasSiswa,$id)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_kd', $this->db->escape_str($id))
		->get('nilai_kd')->result();
	}

	public function getAllNilaiKD($idMapel,$semester)
	{
		return $this->db
		->join('kd', 'kd.id_kd = nilai_kd.id_kd')
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai_kd')->result();
	}

	public function updateNilaiKD($data,$idKelasSiswa,$id)
	{
		$this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_kd', $this->db->escape_str($id))
		->update('nilai_kd', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addNilaiKD($data)
	{
		$this->db->insert('nilai_kd', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function getAllNilai($idMapel,$semester)
	{
		return $this->db
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai')->result();
	}

	public function getNilai($idKelasSiswa,$idMapel,$semester)
	{
		return $this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->get('nilai')->result();
	}

	public function updateNilai($data,$idKelasSiswa,$idMapel,$semester)
	{
		$this->db
		->where('id_kelas_siswa', $this->db->escape_str($idKelasSiswa))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('semester', $this->db->escape_str($semester))
		->update('nilai', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function addNilai($data)
	{
		$this->db->insert('nilai', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file nilai_model.php */
/* Location: ./application/models/nilai_model.php */