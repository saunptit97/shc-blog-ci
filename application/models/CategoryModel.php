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
	public function get_last_id(){
		$this->db->select_max('id');
		$query = $this->db->get('category');
		return $query->result();
	}
	public function find_category($id){
		$this->db->where('id', $id);
		$data = $this->db->get('category')->row();
		return $data;
	}
	public function update($data, $id){
		$this->db->where('id',$id);
		$this->db->update('category', $data);
	}
}

/* End of file CategoryModel.php */
/* Location: ./application/models/CategoryModel.php */