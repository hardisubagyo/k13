<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4>
				<i class="icon-menu mr-2"></i>
				<span class="font-weight-semibold"><?php echo $title; ?></span>
			</h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<!-- /page header -->
	

<div class="content">
	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-header bg-success text-white header-elements-inline">
					<h6 class="card-title">
						<?php echo $title. ' <b>' .$matpel->nama_matpel. '</b> Tahun Ajaran <b>' . $ta->tahunajaran .'</b> Semester <b>'. $this->input->get('semester') .'</b> Tingkat <b>'. $tingkat->tingkat .'</b> Kelas <b>'. $kelas.'</b>'; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>
				<form action="<?php echo site_url('Input/simpan'); ?>" method="post" >
					<div class="card-body">
						<div class="col-md-12">
							<table class="table table-responsive">
								<tr class="bg-success">
									<th></th>
									<?php 
										$id_matpel = base64_decode($this->input->get('id_matpel'));
										$getKD = $this->db->query("SELECT * FROM tm_kd WHERE id_matpel = '$id_matpel' AND id_tingkat = '$tingkat->id_tingkat' AND id_jenis_kd = '$id_jenis_kd'
											")->result();
										foreach($getKD as $item){ 
									?>
									<th><?php echo $item->no_kd; ?></th>
									<?php } ?>
									<th>Keterangan</th>
								</tr>
								<input type="hidden" name="id_matpel" value="<?php echo $id_matpel; ?>">
								<input type="hidden" name="id_jenis_kd" value="<?php echo $id_jenis_kd; ?>">
								<input type="hidden" name="semester" value="<?php echo $this->input->get('semester'); ?>">
								<?php
									$getSiswa = $this->db->query("
											SELECT 
												tm_siswa.NISN, 
												tm_siswa.nama_lengkap,
												tm_tingkat.id_tingkat,
												tm_kelas.id_kelas,
												tm_kelas.id_tingkat
											FROM 
												tm_siswa 
											JOIN tm_kelas ON tm_kelas.id_kelas = tm_siswa.id_kelas
											JOIN tm_tingkat ON tm_tingkat.id_tingkat = tm_kelas.id_tingkat
											WHERE tm_tingkat.id_tingkat = '$tingkat->id_tingkat'
											ORDER BY tm_siswa.nama_lengkap ASC
											")->result();
									foreach($getSiswa as $siswa) {
								?>
								<input type="hidden" name="id_tingkat" value="<?php echo $tingkat->id_tingkat; ?>">
								<input type="hidden" name="tahunajaran" value="<?php echo $ta->id_tahunajaran; ?>">
								<tr>
									<td><?php echo $siswa->nama_lengkap; ?></td>
									<?php foreach($getKD as $kd){ ?>
									<td>
										<input type="text" class="form->control" name="<?php echo str_replace(array("."," ","'"), "", $siswa->NISN.'-'.$kd->no_kd); ?>">
									</td>
									<?php } ?>
									<td>
										<textarea class="form-control" name="<?php echo str_replace(array("."," ","'"), "", $siswa->NISN); ?>"></textarea>
									</td>
								</tr>
								<?php } ?>
							</table>
						</div>
						<hr>

						<div class="col-md-12">
							<table class="table table-responsive" width="100%">
								<tr class="bg-success">
									<th>No Kompetensii Dasar</th>
									<th>Keterangan</th>
								</tr>
								<?php foreach($getKD as $item){  ?>
								<tr>
									<td><?php echo $item->no_kd; ?></td>
									<td><?php echo $item->deskripsi_kd; ?></td>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-success">Simpan <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>