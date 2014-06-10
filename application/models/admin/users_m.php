<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends MY_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
 		
	public function unique_email($id, $email)
	{
		$this->db->where('email', $email);

		!$id || $this->db->where('id !=', $id);


	} 
}

/* End of file users_m.php */
/* Location: ./application/models/users_m.php */