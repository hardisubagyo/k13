<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spiritual extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Nilai Spiritual';
		$data['header_input'] = 'Input Nilai Spiritual';
		$data['header_view'] = 'Lihat Nilai Spiritual';

		$data['tahunajaran'] = $this->M_model->read('tm_tahunajaran')->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat', null, 'tingkat ASC')->result();

		$this->load->view('header', $data);
		$this->load->view('spiritual/index', $data);
		$this->load->view('footer');

	}

	public function form(){
		$tingkat = $this->input->get('id_tingkat');
		$ta = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');

		$data['title'] = 'Input Nilai Spiritual';
		$data['header'] = 'Form Nilai Spiritual';

		$data['siswa'] = $this->db->query("
			SELECT 
				tm_siswa.*,
				tm_tingkat.*,
				tm_kelas.*
			FROM tm_siswa
			JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
			JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
			WHERE tm_tingkat.id_tingkat = '$tingkat'
			ORDER BY tm_siswa.nama_lengkap ASC
		")->result();

		$this->load->view('header', $data);
		$this->load->view('spiritual/form', $data);
		$this->load->view('footer');	
	}

	public function simpan(){
		$id_tingkat = $this->input->post('id_tingkat');
		$id_tahunajaran = $this->input->post('id_tahunajaran');
		$semester = $this->input->post('semester');

		$siswa = $this->db->query("
			SELECT 
				tm_siswa.*,
				tm_tingkat.*,
				tm_kelas.*
			FROM tm_siswa
			JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
			JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
			WHERE tm_tingkat.id_tingkat = '$id_tingkat'
			ORDER BY tm_siswa.nama_lengkap ASC
		")->result();

		foreach($siswa as $item) {
			$ibadahSB = $this->input->post('ibadahSB-'.$item->NISN);
			$ibadahPB = $this->input->post('ibadahPB-'.$item->NISN);
			$syukurSB = $this->input->post('syukurSB-'.$item->NISN);
			$syukurPB = $this->input->post('syukurPB-'.$item->NISN);
			$doaSB = $this->input->post('doaSB-'.$item->NISN);
			$doaPB = $this->input->post('doaPB-'.$item->NISN);
			$toleransiSB = $this->input->post('toleransiSB-'.$item->NISN);
			$toleransiPB = $this->input->post('toleransiPB-'.$item->NISN);

			$ibadah = "";
			$syukur = "";
			$doa = "";
			$toleransi = "";

			if(empty($ibadahSB) && empty($ibadahPB)){
				$ibadah = 'baik ';
			}elseif(!empty($ibadahSB) && empty($ibadahPB)) {
				$ibadah = 'sangat baik ';
			}elseif(empty($ibadahSB) && !empty($ibadahPB)){
				$ibadah = 'dapat meningkatkan sikap ';
			}elseif(!empty($ibadahSB) && !empty($ibadahPB)){
				$ibadah = 'baik ';
			}else{}

			if(empty($syukurSB) && empty($syukurPB)){
				$syukur = 'baik ';
			}elseif(!empty($syukurSB) && empty($syukurPB)) {
				$syukur = 'sangat baik ';
			}elseif(empty($syukurSB) && !empty($syukurPB)){
				$syukur = 'dapat meningkatkan sikap ';
			}elseif(!empty($syukurSB) && !empty($syukurPB)){
				$syukur = 'baik ';
			}else{}

			if(empty($doaSB) && empty($doaPB)){
				$doa = 'baik ';
			}elseif(!empty($doaSB) && empty($doaPB)) {
				$doa = 'sangat baik ';
			}elseif(empty($doaSB) && !empty($doaPB)){
				$doa = 'dapat meningkatkan sikap ';
			}elseif(!empty($doaSB) && !empty($doaPB)){
				$doa = 'baik ';
			}else{}

			if(empty($toleransiSB) && empty($toleransiPB)){
				$toleransi = 'baik ';
			}elseif(!empty($toleransiSB) && empty($toleransiPB)) {
				$toleransi = 'sangat baik ';
			}elseif(empty($toleransiSB) && !empty($toleransiPB)){
				$toleransi = 'dapat meningkatkan sikap ';
			}elseif(!empty($toleransiSB) && !empty($toleransiPB)){
				$toleransi = 'baik ';
			}else{}

			$keterangan = "Ananda ".$item->nama_lengkap." ".$ibadah." dalam ketaatan beribadah, berperilaku ".$syukur." dalam bersyukur, berperilaku ".$doa." dalam berdoa sebelum dan sesudah melakukan kegiatan, dan ".$toleransi." dalam toleransi beragama.";

			$this->db->query("
				INSERT INTO 
					tr_nilai_spirit (NISN,beribadah,syukur,berdoa,toleransi,deskripsi,id_kelas,id_tingkat,id_tahunajaran,semester) 
				VALUES('".$item->NISN."','".$ibadahSB."|".$ibadahPB."','".$syukurSB."|".$syukurPB."','".$doaSB."|".$doaPB."','".$toleransiSB."|".$toleransiPB."','".$keterangan."','".$item->id_kelas."','".$id_tingkat."','".$id_tahunajaran."','".$semester."')
			");
		}

		$this->session->set_flashdata('success', 'Berhasil diinput');
		redirect(site_url('Spiritual'));
	}

	public function view(){
		$tingkat = $this->input->get('id_tingkat');
		$ta = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');

		$data['title'] = 'Input Nilai Spiritual';
		$data['header'] = 'Form Nilai Spiritual';

		$data['siswa'] = $this->db->query("
			SELECT 
				tm_siswa.*,
				tm_tingkat.*,
				tm_kelas.*
			FROM tm_siswa
			JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
			JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
			WHERE tm_tingkat.id_tingkat = '$tingkat'
			ORDER BY tm_siswa.nama_lengkap ASC
		")->result();

		$this->load->view('header', $data);
		$this->load->view('spiritual/view', $data);
		$this->load->view('footer');		
	}

	public function Edit(){
		$nisn = $this->input->post('nisn');
		$ta = $this->input->post('ta');
		$semester = $this->input->post('semester');
		$idtingkat = $this->input->post('idtingkat');
		
		$query = $this->db->query("
			SELECT 
				*
			FROM
				tr_nilai_spirit
			WHERE 
				NISN = '$nisn' AND id_tingkat = '$idtingkat' AND id_tahunajaran = '$ta' AND semester = '$semester'
		")->row();
		
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
		$id = $this->input->post('id_nilai_spirit');

		$ibadahSB = $this->input->post('ibadahSB');
		$ibadahPB = $this->input->post('ibadahPB');
		$syukurSB = $this->input->post('syukurSB');
		$syukurPB = $this->input->post('syukurPB');
		$doaSB = $this->input->post('doaSB');
		$doaPB = $this->input->post('doaPB');
		$toleransiSB = $this->input->post('toleransiSB');
		$toleransiPB = $this->input->post('toleransiPB');

		$ibadah = "";
		$syukur = "";
		$doa = "";
		$toleransi = "";

		if(empty($ibadahSB) && empty($ibadahPB)){
			$ibadah = 'baik ';
		}elseif(!empty($ibadahSB) && empty($ibadahPB)) {
			$ibadah = 'sangat baik ';
		}elseif(empty($ibadahSB) && !empty($ibadahPB)){
			$ibadah = 'dapat meningkatkan sikap ';
		}elseif(!empty($ibadahSB) && !empty($ibadahPB)){
			$ibadah = 'baik ';
		}else{}

		if(empty($syukurSB) && empty($syukurPB)){
			$syukur = 'baik ';
		}elseif(!empty($syukurSB) && empty($syukurPB)) {
			$syukur = 'sangat baik ';
		}elseif(empty($syukurSB) && !empty($syukurPB)){
			$syukur = 'dapat meningkatkan sikap ';
		}elseif(!empty($syukurSB) && !empty($syukurPB)){
			$syukur = 'baik ';
		}else{}

		if(empty($doaSB) && empty($doaPB)){
			$doa = 'baik ';
		}elseif(!empty($doaSB) && empty($doaPB)) {
			$doa = 'sangat baik ';
		}elseif(empty($doaSB) && !empty($doaPB)){
			$doa = 'dapat meningkatkan sikap ';
		}elseif(!empty($doaSB) && !empty($doaPB)){
			$doa = 'baik ';
		}else{}

		if(empty($toleransiSB) && empty($toleransiPB)){
			$toleransi = 'baik ';
		}elseif(!empty($toleransiSB) && empty($toleransiPB)) {
			$toleransi = 'sangat baik ';
		}elseif(empty($toleransiSB) && !empty($toleransiPB)){
			$toleransi = 'dapat meningkatkan sikap ';
		}elseif(!empty($toleransiSB) && !empty($toleransiPB)){
			$toleransi = 'baik ';
		}else{}

		$keterangan = "Ananda ".$item->nama_lengkap." ".$ibadah." dalam ketaatan beribadah, berperilaku ".$syukur." dalam bersyukur, berperilaku ".$doa." dalam berdoa sebelum dan sesudah melakukan kegiatan, dan ".$toleransi." dalam toleransi beragama.";

		$data = array(
			"beribadah" => $ibadahSB."|".$ibadahPB,
			"syukur" => $syukurSB."|".$syukurPB,
			"berdoa" => $doaSB."|".$doaPB,
			"toleransi" => $toleransiSB."|".$toleransiPB,
			"deskripsi" => $keterangan
		);

		$where = array('id_nilai_spirit' => $id);
		$update = $this->M_model->update('tr_nilai_spirit',$data, $where);

		$this->session->set_flashdata('success', 'Berhasil diubah');
		redirect(site_url('Spiritual'));

		/*$this->db->query("
			INSERT INTO 
				tr_nilai_spirit (NISN,beribadah,syukur,berdoa,toleransi,deskripsi,id_kelas,id_tingkat,id_tahunajaran,semester) 
			VALUES('".$item->NISN."','".$ibadahSB."|".$ibadahPB."','".$syukurSB."|".$syukurPB."','".$doaSB."|".$doaPB."','".$toleransiSB."|".$toleransiPB."','".$keterangan."','".$item->id_kelas."','".$id_tingkat."','".$id_tahunajaran."','".$semester."')
		");*/
	}

}
