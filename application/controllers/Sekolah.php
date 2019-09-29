<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Sekolah';
		$data['header'] = 'Sekolah';

		$data['sekolah'] = $this->M_model->read('tm_sekolah',array('id' => '1'))->row();

		$this->load->view('header', $data);
		$this->load->view('master/sekolah/index', $data);
		$this->load->view('footer');
	}


	public function simpan(){
		$data = array(
            "nama" => $this->input->post("nama"),
            "alamat" => $this->input->post("alamat"),
            "email" => $this->input->post("email"),
            "telp" => $this->input->post("telp"),
            "akreditasi" => $this->input->post("akreditasi")
		);

		$where = array('id' => '1');
		$update = $this->M_model->update('tm_sekolah',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Sekolah'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Sekolah'));
		}
	}

}
