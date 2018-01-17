<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function login($username,$password)
	{
		$query = $this->db->where('nisn', $this->db->escape_str($username))
		->get('siswa')->row_array();
		if (password_verify($password, $query['password'])) {
			$siswa = $query;

			$session = array(
				'logged_in' => TRUE,
				'role' => 'siswa',
				'userid' => $siswa['id_siswa'],
				'username' => $siswa['nama_siswa'],
				'foto' => $siswa['foto_siswa'],
				'siswa' => $siswa
			);
			$this->session->set_userdata($session);

			return true;
		}

		$query = $this->db->where('nik', $this->db->escape_str($username))
		->get('guru')->row_array();
		if (password_verify($password, $query['password_guru'])) {
			$guru = $query;

			$session = array(
				'logged_in' => TRUE,
				'role' => 'guru',
				'userid' => $guru['id_guru'],
				'username' => $guru['nama_guru'],
				'foto' => $guru['foto_guru'],
				'guru' => $guru
			);
			$this->session->set_userdata($session);

			return true;
		}

		$query = $this->db->where('username', $this->db->escape_str($username))
		->get('admin')->row_array();
		if (password_verify($password, $query['password'])) {
			$admin = $query;

			$session = array(
				'logged_in' => TRUE,
				'role' => 'admin',
				'userid' => $admin['id_admin'],
				'username' => $admin['nama_admin'],
				'foto' => $admin['foto_admin'],
				'admin' => $admin
			);
			$this->session->set_userdata($session);

			return true;
		}

		return false;
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */