<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_m extends CI_Model {

	public $variable;
	private $table = 'category';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getAllCategory(){
		$query = $this->db->get($this->table);
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

/* End of file Test.php */
/* Location: ./application/models/Test.php */