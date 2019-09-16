<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
	}

	function read($table, $where = null, $orderby = null, $limit = null, $page = null){
		$this->db->select("*");
		$this->db->from($table);

		if($where != null){
			$this->db->where($where);
		}

		if($orderby != null){
			$this->db->order_by($orderby);
		}

		if($limit != null && $page == null){
			$this->db->limit($limit);
		}

		if($limit != null && $page != null){
			$this->db->limit($limit, $page);
		}

		return $this->db->get();
	}

	function insert($tabel, $data){
		$this->db->insert($tabel,$data);
		if ($this->db->affected_rows() > 0 ) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function update($table, $data, $where){
		return $this->db->update($table, $data, $where);
	}

	function delete($table, $where){
		return $this->db->delete($table, $where);
	}

	function kelas($where = null){
		$this->db->select("
			tm_kelas.*, 
			tm_tingkat.*
		");
		$this->db->from('tm_kelas');
		$this->db->join('tm_tingkat','tm_tingkat.id_tingkat = tm_kelas.id_tingkat');

		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function matpel($where = null){
		$this->db->select("
			tm_matpel.*, 
			tm_jenis_matpel.*
		");
		$this->db->from('tm_matpel');
		$this->db->join('tm_jenis_matpel','tm_jenis_matpel.id_jenis_matpel = tm_matpel.id_jenis_matpel');

		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function kd($where = null){
		$this->db->select("
			tm_kd.*, 
			tm_matpel.*,
			tm_jenis_kd.*,
			tm_tingkat.*
		");
		$this->db->from('tm_kd');
		$this->db->join('tm_jenis_kd','tm_jenis_kd.id_jenis_kd = tm_kd.id_jenis_kd');
		$this->db->join('tm_matpel','tm_matpel.id_matpel = tm_kd.id_matpel');
		$this->db->join('tm_tingkat','tm_tingkat.id_tingkat = tm_kd.id_tingkat');

		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function pegawai($where = null){
		$this->db->select("
			tm_pegawai.*, 
			tm_akses.*
		");
		$this->db->from('tm_pegawai');
		$this->db->join('tm_akses','tm_akses.id_akses = tm_pegawai.id_akses');

		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function siswa($where = null){
		$this->db->select("
			tm_siswa.*, 
			tm_kelas.*,
			tm_jenkel.*
		");
		$this->db->from('tm_siswa');
		$this->db->join('tm_kelas','tm_kelas.id_kelas = tm_siswa.id_kelas');
		$this->db->join('tm_jenkel','tm_jenkel.id_jenkel = tm_siswa.id_jenkel');

		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function GuruMatpel($where = null){
		$this->db->select('
			tm_pegawai.*,
			tr_guru_matpel.*,
			tm_matpel.*
		');
		$this->db->from('tr_guru_matpel');
		$this->db->join('tm_matpel','tm_matpel.id_matpel = tr_guru_matpel.id_matpel');
		$this->db->join('tm_pegawai','tm_pegawai.nip = tr_guru_matpel.id_pegawai');

		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get();
	}

	function walikelas($where = null){
		$this->db->select('
			tm_pegawai.*,
			tr_walikelas.*,
			tm_kelas.*
		');
		$this->db->from('tm_pegawai');
		$this->db->join('tr_walikelas','tr_walikelas.nip = tm_pegawai.nip');
		$this->db->join('tm_kelas','tm_kelas.id_kelas = tr_walikelas.id_kelas');

		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get();
	}
	
}
