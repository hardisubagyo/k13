<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h5>
				<i class="icon-menu mr-2"></i>
				<span class="font-weight-semibold"><?php echo $title; ?></span>
			</h5>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<!-- /page header -->

<?php
    $kelas = $this->session->userdata('walikelas');
    $gettingkat = $this->db->query("SELECT * FROM tm_kelas WHERE id_kelas = '$kelas'")->row();
?>

<div class="content">
	<div class="row">

		<div class="col-md-12">

			<div class="card">
				<div class="card-header bg-success text-white header-elements-inline">
                <h6 class="card-title"><?php echo $header ; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
						<table class="table">
		                    <thead>
		                        <tr align="center">
		                            <th colspan="6"><h5><b>RAPOR DAN PROFIL PESERTA DIDIK</b></h5></th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <tr>
                                    <td width="15%">Nama Peserta Didik</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $siswa->nama_lengkap; ?></td>
                                    <td width="15%">Kelas</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $siswa->kelas; ?></td>
                                </tr>
                                <tr>
                                    <td width="15%">NISN</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $siswa->NISN; ?></td>
                                    <td width="15%">Semester</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $semester; ?></td>
                                </tr>
                                <tr>
                                    <td width="15%">Nama Sekolah</td>
                                    <td width="5%">:</td>
                                    <td width="30%">Nama Sekolah</td>
                                    <td width="15%">Tahun Pelajaran</td>
                                    <td width="5%">:</td>
                                    <td width="30%"><?php echo $tahunajaran->tahunajaran; ?></td>
                                </tr>
                                <tr>
                                    <td width="15%">Nama Sekolah</td>
                                    <td width="5%">:</td>
                                    <td colspan="4" width="30%">Alamat Sekolah</td>
                                </tr>
		                    </tbody>
                        </table>
                        <hr>
                        <table class="table">
		                    <thead>
		                        <tr>
		                            <th colspan="3"><h5><b>A. RAPOR DAN PROFIL PESERTA DIDIK</b></h5></th>
		                        </tr>
		                    </thead>
		                    <tbody>
                                <tr align="center">
                                    <td colspan="3">Deskripsi</td>
                                </tr>
		                        <tr>
                                    <td width="5%">1</td>
                                    <td width="25%">Sikap Spiritual</td>
                                    <td width="70%">
                                        <?php 
                                            if(!empty($spiritual->deskripsi)){
                                                echo $spiritual->deskripsi; 
                                            }else{
                                                echo "-";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5%">2</td>
                                    <td width="25%">Sikap Sosial</td>
                                    <td width="70%">
                                        <?php 
                                            if(!empty($sosial->deskripsi)){
                                                echo $sosial->deskripsi; 
                                            }else{
                                                echo "-";
                                            }; 
                                        ?>
                                    </td>
                                </tr>
		                    </tbody>
                        </table>
                        <hr>
                        <table class="table">
		                    <thead>
		                        <tr>
		                            <th colspan="8"><h5><b>B. KOMPETENSI PENGETAHUAN DAN KETERAMPILAN</b></h5></th>
                                </tr>
		                    </thead>
		                    <tbody>
                                <tr align="center">
                                    <td rowspan="2">NO</td>
                                    <td rowspan="2">Mata Pelajaran</td>
                                    <td colspan="3">Pengetahuan</td>
                                    <td colspan="3">Keterampilan</td>
                                </tr>
                                <tr align="center">
                                    <td>Nilai</td>
                                    <td>Predikat</td>
                                    <td>Deskripsi</td>
                                    <td>Nilai</td>
                                    <td>Predikat</td>
                                    <td>Deskripsi</td>
                                </tr>
                                <?php 
                                    $no = 1;
                                    foreach($nilai as $item){ ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $item['MataPelajaran']; ?></td>
                                        <td><?php echo round($item['JenisKD'][0]['Nilai'], 2) ; ?></td>
                                        <td><?php echo $item['JenisKD'][0]['Predikat']; ?></td>
                                        <td><?php echo $item['JenisKD'][0]['Deskripsi']; ?></td>
                                        <td><?php echo round($item['JenisKD'][1]['Nilai'], 2); ?></td>
                                        <td><?php echo $item['JenisKD'][1]['Predikat']; ?></td>
                                        <td><?php echo $item['JenisKD'][1]['Deskripsi']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        
					</div>
                </div>
				
			</div>
		</div>
	</div>
</div>