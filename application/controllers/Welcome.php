<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function simpan()
	{
		$validasi=array(
			array('field'=>'nim','label'=>'NIM','rules'=>'required|is_unique[mahasiswa.nim]'),
		);
		$this->form_validation->set_rules($validasi);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$info['success']=TRUE;
			// $data=array(
			// 	'nim'=>$this->input->post('nim'),
			// 	'nama'=>$this->input->post('nama'),
			// 	'kelamin'=>$this->input->post('kelamin'),
			// 	'telp'=>$this->input->post('telp'),
			// 	'alamat'=>$this->input->post('alamat')
			// );
			// echo $data;
			//$this->mahasiswa_m->simpan_data($data);
			$info['message']="Berhasil tersimpan";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
}
