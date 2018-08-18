<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('postmodel');
		$this->load->model('categorymodel');
        $this->load->model('usermodel');
	}

	public function index()
	{   $data['content'] = 'admin/pages/post/index';
        $data['posts'] = $this->postmodel->order_desc();
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'paging/index';
        // $config['total_rows'] =3;
        $config['per_page'] = 1;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();
        $data['categories'] = $this->categorymodel->fetch_data();
		$this->load->view('admin/index', $data);
	}
    public function fetch(){
        if(isset($_POST['search']) && $_POST['search'] != ''){
            $query = $_POST['search'];
            $posts = $this->postmodel->find_by_name($query)->result();
        }else{
            $posts =  $this->postmodel->order_desc();
        }
        $ouput = '';
        $confirm = "'Are you sure you want to delete this post?'";
        foreach ($posts as $key => $value) {
            $status = $value->status;
            if($status ==0) $status = 'Draft';
            else $status = 'Publish';
            $user = $this->usermodel->get_user_id($value->id_author);
            $ouput .='
                <tr>
                    <td><input type="checkbox" value="'. $value->id .' name="checkbox-delete"/></td>
                    <td>'.(int) ($key + 1) .'</td>
                    <td>'. $value->title .'</td>
                    <td>'.$value->slug.'</td>
                    <td>'.$value->created_at.'</td>
                    <td>'. $user->name.'</td>
                    <td>'.$status.'</td>
                    <td>
                        <a href="'. base_url('admin/post/edit/') . $value->id.'" style="color: #0df100"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="'. base_url('admin/post/delete/') . $value->id .'" style="color: darkred" onclick=" return confirm('. $confirm .')"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>';
        }
        echo $ouput;
    }
    public function add(){
        $data['content'] = 'admin/pages/post/add';
        $data['categories'] = $this->categorymodel->fetch_data();
        $this->load->view('admin/index', $data); 
    }
    public function addpost(){
        if(isset($_POST['submit'])){
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('tags', 'Tag', 'required');
            if ($this->form_validation->run() == TRUE) {
                $title = $_POST['title'];
                $body = $_POST['body'];
                $category = $_POST['category'];
                $status = $_POST['status'];
                $tags = $_POST['tags'];
                $config['upload_path']   = './uploads/'; 
                $config['allowed_types'] = 'gif|jpg|png|jpeg';   
                $this->load->library('upload', $config);
            
                if ($this->upload->do_upload('image')) {
                    $data1 = array('upload_data' => $this->upload->data());
                    $image =  $data1["upload_data"]["file_name"];
                    $data = array(
                        'title' =>  $title,
                        'body' => $body,
                        'created_at' => date("m.d.Y H:i:s"),
                        'id_author' => 1,
                        'id_category' => (int)$category,
                        'img' => $image,
                        'slug' => $this->to_slug($title),
                        'tags' => $tags,
                        'status' => (int)$status
                    );
                    $this->postmodel->create($data);
                    redirect(base_url('admin/post'));   
                }else{
                    show_404();
                }
            }else {
                $data['message'] = 'Field is required';
                $data['content'] = 'admin/pages/post/add';
                $data['categories'] = $this->categorymodel->fetch_data();
                $this->load->view('admin/index', $data);
            }
        }else{
            show_404();
        }
    }
    
    public function edit($id =null ){
        if($id!=null){
            $data['content'] = 'admin/pages/post/edit';
            $data['categories'] = $this->categorymodel->fetch_data();
            $data['post'] = $this->postmodel->find_post($id);
            $data['id'] = $id;
            $this->load->view('admin/index', $data); 
        }else{
            show_404();
        }
          
    }
    public function editpost($id){
        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            $body = $_POST['body'];
            $category = $_POST['category'];
            $status = $_POST['status'];
            $tags = $_POST['tags'];
            //$image = $_FILES['fileToUpload']['name'];
            $data = array(
                'title' =>  $title,
                'body' => $body,
                'id_author' => 1,
                'id_category' => (int)$category,
              //  'img' => $image,
                'slug' => $this->to_slug($title),
                'tags' => $tags,
                'status' => (int)$status

            );
            $this->postmodel->update($data, $id);
            redirect(base_url('admin/post'));    
        }
        else{
            show_404();
        }
            
    }
    public function delete($id){
        $this->postmodel->delete($id);
        redirect(base_url('admin/post'));
    }
    public function massdelete(){
         $_POST['checkbox-delete'];
    }
    public function search(){
        $string = $_POST['search'];
        $data['posts'] = $this->postmodel->find_by_name($string)->result();
         $this->postmodel->find_by_name($string)->num_rows();
        $data['content'] = 'admin/pages/post/index';
        $this->load->view('admin/index', $data);
    }
    function to_slug($str) {

    $str = trim(mb_strtolower($str));

    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);

    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);

    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);

    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);

    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);

    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);

    $str = preg_replace('/(đ)/', 'd', $str);

    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);

    $str = preg_replace('/([\s]+)/', '-', $str);

    return $str;

    }
    public function add_ajax(){  
       $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('tags', 'Tag', 'required');
            if ($this->form_validation->run() == TRUE) {
                $title = $_POST['title'];
                $body = $_POST['body'];
                $category = $_POST['category'];
                $status = $_POST['status'];
                $tags = $_POST['tags'];
                $config['upload_path']   = './uploads/'; 
                $config['allowed_types'] = 'gif|jpg|png|jpeg';   
                $this->load->library('upload', $config);
            
                if ($this->upload->do_upload('image')) {
                    $data1 = array('upload_data' => $this->upload->data());
                    $image =  $data1["upload_data"]["file_name"];
                    $data = array(
                        'title' =>  $title,
                        'body' => $body,
                        'created_at' => date("m.d.Y H:i:s"),
                        'id_author' => 1,
                        'id_category' => (int)$category,
                        'img' => $image,
                        'slug' => $this->to_slug($title),
                        'tags' => $tags,
                        'status' => (int)$status
                    );
                    $this->postmodel->create($data);
                    echo json_encode(['success' => TRUE]);
                }
            }else {
                $data['message'] = 'Field is required';
                $data['content'] = 'admin/pages/post/add';
                $data['categories'] = $this->categorymodel->fetch_data();
                 echo json_encode(['message' => $data]);
            }
       // echo json_encode(['success' => TRUE]);
    }
    public function post_ajax(){
        $columns = array( 
                        0 =>'id', 
                        1 =>'title',
                        2=> 'description',
                        3=> 'category',
                        4=> 'author',
                        6 => 'created_at',
                        7 => 'status'
                    );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

       $totalData = $this->postmodel->count_all_post();
          
       $totalFiltered = $totalData; 
          
       if(empty($this->input->post('search')['value']))
       {            
           $posts = $this->postmodel->get_all_post($limit,$start,$order,$dir);
       }
       else {
           $search = $this->input->post('search')['value']; 
           $posts =  $this->postmodel->post_search($limit,$start,$search,$order,$dir);
 
           $totalFiltered = $this->postmodel->count_post_search($search);
       }
       $data = array();
       if(!empty($posts))
       {
           foreach ($posts as $post)
           {

               $nestedData['id'] = $post->id;
               $nestedData['title'] = $post->title;
               $nestedData['description'] = $post->description;
               $nestedData['category'] = $post->id_category;
               $nestedData['author'] = $post->id_author;
               $nestedData['created_at'] = $post->created_at;
               $nestedData['status'] = $post->status;
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

/* End of file Post.php */
/* Location: ./application/controllers/Post.php */