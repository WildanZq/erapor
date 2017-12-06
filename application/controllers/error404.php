<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {

	public function index()
	{
		$this->output->set_status_header('404');
		$data['title'] = '404 Page Not Found';
		$this->load->view('error404_view', $data);
	}

}

/* End of file error404.php */
/* Location: ./application/controllers/error404.php */