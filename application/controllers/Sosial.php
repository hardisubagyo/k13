<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sosial extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Nilai Sosial';
		$data['header_input'] = 'Input Nilai Sosial';
		$data['header_view'] = 'Lihat Nilai Sosial';

		$data['tahunajaran'] = $this->M_model->read('tm_tahunajaran')->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat', null, 'tingkat ASC')->result();

		$this->load->view('header', $data);
		$this->load->view('sosial/index', $data);
		$this->load->view('footer');

	}

	public function form(){
		$tingkat = $this->input->get('id_tingkat');
		$ta = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');

		$data['title'] = 'Input Nilai Sosial';
		$data['header'] = 'Form Nilai Sosial';

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
		$this->load->view('sosial/form', $data);
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
			$jujurSB = $this->input->post('jujurSB-'.$item->NISN);
			$jujurPB = $this->input->post('jujurPB-'.$item->NISN);
			$disiplinSB = $this->input->post('disiplinSB-'.$item->NISN);
			$disiplinPB = $this->input->post('disiplinPB-'.$item->NISN);
			$TJSB = $this->input->post('TJSB-'.$item->NISN);
			$TJPB = $this->input->post('TJPB-'.$item->NISN);
			$santunSB = $this->input->post('santunSB-'.$item->NISN);
			$santunPB = $this->input->post('santunPB-'.$item->NISN);
			$peduliSB = $this->input->post('peduliSB-'.$item->NISN);
			$peduliPB = $this->input->post('peduliPB-'.$item->NISN);
			$PDSB = $this->input->post('PDSB-'.$item->NISN);
			$PDPB = $this->input->post('PDPB-'.$item->NISN);

			$jujur = "";
			$disiplin = "";
			$TJ = "";
			$santun = "";
			$peduli = "";
			$PD = "";

			if(empty($jujurSB) && empty($jujurPB)){
				$jujur = 'baik ';
			}elseif(!empty($jujurSB) && empty($jujurPB)) {
				$jujur = 'sangat baik ';
			}elseif(empty($jujurSB) && !empty($jujurPB)){
				$jujur = 'dapat meningkatkan sikap ';
			}elseif(!empty($jujurSB) && !empty($jujurPB)){
				$jujur = 'baik ';
			}else{}

			if(empty($disiplinSB) && empty($disiplinPB)){
				$disiplin = 'baik ';
			}elseif(!empty($disiplinSB) && empty($disiplinPB)) {
				$disiplin = 'sangat baik ';
			}elseif(empty($disiplinSB) && !empty($disiplinPB)){
				$disiplin = 'dapat meningkatkan sikap ';
			}elseif(!empty($disiplinSB) && !empty($disiplinPB)){
				$disiplin = 'baik ';
			}else{}

			if(empty($TJSB) && empty($TJPB)){
				$TJ = 'baik ';
			}elseif(!empty($TJSB) && empty($TJPB)) {
				$TJ = 'sangat baik ';
			}elseif(empty($TJSB) && !empty($TJPB)){
				$TJ = 'dapat meningkatkan sikap ';
			}elseif(!empty($TJSB) && !empty($TJPB)){
				$TJ = 'baik ';
			}else{}

			if(empty($santunSB) && empty($santunPB)){
				$santun = 'baik ';
			}elseif(!empty($santunSB) && empty($santunPB)) {
				$santun = 'sangat baik ';
			}elseif(empty($santunSB) && !empty($santunPB)){
				$santun = 'dapat meningkatkan sikap ';
			}elseif(!empty($santunSB) && !empty($santunPB)){
				$santun = 'baik ';
			}else{}

			if(empty($peduliSB) && empty($peduliPB)){
				$peduli = 'baik ';
			}elseif(!empty($peduliSB) && empty($peduliPB)) {
				$peduli = 'sangat baik ';
			}elseif(empty($peduliSB) && !empty($peduliPB)){
				$peduli = 'dapat meningkatkan sikap ';
			}elseif(!empty($peduliSB) && !empty($peduliPB)){
				$peduli = 'baik ';
			}else{}

			if(empty($PDSB) && empty($PDPB)){
				$PD = 'baik ';
			}elseif(!empty($PDSB) && empty($PDPB)) {
				$PD = 'sangat baik ';
			}elseif(empty($PDSB) && !empty($PDPB)){
				$PD = 'dapat meningkatkan sikap ';
			}elseif(!empty($PDSB) && !empty($PDPB)){
				$PD = 'baik ';
			}else{}

			$keterangan = "Ananda ".$item->nama_lengkap." ".$jujur." dalam sikap jujur, ".$disiplin." dalam sikap disiplin, ".$TJ." dalam sikap tanggung jawab, ".$santun." dalam sikap santun, ".$peduli." dalam sikap peduli, dan ".$PD." dalam sikap percaya diri.";

			$this->db->query("
				INSERT INTO 
					tr_nilai_sosial (NISN,jujur,disiplin,tanggung_jawab,santun,peduli,percaya_diri,deskripsi,id_kelas,id_tingkat,id_tahunajaran,semester) 
				VALUES('".$item->NISN."','".$jujurSB."|".$jujurPB."','".$disiplinSB."|".$disiplinPB."','".$TJSB."|".$TJPB."','".$santunSB."|".$santunPB."','".$peduliSB."|".$peduliPB."','".$PDSB."|".$PDPB."','".$keterangan."','".$item->id_kelas."','".$id_tingkat."','".$id_tahunajaran."','".$semester."')
			");
		}

		$this->session->set_flashdata('success', 'Berhasil diinput');
		redirect(site_url('Sosial'));
	}

	public function view(){
		$tingkat = $this->input->get('id_tingkat');
		$ta = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');

		$data['title'] = 'Input Nilai Sosial';
		$data['header'] = 'Form Nilai Sosial';

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
		$this->load->view('sosial/view', $data);
		$this->load->view('footer');		
	}

	public function Edit(){
		$id = $this->input->post('id');
		
		$query = $this->db->query("SELECT * FROM tr_nilai_sosial WHERE id_nilai_sosi = '$id'")->row();
		
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
		$id = $this->input->post('id_nilai_sosi');

		$jujurSB = $this->input->post('jujurSB');
		$jujurPB = $this->input->post('jujurPB');
		$disiplinSB = $this->input->post('disiplinSB');
		$disiplinPB = $this->input->post('disiplinPB');
		$TJSB = $this->input->post('TJSB');
		$TJPB = $this->input->post('TJPB');
		$santunSB = $this->input->post('santunSB');
		$santunPB = $this->input->post('santunPB');
		$peduliSB = $this->input->post('peduliSB');
		$peduliPB = $this->input->post('peduliPB');
		$PDSB = $this->input->post('PDSB');
		$PDPB = $this->input->post('PDPB');

		$jujur = "";
		$disiplin = "";
		$TJ = "";
		$santun = "";
		$peduli = "";
		$PD = "";

		if(empty($jujurSB) && empty($jujurPB)){
			$jujur = 'baik ';
		}elseif(!empty($jujurSB) && empty($jujurPB)) {
			$jujur = 'sangat baik ';
		}elseif(empty($jujurSB) && !empty($jujurPB)){
			$jujur = 'dapat meningkatkan sikap ';
		}elseif(!empty($jujurSB) && !empty($jujurPB)){
			$jujur = 'baik ';
		}else{}

		if(empty($disiplinSB) && empty($disiplinPB)){
			$disiplin = 'baik ';
		}elseif(!empty($disiplinSB) && empty($disiplinPB)) {
			$disiplin = 'sangat baik ';
		}elseif(empty($disiplinSB) && !empty($disiplinPB)){
			$disiplin = 'dapat meningkatkan sikap ';
		}elseif(!empty($disiplinSB) && !empty($disiplinPB)){
			$disiplin = 'baik ';
		}else{}

		if(empty($TJSB) && empty($TJPB)){
			$TJ = 'baik ';
		}elseif(!empty($TJSB) && empty($TJPB)) {
			$TJ = 'sangat baik ';
		}elseif(empty($TJSB) && !empty($TJPB)){
			$TJ = 'dapat meningkatkan sikap ';
		}elseif(!empty($TJSB) && !empty($TJPB)){
			$TJ = 'baik ';
		}else{}

		if(empty($santunSB) && empty($santunPB)){
			$santun = 'baik ';
		}elseif(!empty($santunSB) && empty($santunPB)) {
			$santun = 'sangat baik ';
		}elseif(empty($santunSB) && !empty($santunPB)){
			$santun = 'dapat meningkatkan sikap ';
		}elseif(!empty($santunSB) && !empty($santunPB)){
			$santun = 'baik ';
		}else{}

		if(empty($peduliSB) && empty($peduliPB)){
			$peduli = 'baik ';
		}elseif(!empty($peduliSB) && empty($peduliPB)) {
			$peduli = 'sangat baik ';
		}elseif(empty($peduliSB) && !empty($peduliPB)){
			$peduli = 'dapat meningkatkan sikap ';
		}elseif(!empty($peduliSB) && !empty($peduliPB)){
			$peduli = 'baik ';
		}else{}

		if(empty($PDSB) && empty($PDPB)){
			$PD = 'baik ';
		}elseif(!empty($PDSB) && empty($PDPB)) {
			$PD = 'sangat baik ';
		}elseif(empty($PDSB) && !empty($PDPB)){
			$PD = 'dapat meningkatkan sikap ';
		}elseif(!empty($PDSB) && !empty($PDPB)){
			$PD = 'baik ';
		}else{}

		$keterangan = "Ananda ".$item->nama_lengkap." ".$jujur." dalam sikap jujur, ".$disiplin." dalam sikap disiplin, ".$TJ." dalam sikap tanggung jawab, ".$santun." dalam sikap santun, ".$peduli." dalam sikap peduli, dan ".$PD." dalam sikap percaya diri.";

		$data = array(
			"jujur" => $jujurSB."|".$jujurPB,
			"disiplin" => $disiplinSB."|".$disiplinPB,
			"tanggung_jawab" => $TJSB."|".$TJPB,
			"santun" => $santunSB."|".$santunPB,
			"peduli" => $peduliSB."|".$peduliPB,
			"percaya_diri" => $PDSB."|".$PDPB,
			"deskripsi" => $keterangan
		);

		$where = array('id_nilai_sosi' => $id);
		$update = $this->M_model->update('tr_nilai_sosial',$data, $where);

		$this->session->set_flashdata('success', 'Berhasil diubah');
		redirect(site_url('Sosial'));
	}

}
