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
					<button type="button" class="btn bg-green" data-toggle="modal" data-target="#Add_TahunAjaran" data-backdrop="static" data-keyboard="false">
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
							<th>Tahun Ajaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach($tahunajaran as $item) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $item->tahunajaran;?></td>
								<td>
									<div class="list-icons list-icons-extended">
										<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_TahunAjaran" data-toggle="modal" data-target="#Edit_TahunAjaran" data-id="<?php echo $item->id_tahunajaran; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDelete(<?php echo $item->id_tahunajaran; ?>)">
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

<div id="Add_TahunAjaran" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('TahunAjaran/simpan'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Tahun Ajaran</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nama Tahun Ajaran</label>
						<input type="text" name="tahunajaran" class="form-control" placeholder="Nama Tahun Ajaran">
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

<div id="Edit_TahunAjaran" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo site_url('TahunAjaran/ubah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Tahun Ajaran</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">				
					<div class="form-group">
						<label>Nama TahunAjaran</label>
						<input type="text" name="tahunajaran" id="tahunajaran" class="form-control" placeholder="Nama Tahun Ajaran">
					</div>
				</div>

				<input type="hidden" name="id_tahunajaran" id="id_tahunajaran">

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
      	location.href='TahunAjaran/Delete/'+val;
  	}

  	$(document).on("click", ".Edit_TahunAjaran", function () {
	    var Id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('TahunAjaran/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
		        	$('#tahunajaran').val(get.tahunajaran);
		        	$('#id_tahunajaran').val(Id);
		        }else{
		        	
		        }
		    }
	    });
	});
</script>