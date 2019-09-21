<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {

	public function matpel($id)
	{	
		$data['title'] = 'Input Nilai';

		$data['matpel'] = $this->M_model->read('tm_matpel', array('id_matpel' => base64_decode($id)))->row();
		$data['tahunajaran'] = $this->M_model->read('tm_tahunajaran')->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat', null, 'tingkat ASC')->result();
		$data['kd'] = $this->M_model->read('tm_jenis_kd')->result();

		$getkelas = $this->db->query("SELECT * FROM tr_guru_matpel WHERE id_pegawai = ".$this->session->userdata('NIP')." AND id_matpel = ".base64_decode($id)."")->row();
		$id_matpel = str_replace(array('[',']','"'),'',json_encode($getkelas->id_kelas));
		$getmatpel = explode(",",$id_matpel);
		$idmatpel = array();
		foreach ($getmatpel as $item) {
			$idmatpel[] = $item;
		};
		$getarrmatpel = str_replace(array('[',']'),'',json_encode($idmatpel));

		$data['kelas'] = $this->db->query("SELECT * FROM tm_kelas WHERE id_kelas IN ($getarrmatpel) ORDER BY kelas ASC")->result();

		$this->load->view('header', $data);
		$this->load->view('input/index', $data);
		$this->load->view('footer');

	}

	public function nilai(){
		$kelas = $this->input->get('id_kelas');
		$ta = $this->input->get('id_tahunajaran');
		$id_jenis_kd = $this->input->get('id_jenis_kd');

		$tingkat = $this->db->query("SELECT * FROM tm_kelas WHERE id_kelas = '$kelas'")->row();

		$data['title'] = 'Form Nilai';
		$data['matpel'] = $this->M_model->read('tm_matpel', array('id_matpel' => base64_decode($this->input->get('id_matpel'))))->row();
		$data['ta'] = $this->M_model->read('tm_tahunajaran', array('id_tahunajaran' => $ta))->row();
		$data['tingkat'] = $this->M_model->read('tm_tingkat', array('id_tingkat' => $tingkat->id_tingkat))->row();
		$data['kelas'] = $tingkat->kelas;
		$data['id_jenis_kd'] = $id_jenis_kd;

		//echo json_encode($data);

		$this->load->view('header', $data);
		$this->load->view('input/input', $data);
		$this->load->view('footer');	
	}

	public function simpan(){
		$id_tingkat = $this->input->post('id_tingkat');
		$id_matpel = $this->input->post('id_matpel');
		$tahunajaran = $this->input->post('tahunajaran');
		$semester = $this->input->post('semester');
		$id_jenis_kd = $this->input->post('id_jenis_kd');
		$idkelas = $this->input->post('id_kelas');

		$getKD = $this->db->query("SELECT * FROM tm_kd WHERE id_matpel = '$id_matpel' AND id_tingkat = '$id_tingkat' AND id_jenis_kd = '$id_jenis_kd'")->result();
		$getSiswa = $this->db->query("
			SELECT 
				tm_siswa.NISN, 
				tm_siswa.nama_lengkap,
				tm_tingkat.id_tingkat,
				tm_kelas.id_kelas,
				tm_kelas.id_tingkat
			FROM 
				tm_siswa 
			JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
			JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
			WHERE tm_tingkat.id_tingkat = '$id_tingkat'
			AND tm_siswa.id_kelas = '$idkelas'
			ORDER BY tm_siswa.nama_lengkap ASC
			")->result();

		foreach($getSiswa as $siswa) {
			foreach($getKD as $kd){
				$nilai = $this->input->post(str_replace(array("."," ","'"), "", $siswa->NISN.'-'.$kd->no_kd));
				$this->db->query("INSERT INTO tr_nilai_matpel (NISN,id_matpel,id_kd,nilai,id_tingkat,id_kelas,id_tahunajaran,semester,id_jenis_kd) VALUES('".$siswa->NISN."','".$id_matpel."','".$kd->id_kd."','".$nilai."','".$id_tingkat."','".$idkelas."','".$tahunajaran."','".$semester."','".$id_jenis_kd."')");
			}
			$this->db->query("INSERT INTO tr_katerangan (NISN,id_matpel,id_tahunajaran,keterangan,semester,id_jenis_kd) VALUES('".$siswa->NISN."','".$id_matpel."','".$tahunajaran."','".$this->input->post(str_replace(array("."," ","'"), "", $siswa->NISN))."','".$semester."','".$id_jenis_kd."')");
		}

		$this->session->set_flashdata('success', 'Berhasil diinput');
		redirect(site_url('Nilai'));
	}

}
