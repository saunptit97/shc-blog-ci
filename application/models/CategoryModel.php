<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends CI_Model {

	public $variable;
	var $column_search = array('id','name','description');
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
	public function check_unique_category($id = '', $category) {
        $this->db->where('name', $category);
        if($id) {
            $this->db->where_not_in('id', $id);
        }
        return $this->db->get('category')->num_rows();
    }
    public function getAllCategory(){
		$query = $this->db->get('category');
		return $query->num_rows();
	}
	function allposts($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('category');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return null;
        }
        
    }
    function posts_search($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->like('id',$search)
                ->or_like('name',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->get('category');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }
    function posts_search_count($search)
    {
        $query = $this
                ->db
                ->like('id',$search)
                ->or_like('name',$search)
                ->get('category');
        return $query->num_rows();
    } 

}

/* End of file CategoryModel.php */
/* Location: ./application/models/CategoryModel.php */