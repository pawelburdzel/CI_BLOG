<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/users_m');
	}

	public function index()
	{
		$data['users'] = $this->users_m->get('users');
		$this->load->view('admin/users/index', $data);
		
	}
	//metoda tworzenia użytkowników
	public function create()
	{
		//Jesli formularz zostanie przesłany
		if(!empty($_POST))
			{				

				
				
				$config = array(
				    'required' => 'Pole %s jest wymagane',
				    'valid_email' => 'Wpisałeś nie poprawny adres email',
				    'matches' => 'Hasła nie sa identyczne',
				    'is_unique' => 'Adres email jest juz w bazie danych', 
            	);

				$this->form_validation->set_message($config);

				
				if ($this->form_validation->run('users_create') == True)
				{	
				//jeśli walidacja zadziałała

					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),	
					);
					
					$data['password'] = hash_salt($data['password']);

					
					$this->users_m->create('users',$data); 

					redirect('admin/users');
				}
				
				
			}
		// widok formularza tworzenia użytkowników	
		$this->load->view('admin/users/create');
	}

	public function edit(){

		$id = $this->uri->segment(4);

		$where = array('id' => $id);
		$data['user'] = $this->users_m->get('users',$where, TRUE);

		$id = $data['user']->id;

		if(!empty($_POST))
			{	
				
				
				$config = array(
				    'required' => 'Pole %s jest wymagane',
				    'valid_email' => 'Wpisałeś nie poprawny adres email',
				    'matches' => 'Hasła nie sa identyczne',
				    'is_unique' => 'Adres email jest juz w bazie danych', 
            	);

				$this->form_validation->set_message($config);

				
				if ($this->form_validation->run('users_edit') == True)
				{	
				//jeśli walidacja nie zadziałała

					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),	
					);
					
					$data['password'] = hash_salt($data['password']);
					
					if ($this->input->post('password') == '')
					{
						$data['password'] = $data['user']->password;
					}

					$where = array('id' => $id);
					$this->users_m->update('users', $where, $data);

					redirect('admin/users');
				}
								
		}
			$this->load->view('admin/users/edit', $data);
	}	

	public function  delete($id)
	{

		$id = $this->uri->segment(4);
		$where = array('id' => $id);
		$this->users_m->delete('users', $where);

		redirect('admin/users');
	}


	 function _unique_email()
	{
			$id = $this->uri->segment(4); 
			$email = $this->input->post('email');

			$this->users_m->unique_email($id, $email);

			if( $this->users_m->get('users') )
			{
				$this->form_validation->set_message('_unique_email','Inny użytkownik ma już taki adres email');
				return False;
			}

			return TRUE;
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */