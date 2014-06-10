<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/users_m');
	}

	public function index()
	{
		echo 'Panel Admina';
	}

	public function login()
	{
		$this->loggedin() == TRUE || redirect('admin/panel');
		if($_POST)
		{
			$config = array(
				    'required' => 'Pole %s jest wymagane',
				    'valid_email' => 'Wpisałeś nie poprawny adres email',
			);

				$this->form_validation->set_message($config);

				if ($this->form_validation->run('panel_login') == TRUE)
				{	
				//jeśli walidacja zadziałała

					$data = array(
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),	
					);
					
					$data['password'] = hash_salt($data['password']);

					//sprawdzenie czy użytkownik istnieje w bazie

					$user = $this->users_m->get('users', $data, TRUE);
					if( !empty($user) )
					{
						$data = array(
							'id' => $user->id,
							'name' => $user->name,
							'email' => $user->email,
							'loggedin' => TRUE,
							);
						$this->session->set_userdata($data);
						redirect('admin/panel');
					}

					else
					{
						echo 'Złe hasło bądź login';
					}


					//redirect('admin/users');
				}

		}
		$this->load->view('admin/panel/login');
	}

	public function loggedin()
	{
		return !$this->session->userdata('loggedin');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		echo 'wylogowany';
	}
}

/* End of file panel.php */
/* Location: ./application/controllers/panel.php */