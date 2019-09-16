<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kd extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Kompetensi Dasar';
		$data['header'] = 'Kompetensi Dasar';

		$data['kd'] = $this->M_model->kd()->result();
		$data['matpel'] = $this->M_model->read('tm_matpel')->result();
		$data['jenis_kd'] = $this->M_model->read('tm_jenis_kd')->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat')->result();

		$this->load->view('header', $data);
		$this->load->view('master/kd/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Kompetensi Dasar';
		$data['header'] = 'Tambah Kompetensi Dasar';

		$data['matpel'] = $this->M_model->read('tm_matpel')->result();
		$data['jenis_kd'] = $this->M_model->read('tm_jenis_kd')->result();

		$this->load->view('header', $data);
		$this->load->view('master/kd/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"no_kd" => $this->input->post("no_kd"),
			"deskripsi_kd" => $this->input->post("deskripsi_kd"),
			"id_matpel" => $this->input->post("id_matpel"),
			"id_jenis_kd" => $this->input->post("id_jenis_kd"),
			"id_tingkat" => $this->input->post("id_tingkat"),
			"semester" => $this->input->post("semester")
		);

		$insert = $this->M_model->insert('tm_Kd',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Kd'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Kd'));
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_kd',array('id_Kd' => $id))->row();
		
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
			"no_kd" => $this->input->post("no_kd"),
			"deskripsi_kd" => $this->input->post("deskripsi_kd"),
			"id_matpel" => $this->input->post("id_matpel"),
			"id_jenis_kd" => $this->input->post("id_jenis_kd"),
			"id_tingkat" => $this->input->post("id_tingkat"),
			"semester" => $this->input->post("semester")
		);

		$where = array('id_kd' => $this->input->post('id_kd'));
		$update = $this->M_model->update('tm_kd',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Kd'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Kd'));
		}
	}

	public function Delete($id){
		$where = array('id_kd' => $id);
		$this->M_model->delete('tm_kd', $where);
		redirect(site_url('Kd'));
	}
}
