<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Nilai';
		$data['header'] = 'Nilai';

		$id_matpel = str_replace(array('[',']'),'',json_encode($this->session->userdata('id_matpel')));
		if($this->session->userdata('id_akses') == '2' || ($this->session->userdata('id_akses') == '1')){
			$data['matpel'] = $this->db->query("SELECT * FROM tm_matpel WHERE id_matpel IN ($id_matpel) ORDER BY nama_matpel ASC")->result();
		}else{
			$data['matpel'] = $this->db->query("SELECT * FROM tm_matpel ORDER BY nama_matpel ASC")->result();
		}

		//$data['matpel'] = $this->M_model->read('tm_matpel', null, 'nama_matpel ASC')->result();
		$data['tahunajaran'] = $this->M_model->read('tm_tahunajaran')->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat', null, 'tingkat ASC')->result();
		$data['kd'] = $this->M_model->read('tm_jenis_kd')->result();

		$this->load->view('header', $data);
		$this->load->view('nilai/index', $data);
		$this->load->view('footer');
	}

	public function View(){
		$id_matpel = $this->input->get('id_matpel');
		
		$id_tahunajaran = $this->input->get('id_tahunajaran');
		$semester = $this->input->get('semester');
		$id_jenis_kd = $this->input->get('id_jenis_kd');
		$id_kelas = $this->input->get('id_kelas');

		$gettingkat = $this->db->query("SELECT * FROM tm_kelas WHERE id_kelas = '$id_kelas'")->row();

		$id_tingkat = $gettingkat->id_tingkat;

		$data['title'] = 'Master Nilai';
		$data['header'] = 'Nilai';

		$data['matpel'] = $this->M_model->read('tm_matpel', array('id_matpel' => $id_matpel))->row();
		$data['kd'] = $this->M_model->read('tm_kd',array('id_matpel' => $id_matpel, 'id_tingkat' => $id_tingkat,'semester' => $semester, 'id_jenis_kd' => $id_jenis_kd))->result();
		$data['tingkat'] = $this->M_model->read('tm_tingkat', array('id_tingkat' => $id_tingkat))->row();
		$data['kelas'] = $this->M_model->read('tm_kelas', array('id_kelas' => $id_kelas))->row();
		$data['ta'] = $this->M_model->read('tm_tahunajaran', array('id_tahunajaran' => $id_tahunajaran))->row();
		$data['jenis_kd'] = $this->M_model->read('tm_jenis_kd', array('id_jenis_kd' => $id_jenis_kd))->row();


		$this->load->view('header', $data);
		$this->load->view('nilai/view', $data);
		$this->load->view('footer');	

	}

	public function Edit(){
		$nisn = $this->input->post('nisn');
		$idmatpel = $this->input->post('idmatpel');
		$ta = $this->input->post('ta');
		$idjeniskd = $this->input->post('idjeniskd');
		$semester = $this->input->post('semester');
		$idkd = $this->input->post('idkd');
		$idtingkat = $this->input->post('idtingkat');
		$idkelas = $this->input->post('idkelas');
		$jenisnilai = $this->input->post('jenisnilai');

		$query = $this->db->query("
			SELECT 
				tr_nilai_matpel.*,
				tm_kd.*
			FROM 
				tr_nilai_matpel
			JOIN tm_kd ON tm_kd.id_kd = tr_nilai_matpel.id_kd
			WHERE tr_nilai_matpel.NISN = '$nisn' AND tr_nilai_matpel.id_matpel = '$idmatpel' AND tr_nilai_matpel.id_tahunajaran = '$ta' AND tr_nilai_matpel.semester = '$semester' AND tr_nilai_matpel.id_jenis_kd = '$idjeniskd' AND tr_nilai_matpel.id_tingkat = '$idtingkat' AND tr_nilai_matpel.jenis_nilai = '$jenisnilai'
		")->result();

		$keterangan = $this->db->query("
			SELECT 
				*
			FROM 
				tr_katerangan
			WHERE 
				NISN = '$nisn' 
			AND 
				id_matpel = '$idmatpel' 
			AND 
				id_tahunajaran = '$ta' 
			AND 
				semester = '$semester' 
			AND 
				id_jenis_kd = '$idjeniskd'
		")->row();

		if($query){
			$output = array(
				'status' => '1',
				'message' => 'Berhasil',
				'data' => json_encode($query),
				'keterangan' => json_encode($keterangan)
			);
		}else{
			$output = array(
				'status' => '0',
				'message' => 'Gagal',
				'data' => json_encode($query),
				'keterangan' => json_encode($keterangan)
			);
		}

		echo json_encode($output);
	}

	public function ubah(){
		$nisn = $this->input->post('nisn');
		$idmatpel = $this->input->post('idmatpel');
		$ta = $this->input->post('ta');
		$idjeniskd = $this->input->post('idjeniskd');
		$semester = $this->input->post('semester');
		$idkd = $this->input->post('idkd');
		$idtingkat = $this->input->post('idtingkat');
		$idkelas = $this->input->post('idkelas');

		$query = $this->db->query("
			SELECT 
				tr_nilai_matpel.*,
				tm_kd.*
			FROM 
				tr_nilai_matpel
			JOIN tm_kd ON tm_kd.id_kd = tr_nilai_matpel.id_kd
			WHERE tr_nilai_matpel.NISN = '$nisn' AND tr_nilai_matpel.id_matpel = '$idmatpel' AND tr_nilai_matpel.id_tahunajaran = '$ta' AND tr_nilai_matpel.semester = '$semester' AND tr_nilai_matpel.id_jenis_kd = '$idjeniskd' AND tr_nilai_matpel.id_tingkat = '$idtingkat'
		")->result();

		foreach($query as $item){
			
			$this->M_model->update('tr_nilai_matpel',array('nilai' => $this->input->post("nilai".$item->id_nilai)), array('id_nilai' => $this->input->post("id_nilai".$item->id_nilai)));
		}

		$this->M_model->update('tr_katerangan',array('keterangan' => $this->input->post("keterangan")), array('id_keterangan' => $this->input->post("id_keterangan")));

		redirect(site_url('Nilai/View?id_jenis_kd='.$idjeniskd.'&id_matpel='.$idmatpel.'&id_kelas='.$idkelas.'&id_tahunajaran='.$ta.'&semester='.$semester.''));
	}

	public function get_kelas($id){
		$getkelas = $this->db->query("SELECT * FROM tr_guru_matpel WHERE id_pegawai = ".$this->session->userdata('NIP')." AND id_matpel = ".$id."")->row();
		$id_matpel = str_replace(array('[',']','"'),'',json_encode($getkelas->id_kelas));
		$getmatpel = explode(",",$id_matpel);
		$idmatpel = array();
		foreach ($getmatpel as $item) {
			$idmatpel[] = $item;
		};
		$getarrmatpel = str_replace(array('[',']'),'',json_encode($idmatpel));

		$data['kelas'] = $this->db->query("SELECT * FROM tm_kelas WHERE id_kelas IN ($getarrmatpel) ORDER BY kelas ASC")->result();

		$this->load->view('nilai/kelas', $data);
	}
}
