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
		$data['nilai'] = $jm;

		$eksta = array();
		$getekstra = $this->db->query("
			SELECT 
				*
			FROM tr_ekstra
			WHERE 
				NISN = '$get[0]'
			AND 
				id_tahunajaran = '$get[1]'
			AND 
				semester = '$get[2]'
		")->row();

		$nilaiekstra1 = $this->db->query("
			SELECT 
				tm_ekstra.nama_ekstra,
				tr_ekstra.nilai
			FROM tr_ekstra
			JOIN tm_ekstra ON tm_ekstra.id_tm_ekstra = tr_ekstra.id_tm_ekstra_1
			WHERE 
				NISN = '$get[0]'
			AND 
				id_tahunajaran = '$get[1]'
			AND 
				semester = '$get[2]'
		")->row();

		$nilaiekstra2 = $this->db->query("
			SELECT 
				tm_ekstra.nama_ekstra,
				tr_ekstra.nilai_2
			FROM tr_ekstra
			JOIN tm_ekstra ON tm_ekstra.id_tm_ekstra = tr_ekstra.id_tm_ekstra_2
			WHERE 
				NISN = '$get[0]'
			AND 
				id_tahunajaran = '$get[1]'
			AND 
				semester = '$get[2]'
		")->row();

		$nilaiekstra3 = $this->db->query("
			SELECT 
				tm_ekstra.nama_ekstra,
				tr_ekstra.nilai_3
			FROM tr_ekstra
			JOIN tm_ekstra ON tm_ekstra.id_tm_ekstra = tr_ekstra.id_tm_ekstra_3
			WHERE 
				NISN = '$get[0]'
			AND 
				id_tahunajaran = '$get[1]'
			AND 
				semester = '$get[2]'
		")->row();

		array_push($eksta, 
			array(
				"nama" => $nilaiekstra1->nama_ekstra,
				"nilai" => $nilaiekstra1->nilai
			),
			array(
				"nama" => $nilaiekstra2->nama_ekstra,
				"nilai" => $nilaiekstra2->nilai_2
			),
			array(
				"nama" => $nilaiekstra3->nama_ekstra,
				"nilai" => $nilaiekstra3->nilai_3
			)
		);

		$data['ekstra'] = $eksta;

		$data['absen'] = $this->M_model->read('tr_absen',array('NISN' => $get[0], 'id_tahunajaran' => $get[1], 'semester' => $get[2]))->row();

		$data['fisik'] = $this->M_model->read('tr_fisik',array('NISN' => $get[0], 'id_tahunajaran' => $get[1], 'semester' => $get[2]))->row();

		$data['prestasi'] = $this->M_model->read('tr_prestasi',array('NISN' => $get[0], 'id_tahunajaran' => $get[1], 'semester' => $get[2]))->row();

		$this->load->view('header', $data);
		$this->load->view('nilaisiswa/rapor', $data);
		$this->load->view('footer');
	}
	
}
