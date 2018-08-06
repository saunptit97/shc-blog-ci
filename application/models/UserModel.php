<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function fetch_data(){
		$query = $this->db->get('users');
		return $query->result();
	}
	public function check_login($data){
		return $this->db->get_where('users', array('email' => $data['username'], 'password' => $data['password']))->result();
	}
	public function get_user_id($id){
		$this->db->where('id', $id);
		$data = $this->db->get('users')->row();
		return $data;
	}
}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */