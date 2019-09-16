<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisKd extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Jenis Kompetensi Dasar';
		$data['header'] = 'Jenis Kompetensi Dasar';

		$data['jenis_kd'] = $this->M_model->read('tm_jenis_kd')->result();

		$this->load->view('header', $data);
		$this->load->view('master/jenis_kd/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Jenis Kompetensi Dasar';
		$data['header'] = 'Tambah Master Jenis Kompetensi Dasar';

		$this->load->view('header', $data);
		$this->load->view('master/jenis_kd/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"nama_jenis_kd" => $this->input->post("nama")
		);

		$insert = $this->M_model->insert('tm_jenis_kd',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('JenisKd'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('JenisKd'));
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_jenis_kd',array('id_jenis_kd' => $id))->row();
		
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
			"nama_jenis_kd" => $this->input->post("nama")
		);

		$where = array('id_jenis_kd' => $this->input->post('id_jenis_kd'));
		$update = $this->M_model->update('tm_jenis_kd',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('JenisKd'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('JenisKd'));
		}
	}

	public function Delete($id){
		$where = array('id_jenis_kd' => $id);
		$this->M_model->delete('tm_jenis_kd', $where);
		redirect(site_url('JenisKd'));
	}
}
