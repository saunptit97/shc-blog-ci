<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['content'] = 'admin/pages/user/index';
		$data['users'] = $this->usermodel->fetch_data();
		$this->load->view('admin/index', $data);
	}
	public function validateForm(){
	 	$rules = array(
	 		array(
	 			'field' => 'name',
	 			'label' => 'Name',
	 			'rules' => 'required' 
	 		),
	 		array(
	 			'field' => 'email',
	 			'label' => 'Email',
	 			'rules' => 'required|valid_email|is_unique[user.email]' 
	 		),
	 		array(
	 			'field' => 'address',
	 			'label' => 'Address',
	 			'rules' => 'required' 
	 		),
	 		array(
	 			'field' => 'phone',
	 			'label' => 'Phone',
	 			'rules' => 'required' 
	 		),
	 		array(
	 			'field' => 'password',
	 			'label' => 'Password',
	 			'rules' => 'callback_valid_password' 
	 		),
	 		array(
	 			'field' => 'confirm_password',
	 			'label' => 'Confirm Password',
	 			'rules' => 'callback_valid_password|matches[password]' 
	 		),

	 	);
	  	$this->form_validation->set_message('required', 'You missed the input {field}!');
 		$this->form_validation->set_rules($rules);
 		$valid = null;
        if($this->form_validation->run() == false) {
            if(!empty($rules)) foreach ($rules as $item){
                if(!empty(form_error($item['field']))) $valid[$item['field']] = form_error($item['field']);
            }
            $mess['mess'] = $valid;
            echo json_encode($mess);
            exit();
        }
    }
	
	public function add(){
		$this->validateForm();
		//$id = (int) ($this->usermodel->get_last_id()->id +1);
		$data = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'address' => $_POST['address'],
			'phone' => $_POST['phone'],
			'password' => $_POST['password'],
			'created_at' => date("Y:m:d"),
			'role' => 'admin',
			'username' => $_POST['email']
		);
		$this->usermodel->create_user($data);
		echo json_encode(['success' => TRUE]);
	}

	public function edit($id){
		
	}
	public function valid_password($password = ''){
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (strlen($password) < 5)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 32)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }
        return TRUE;
    }
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */