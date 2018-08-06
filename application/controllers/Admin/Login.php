<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('usermodel');
		$this->load->library('session');
	}

	public function index()
	{
		if(!$this->session->has_userdata('user')){
			$this->load->view('admin/pages/login');
		}
		else redirect('admin');
	}
	public function post(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$data = array(
			'username' => $username,
			'password' => $password
		);
		$row = $this->usermodel->check_login($data);
		if($row){	
			foreach ($row as $key => $value) {
				$this->session->set_userdata('user', $value);
			}
			redirect(base_url('admin/dashboard'));
		}else{
			redirect(base_url('admin/login'));
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */