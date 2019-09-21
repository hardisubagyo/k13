<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lainnya extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Nilai Lainnya';
		$data['header_input'] = 'Input Nilai Lainnya';
		$data['header_view'] = 'Lihat Nilai Lainnya';

		$data['tahunajaran'] = $this->M_model->read('tm_tahunajaran')->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat', null, 'tingkat ASC')->result();
		$data['kelas'] = $this->M_model->read('tm_kelas', array('id_kelas' => $this->session->userdata('walikelas')))->result();

		$this->load->view('header', $data);
		$this->load->view('lainnya/index', $data);
		$this->load->view('footer');

	}

	public function form(){
		$idkelas = $this->input->get("id_kelas");
		$gettingkat = $this->M_model->read("tm_kelas",array("id_kelas" => $this->input->get("id_kelas")))->row();
		
		$tingkat = $gettingkat->id_tingkat;

		$ta = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');

		$data['title'] = 'Input Nilai Lainnya';
		$data['header'] = 'Form Nilai Lainnya';
		$data['ekstra'] = $this->M_model->read('tm_ekstra')->result();

		$data['siswa'] = $this->db->query("
			SELECT 
				tm_siswa.*,
				tm_tingkat.*,
				tm_kelas.*
			FROM tm_siswa
			JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
			JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
			WHERE tm_tingkat.id_tingkat = '$tingkat'
			AND tm_siswa.id_kelas = '$idkelas'
			ORDER BY tm_siswa.nama_lengkap ASC
		")->result();

		$this->load->view('header', $data);
		$this->load->view('lainnya/form', $data);
		$this->load->view('footer');	
	}

	public function simpan(){
		$idkelas = $this->input->post("id_kelas");
		$gettingkat = $this->M_model->read("tm_kelas",array("id_kelas" => $idkelas))->row();

		$tingkat = $gettingkat->id_tingkat;
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
			WHERE tm_tingkat.id_tingkat = '$tingkat'
			AND tm_siswa.id_kelas = '$idkelas'
			ORDER BY tm_siswa.nama_lengkap ASC
		")->result();

		foreach($siswa as $item) {
			$id_tm_ekstra_1 = $this->input->post('id_tm_ekstra_1-'.$item->NISN);
			$nilai = $this->input->post('nilai-'.$item->NISN);
			$id_tm_ekstra_2 = $this->input->post('id_tm_ekstra_2-'.$item->NISN);
			$nilai_2 = $this->input->post('nilai_2-'.$item->NISN);
			$id_tm_ekstra_3 = $this->input->post('id_tm_ekstra_3-'.$item->NISN);
			$nilai_3 = $this->input->post('nilai_3-'.$item->NISN);
			$sakit = $this->input->post('sakit-'.$item->NISN);
			$ijin = $this->input->post('ijin-'.$item->NISN);
			$alpa = $this->input->post('alpa-'.$item->NISN);
			$saran = $this->input->post('saran-'.$item->NISN);
			$tinggi_1 = $this->input->post('tinggi_1-'.$item->NISN);
			$berat_1 = $this->input->post('berat_1-'.$item->NISN);
			$tinggi_2 = $this->input->post('tinggi_2-'.$item->NISN);
			$berat_2 = $this->input->post('berat_2-'.$item->NISN);
			$pendengaran = $this->input->post('pendengaran-'.$item->NISN);
			$penglihatan = $this->input->post('penglihatan-'.$item->NISN);
			$gigi = $this->input->post('gigi-'.$item->NISN);
			$prestasi = $this->input->post('prestasi-'.$item->NISN);
			
			$this->db->query("
				INSERT INTO 
					tr_absen(NISN,sakit,ijin,alpa,saran,id_kelas,id_tahunajaran,semester) 
				VALUES('".$item->NISN."','".$sakit."','".$ijin."','".$alpa."','".$saran."','".$idkelas."','".$id_tahunajaran."','".$semester."')
			");

			$this->db->query("
				INSERT INTO 
					tr_ekstra(NISN,id_tm_ekstra_1,nilai,id_tm_ekstra_2,nilai_2,id_tm_ekstra_3,nilai_3,id_kelas,id_tahunajaran,semester) 
				VALUES('".$item->NISN."','".$id_tm_ekstra_1."','".$nilai."','".$id_tm_ekstra_2."','".$nilai_2."','".$id_tm_ekstra_3."','".$nilai_3."','".$idkelas."','".$id_tahunajaran."','".$semester."')
			");

			$this->db->query("
				INSERT INTO 
					tr_fisik(NISN,tinggi_1,berat_1,tinggi_2,berat_2,pendengaran,penglihatan,gigi,id_kelas,id_tahunajaran,semester) 
				VALUES('".$item->NISN."','".$tinggi_1."','".$berat_1."','".$tinggi_2."','".$berat_2."','".$pendengaran."','".$penglihatan."','".$gigi."','".$idkelas."','".$id_tahunajaran."','".$semester."')
			");

			$this->db->query("
				INSERT INTO 
					tr_prestasi(NISN,prestasi,id_kelas,id_tahunajaran,semester) 
				VALUES('".$item->NISN."','".$prestasi."','".$idkelas."','".$id_tahunajaran."','".$semester."')
			");
		}

		$this->session->set_flashdata('success', 'Berhasil diinput');
		redirect(site_url('lainnya'));
	}

	public function view(){
		$idkelas = $this->input->get('id_kelas');
		$ta = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');

		$data['title'] = 'Input Nilai Lainnya';
		$data['header'] = 'Form Nilai Lainnya';
		$data['ekstra'] = $this->M_model->read('tm_ekstra')->result();

		$data['siswa'] = $this->db->query("
			SELECT 
				tm_siswa.*,
				tm_tingkat.*,
				tm_kelas.*
			FROM tm_siswa
			JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
			JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
			WHERE tm_siswa.id_kelas = '$idkelas'
			ORDER BY tm_siswa.nama_lengkap ASC
		")->result();

		$this->load->view('header', $data);
		$this->load->view('lainnya/view', $data);
		$this->load->view('footer');		
	}

	public function Edit(){
		$nisn = $this->input->post('nisn');
		$idkelas = $this->input->post('idkelas');
		$idtahunajaran = $this->input->post('idtahunajaran');
		$semester = $this->input->post('semester');

		$absen = $this->db->query("
			SELECT * FROM tr_absen WHERE NISN = '".$nisn."' AND id_kelas = '".$idkelas."' AND id_tahunajaran = '".$idtahunajaran."' AND semester = '".$semester."'")->row();

		$fisik = $this->db->query("
			SELECT * FROM tr_fisik WHERE NISN = '".$nisn."' AND id_kelas = '".$idkelas."' AND id_tahunajaran = '".$idtahunajaran."' AND semester = '".$semester."'")->row();

		$prestasi = $this->db->query("
			SELECT * FROM tr_prestasi WHERE NISN = '".$nisn."' AND id_kelas = '".$idkelas."' AND id_tahunajaran = '".$idtahunajaran."' AND semester = '".$semester."'")->row();

		$eks = $this->db->query("
			SELECT * FROM tr_ekstra WHERE NISN = '".$nisn."' AND id_kelas = '".$idkelas."' AND id_tahunajaran = '".$idtahunajaran."' AND semester = '".$semester."'")->row();
		
		if(($absen) && ($fisik) && ($prestasi) && ($eks)){
			$output = array(
				'status' => '1',
				'message' => 'Berhasil',
				'absen' => json_encode($absen),
				'fisik' => json_encode($fisik),
				'prestasi' => json_encode($prestasi),
				'eks' => json_encode($eks),
				'semester' => $semester,
				'id_kelas' => $idkelas,
				'id_tahunajaran' => $idtahunajaran,
				'nisn' => $nisn
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
		$nisn = $this->input->post('nisn');
		$id_kelas = $this->input->post('id_kelas');
		$id_tahunajaran = $this->input->post('id_tahunajaran');
		$semester = $this->input->post('semester');

		$absen = array(
			"sakit" => $this->input->post("sakit"),
			"ijin" => $this->input->post("ijin"),
			"alpa" => $this->input->post("alpa"),
			"saran" => $this->input->post("saran")
		);

		$ekstra = array(
			"id_tm_ekstra_1" => $this->input->post("id_tm_ekstra_1"),
			"nilai" => $this->input->post("nilai"),
			"id_tm_ekstra_2" => $this->input->post("id_tm_ekstra_2"),
			"nilai_2" => $this->input->post("nilai_2"),
			"id_tm_ekstra_3" => $this->input->post("id_tm_ekstra_3"),
			"nilai_3" => $this->input->post("nilai_3")
		);

		$fisik = array(
			"tinggi_1" => $this->input->post("tinggi_1"),
			"berat_1" => $this->input->post("berat_1"),
			"tinggi_2" => $this->input->post("tinggi_2"),
			"berat_2" => $this->input->post("berat_2"),
			"pendengaran" => $this->input->post("pendengaran"),
			"penglihatan" => $this->input->post("penglihatan"),
			"gigi" => $this->input->post("gigi")
		);

		$prestasi = array(
			"prestasi" => $this->input->post("prestasi")
		);

		$where = array('NISN' => $nisn, 'id_kelas' => $id_kelas, 'id_tahunajaran' => $id_tahunajaran, 'semester' => $semester);

		$this->M_model->update('tr_absen',$absen, $where);
		$this->M_model->update('tr_fisik',$fisik, $where);
		$this->M_model->update('tr_prestasi',$prestasi, $where);
		$this->M_model->update('tr_ekstra',$ekstra, $where);

		$this->session->set_flashdata('success', 'Berhasil diubah');
		redirect(site_url('Lainnya/view?id_kelas='.$id_kelas.'&id_tahunajaran='.$id_tahunajaran.'&semester='.$semester));
	}

}
