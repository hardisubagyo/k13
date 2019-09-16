<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Kategori';
		$data['header'] = 'Kategori';

		$data['kategori'] = $this->M_model->read('tm_kategori')->result();

		$this->load->view('header', $data);
		$this->load->view('master/kategori/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Kategori';
		$data['header'] = 'Tambah Master Kategori';

		$this->load->view('header', $data);
		$this->load->view('master/kategori/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){
		$data = array(
			"nama_kategori" => $this->input->post("nama")
		);

		$insert = $this->M_model->insert('tm_kategori',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Kategori'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Kategori'));
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_kategori',array('id_kategori' => $id))->row();
		
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
			"nama_kategori" => $this->input->post("nama")
		);

		$where = array('id_kategori' => $this->input->post('id_kategori'));
		$update = $this->M_model->update('tm_kategori',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Kategori'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Kategori'));
		}
	}

	public function Delete($id){
		$where = array('id_kategori' => $id);
		$this->M_model->delete('tm_kategori', $where);
		redirect(site_url('Kategori'));
	}
}
