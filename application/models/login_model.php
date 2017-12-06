<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
	}

	public function login($username,$password)
	{
		$query = $this->db->where('nisn', $this->db->escape_str($username))
		->where('password', $this->db->escape_str($password))
		->get('siswa');
		if ($this->db->affected_rows() == 1) {
			$siswa = $query->row_array();

			$session = array(
				'logged_in' => TRUE,
				'role' => 'siswa',
				'userid' => $siswa['id_siswa'],
				'username' => $siswa['nama_siswa'],
				'foto' => $siswa['foto_siswa']
			);
			$this->session->set_userdata($session);

			return true;
		}

		$query = $this->db->where('nik', $this->db->escape_str($username))
		->where('password', $this->db->escape_str($password))
		->get('guru');
		if ($this->db->affected_rows() == 1) {
			$guru = $query->row_array();

			$session = array(
				'logged_in' => TRUE,
				'role' => 'guru',
				'userid' => $guru['id_guru'],
				'username' => $guru['nama_guru'],
				'foto' => $guru['foto_guru']
			);
			$this->session->set_userdata($session);

			return true;
		}

		$query = $this->db->where('username', $this->db->escape_str($username))
		->where('password', $this->db->escape_str($password))
		->get('admin');
		if ($this->db->affected_rows() == 1) {
			$admin = $query->row_array();

			$session = array(
				'logged_in' => TRUE,
				'role' => 'admin',
				'userid' => $admin['id_admin'],
				'username' => $admin['username']
			);
			$this->session->set_userdata($session);

			return true;
		}

		return false;
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */