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
					<h6 class="card-title"><?php echo $header; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>
				<div class="card-body">
					<form action="<?php echo site_url('Lainnya/simpan'); ?>" method="post" >
						<div class="card-body" style="overflow-x:scroll;overflow-y:visible;">
							<div class="col-md-12">
								<table class="table" style="width: 2700px;">
									<tr class="bg-success" align="center">
										<th rowspan="3" width="200px">Nama Siswa</th>
										<th colspan="6">Ekstrakulikuler</th>
										<th colspan="3">Absen</th>
										<th rowspan="3" width="300px">Keterangan</th>
										<th colspan="4">Ukuran Badan</th>
										<th colspan="3">Kondisi Kesehatan</th>
										<th rowspan="3" width="300px">Prestasi</th>
									</tr>
									<tr class="bg-success" align="center">
										<th colspan="2">Pilihan 1</th>
										<th colspan="2">Pilihan 2</th>
										<th colspan="2">Pilihan 3</th>
										<th rowspan="2" width="100px">Sakit</th>
										<th rowspan="2" width="100px">Ijin</th>
										<th rowspan="2" width="100px">Alpa</th>
										<th colspan="2">Ganjil</th>
										<th colspan="2">Genap</th>
										<th rowspan="2" width="150px">Pendengaran</th>
										<th rowspan="2" width="150px">Penglihatan</th>
										<th rowspan="2" width="150px">Gigi</th>
									</tr>
									<tr class="bg-success" align="center">
										<th width="150px">Nama</th>
										<th width="100px">Nilai</th>
										<th width="150px">Nama</th>
										<th width="100px">Nilai</th>
										<th width="150px">Nama</th>
										<th width="100px">Nilai</th>
										<th width="100px">Tinggi</th>
										<th width="100px">Berat</th>
										<th width="100px">Tinggi</th>
										<th width="100px">Berat</th>

									</tr>
									<?php foreach($siswa as $rows){ ?>
									<tr>
										<td><?php echo $rows->nama_lengkap; ?></td>
										<!-- Pilihan 1 -->
										<td>
											<select class="form-control" name="id_tm_ekstra_1-<?php echo $rows->NISN; ?>">
												<?php foreach($ekstra as $item){ ?>
												<option value="<?php echo $item->id_tm_ekstra; ?>"><?php echo $item->nama_ekstra; ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<input type="text" class="form-control" name="nilai-<?php echo $rows->NISN; ?>">
										</td>

										<!-- Pilihan 2 -->
										<td>
											<select class="form-control" name="id_tm_ekstra_2-<?php echo $rows->NISN; ?>">
												<?php foreach($ekstra as $item){ ?>
												<option value="<?php echo $item->id_tm_ekstra; ?>"><?php echo $item->nama_ekstra; ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<input type="text" class="form-control" name="nilai_2-<?php echo $rows->NISN; ?>">
										</td>

										<!-- Pilihan 2 -->
										<td>
											<select class="form-control" name="id_tm_ekstra_3-<?php echo $rows->NISN; ?>">
												<?php foreach($ekstra as $item){ ?>
												<option value="<?php echo $item->id_tm_ekstra; ?>"><?php echo $item->nama_ekstra; ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<input type="text" class="form-control" name="nilai_3-<?php echo $rows->NISN; ?>">
										</td>

										<!-- Absen -->
										<td>
											<input type="text" class="form-control" name="sakit-<?php echo $rows->NISN; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="ijin-<?php echo $rows->NISN; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="alpa-<?php echo $rows->NISN; ?>">
										</td>

										<!-- Keterangan -->
										<td>
											<textarea class="form-control" name="saran-<?php echo $rows->NISN; ?>"></textarea>
										</td>

										<!-- Ukuran Badan -->
										<td>
											<input type="text" class="form-control" name="tinggi_1-<?php echo $rows->NISN; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="berat_1-<?php echo $rows->NISN; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="tinggi_2-<?php echo $rows->NISN; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="berat_2-<?php echo $rows->NISN; ?>">
										</td>

										<!-- Kesehatan -->
										<td>
											<input type="text" class="form-control" name="pendengaran-<?php echo $rows->NISN; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="penglihatan-<?php echo $rows->NISN; ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="gigi-<?php echo $rows->NISN; ?>">
										</td>

										<!-- Prestasi -->
										<td>
											<textarea class="form-control" name="prestasi-<?php echo $rows->NISN; ?>"></textarea>
										</td>
									</tr>
									<?php } ?>
								</table>
							</div>
							<hr>
							<input type="hidden" name="id_kelas" value="<?php echo $this->input->get('id_kelas'); ?>">
							<input type="hidden" name="id_tahunajaran" value="<?php echo $this->input->get('id_tahunajaran'); ?>">
							<input type="hidden" name="semester" value="<?php echo $this->input->get('semester'); ?>">
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-success">Simpan <i class="icon-paperplane ml-2"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>