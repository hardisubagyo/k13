<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matpel extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Mata Pelajaran';
		$data['header'] = 'Mata Pelajaran';

		$data['matpel'] = $this->M_model->matpel()->result();
		$data['jenis_matpel'] = $this->M_model->read('tm_jenis_matpel')->result();

		$this->load->view('header', $data);
		$this->load->view('master/matpel/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Mata Pelajaran';
		$data['header'] = 'Tambah Master Mata Pelajaran';
		$data['jenis_matpel'] = $this->M_model->read('tm_jenis_matpel')->result();

		$this->load->view('header', $data);
		$this->load->view('master/matpel/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"nama_matpel" => $this->input->post("nama_matpel"),
			"id_jenis_matpel" => $this->input->post("id_jenis_matpel")
		);

		$insert = $this->M_model->insert('tm_matpel',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Matpel'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Matpel'));
		}
	}

	public function Edit(){
		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_matpel',array('id_matpel' => $id))->row();
		
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
			"nama_matpel" => $this->input->post("nama_matpel"),
			"id_jenis_matpel" => $this->input->post("id_jenis_matpel")
		);

		$where = array('id_matpel' => $this->input->post('id_matpel'));
		$update = $this->M_model->update('tm_matpel',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Matpel'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Matpel'));
		}
	}

	public function Delete($id){
		$where = array('id_matpel' => $id);
		$this->M_model->delete('tm_matpel', $where);
		redirect(site_url('Matpel'));
	}
}
