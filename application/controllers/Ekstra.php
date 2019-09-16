<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ekstra extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Ekstra';
		$data['header'] = 'Ekstra';

		$data['ekstra'] = $this->M_model->read('tm_ekstra')->result();

		$this->load->view('header', $data);
		$this->load->view('master/ekstra/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Ekstra';
		$data['header'] = 'Tambah Master Ekstra';

		$this->load->view('header', $data);
		$this->load->view('master/ekstra/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"nama_ekstra" => $this->input->post("nama")
		);

		$insert = $this->M_model->insert('tm_ekstra',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Ekstra'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Ekstra'));
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_ekstra',array('id_tm_ekstra' => $id))->row();
		
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
			"nama_ekstra" => $this->input->post("nama")
		);

		$where = array('id_tm_ekstra' => $this->input->post('id_tm_ekstra'));
		$update = $this->M_model->update('tm_ekstra',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Ekstra'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Ekstra'));
		}
	}

	public function Delete($id){
		$where = array('id_tm_ekstra' => $id);
		$this->M_model->delete('tm_ekstra', $where);
		redirect(site_url('Ekstra'));
	}
}
