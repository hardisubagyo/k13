<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Pegawai';
		$data['header'] = 'Pegawai';

		$data['pegawai'] = $this->M_model->pegawai()->result();
		$data['akses'] = $this->M_model->read('tm_akses')->result();
		$data['kelas'] = $this->M_model->read('tm_kelas')->result();
		$data['matpel'] = $this->M_model->matpel()->result();

		$this->load->view('header', $data);
		$this->load->view('master/pegawai/index', $data);
		$this->load->view('footer');
	}

	public function add()
	{	
		$data['title'] = 'Master Pegawai';
		$data['header'] = 'Tambah Pegawai';

		$data['akses'] = $this->M_model->read('tm_akses')->result();
		$data['kelas'] = $this->M_model->read('tm_kelas')->result();
		$data['matpel'] = $this->M_model->matpel()->result();

		$this->load->view('header', $data);
		$this->load->view('master/pegawai/add', $data);
		$this->load->view('footer');
	}

	public function simpan(){

		if($this->input->post("password") != $this->input->post("repassword")){
			$this->session->set_flashdata('failed', 'Password tidak sama');
			redirect(site_url('Pegawai'));
		}else{
			$data = array(
				"NIP" => $this->input->post("nip"),
				"nama_pegawai" => $this->input->post("nama"),
				"email" => $this->input->post("email"),
				"id_akses" => $this->input->post("id_akses"),
				"password" => md5($this->input->post("password"))
			);

			$insert = $this->M_model->insert('tm_pegawai',$data);

			if($insert == 1){
				$this->session->set_flashdata('success', 'Berhasil diinput');
				redirect(site_url('Pegawai'));
			}else{
				$this->session->set_flashdata('failed', 'Gagal diinput');
				redirect(site_url('Pegawai'));
			}
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_pegawai',array('NIP' => $id))->row();
		
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

		if($this->input->post("password") != ''){
			if($this->input->post("password") != $this->input->post("repassword")){
				$this->session->set_flashdata('failed', 'Password tidak sama');
				redirect(site_url('Pegawai'));
			}else{
				$data = array(
					"nama_pegawai" => $this->input->post("nama"),
					"email" => $this->input->post("email"),
					"id_akses" => $this->input->post("id_akses"),
					"password" => md5($this->input->post("password"))
				);
				$where = array('NIP' => $this->input->post('nip'));
				$update = $this->M_model->update('tm_pegawai',$data, $where);

				if($update == 1){
					$this->session->set_flashdata('success', 'Berhasil diedit');
					redirect(site_url('Pegawai'));
				}else{
					$this->session->set_flashdata('failed', 'Gagal diedit');
					redirect(site_url('Pegawai'));
				}
			}
		}else{
			$data = array(
				"nama_pegawai" => $this->input->post("nama"),
				"email" => $this->input->post("email"),
				"id_akses" => $this->input->post("id_akses"),
			);
			$where = array('NIP' => $this->input->post('nip'));
			$update = $this->M_model->update('tm_pegawai',$data, $where);

			if($update == 1){
				$this->session->set_flashdata('success', 'Berhasil diedit');
				redirect(site_url('Pegawai'));
			}else{
				$this->session->set_flashdata('failed', 'Gagal diedit');
				redirect(site_url('Pegawai'));
			}
		}
	}

	public function Delete($id){
		$where = array('NIP' => $id);
		$this->M_model->delete('tm_pegawai', $where);
		redirect(site_url('Pegawai'));
	}
}
