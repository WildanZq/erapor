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
		
	}

}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */