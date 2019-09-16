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

				<table class="table datatable-basic">
					<thead>
						<tr>
							<th>No</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Mata Pelajaran</th>
							<th>Kelas</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach ($manajemen as $item) {
						?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $item->id_pegawai; ?></td>
								<td><?php echo $item->nama_pegawai; ?></td>
								<td><?php echo $item->nama_matpel; ?></td>
								<td>
									<?php 
										$getkelas = explode(',',$item->id_kelas);
										foreach($getkelas as $row){
											$get = $this->db->query("SELECT * FROM tm_kelas WHERE id_kelas = '$row'")->row();
											echo $get->kelas.", ";
										}
									?>
								</td>
								<td>
									<div class="list-icons list-icons-extended">
										<button type="button" class="btn btn-outline bg-brown text-brown-800 btn-icon ml-2 Edit_Pegawai" data-toggle="modal" data-target="#Edit_Pegawai" data-id="<?php echo $item->id_guru_matpel; ?>" data-backdrop="static" data-keyboard="false">
											<i class="icon-pencil3"></i>
										</button>
										<button type="button" class="btn btn-outline bg-danger text-danger-800 btn-icon ml-2" onclick="ConfirmDelete(<?php echo $item->id_guru_matpel; ?>)">
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
			<form action="<?php echo site_url('Manajemen/simpan'); ?>" method="post" id="Add_Pegawai">
				<div class="modal-header">
					<h5 class="modal-title">Tambah Manajaman Pengajar</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="form-group">
						<label>Nama Pengajar</label>
						<select class="form-control select" name="id_pegawai" id="id_pegawai">
							<?php foreach ($pegawai as $item) {?>
								<option value="<?php echo $item->NIP; ?>"><?php echo $item->nama_pegawai; ?></option>
							<?php }?>
						</select>
					</div>

					<div class="form-group">
						<label>Mata Pelajaran</label>
						<select class="form-control select" name="id_matpel" id="id_matpel">
							<?php foreach ($matpel as $item) {?>
								<option value="<?php echo $item->id_matpel; ?>"><?php echo $item->nama_matpel; ?></option>
							<?php }?>
						</select>
					</div>

					<div class="form-group">
						<label>Kelas</label>
						<select class="form-control select" multiple name="id_kelas[]">
							<?php foreach ($kelas as $row) {?>
								<option value="<?php echo $row->id_kelas; ?>"><?php echo $row->kelas; ?></option>
							<?php }?>
						</select>
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
			<form action="<?php echo site_url('Manajemen/ubah'); ?>" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Edit Pegawai</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<input type="hidden" name="id_guru_matpel" id="id_guru_matpel">
					<div class="form-group">
						<label>Nama Pengajar</label>
						<select class="form-control select_edit" name="id_pegawai_edit" id="id_pegawai_edit">
							<?php foreach ($pegawai as $item) {?>
								<option value="<?php echo $item->NIP; ?>"><?php echo $item->nama_pegawai; ?></option>
							<?php }?>
						</select>
					</div>

					<div class="form-group">
						<label>Mata Pelajaran</label>
						<select class="form-control select_edit" name="id_matpel_edit" id="id_matpel_edit">
							<?php foreach ($matpel as $item) {?>
								<option value="<?php echo $item->id_matpel; ?>"><?php echo $item->nama_matpel; ?></option>
							<?php }?>
						</select>
					</div>

					<div class="form-group">
						<label>Kelas</label>
						<select class="form-control select_edit_form" multiple name="id_kelas_edit[]" id="id_kelas_edit[]">
							<?php foreach ($kelas as $row) {?>
								<option value="<?php echo $row->id_kelas; ?>"><?php echo $row->kelas; ?></option>
							<?php }?>
						</select>
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
      	location.href='Manajemen/Delete/'+val;
  	}

  	$(document).on("click", ".Edit_Pegawai", function () {
	    var Id = $(this).data('id');
	    $.ajax({
			type : "post",
		    data: {
		        'id' : Id
		    },
		    url: "<?php echo site_url('Manajemen/Edit'); ?>",
		    dataType: "json",
		    success: function(data){
		        if(data.status == '1'){
		        	var get = JSON.parse(data.data);
					console.log(get);
		        	$('#id_guru_matpel').val(Id);
					document.getElementById("id_pegawai_edit").value = get.id_pegawai;
					document.getElementById("id_matpel_edit").value = get.id_matpel;
					var selectedValues = get.id_kelas.split(',');
					console.log(selectedValues);
					$('.select_edit_form').val(selectedValues).trigger("change");
					

		        }else{

		        }
		    }
	    });
	});

	$(document).ready(function() {
		$(".select").select2({
			dropdownParent: $("#Add_Pegawai")
		});

		$(".select_edit").select2({
			dropdownParent: $("#Edit_Pegawai")
		});

		$(".select_edit_form").select2({
			dropdownParent: $("#Edit_Pegawai")
		});
	});

</script>