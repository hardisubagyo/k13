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
		<div class="col-md-6">
			<div class="card">
				<div class="card-header header-elements-inline">
					<button type="button" class="btn bg-green" data-toggle="modal" data-target="#Add_Tingkat" data-backdrop="static" data-keyboard="false">
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
							<th>Tingkat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach($tingkat as $item) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $item->tingkat;?></td>
								<td>
									<div class="list-icons list-icons-extended">
				                    	<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Tingkat" data-toggle="modal" data-target="#Edit_Tingkat" data-id="<?php echo $item->id_tingkat; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDeleteTingkat(<?php echo $item->id_tingkat; ?>)">
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

		<div class="col-md-6">
			<div class="card">
				<div class="card-header header-elements-inline">
					<button type="button" class="btn bg-green" data-toggle="modal" data-target="#Add_Kelas" data-backdrop="static" data-keyboard="false">
						<i class="icon-plus3"></i> Kelas
					</button>
					<div class="header-elements">
						<div class="list-icons">
		            		<a class="list-icons-item" data-action="collapse"></a>
		            		<a class="list-icons-item" data-action="remove"></a>
		            	</div>
		        	</div>
				</div>

				<?php if($this->session->flashdata('successkelas')){ ?>
		          	<div class="alert alert-primary border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('successkelas'); ?>
		          	</div>
		        <?php }else if($this->session->flashdata('failedkelas')){ ?>
		        	<div class="alert alert-danger border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('failedkelas'); ?>
		          	</div>
		        <?php } ?>
				
				<table class="table datatable-basic">
					<thead>
						<tr>
							<th>No</th>
							<th>Tingkat</th>
							<th>Kelas</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach($kelas as $item) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $item->tingkat; ?></td>
								<td><?php echo $item->kelas;?></td>
								<td>
									<div class="list-icons list-icons-extended">
										<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Kelas" data-toggle="modal" data-target="#Edit_Kelas" data-id="<?php echo $item->id_kelas; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDeleteTingkat(<?php echo $item->id_kelas; ?>)">
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


<div id="Add_Tingkat" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kelas/simpantingkat'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Tingkat</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nama Tingkat</label>
						<input type="text" name="nama_tingkat" class="form-control" placeholder="Nama Tingkat">
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
<div id="Edit_Tingkat" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kelas/ubahtingkat'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Tingkat</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nama Tingkat</label>
						<input type="text" name="nama_tingkat" id="nama_tingkat" class="form-control" placeholder="Nama Tingkat">
					</div>
				</div>

				<input type="hidden" name="id_tingkat" id="id_tingkat">

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="Add_Kelas" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kelas/simpan'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Kelas</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Tingkat</label>
						<select class="form-control" name="id_tingkat" id="id_tingkat">
							<?php foreach($tingkat as $item){ ?>
								<option value="<?php echo $item->id_tingkat; ?>"><?php echo $item->tingkat; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Nama Kelas</label>
						<input type="text" name="kelas" id="kelas" class="form-control" placeholder="Nama Kelas">
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
<div id="Edit_Kelas" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kelas/ubah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Kelas</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">

					<div class="form-group">
						<label>Tingkat</label>
						<select class="form-control" name="id_tingkat" id="id_tingkat_edit">
							<?php foreach($tingkat as $item){ ?>
								<option value="<?php echo $item->id_tingkat; ?>"><?php echo $item->tingkat; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label>Nama Kelas</label>
						<input type="text" name="kelas" id="kelas_edit" class="form-control" placeholder="Nama Kelas">
					</div>
				</div>

				<input type="hidden" name="id_kelas" id="id_kelas">

				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function ConfirmDeleteTingkat(val){
    	if (confirm("Hapus Data ?"))
      	location.href='Kelas/DeleteTingkat/'+val;
  	}

  	$(document).on("click", ".Edit_Tingkat", function () {
	    var Id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('Kelas/EditTingkat'); ?>",
		    dataType: "json",
		    success: function(data){
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
		        	$('#nama_tingkat').val(get.tingkat);
		        	$('#id_kelas').val(Id);
		        }else{
		        	
		        }
		    }
	    });
	});


	$(document).on("click", ".Edit_Kelas", function () {
	    var Id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('Kelas/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		    	console.log(data);
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
		        	$('#kelas_edit').val(get.kelas);
		        	$('#id_kelas').val(Id);
		        	document.getElementById("id_tingkat_edit").value = get.id_tingkat;
		        }else{
		        	
		        }
		    }
	    });
	});


</script>