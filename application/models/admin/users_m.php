<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function create($data)
	{
		$this->db->insert('users',$data);

	}

	public function get($table, $where = FALSE, $single = FALSE)
	{
		if($where == TRUE)
		{
			$this->db->where($where);
		}

		 $query = $this->db->get($table);

		 #pobieranie jednej wartości
		if($single == TRUE)
		{
			return $query->row();
		}
		#pobieranie wszystkich rekordów
		
		return $query->result();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

	public function unique_email($id, $email)
	{
		$this->db->where('email', $email);

		!$id || $this->db->where('id !=', $id);


	} 
}

/* End of file users_m.php */
/* Location: ./application/models/users_m.php */