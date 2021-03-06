<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function fetch_data(){
		$query = $this->db->get('user');
		return $query->result();
	}
	public function check_login($data){
		return $this->db->get_where('user', array('email' => $data['username'], 'password' => $data['password']))->result();
	}
	public function get_user_id($id){
		$this->db->where('id', $id);
		$data = $this->db->get('user')->row();
		return $data;
	}
	public function create_user($data){
		$this->db->insert('user', $data);
	}
	public function get_last_id(){
		$this->db->select_max('id');
		$query = $this->db->get('user');
		return $query->row();
	}
	public function get_all_user(){
		return $this->db->get('user')->num_rows();
	}
	public function all_user($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('user');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
    function user_search($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->like('id',$search)
                ->or_like('name',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('user');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }
    public function user_search_count($search)
    {
        $query = $this
                ->db
                ->like('id',$search)
                ->or_like('name',$search)
                ->get('user');
    
        return $query->num_rows();
    } 
}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */