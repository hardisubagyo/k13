<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelamin extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Kelamin';
		$data['header'] = 'Kelamin';

		$data['kelamin'] = $this->M_model->read('tm_jenkel')->result();

		$this->load->view('header', $data);
		$this->load->view('master/kelamin/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Kelamin';
		$data['header'] = 'Tambah Master Kelamin';

		$this->load->view('header', $data);
		$this->load->view('master/kelamin/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"nama_jenkel" => $this->input->post("nama")
		);

		$insert = $this->M_model->insert('tm_jenkel',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Kelamin'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Kelamin'));
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_jenkel',array('id_jenkel' => $id))->row();
		
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
			"nama_jenkel" => $this->input->post("nama")
		);

		$where = array('id_jenkel' => $this->input->post('id_jenkel'));
		$update = $this->M_model->update('tm_jenkel',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Kelamin'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Kelamin'));
		}
	}

	public function Delete($id){
		$where = array('id_jenkel' => $id);
		$this->M_model->delete('tm_jenkel', $where);
		redirect(site_url('Kelamin'));
	}
}
