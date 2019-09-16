<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TahunAjaran extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Tahun Ajaran';
		$data['header'] = 'Tahun Ajaran';

		$data['tahunajaran'] = $this->M_model->read('tm_tahunajaran')->result();

		$this->load->view('header', $data);
		$this->load->view('master/tahunajaran/index', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"tahunajaran" => $this->input->post("tahunajaran")
		);

		$insert = $this->M_model->insert('tm_tahunajaran',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('TahunAjaran'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('TahunAjaran'));
		}
	}

	public function Edit(){
		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_tahunajaran',array('id_tahunajaran' => $id))->row();
		
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
			"tahunajaran" => $this->input->post("tahunajaran")
		);

		$where = array('id_tahunajaran' => $this->input->post('id_tahunajaran'));
		$update = $this->M_model->update('tm_tahunajaran',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('TahunAjaran'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('TahunAjaran'));
		}
	}

	public function Delete($id){
		$where = array('id_tahunajaran' => $id);
		$this->M_model->delete('tm_tahunajaran', $where);
		redirect(site_url('TahunAjaran'));
	}
}
