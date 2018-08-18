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
    $rules  = array(
        array(
          'field' => 'category',
          'label' => 'Category',
          'rules' => 'required|is_unique[category.name]' 
        ),
        array(
          'field' => 'description',
          'label' => 'Description',
          'rules' => 'required'
        )
    );
 		$this->form_validation->set_rules($rules);
 	  $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    if ($this->form_validation->run()) {
      $category = array(
         'name' => $_POST['category'],
         'description' => $_POST['description'],
         'created_at' => date('Y-m-d h:i:sa')
      );
      $this->categorymodel->create($category);
      $data['success'] = true;
      echo json_encode($data);
    }
    else {
      foreach ($_POST as $key => $value) {
        $data['messages'][$key] = form_error($key);
      }
      echo json_encode($data);
    }
   // echo json_encode($data);
  }
 	public function edit($id){
 		$data = $this->categorymodel->find_category($id);
 		echo json_encode(['data' => $data]);
 	}
 	public function delete($id){
 		$this->categorymodel->delete($id);
 		redirect(base_url('admin/category/index'));
 	}
 	public function update($id){
 		 $rules  = array(
        array(
          'field' => 'category',
          'label' => 'Category',
          'rules' => 'required|callback_category_check'
        )
      );
    $this->form_validation->set_rules($rules);
    $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    if ($this->form_validation->run()) {
      $category = array(
         'id'  => $id,
         'name' => $_POST['category'],
         'description' => $_POST['description'],
         'created_at' => date('Y-m-d h:i:sa')
      );
      $this->categorymodel->update($category, $id);
      $data['success'] = true;
      
    }else {
       foreach ($_POST as $key => $value) {
        $data['messages'][$key] = form_error($key);
      }
    }
    echo json_encode($data);
 	}

  public function category_check($category){        
     if(isset($_POST['id'])){
       $id = $_POST['id'];
       $result = $this->categorymodel->check_unique_category($id, $category);
       if($result !=0){
        $this->form_validation->set_message('category_check','Category '.$category .'  already exists');
        return false;
       }else{
        return true;
       }

     }else{
      return false;
     }
  }
  public function category_ajax(){
    $columns = array( 
                        0 =>'id', 
                        1 =>'name',
                        2=> 'description',
                        3=> 'created_at',
                        4=> 'action'
                    );
    $limit = $this->input->post('length');
      $start = $this->input->post('start');
      $order = $columns[$this->input->post('order')[0]['column']];
      $dir = $this->input->post('order')[0]['dir'];

      $totalData = $this->categorymodel->getAllCategory();
          
      $totalFiltered = $totalData; 
          
      if(empty($this->input->post('search')['value']))
      {            
          $posts = $this->categorymodel->allposts($limit,$start,$order,$dir);
      }
      else {
          $search = $this->input->post('search')['value']; 

          $posts =  $this->categorymodel->posts_search($limit,$start,$search,$order,$dir);

          $totalFiltered = $this->categorymodel->posts_search_count($search);
      }

      $data = array();
      if(!empty($posts))
      {
          foreach ($posts as $post)
          {

              $nestedData['id'] = $post->id;
              $nestedData['name'] = $post->name;
              $nestedData['description'] = $post->description;
              $nestedData['created_at'] = $post->created_at;
              $nestedData['action'] = '<a href="#" style="color: #0df100"   onclick="editCategory('.$post->id.')"><span class="glyphicon glyphicon-edit"></span></a>
                                      <a href="#" style="color: darkred" onclick="deleteCategory('.$post->id.')"><span class="glyphicon glyphicon-trash"></span></a>';
              
              $data[] = $nestedData;

          }
      }
        
      $json_data = array(
                  "draw"            => intval($this->input->post('draw')),  
                  "recordsTotal"    => intval($totalData),  
                  "recordsFiltered" => intval($totalFiltered), 
                  "data"            => $data   
                  );
          
      echo json_encode($json_data); 
  }
}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */