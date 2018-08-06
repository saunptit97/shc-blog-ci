<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('categorymodel');
	}

	public function index()
	{
		$data['content'] = 'admin/pages/category/index';
		
		$this->load->view('admin/index', $data);
 	}
 	
 	public function fetch_data(){
 		$categories= $this->categorymodel->fetch_data();
 		$result = '';
 		$confirm = "'Are you sure you want to delete this post?'";
 		foreach($categories as $key => $category){
 			$result .= '
 			<tr>
 			
 				<td> '.(int) ($key+1).'</td>
 				<td>' . $category->name .'</td>
 				<td>
                    <a href="'. base_url('admin/category/edit/') . $category->id.'" style="color: #0df100"><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="'. base_url('admin/category/delete/') . $category->id .'" style="color: darkred" onclick=" return confirm('. $confirm .')"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>';
 		}
 		echo $result;
 	}

 	public function add(){
 
 		
           $data = array('name' => $_POST['category'] );
           $this->categorymodel->create($data);
           echo json_encode(['success' => 'TRUE']);
       // }
 		// $data =  array('name' => 'AAA' );
 		// $this->categorymodel->create($data);
 	}
}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */