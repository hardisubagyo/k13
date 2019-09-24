<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rapor extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Rapor Siswa';
		$data['header_view'] = 'Lihat Rapor Siswa';

		$data['tahunajaran'] = $this->M_model->read('tm_tahunajaran')->result();
        $data['kelas'] = $this->M_model->read('tm_kelas')->result();
        $data['matpel'] = $this->M_model->read('tm_matpel')->result();
        
        $this->load->view('header', $data);
		$this->load->view('nilaisiswa/index', $data);
		$this->load->view('footer');
	}

	public function view(){
		$ta = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');
		$id_kelas = $this->input->get('id_kelas');
		

		$data['title'] = 'Nilai Siswa';
		$data['header'] = 'Nilai Siswa';

		$data['siswa'] = $this->db->query("
			SELECT 
				tm_siswa.* ,
				tm_jenkel.*,
				tm_agama.*
			FROM 
				tm_siswa
			JOIN tm_jenkel ON tm_jenkel.id_jenkel = tm_siswa.id_jenkel
			JOIN tm_agama ON tm_agama.id_agama = tm_siswa.id_agama
			WHERE tm_siswa.id_kelas = '$id_kelas'
		")->result();

		$this->load->view('header', $data);
		$this->load->view('nilaisiswa/view', $data);
		$this->load->view('footer');
	}

	public function detail($id){
		$get = explode("|",base64_decode($id));

		$data['title'] = 'Nilai Siswa';
		$data['header'] = 'Nilai Siswa';

		$data['tahunajaran'] = $this->db->query("SELECT * FROM tm_tahunajaran WHERE id_tahunajaran = '$get[1]'")->row();
		$data['semester'] = $get[2];
		
		$data['siswa'] = $this->db->query("
			SELECT 
				tm_siswa.* ,
				tm_jenkel.*,
				tm_agama.*,
				tm_kelas.*
			FROM 
				tm_siswa
			JOIN tm_jenkel ON tm_jenkel.id_jenkel = tm_siswa.id_jenkel
			JOIN tm_agama ON tm_agama.id_agama = tm_siswa.id_agama
			JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
			WHERE tm_siswa.NISN = '$get[0]'
		")->row();

		$this->load->view('header', $data);
		$this->load->view('nilaisiswa/rapor', $data);
		$this->load->view('footer');
	}
	
}
