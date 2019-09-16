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
					<!-- <a href="<?php echo site_url('Kelamin/add'); ?>">
						<button type="button" class="btn bg-green">
							<i class="icon-plus3"></i>
						</button>
					</a> -->
					<button type="button" class="btn bg-green" data-toggle="modal" data-target="#Add_Kelamin" data-backdrop="static" data-keyboard="false">
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
							<th>No</th>
							<th>Jenis Kelamin</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach($kelamin as $item) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $item->nama_jenkel;?></td>
								<td>
									<div class="list-icons list-icons-extended">
										<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Kelamin" data-toggle="modal" data-target="#Edit_Kelamin" data-id="<?php echo $item->id_jenkel; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDelete(<?php echo $item->id_jenkel; ?>)">
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

<div id="Add_Kelamin" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kelamin/simpan'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Kelamin</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nama Jenis Kelamin</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama Jenis Kelamin">
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

<div id="Edit_Kelamin" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('Kelamin/ubah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Kelamin</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nama Jenis Kelamin</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Jenis Kelamin">
					</div>
				</div>

				<input type="hidden" name="id_jenkel" id="id_jenkel">

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
      	location.href='Kelamin/Delete/'+val;
  	}

  	$(document).on("click", ".Edit_Kelamin", function () {
	    var Id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('Kelamin/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
		        	$('#nama').val(get.nama_jenkel);
		        	$('#id_jenkel').val(Id);
		        }else{
		        	
		        }
		    }
	    });
	});
</script>