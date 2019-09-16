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
					<button type="button" class="btn bg-green" data-toggle="modal" data-target="#Add_Pegawai" data-backdrop="static" data-keyboard="false">
						<i class="icon-plus3"></i>
					</button>
					<div class="header-elements">
						<div class="list-icons">
		            		<a class="list-icons-item" data-action="collapse"></a>
		            		<a class="list-icons-item" data-action="remove"></a>
		            	</div>
		        	</div>
				</div>

				<?php if ($this->session->flashdata('success')) {?>
		          	<div class="alert alert-primary border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('success'); ?>
		          	</div>
		        <?php } else if ($this->session->flashdata('failed')) {?>
		        	<div class="alert alert-danger border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('failed'); ?>
		          	</div>
				<?php }?>

				<!-- <form action="<?php echo site_url('Pegawai/test'); ?>" method="post">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header header-elements-inline">
								<h5 class="card-title">Multiple select</h5>
								<div class="header-elements">
									<div class="list-icons">
										<a class="list-icons-item" data-action="collapse"></a>
										<a class="list-icons-item" data-action="reload"></a>
										<a class="list-icons-item" data-action="remove"></a>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label>Multiple select</label>
									<select multiple="multiple" class="form-control select" name="test123[]">
										<optgroup label="Mountain Time Zone">
											<option value="AZ">Arizona</option>
											<option value="CO">Colorado</option>
											<option value="ID">Idaho</option>
											<option value="WY">Wyoming</option>
										</optgroup>
										<optgroup label="Central Time Zone">
											<option value="AL">Alabama</option>
											<option value="IA">Iowa</option>
											<option value="KS">Kansas</option>
											<option value="KY">Kentucky</option>
										</optgroup>
									</select>
								</div>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
				</form> -->

				<table class="table datatable-basic">
					<thead>
						<tr>
							<th>No</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Akses</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach ($pegawai as $item) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $item->NIP; ?></td>
								<td><?php echo $item->nama_pegawai; ?></td>
								<td><?php echo $item->email; ?></td>
								<td><?php echo $item->nama_akses; ?></td>
								<td>
									<div class="list-icons list-icons-extended">
										<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Pegawai" data-toggle="modal" data-target="#Edit_Pegawai" data-id="<?php echo $item->NIP; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDelete(<?php echo $item->NIP; ?>)">
											<i class="icon-eraser"></i>
										</button>
			                    	</div>
								</td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="Add_Pegawai" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Add_Pegawai" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Pegawai/simpan'); ?>" method="post" id="Add_Pegawai">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Pegawai</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label>NIP</label>
						<input type="text" name="nip" class="form-control" placeholder="NIP" required>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama" required>
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" placeholder="Email" required>
					</div>

					<div class="form-group">
						<label>Akses</label>
						<select class="form-control" name="id_akses" id="id_akses">
							<option value="">Pilih Tipe Akses</option>
							<?php foreach ($akses as $item) {?>
								<option value="<?php echo $item->id_akses; ?>"><?php echo $item->nama_akses; ?></option>
							<?php }?>
						</select>
					</div>

					
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>

					<div class="form-group">
						<label>RePassword</label>
						<input type="password" name="repassword" class="form-control" placeholder="RePassword" required>
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

<div id="Edit_Pegawai" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Pegawai/ubah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Pegawai</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label>NIP</label>
						<input type="text" name="nip" id="nip" class="form-control" placeholder="NIP" readonly required>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
					</div>

					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
					</div>

					<div class="form-group">
						<label>Akses</label>
						<select class="form-control" name="id_akses" id="id_akses_edit">
							<?php foreach ($akses as $item) {?>
								<option value="<?php echo $item->id_akses; ?>"><?php echo $item->nama_akses; ?></option>
							<?php }?>
						</select>
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" placeholder="Isi Jika Ingin Mengganti Password">
					</div>

					<div class="form-group">
						<label>RePassword</label>
						<input type="password" name="repassword" class="form-control" placeholder="Isi Jika Ingin Mengganti Password">
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
      	location.href='Pegawai/Delete/'+val;
  	}

  	$(document).on("click", ".Edit_Pegawai", function () {
	    var Id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('Pegawai/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
		        	$('#nip').val(get.NIP);
		        	$('#nama').val(get.nama_pegawai);
		        	$('#email').val(get.email);
		        	document.getElementById("id_akses_edit").value = get.id_akses;
		        }else{

		        }
		    }
	    });
	});

</script>