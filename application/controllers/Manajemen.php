<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Manajemen Pengajar';
		$data['header'] = 'Manajemen Pengajar';

        $data['manajemen'] = $this->M_model->GuruMatpel()->result();
        $data['pegawai'] = $this->M_model->pegawai()->result();
        $data['matpel'] = $this->M_model->matpel()->result();
        $data['kelas'] = $this->M_model->read('tm_kelas')->result();

		$this->load->view('header',$data);
		$this->load->view('master/manajemen/index',$data);
        $this->load->view('footer');
        
    }
    
	public function simpan(){

        $data = array(
            "id_pegawai" => $this->input->post("id_pegawai"),
            "id_matpel" => $this->input->post("id_matpel")
        );

        $kelas = array();
        foreach($this->input->post("id_kelas") as $item){
            $kelas[] = $item;
        }

        $data['id_kelas'] =implode( ",", $kelas );

        $insert = $this->M_model->insert('tr_guru_matpel',$data);

        if($insert == 1){
            $this->session->set_flashdata('success', 'Berhasil diinput');
            redirect(site_url('Manajemen'));
        }else{
            $this->session->set_flashdata('failed', 'Gagal diinput');
            redirect(site_url('Manajemen'));
        }
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tr_guru_matpel',array('id_guru_matpel' => $id))->row();
		
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
            "id_pegawai" => $this->input->post("id_pegawai_edit"),
            "id_matpel" => $this->input->post("id_matpel_edit")
        );

        $kelas = array();
        foreach($this->input->post("id_kelas_edit") as $item){
            $kelas[] = $item;
        }

		$data['id_kelas'] =implode( ",", $kelas );
		
		echo json_encode($data);

        $update = $this->M_model->update('tr_guru_matpel',$data,array('id_guru_matpel' => $this->input->post('id_guru_matpel')));

        if($update == 1){
            $this->session->set_flashdata('success', 'Berhasil diedit');
            redirect(site_url('Manajemen'));
        }else{
            $this->session->set_flashdata('failed', 'Gagal diedit');
            redirect(site_url('Manajemen'));
        }
	}

	public function Delete($id){
		$where = array('id_guru_matpel' => $id);
		$this->M_model->delete('tr_guru_matpel', $where);
		redirect(site_url('Manajemen'));
	}
}
