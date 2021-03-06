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
		error_reporting(0);

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
					DISTINCT m.nama_matpel, m.id_matpel, d.desk_pengetahuan, d.desk_keterampilan
				FROM 
					tm_matpel as m
				JOIN tm_kd as k ON k.id_matpel = m.id_matpel
				LEFT JOIN tm_desk_matpel as d ON d.id_matpel = m.id_matpel
				WHERE k.id_tingkat = '$idtingkat->id_tingkat'
			")->result();

		//echo json_encode($matapelajaran);

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
				"JenisKD" => $JenisKD,
				"DeskPengetahuan" => $item->desk_pengetahuan,
				"DeskKeterampilan" => $item->desk_keterampilan
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

		$data['sekolah'] = $this->M_model->read('tm_sekolah',array('id'=>'1'))->row();

		$this->load->view('header', $data);
		$this->load->view('nilaisiswa/rapor', $data);
		$this->load->view('footer');
	}

	public function cetak($id){
		error_reporting(0);
		
		$get = explode("|",base64_decode($id));

		$tahunajaran = $this->db->query("SELECT * FROM tm_tahunajaran WHERE id_tahunajaran = '$get[1]'")->row();
		$semester = $get[2];
		
		$siswa = $this->db->query("
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

		$spiritual = $this->db->query("
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

		$sosial = $this->db->query("
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

		$idtingkat = $this->db->query("SELECT tm_kelas.id_tingkat, tm_kelas.id_kelas FROM tm_siswa JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas WHERE tm_siswa.NISN = '$get[0]' ")->row();

		$jm = array();
		$matapelajaran = $this->db->query("
				SELECT 
					DISTINCT m.nama_matpel, m.id_matpel,  d.desk_pengetahuan, d.desk_keterampilan
				FROM 
					tm_matpel as m
				JOIN tm_kd as k ON k.id_matpel = m.id_matpel
				LEFT JOIN tm_desk_matpel as d ON d.id_matpel = m.id_matpel
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
				"JenisKD" => $JenisKD,
				"DeskPengetahuan" => $item->desk_pengetahuan,
				"DeskKeterampilan" => $item->desk_keterampilan
			));
		}
		$nilai = $jm;

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

		$ekstra = $eksta;
		$absen = $this->M_model->read('tr_absen',array('NISN' => $get[0], 'id_tahunajaran' => $get[1], 'semester' => $get[2]))->row();
		$fisik = $this->M_model->read('tr_fisik',array('NISN' => $get[0], 'id_tahunajaran' => $get[1], 'semester' => $get[2]))->row();
		$prestasi = $this->M_model->read('tr_prestasi',array('NISN' => $get[0], 'id_tahunajaran' => $get[1], 'semester' => $get[2]))->row();
		$sekolah = $this->M_model->read('tm_sekolah',array('id'=>'1'))->row();
		$kepsek = $this->M_model->read('tm_pegawai',array('id_akses' => '3'))->row();

		$walikelas = $this->db->query("
			SELECT 
				tm_pegawai.NIP,
				tm_pegawai.nama_pegawai
			FROM 
				tr_walikelas 
			JOIN tm_pegawai ON tm_pegawai.NIP = tr_walikelas.NIP
			WHERE 
				tr_walikelas.id_kelas = '$idtingkat->id_kelas'
		")->row();

		$mpdf = new \Mpdf\Mpdf(
			['format' => 'Letter-P']);

		$stylesheet = file_get_contents(base_url().'assets/mpdf.css');
		$mpdf->WriteHTML($stylesheet,1);

		if(!empty($spiritual->deskripsi)){
			$deskripsi_spiritual = $spiritual->deskripsi; 
		}else{
			$deskripsi_spiritual = "-";
		}

		if(!empty($sosial->deskripsi)){
			$deskripsi_sosial = $sosial->deskripsi; 
		}else{
			$deskripsi_sosial = "-";
		}; 

		if(!empty($siswa->nama_ayah)){
			$ortu = $siswa->nama_ayah; 
		}else{
			$ortu = $siswa->nama_wali;
		}; 
		
		$mpdf->WriteHTML('
			<table id="Rekap">
				<thead>
					<tr align="center">
						<th colspan="6"><h4><b>RAPOR DAN PROFIL PESERTA DIDIK</b></h4></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="25%">Nama Peserta Didik</td>
						<td width="1%">:</td>
						<td width="39%">'.$siswa->nama_lengkap.'</td>
						<td width="21%">Kelas</td>
						<td width="1%">:</td>
						<td width="13%">'.$siswa->kelas.'</td>
					</tr>
					<tr>
						<td width="15%">NISN</td>
						<td width="5%">:</td>
						<td width="30%">'.$siswa->NISN.'</td>
						<td width="15%">Semester</td>
						<td width="5%">:</td>
						<td width="30%">'.$semester.'</td>
					</tr>
					<tr>
						<td width="15%">Nama Sekolah</td>
						<td width="5%">:</td>
						<td width="30%">'.$sekolah->nama.'</td>
						<td width="15%">Tahun Pelajaran</td>
						<td width="5%">:</td>
						<td width="30%">'.$tahunajaran->tahunajaran.'</td>
					</tr>
					<tr>
						<td width="15%">Alamat Sekolah</td>
						<td width="5%">:</td>
						<td colspan="4" width="30%">'.$sekolah->alamat.'</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table id="Rekap">
				<thead>
					<tr>
						<th colspan="3"><h5><b>A. RAPOR DAN PROFIL PESERTA DIDIK</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="center" colspan="3">Deskripsi</td>
					</tr>
					<tr valign="top">
						<td width="5%">1</td>
						<td width="25%">Sikap Spiritual</td>
						<td width="70%">
							'.$deskripsi_spiritual.'
						</td>
					</tr>
					<tr>
						<td width="5%">2</td>
						<td width="25%">Sikap Sosial</td>
						<td width="70%">
							'.$deskripsi_sosial.'
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table id="Rekap">`
				<thead>
					<tr>
						<th colspan="8"><h5><b>B. KOMPETENSI PENGETAHUAN DAN KETERAMPILAN</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td rowspan="2" width="5%">No</td>
						<td rowspan="2" width="25%">Mata Pelajaran</td>
						<td colspan="3" width="40%">Pengetahuan</td>
						<td colspan="3" width="40%">Keterampilan</td>
					</tr>
					<tr align="center">
						<td>Nilai</td>
						<td>Predikat</td>
						<td>Deskripsi</td>
						<td>Nilai</td>
						<td>Predikat</td>
						<td>Deskripsi</td>
					</tr>
		');

		$no = 1;
        foreach($nilai as $item){
			if(round($item['JenisKD'][1]['Nilai']) > 89){
				$predikatket = "A";
				$deskripsi_nilai_1 = "Sangat Baik";
			}else if(round($item['JenisKD'][1]['Nilai']) > 79){
				$predikatket = "B";
				$deskripsi_nilai_1 = "Baik";
			}else if(round($item['JenisKD'][1]['Nilai']) > 70){
				$predikatket = "C";
				$deskripsi_nilai_1 = "Cukup";
			}else{
				$predikatket = "D	";
				$deskripsi_nilai_1 = "Perlu Bimbingan";
			}

			if(round($item['JenisKD'][0]['Nilai']) > 89){
				$predikatpeng = "A";
				$deskripsi_nilai_0 = "Sangat Baik";
			}else if(round($item['JenisKD'][0]['Nilai']) > 79){
				$predikatpeng = "B";
				$deskripsi_nilai_0 = "Baik";
			}else if(round($item['JenisKD'][0]['Nilai']) > 70){
				$predikatpeng = "C";
				$deskripsi_nilai_0 = "Cukup";
			}else{
				$predikatpeng = "D	";
				$deskripsi_nilai_0 = "Perlu Bimbingan";
			}

			$mpdf->WriteHTML('
				<tr>
					<td>'.$no++.'</td>
					<td>'.$item["MataPelajaran"].'</td>
					<td>'.round($item["JenisKD"][0]["Nilai"]).'</td>
					<td>'.$predikatket.'</td>
					<td>'.$deskripsi_nilai_0.' dalam '.$item["DeskPengetahuan"].'</td>
					<td>'.round($item["JenisKD"][1]["Nilai"]).'</td>
					<td>'.$predikatpeng.'</td>
					<td>'.$deskripsi_nilai_1.' dalam '.$item["DeskKeterampilan"].'</td>
				</tr>
			');
		}

		$mpdf->WriteHTML('
			</table>
			<hr>
			<table id="Rekap">
				<thead>
					<tr>
						<th colspan="3"><h5><b>C. EKSTRA KULIKULER</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="5%">No</td>
						<td width="25%">Kegiatan Ekstra Kurikuler</td>
						<td width="70%">Keterangan</td>
					</tr>
		');

		$nop = 1; 
		foreach($ekstra as $row) {
			$mpdf->WriteHTML('
			<tr>
				<td>'.$nop++.'</td>
				<td>'.$row['nama'].'</td>
				<td>'.$row['nilai'].'</td>
			</tr>
			');
		}

		$mpdf->WriteHTML('
			</table>
			<hr>
			<table id="rekap">
				<thead>
					<tr>
						<th><h5><b>D. SARAN-SARAN</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>'.$absen->saran.'</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table id="rekap">
				<thead>
					<tr>
						<th colspan="4"><h5><b>E. TINGGI DAN BERAT BADAN</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td rowspan="2" width="5%">No</td>
						<td rowspan="2" width="45%">Aspek yang dinilai</td>
						<td colspan="2">Semester</td>
					</tr>
					<tr align="center">
						<td>1</td>
						<td>2</td>
					</tr>
					<tr>
						<td>1</td>
						<td>Tiggi Badan</td>
						<td>'.$fisik->tinggi_1.' cm</td>
						<td>'.$fisik->tinggi_2.' cm</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Berat Badan</td>
						<td>'.$fisik->berat_1.' kg</td>
						<td>'.$fisik->berat_2.' kg</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table id="rekap">
				<thead>
					<tr>
						<th colspan="4"><h5><b>F. KONDISI KESEHATAN</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<td width="10%">No</td>
						<td width="35%">Aspek Fisik</td>
						<td width="55%">Keterangan</td>
					</tr>
					<tr>
						<td>1</td>
						<td>Pendengaran</td>
						<td>'.$fisik->pendengaran.' kg</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Penglihatan</td>
						<td>'.$fisik->penglihatan.' kg</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Gigi</td>
						<td>'.$fisik->gigi.' kg</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table id="rekap">
				<thead>
					<tr>
						<th><h5><b>G. PRESTASI</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>'.$prestasi->prestasi.'</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table id="rekap">
				<thead>
					<tr>
						<th colspan="4"><h5><b>H. KETIDAKHADIRAN</b></h5></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="5%">1</td>
						<td width="25%">Sakit</td>
						<td width="70%">'.$absen->sakit.'</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Izin</td>
						<td>'.$absen->ijin.'</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Tanpa Keterangan</td>
						<td>'.$absen->alpa.'</td>
					</tr>
				</tbody>
			</table>
		');

		$mpdf->WriteHTML('
			<table width="100%">
				<tr>
					<td width="65%">&nbsp;</td>
					<td width="35%">
						Keputusan<br>
						Berdasarkan pencapaian<br>
						seluruh kompetensi<br>
						peserta didik dinyatakan :<br>
						(Naik/Tinggal*) Kelas : (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br>
						*) Coret yang tidak perlu
					</td>
				</tr>
			</table>
			<br>
			<br>
			<table width="100%">
				<tr>
					<td width="30%" align="center">
						Orang Tua/Wali
						<br><br><br><br><br>
						'.$ortu.'
					</td>
					<td width="40%">

					</td>
					<td width="30%" align="center">
						Guru Kelas
						<br><br><br><br><br>
						'.$walikelas->nama_pegawai.'<br>
						NIP : '.$walikelas->NIP.'
					</td>
				</tr>

				<tr>
					<td width="30%" align="center"></td>
					<td width="40%" align="center">
						Mengetahui<br>
						Kepala Sekolah
						<br><br><br><br><br>
						'.$kepsek->nama_pegawai.'<br>
						NIP : '.$kepsek->NIP.'

					</td>
					<td width="30%" align="center"></td>
				</tr>
			</table>
		');

		$mpdf->Output();
	}
	
}
