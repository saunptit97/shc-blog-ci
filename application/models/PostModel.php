<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PostModel extends CI_Model {

	public $variable;
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
	public function count_all_post(){
		return $this->db->get('post')->num_rows();
	}
	public function get_all_post($limit , $start, $col , $dir){
		$query = $this->db->limit($limit, $start)
					->order_by($col, $dir)
					->get('post');
		if($query->num_rows() >0){
			return $query->result();
		}else{
			return null;
		}
	}
	 function post_search($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->like('id',$search)
                ->or_like('title',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('post');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }
	public function count_post_search($search){
		$query = $this->db->like('id' , $search)
				 ->or_like('title', $search)
				 ->order_by($col, $dir)
				 ->get('post');
		return $query->num_rows();
	}
}

/* End of file PostModel.php */
/* Location: ./application/models/PostModel.php */