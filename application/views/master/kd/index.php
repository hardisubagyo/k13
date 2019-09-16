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
					<button type="button" class="btn bg-green" data-toggle="modal" data-target="#Add_KD" data-backdrop="static" data-keyboard="false">
						<i class="icon-plus3"></i> Tingkat
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
							<th>No</th>
							<th>No Kompetensi Dasar</th>
							<th>Mata Pelajaran</th>
							<th>Jenis Kompetensi Dasar</th>
							<th>Deskripsi Kompetensi Dasar</th>
							<th>Tingkat</th>
							<th>Semester</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach($kd as $item) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $item->no_kd;?></td>
								<td><?php echo $item->nama_matpel;?></td>
								<td><?php echo $item->nama_jenis_kd;?></td>
								<td><?php echo $item->deskripsi_kd;?></td>
								<td><?php echo $item->tingkat;?></td>
								<td><?php echo $item->semester;?></td>
								<td>
									<div class="list-icons list-icons-extended">
				                    	<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_KD" data-toggle="modal" data-target="#Edit_KD" data-id="<?php echo $item->id_kd; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDelete(<?php echo $item->id_kd; ?>)">
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

<div id="Add_KD" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kd/simpan'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Kompetensi Dasar</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nomor Kompentsi Dasar</label>
						<input type="text" name="no_kd" class="form-control" placeholder="Nomor Kompentsi Dasar">
					</div>

					<div class="form-group">
						<label>Mata Pelajaran</label>
						<select class="form-control" name="id_matpel">
							<?php foreach($matpel as $item) { ?>
								<option value="<?php echo $item->id_matpel; ?>"><?php echo $item->nama_matpel; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Jenis Kompetensi Dasar</label>
						<select class="form-control" name="id_jenis_kd">
							<?php foreach($jenis_kd as $item) { ?>
								<option value="<?php echo $item->id_jenis_kd; ?>"><?php echo $item->nama_jenis_kd; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Tingkat</label>
						<select class="form-control" name="id_tingkat">
							<?php foreach($tingkat as $item) { ?>
								<option value="<?php echo $item->id_tingkat; ?>"><?php echo $item->tingkat; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Semester</label>
						<select class="form-control" name="semester">
							<option value="Ganjil">Ganjil</option>
							<option value="Genap">Genap</option>
						</select>
					</div>

					<div class="form-group">
						<label>Deskripsi Kompentsi Dasar</label>
						<textarea name="deskripsi_kd" class="form-control" placeholder="Deskripsi Kompentsi Dasar"></textarea>
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
<div id="Edit_KD" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kd/ubah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Tingkat</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nomor Kompentsi Dasar</label>
						<input type="text" name="no_kd" id="no_kd" class="form-control" placeholder="Nomor Kompentsi Dasar">
					</div>

					<div class="form-group">
						<label>Mata Pelajaran</label>
						<select class="form-control" name="id_matpel" id="id_matpel">
							<?php foreach($matpel as $item) { ?>
								<option value="<?php echo $item->id_matpel; ?>"><?php echo $item->nama_matpel; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Jenis Kompetensi Dasar</label>
						<select class="form-control" name="id_jenis_kd" id="id_jenis_kd">
							<?php foreach($jenis_kd as $item) { ?>
								<option value="<?php echo $item->id_jenis_kd; ?>"><?php echo $item->nama_jenis_kd; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Tingkat</label>
						<select class="form-control" name="id_tingkat" id="id_tingkat">
							<?php foreach($tingkat as $item) { ?>
								<option value="<?php echo $item->id_tingkat; ?>"><?php echo $item->tingkat; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Semester</label>
						<select class="form-control" name="semester" id="semester">
							<option value="Ganjil">Ganjil</option>
							<option value="Genap">Genap</option>
						</select>
					</div>

					<div class="form-group">
						<label>Deskripsi Kompentsi Dasar</label>
						<textarea name="deskripsi_kd" id="deskripsi_kd" class="form-control" placeholder="Deskripsi Kompentsi Dasar"></textarea>
					</div>

					<input type="hidden" name="id_kd" id="id_kd">
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
      	location.href='Kd/Delete/'+val;
  	}

  	$(document).on("click", ".Edit_KD", function () {
	    var Id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('Kd/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		    	console.log(data);
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
		        	$('#no_kd').val(get.no_kd);
		        	$('#deskripsi_kd').val(get.deskripsi_kd);
		        	$('#id_kd').val(Id);
		        	document.getElementById("id_tingkat").value = get.id_tingkat;
		        	document.getElementById("id_matpel").value = get.id_matpel;
		        	document.getElementById("id_jenis_kd").value = get.id_jenis_kd;
		        	document.getElementById("semester").value = get.semester;
		        }else{
		        	
		        }
		    }
	    });
	});
</script>