<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Kelas';
		$data['header'] = 'Kelas';

		$data['kelas'] = $this->M_model->kelas()->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat')->result();

		$this->load->view('header', $data);
		$this->load->view('master/kelas/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Kelas';
		$data['header'] = 'Tambah Master Kelas';

		$this->load->view('header', $data);
		$this->load->view('master/kelas/add', $data);
		$this->load->view('footer');
	}

	public function simpantingkat(){
		$data = array(
			"tingkat" => $this->input->post("nama_tingkat")
		);

		$insert = $this->M_model->insert('tm_tingkat',$data);

		if($insert == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Kelas'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Kelas'));
		}
	}

	public function EditTingkat(){
		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_tingkat',array('id_tingkat' => $id))->row();
		
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

	public function ubahtingkat(){
		$data = array(
			"tingkat" => $this->input->post("nama_tingkat")
		);

		$where = array('id_tingkat' => $this->input->post('id_tingkat'));
		$update = $this->M_model->update('tm_tingkat',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diedit');
			redirect(site_url('Kelas'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diedit');
			redirect(site_url('Kelas'));
		}
	}

	public function DeleteTingkat($id){
		$where = array('id_tingkat' => $id);
		$this->M_model->delete('tm_tingkat', $where);
		redirect(site_url('Kelas'));
	}

	public function simpan(){
		$data = array(
			"kelas" => $this->input->post("kelas"),
			"id_tingkat" => $this->input->post("id_tingkat")
		);

		$insert = $this->M_model->insert('tm_kelas',$data);

		if($insert == 1){
			$this->session->set_flashdata('successkelas', 'Berhasil diinput');
			redirect(site_url('Kelas'));
		}else{
			$this->session->set_flashdata('failedkelas', 'Gagal diinput');
			redirect(site_url('Kelas'));
		}
	}

	public function Edit(){
		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_kelas',array('id_kelas' => $id))->row();
		
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
			"kelas" => $this->input->post("kelas"),
			"id_tingkat" => $this->input->post("id_tingkat")
		);

		$where = array('id_kelas' => $this->input->post('id_kelas'));
		$update = $this->M_model->update('tm_kelas',$data, $where);

		if($update == 1){
			$this->session->set_flashdata('successkelas', 'Berhasil diedit');
			redirect(site_url('Kelas'));
		}else{
			$this->session->set_flashdata('failedkelas', 'Gagal diedit');
			redirect(site_url('Kelas'));
		}
	}

	public function Delete($id){
		$where = array('id_Kelas' => $id);
		$this->M_model->delete('tm_kelas', $where);
		redirect(site_url('Kelas'));
	}
}
