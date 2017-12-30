<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kd_model extends CI_Model {

	public function getKDBySemesterAndIdMapel($semester,$idMapel)
	{
		return $this->db
		->where('semester', $this->db->escape_str($semester))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->order_by('urutan', 'asc')
		->get('kd')->result();
	}

	public function getKDById($idKD)
	{
		return $this->db
		->where('id_kd', $this->db->escape_str($idKD))
		->get('kd')->result();
	}

	public function getMaxUrutanKDBySemesterAndIdMapel($semester,$idMapel)
	{
		return $this->db
		->select_max('urutan')
		->where('semester', $this->db->escape_str($semester))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->get('kd')->result();
	}

	public function addKD($data)
	{
		$this->db->insert('kd', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function editKD($idKD,$data)
	{
		$this->db
		->where('id_kd', $this->db->escape_str($idKD))
		->update('kd', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function deleteKD($id)
	{
		$this->db
		->where('id_kd', $this->db->escape_str($id))
		->delete('kd');
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

	public function moveKD($semester,$idMapel,$urutan,$data)
	{
		$this->db
		->where('semester', $this->db->escape_str($semester))
		->where('id_mapel', $this->db->escape_str($idMapel))
		->where('urutan', $this->db->escape_str($urutan))
		->update('kd', $data);
		if ($this->db->affected_rows() == 0) {
			return false;
		}
		return true;
	}

}

/* End of file kd_model.php */
/* Location: ./application/models/kd_model.php */