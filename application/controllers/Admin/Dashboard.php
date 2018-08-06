<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
//		if($this->session->has_userdata('user')){
//			$data['user'] = $this->session->userdata('user');
//			$data['content'] = 'admin/index';
//			$this->load->view('admin/index', $data);
//		}else{
//			// $this->load->view('admin/pages/login');
//			redirect(base_url('admin/login'));
//		}
        $data['content'] = 'admin/pages/home';
        $this->load->view('admin/index', $data);
		
	}
	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect(base_url('admin/login'));
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */