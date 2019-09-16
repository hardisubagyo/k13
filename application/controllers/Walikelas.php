<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas extends CI_Controller {

	public function index()
	{	
		$data['title'] = 'Master Wali Kelas';
		$data['header'] = 'Wali Kelas';

        $data['walikelas'] = $this->M_model->walikelas()->result();
        $data['pegawai'] = $this->M_model->pegawai(array('tm_pegawai.id_akses' => '2'))->result();
        $data['kelas'] = $this->M_model->read('tm_kelas')->result();

		$this->load->view('header',$data);
		$this->load->view('master/walikelas/index',$data);
        $this->load->view('footer');
        
    }
    
	public function simpan(){

        $data = array(
            "nip" => $this->input->post("nip"),
            "id_kelas" => $this->input->post("id_kelas")
        );

        $insert = $this->M_model->insert('tr_walikelas',$data);

        if($insert == 1){
            $this->session->set_flashdata('success', 'Berhasil diinput');
            redirect(site_url('Walikelas'));
        }else{
            $this->session->set_flashdata('failed', 'Gagal diinput');
            redirect(site_url('Walikelas'));
        }
	}

	public function Edit(){

		$id = $this->input->post('id');
		$query = $this->M_model->read('tr_walikelas',array('id_walikelas' => $id))->row();
		
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
            "nip" => $this->input->post("nip_edit"),
            "id_kelas" => $this->input->post("id_kelas_edit")
        );
		
		echo json_encode($data);

        $update = $this->M_model->update('tr_walikelas',$data,array('id_walikelas' => $this->input->post('id_walikelas')));

        if($update == 1){
            $this->session->set_flashdata('success', 'Berhasil diedit');
            redirect(site_url('Walikelas'));
        }else{
            $this->session->set_flashdata('failed', 'Gagal diedit');
            redirect(site_url('Walikelas'));
        }
	}

	public function Delete($id){
		$where = array('id_walikelas' => $id);
		$this->M_model->delete('tr_walikelas', $where);
		redirect(site_url('Walikelas'));
	}
}
