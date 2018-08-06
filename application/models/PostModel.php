<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PostModel extends CI_Model {

	public $variable;
	//private $table = 'post';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function fetch_data(){
		$query = $this->db->get('post');
		return $query->result();
	}
	public function create($data){
		$this->db->insert('post', $data);
	}
	public function update($data, $id){
		$this->db->where('id',$id);
		$this->db->update('post', $data);
	}
	public function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('post');
	}
	public function find_post($id){
		$this->db->where('id', $id);
		$data = $this->db->get('post')->row();
		return $data;
	}
	public function order_desc(){
		$this->db->order_by("id", "desc");
		$query = $this->db->get('post');
		return $query->result();
	}
	public function find_by_name($string){
		$this->db->like('title', $string);
		$query = $this->db->get('post');
		return $query;
	}

}

/* End of file PostModel.php */
/* Location: ./application/models/PostModel.php */