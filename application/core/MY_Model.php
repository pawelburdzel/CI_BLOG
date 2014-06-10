<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function create($table, $data)
	{
		$this->db->insert($table ,$data);

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

	public function update($table, $where, $data)
		{
			$this->db->where($where);
			$this->db->update($table, $data);
		}

	public function delete($table, $where){
		$this->db->where($where);
		$this->db->delete($table);
	}



}

/* End of file MY_Model.php */
/* Location: ./application/controllers/MY_Model.php */