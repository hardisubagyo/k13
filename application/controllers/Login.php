<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Login';

		$this->load->view('header', $data);
		$this->load->view('home/index', $data);
		$this->load->view('footer');
	}

	public function in(){
		$where = array(
			"email" => $this->input->post("email"),
			"password" => md5($this->input->post("password"))
		);

		$query = $this->M_model->read('tm_user',$where)->row();

		if($query){
			$data = array(
				"nip" => $query->nip,
				"email" => $query->email,
				"id_akses" => $query->id_akses,
				"id_toko" => $query->id_toko,
				"logged_in" => true
			);
			$this->session->set_userdata($data);
			$logged_in = $this->session->userdata('logged_in');
			redirect('Dashboard');
		}else{
			$this->session->set_flashdata('error', 'Gagal Login');
			redirect(site_url());
		}
	}
}
