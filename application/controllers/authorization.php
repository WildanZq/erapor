<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard');
		}

		$data['title'] = 'Login';
		$this->load->view('login_view', $data);
	}

	public function login()
	{
		if(! $this->input->is_ajax_request()) {
			$data['title'] = '404 Page Not Found';
    		$this->load->view('error404_view',$data);
    		return;
		}
		if ($this->session->userdata('logged_in')) {
			redirect('dashboard');
		}

		$r = array('status' => false, 'error' => '');

		if ($this->input->post('username') == '' || $this->input->post('password') == '') {
			$r['error'] = 'Fill all the input!';
			echo json_encode($r);
			return;
		}
		if ($this->login_model->login($this->input->post('username'),$this->input->post('password'))) {
			$r['status'] = true;
		} else {
			$r['error'] = 'Invalid Username or Password';
		}

		echo json_encode($r);
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('guru');
		$this->session->unset_userdata('siswa');

		redirect('/');
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */