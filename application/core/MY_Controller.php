<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$data['loggedin'] = $this->loggedin();
		$this->load->vars($data);
	}

	public function index()
	{
		
	}

	public function loggedin()
	{
		return $this->session->userdata('loggedin');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/panel');
		
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */