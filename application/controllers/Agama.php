<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agama extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Agama';
		$data['header'] = 'Agama';

		$data['agama'] = $this->M_model->read('tm_agama')->result();

		$this->load->view('header', $data);
		$this->load->view('master/agama/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Agama';
		$data['header'] = 'Tambah Master Agama';

		$this->load->view('header', $data);
		$this->load->view('master/agama/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"nama_agama" => $this->input->post("nama")
		);

		$insert = $this->M_model->insert('tm_agama',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Agama'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Agama'));
		}
	}

	public function Edit(){
		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_agama',array('id_agama' => $id))->row();
		
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
			"nama_agama" => $this->input->post("nama")
		);

		$where = array('id_agama' => $this->input->post('id_agama'));
		$update = $this->M_model->update('tm_agama',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Agama'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Agama'));
		}
	}

	public function Delete($id){
		$where = array('id_agama' => $id);
		$this->M_model->delete('tm_agama', $where);
		redirect(site_url('Agama'));
	}
}
