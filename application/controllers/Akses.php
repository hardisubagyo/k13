<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Akses';
		$data['header'] = 'Akses';

		$data['akses'] = $this->M_model->read('tm_akses')->result();

		$this->load->view('header', $data);
		$this->load->view('master/akses/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Akses';
		$data['header'] = 'Tambah Master Akses';

		$this->load->view('header', $data);
		$this->load->view('master/akses/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"nama_Akses" => $this->input->post("nama")
		);

		$insert = $this->M_model->insert('tm_akses',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Akses'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Akses'));
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_akses',array('id_akses' => $id))->row();
		
		if($query){
			$output = array(
				'status' => '1',
				'message' => 'Berhasil',
				'data' => json_encode($query)
			);
		}else{
			$output = array(
				'status' => '1',
				'message' => 'Gagal',
				'data' => ''
			);
		}

		echo json_encode($output);
	}

	public function ubah(){
		$data = array(
			"nama_Akses" => $this->input->post("nama")
		);

		$where = array('id_akses' => $this->input->post('id_akses'));
		$update = $this->M_model->update('tm_akses',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Akses'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Akses'));
		}
	}

	public function Delete($id){
		$where = array('id_akses' => $id);
		$this->M_model->delete('tm_akses', $where);
		redirect(site_url('Akses'));
	}
}
