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
				//ładowanie biblioteke
				$this->load->library('form_validation');

				$config = array(
				               array(
				                     'field'   => 'name', 
				                     'label'   => 'Imie', 
				                     'rules'   => 'trim|required'
				                  ),
				               array(
				                     'field'   => 'email', 
				                     'label'   => 'Email', 
				                     'rules'   => 'trim|required|valid_email|is_unique[users.email]'
				                  ),
				               array(
				                     'field'   => 'password', 
				                     'label'   => 'Hasło', 
				                     'rules'   => 'trim|required|matches[passconf]'
				                  ),   
				               array(
				                     'field'   => 'passconf', 
				                     'label'   => 'Potwierdzenie hasła', 
				                     'rules'   => 'trim|required'
				                  )
            );
				$this->form_validation->set_rules($config);


				$config = array(
				    'required' => 'Pole %s jest wymagane',
				    'valid_email' => 'Wpisałeś nie poprawny adres email',
				    'matches' => 'Hasła nie sa identyczne',
				    'is_unique' => 'Adres email jest juz w bazie danych', 
            	);

				$this->form_validation->set_message($config);

				
				if ($this->form_validation->run() == True)
				{	
				//jeśli walidacja nie zadziałała

					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),	
					);
					
					$data['password'] = hash_salt($data['password']);

					
					$this->users_m->create($data); 

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
				//ładowanie biblioteke
				$this->load->library('form_validation');

				$config = array(
				               array(
				                     'field'   => 'name', 
				                     'label'   => 'Imie', 
				                     'rules'   => 'trim|required'
				                  ),
				               array(
				                     'field'   => 'email', 
				                     'label'   => 'Email', 
				                     'rules'   => 'trim|required|valid_email|callback_unique_email'
				                  ),
				               array(
				                     'field'   => 'password', 
				                     'label'   => 'Hasło', 
				                     'rules'   => 'trim|matches[passconf]'
				                  ),   
				               array(
				                     'field'   => 'passconf', 
				                     'label'   => 'Potwierdzenie hasła', 
				                     'rules'   => 'trim'
				                  )
            );
				$this->form_validation->set_rules($config);


				$config = array(
				    'required' => 'Pole %s jest wymagane',
				    'valid_email' => 'Wpisałeś nie poprawny adres email',
				    'matches' => 'Hasła nie sa identyczne',
				    'is_unique' => 'Adres email jest juz w bazie danych', 
            	);

				$this->form_validation->set_message($config);

				
				if ($this->form_validation->run() == True)
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

					$this->users_m->update($id, $data);

					redirect('admin/users');
				}
				


				
		}
			$this->load->view('admin/users/edit', $data);
	}	

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
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