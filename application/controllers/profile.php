<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (! $this->session->userdata('logged_in') || $this->session->userdata('logged_in') == null) {
			redirect('/');
		}
		$this->load->model('service_model');
	}

	public function index()
	{
		if ($this->session->userdata('role') == 'admin') {
			$data['title'] = 'Profile Settings';
			$data['main'] = 'admin/profile/index';
			$this->load->view('template', $data);
			return;
		}

		if ($this->session->userdata('role') == 'guru') {
			$data['title'] = 'Profile Settings';
			$data['main'] = 'guru/profile/index';
			$this->load->view('template', $data);
			return;
		}

		if ($this->session->userdata('role') == 'siswa') {
			$data['title'] = 'Profile Settings';
			$data['main'] = 'siswa/profile/index';
			$this->load->view('template', $data);
			return;
		}

		$data['title'] = '404 Page Not Found';
    	$this->load->view('error404_view',$data);
	}

	public function editPassword()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		if ($this->session->userdata('role') == 'admin') {
			$this->load->model('admin_model');

			$r = array('status' => false, 'error' => '');

			if ($this->input->post('password') == '') {
				$r['error'] = 'Isi password baru!';
				echo json_encode($r);
				return;
			}
			if ($this->input->post('password') != $this->input->post('password2')) {
				$r['error'] = 'Password tidak sama!';
				echo json_encode($r);
				return;
			}

			$data = array( 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT) );
			$data = $this->service_model->escape_array($data);
			if ($this->admin_model->editPassword($data, $this->session->userdata('userid'))) {
				$r['status'] = true;
			} else {
				$r['error'] = 'Edit password gagal';
			}

			echo json_encode($r);
		}
	}

	public function cekPassword()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		if ($this->session->userdata('role') == 'admin') {
			$this->load->model('admin_model');

			$r = array('valid' => false, 'error' => '');
			
			if (! $this->input->post('password')) {
				$r['error'] = 'Masukkan password!';
			} elseif ($this->admin_model->cekPassword($this->input->post('password'),$this->session->userdata('userid'))) {
				$r['valid'] = true;
			} else {
				$r['error'] = 'Password salah!';
			}

			echo json_encode($r);
		}
	}

	public function editProfile()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		if ($this->session->userdata('role') == 'admin') {
			$this->load->model('admin_model');

			$r = array('status' => false, 'error' => '', 'nama' => '', 'username' => '');
			$data = array(
				'nama_admin' => $this->input->post('nama'),
				'username' => $this->input->post('username')
			);

			if ($this->input->post('id') == '' || $data['nama_admin'] == '' || $data['username'] == '') {
				$r['error'] = 'Isi semua data yang diperlukan!';
				echo json_encode($r);
				return;
			}

			$data = $this->service_model->escape_array($data);
			if ($this->admin_model->editAdmin($this->input->post('id'), $data)) {
				$r['status'] = true;

				$p = $this->admin_model->getAdminById($this->session->userdata('userid'))[0];
				$r['nama'] = $p->nama_admin;
				$r['username'] = $p->username;

				$session = array(
					'username' => $p->nama_admin,
					'admin' => $this->db->where('id_admin', $this->db->escape_str($this->session->userdata('userid')))->get('admin')->row_array()
				);
				$this->session->set_userdata($session);
			} else {
				$r['error'] = 'Gagal mengedit profile';
			}

			echo json_encode($r);
		}

	}

	public function getProfile()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}

		if ($this->session->userdata('role') == 'admin') {
			$this->load->model('admin_model');
			$r = $this->admin_model->getAdminById($this->session->userdata('userid'));
		}

		echo json_encode($r[0]);
	}

}

/* End of file profile.php */
/* Location: ./application/controllers/profile.php */