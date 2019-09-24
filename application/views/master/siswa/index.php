<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4>
				<i class="icon-menu mr-2"></i>
				<span class="font-weight-semibold"><?php echo $title; ?></span> - <?php echo $header; ?>
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
				<div class="card-header header-elements-inline">
					<button type="button" class="btn bg-green" data-toggle="modal" data-target="#Add_Siswa" data-backdrop="static" data-keyboard="false">
						<i class="icon-plus3"></i>
					</button>
					<div class="header-elements">
						<div class="list-icons">
		            		<a class="list-icons-item" data-action="collapse"></a>
		            		<a class="list-icons-item" data-action="remove"></a>
		            	</div>
		        	</div>
				</div>

				<?php if($this->session->flashdata('success')){ ?>
		          	<div class="alert alert-primary border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('success'); ?>
		          	</div>
		        <?php }else if($this->session->flashdata('failed')){ ?>
		        	<div class="alert alert-danger border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('failed'); ?>
		          	</div>
		        <?php } ?>
				
				<table class="table datatable-basic">
					<thead>
						<tr>
							<th>NISN</th>
							<th>No Induk</th>
							<th>Nama Lengkap</th>
							<th>TTL</th>
							<th>Kelas</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach($siswa as $item) {
						?>
							<tr>
								<td><?php echo $item->NISN; ?></td>
								<td><?php echo $item->no_induk;?></td>
								<td><?php echo $item->nama_lengkap; ?></td>
								<td><?php echo $item->tmpt_lahir.', '.$item->tgl_lahir;?></td>
								<td><?php echo $item->kelas; ?></td>
								<td>
									<div class="list-icons list-icons-extended">
										<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Siswa" data-toggle="modal" data-target="#Edit_Siswa" data-id="<?php echo $item->NISN; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDelete(<?php echo $item->NISN; ?>)">
											<i class="icon-eraser"></i>
										</button>
			                    	</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				

			</div>
		</div>
	</div>
</div>

<div id="Add_Siswa" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<?php echo form_open_multipart('Siswa/simpan'); ?>
				<div class="modal-header">
					<h5 class="modal-title">Tambah Data Siswa</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="row">
						
						<div class="col-md-6">
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Data Siswa</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">

									<div class="form-group">
										<label>NISN</label>
										<input type="text" name="NISN" class="form-control" placeholder="NISN" required>
									</div>

									<div class="form-group">
										<label>No Induk</label>
										<input type="text" name="no_induk" class="form-control" placeholder="No Induk" required>
									</div>

									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
									</div>

									<div class="form-group">
										<label>Nama Panggilan</label>
										<input type="text" name="nama_panggilan" class="form-control" placeholder="Nama Panggilan" required>
									</div>

									<div class="form-group">
										<label>Tempat Lahir</label>
										<input type="text" name="tmpt_lahir" class="form-control" placeholder="Tempat Lahir" required>
									</div>

									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input class="form-control" type="input" name="tgl_lahir" id="tgl" placeholder="Tanggal Lahir" required>
									</div>

									<div class="form-group">
										<label>Pendidikan Sebelumnya</label>
										<input type="text" name="pendidikan_sblmnya" class="form-control" placeholder="Pendidikan Sebelumnya">
									</div>

									<div class="form-group">
										<label>Alamat</label>
										<textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
									</div>

									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select name="id_jenkel" class="form-control">
											<?php foreach($kelamin as $item){ ?>
												<option value="<?php echo $item->id_jenkel; ?>"><?php echo $item->nama_jenkel; ?></option>
											<?php } ?>
										</select>
									</div>	

									<div class="form-group">
										<label>Agama</label>
										<select name="id_agama" class="form-control">
											<?php foreach($agama as $item){ ?>
												<option value="<?php echo $item->id_agama; ?>"><?php echo $item->nama_agama; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group">
										<label>Kelas</label>
										<select name="id_kelas" class="form-control">
											<?php foreach($kelas as $item){ ?>
												<option value="<?php echo $item->id_kelas; ?>"><?php echo $item->kelas; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group">
										<label>Foto Siswa</label>
										<input type="file" class="form-control" name="foto" required>
									</div>
								
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Data Orang Tua</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">

									<div class="form-group">
										<label>Nama Ayah</label>
										<input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah">
									</div>

									<div class="form-group">
										<label>Nama Ibu</label>
										<input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu">
									</div>

									<div class="form-group">
										<label>Pekerjaan Ayah</label>
										<input type="text" name="pek_ayah" class="form-control" placeholder="Pekerjaan Ayah">
									</div>

									<div class="form-group">
										<label>Pekerjaan Ibu</label>
										<input type="text" name="pek_ibu" class="form-control" placeholder="Pekerjaan Ibu">
									</div>

									<div class="form-group">
										<label>Alamat Orangtua</label>
										<textarea name="alamat_ortu" class="form-control" placeholder="Alamat Orangtu"></textarea>
									</div>

									<div class="form-group">
										<label>No Telp</label>
										<input type="text" name="tlp" class="form-control" placeholder="No Telp">
									</div>

									
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Data Wali</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">

									<div class="form-group">
										<label>Nama Wali</label>
										<input type="text" name="nama_wali" class="form-control" placeholder="Nama Wali">
									</div>

									<div class="form-group">
										<label>Pekerjaan Wali</label>
										<input type="text" name="pek_wali" class="form-control" placeholder="Pekerjaan Wali">
									</div>

									<div class="form-group">
										<label>Alamat Wali</label>
										<input type="text" name="alamat_wali" class="form-control" placeholder="Alamat Wali">
									</div>
									
								</div>
							</div>
						</div>
					
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="Edit_Siswa" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<?php echo form_open_multipart('Siswa/ubah'); ?>
				<div class="modal-header">
					<h5 class="modal-title">Tambah Data Siswa</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="row">
						
						<div class="col-md-6">
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Data Siswa</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">

									<div class="form-group">
										<label>NISN</label>
										<input type="text" name="NISN" id="NISN" class="form-control" placeholder="NISN" required readonly>
									</div>

									<div class="form-group">
										<label>No Induk</label>
										<input type="text" name="no_induk" id="no_induk" class="form-control" placeholder="No Induk" required>
									</div>

									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
									</div>

									<div class="form-group">
										<label>Nama Panggilan</label>
										<input type="text" name="nama_panggilan" id="nama_panggilan" class="form-control" placeholder="Nama Panggilan" required>
									</div>

									<div class="form-group">
										<label>Tempat Lahir</label>
										<input type="text" name="tmpt_lahir" id="tmpt_lahir" class="form-control" placeholder="Tempat Lahir" required>
									</div>

									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input class="form-control" type="input" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir" required>
									</div>

									<div class="form-group">
										<label>Pendidikan Sebelumnya</label>
										<input type="text" name="pendidikan_sblmnya" class="form-control" id="pendidikan_sblmnya" placeholder="Pendidikan Sebelumnya">
									</div>

									<div class="form-group">
										<label>Alamat</label>
										<textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat"></textarea>
									</div>

									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select name="id_jenkel" id="id_jenkel" class="form-control">
											<?php foreach($kelamin as $item){ ?>
												<option value="<?php echo $item->id_jenkel; ?>"><?php echo $item->nama_jenkel; ?></option>
											<?php } ?>
										</select>
									</div>	

									<div class="form-group">
										<label>Agama</label>
										<select name="id_agama" id="id_agama" class="form-control">
											<?php foreach($agama as $item){ ?>
												<option value="<?php echo $item->id_agama; ?>"><?php echo $item->nama_agama; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group">
										<label>Kelas</label>
										<select name="id_kelas" id="id_kelas" class="form-control">
											<?php foreach($kelas as $item){ ?>
												<option value="<?php echo $item->id_kelas; ?>"><?php echo $item->kelas; ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="form-group">
										<label>Foto Siswa</label>
										<input type="file" class="form-control" name="foto">
									</div>
								
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Data Orang Tua</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">

									<div class="form-group">
										<label>Nama Ayah</label>
										<input type="text" name="nama_ayah" id="nama_ayah" class="form-control" placeholder="Nama Ayah">
									</div>

									<div class="form-group">
										<label>Nama Ibu</label>
										<input type="text" name="nama_ibu" id="nama_ibu" class="form-control" placeholder="Nama Ibu">
									</div>

									<div class="form-group">
										<label>Pekerjaan Ayah</label>
										<input type="text" name="pek_ayah" id="pek_ayah" class="form-control" placeholder="Pekerjaan Ayah">
									</div>

									<div class="form-group">
										<label>Pekerjaan Ibu</label>
										<input type="text" name="pek_ibu" id="pek_ibu" class="form-control" placeholder="Pekerjaan Ibu">
									</div>

									<div class="form-group">
										<label>Alamat Orangtua</label>
										<textarea name="alamat_ortu" id="alamat_ortu" class="form-control" placeholder="Alamat Orangtu"></textarea>
									</div>

									<div class="form-group">
										<label>No Telp</label>
										<input type="text" name="tlp" id="tlp" class="form-control" placeholder="No Telp">
									</div>

									
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Data Wali</h5>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse"></a>
					                	</div>
				                	</div>
								</div>

								<div class="card-body">

									<div class="form-group">
										<label>Nama Wali</label>
										<input type="text" name="nama_wali" id="nama_wali" class="form-control" placeholder="Nama Wali">
									</div>

									<div class="form-group">
										<label>Pekerjaan Wali</label>
										<input type="text" name="pek_wali" id="pek_wali" class="form-control" placeholder="Pekerjaan Wali">
									</div>

									<div class="form-group">
										<label>Alamat Wali</label>
										<input type="text" name="alamat_wali" id="alamat_wali" class="form-control" placeholder="Alamat Wali">
									</div>
									
								</div>
							</div>
						</div>
					
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function ConfirmDelete(val){
    	if (confirm("Hapus Data ?"))
      	location.href='Siswa/Delete/'+val;
  	}

  	$(document).on("click", ".Edit_Siswa", function () {
	    var Id = $(this).data('id');

	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('Siswa/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		    	console.log(data);
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
		        	$('#NISN').val(get.NISN);
		        	$('#no_induk').val(get.no_induk);
		        	$('#nama_lengkap').val(get.nama_lengkap);
		        	$('#nama_panggilan').val(get.nama_panggilan);
		        	$('#tmpt_lahir').val(get.tmpt_lahir);
		        	$('#tgl_lahir').val(get.tgl_lahir);
		        	$('#pendidikan_sblmnya').val(get.pendidikan_sblmnya);
		        	$('#alamat').val(get.alamat);
		        	$('#nama_ayah').val(get.nama_ayah);
		        	$('#nama_ibu').val(get.nama_ibu);
		        	$('#pek_ayah').val(get.pek_ayah);
		        	$('#pek_ibu').val(get.pek_ibu);
		        	$('#alamat_ortu').val(get.alamat_ortu);
		        	$('#tlp').val(get.tlp);
		        	$('#nama_wali').val(get.nama_wali);
		        	$('#pek_wali').val(get.pek_wali);
		        	$('#alamat_wali').val(get.alamat_wali);

		        	document.getElementById("id_jenkel").value = get.id_jenkel;
		        	document.getElementById("id_agama").value = get.id_agama;
		        	document.getElementById("id_kelas").value = get.id_kelas;
		        }else{
		        	
		        }
		    }
	    });
	});
</script>