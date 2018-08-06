<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function fetch_data(){
		$query = $this->db->get('category');
		return $query->result();
	}
	public function create($data){
		$this->db->insert('category', $data);
	}
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('category');
	}
	
}

/* End of file CategoryModel.php */
/* Location: ./application/models/CategoryModel.php */