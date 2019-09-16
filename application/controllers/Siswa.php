<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Siswa';
		$data['header'] = 'Siswwa';

		$data['siswa'] = $this->M_model->siswa()->result();
		$data['kelamin'] = $this->M_model->read('tm_jenkel')->result();
		$data['agama'] = $this->M_model->read('tm_agama')->result();
		$data['kelas'] = $this->M_model->kelas()->result();
		$data['kategori'] = $this->M_model->read('tm_kategori')->result();

		$this->load->view('header', $data);
		$this->load->view('master/siswa/index', $data);
		$this->load->view('footer');
	}

	public function simpan(){

		$cek = $this->M_model->read('tm_siswa', array('NISN' => $this->input->post('NISN')))->row();

		if(count($cek) == '0'){
			$data = array(
				"NISN" => $this->input->post("NISN"),
				"no_induk" => $this->input->post("no_induk"),
				"nama_lengkap" => $this->input->post("nama_lengkap"),
				"nama_panggilan" => $this->input->post("nama_panggilan"),
				"tmpt_lahir" => $this->input->post("tmpt_lahir"),
				"tgl_lahir" => $this->input->post("tgl_lahir"),
				"pendidikan_sblmnya" => $this->input->post("pendidikan_sblmnya"),
				"alamat" => $this->input->post("alamat"),
				"id_jenkel" => $this->input->post("id_jenkel"),
				"id_agama" => $this->input->post("id_agama"),
				"id_kelas" => $this->input->post("id_kelas"),
				"id_kategori" => $this->input->post("id_kategori"),
				"nama_ayah" => $this->input->post("nama_ayah"),
				"nama_ibu" => $this->input->post("nama_ibu"),
				"pek_ayah" => $this->input->post("pek_ayah"),
				"pek_ibu" => $this->input->post("pek_ibu"),
				"alamat_ortu" => $this->input->post("alamat_ortu"),
				"tlp" => $this->input->post("tlp"),
				"nama_wali" => $this->input->post("nama_wali"),
				"pek_wali" => $this->input->post("pek_wali"),
				"alamat_wali" => $this->input->post("alamat_wali")
			);

			$foto = $_FILES['foto']['name'];
			if($foto != ''){
				$namagambar = str_replace(' ', '-', date('ymdhis').'-'.$foto);
				$config['upload_path'] = './assets/foto/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				$config['max_size'] = '4096';
				$config['file_name'] = $namagambar;
				$this->load->library('upload',$config);
				$this->upload->do_upload('foto');
				$upload_gambar = $this->upload->data();
				$finalgambar = $upload_gambar['file_name'];
				$data['foto'] = $namagambar;
			}else{}

			$insert = $this->M_model->insert('tm_siswa',$data);

			if($insert == 1){
				$this->session->set_flashdata('success', 'Berhasil diinput');
				redirect(site_url('Siswa'));
			}else{
				$this->session->set_flashdata('failed', 'Gagal diinput');
				redirect(site_url('Siswa'));
			}
		}else{
			$this->session->set_flashdata('failed', 'NISN Sudah Tersedia');
			redirect(site_url('Siswa'));
		}
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tm_siswa',array('NISN' => $id))->row();
		
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
			"no_induk" => $this->input->post("no_induk"),
			"nama_lengkap" => $this->input->post("nama_lengkap"),
			"nama_panggilan" => $this->input->post("nama_panggilan"),
			"tmpt_lahir" => $this->input->post("tmpt_lahir"),
			"tgl_lahir" => $this->input->post("tgl_lahir"),
			"pendidikan_sblmnya" => $this->input->post("pendidikan_sblmnya"),
			"alamat" => $this->input->post("alamat"),
			"id_jenkel" => $this->input->post("id_jenkel"),
			"id_agama" => $this->input->post("id_agama"),
			"id_kelas" => $this->input->post("id_kelas"),
			"id_kategori" => $this->input->post("id_kategori"),
			"nama_ayah" => $this->input->post("nama_ayah"),
			"nama_ibu" => $this->input->post("nama_ibu"),
			"pek_ayah" => $this->input->post("pek_ayah"),
			"pek_ibu" => $this->input->post("pek_ibu"),
			"alamat_ortu" => $this->input->post("alamat_ortu"),
			"tlp" => $this->input->post("tlp"),
			"nama_wali" => $this->input->post("nama_wali"),
			"pek_wali" => $this->input->post("pek_wali"),
			"alamat_wali" => $this->input->post("alamat_wali")
		);

		$foto = $_FILES['foto']['name'];
		if($foto != ''){
			$namagambar = str_replace(' ', '-', date('ymdhis').'-'.$foto);
			$config['upload_path'] = './assets/foto/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['max_size'] = '4096';
			$config['file_name'] = $namagambar;
			$this->load->library('upload',$config);
			$this->upload->do_upload('foto');
			$upload_gambar = $this->upload->data();
			$finalgambar = $upload_gambar['file_name'];
			$data['foto'] = $namagambar;
		}else{}

		$update = $this->M_model->update('tm_siswa',$data, array('NISN' => $this->input->post("NISN")));

		if($update == 1){
			$this->session->set_flashdata('success', 'Berhasil diinput');
			redirect(site_url('Siswa'));
		}else{
			$this->session->set_flashdata('failed', 'Gagal diinput');
			redirect(site_url('Siswa'));
		}
	}

	public function Delete($id){
		$where = array('NISN' => $id);
		$this->M_model->delete('tm_siswa', $where);
		redirect(site_url('Siswa'));
	}
}
