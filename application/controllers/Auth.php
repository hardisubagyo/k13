<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{	
		if($this->session->userdata('logged_in') === NULL){
			$data = array();
			$this->load->view('auth/index',$data);
		}else{
			redirect(site_url('Home'));
		}
		
	}

	public function In(){
		$where = array(
			"email" => $this->input->post("username"),
			"password" => md5($this->input->post("password"))
		);

		$query = $this->M_model->read('tm_pegawai',$where)->row();

		if($query){
			$data['NIP'] = $query->NIP;
			$data['email'] = $query->email;
			$data['id_akses'] = $query->id_akses;
			$data['nama_pegawai'] = $query->nama_pegawai;
			$data['logged_in'] = true;

			if(($query->id_akses == '1') || ($query->id_akses == '2')){
				$getmatpel = $this->M_model->read('tr_guru_matpel',array('id_pegawai' => $query->NIP))->result();
				$id_matpel = array();
				foreach($getmatpel as $rows){
					$id_matpel[] = $rows->id_matpel;
				}
				$data['id_matpel'] = $id_matpel;
			}

			if($query->id_akses == '2'){
				$getwalikelas = $this->M_model->read('tr_walikelas',array('nip' => $query->NIP))->row();
				$data['walikelas'] = $getwalikelas->id_kelas;
			}

			//echo json_encode($data);
			$this->session->set_userdata($data);
			$logged_in = $this->session->userdata('logged_in');
			redirect('Home');
		}else{
			$this->session->set_flashdata('error', 'Gagal Login');
			redirect(site_url());
		}
	}

	public function Out(){
		$this->session->sess_destroy();
		redirect(site_url());
	}
}
