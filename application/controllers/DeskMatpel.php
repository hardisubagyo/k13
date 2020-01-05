<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeskMatpel extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Deskripsi Mata Pelajaran';
		$data['header'] = 'Deskripsi Mata Pelajaran';

		$data['deskmatpel'] = $this->M_model->deskmatpel()->result();
		$data['matpel'] = $this->M_model->read('tm_matpel')->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat')->result();

		$this->load->view('header', $data);
		$this->load->view('master/deskmatpel/index', $data);
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
			"id_matpel" => $this->input->post("id_matpel"),
			"id_tingkat" => $this->input->post("id_tingkat"),
			"desk_pengetahuan" => $this->input->post("desk_pengetahuan"),
			"desk_keterampilan" => $this->input->post("desk_keterampilan")
		);

		$insert = $this->M_model->insert('tm_desk_matpel',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('DeskMatpel'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('DeskMatpel'));
		}
	}

	public function Edit(){
		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_desk_matpel',array('id' => $id))->row();
		
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
			"id_matpel" => $this->input->post("id_matpel"),
			"id_tingkat" => $this->input->post("id_tingkat"),
			"desk_pengetahuan" => $this->input->post("desk_pengetahuan"),
			"desk_keterampilan" => $this->input->post("desk_keterampilan")
		);

		$where = array('id' => $this->input->post('id'));
		$update = $this->M_model->update('tm_desk_matpel',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('DeskMatpel'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('DeskMatpel'));
		}
	}

	public function Delete($id){
		$where = array('id' => $id);
		$this->M_model->delete('tm_desk_matpel', $where);
		redirect(site_url('DeskMatpel'));
	}
}
