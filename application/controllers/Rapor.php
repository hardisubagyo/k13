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

		$data['spiritual'] = $this->db->query("
			SELECT 
				* 
			FROM 
				tr_nilai_spirit
			WHERE 
				NISN = '$get[0]'
			AND 
				id_tahunajaran = '$get[1]'
			AND 
				semester = '$get[2]'
		")->row();

		$data['sosial'] = $this->db->query("
			SELECT 
				* 
			FROM 
				tr_nilai_sosial
			WHERE 
				NISN = '$get[0]'
			AND 
				id_tahunajaran = '$get[1]'
			AND 
				semester = '$get[2]'
		")->row();

		$idtingkat = $this->db->query("SELECT tm_kelas.id_tingkat FROM tm_siswa JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas WHERE tm_siswa.NISN = '$get[0]' ")->row();

		$jm = array();
		$matapelajaran = $this->db->query("
				SELECT 
					DISTINCT m.nama_matpel, m.id_matpel
				FROM 
					tm_matpel as m
				JOIN tm_kd as k ON k.id_matpel = m.id_matpel
				WHERE k.id_tingkat = '$idtingkat->id_tingkat'
			")->result();
		foreach($matapelajaran as $item){

			$JenisKD = array();
			$jenis_kd = $this->M_model->read('tm_jenis_kd')->result();
			foreach($jenis_kd as $jenis){
				$nilai = $this->db->query("
					SELECT 
						AVG(nilai) as nilai 
					FROM 
						tr_nilai_matpel 
					WHERE 
						NISN='$get[0]' 
					AND 
						id_matpel = '$item->id_matpel' 
					AND 
						id_tahunajaran = '$get[1]'
					AND 
						semester = '$get[2]'
					AND 
						id_jenis_kd = '$jenis->id_jenis_kd'
				")->row();

				$deskripsi = $this->db->query("
					SELECT 
						keterangan
					FROM 
						tr_katerangan
					WHERE 
						NISN='$get[0]' 
					AND 
						id_matpel = '$item->id_matpel' 
					AND 
						id_tahunajaran = '$get[1]' 
					AND 
						semester = '$get[2]'
					AND 
						id_jenis_kd = '$jenis->id_jenis_kd'
				")->row();

				array_push($JenisKD, array(
					"JenisMatpel" => $jenis->nama_jenis_kd,
					"Nilai" => $nilai->nilai,
					"Predikat" => "",
					"Deskripsi" => $deskripsi->keterangan
				));
			}
			
			array_push($jm, array(
				"MataPelajaran" => $item->nama_matpel,
				"JenisKD" => $JenisKD
			));
		}

		//echo json_encode($jm);
		
		$data['nilai'] = $jm;

		$this->load->view('header', $data);
		$this->load->view('nilaisiswa/rapor', $data);
		$this->load->view('footer');
	}
	
}
