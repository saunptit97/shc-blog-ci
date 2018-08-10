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
		$data['categories'] = $this->categorymodel->fetch_data();
		
		$this->load->view('admin/index', $data);
 	}
 	
 	public function fetch_data(){
 		$categories= $this->categorymodel->fetch_data();
 		$result = '';
 		$confirm = "'Are you sure you want to delete this category?'";
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
 		$this->form_validation->set_rules('category', 'category', 'required|is_unique[category.name]');
	    if ($this->form_validation->run() == FALSE)
        {
             echo json_encode(['error' => validation_errors()]);
        }else{
           	$data = array(
           		'name' => $_POST['category'],
              'created_at' => date('m.d.Y H:i:s') 
           	);

           	$this->categorymodel->create($data);
           	echo json_encode(['success' => 'TRUE']);	
        }
 	}
 	public function edit($id){

 		$data = $this->categorymodel->find_category($id);
 		echo json_encode(['data' => $data]);
 	}
 	public function delete($id){
 		$this->categorymodel->delete($id);
 		redirect(base_url('admin/category/index'));
 	}
 	public function update(){
 		$this->form_validation->set_rules('category', 'category', 'required|is_unique[category.name]');
	    if ($this->form_validation->run() == FALSE)
        {
             echo json_encode(['error' => validation_errors()]);
       }else{
	        $id =  $_POST['id-category'];
           	$data = array(
           		'id'   => $id,
           		'name' => $_POST['category'] 
           	);

           	$this->categorymodel->update($data, $id);
           	echo json_encode(['success' => 'TRUE']);	
        }
 	}
}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */