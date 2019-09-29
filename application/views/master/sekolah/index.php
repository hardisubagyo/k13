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
					<h5 class="card-title"><?php echo $header; ?></h5>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
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

				<div class="card-body">
					<form action="<?php echo site_url('Sekolah/simpan'); ?>" method="post">
						<div class="form-group">
							<label>Nama Sekolah</label>
							<input type="text" name="nama" class="form-control" placeholder="Nama Sekolah" value="<?php echo $sekolah->nama; ?>">
						</div>

						<div class="form-group">
							<label>Alamat Sekolah</label>
							<input type="text" name="alamat" class="form-control" placeholder="Alamat Sekolah" value="<?php echo $sekolah->alamat; ?>">
						</div>

						<div class="form-group">
							<label>Email Sekolah</label>
							<input type="text" name="email" class="form-control" placeholder="Email Sekolah" value="<?php echo $sekolah->email; ?>">
						</div>

						<div class="form-group">
							<label>Telp Sekolah</label>
							<input type="text" name="telp" class="form-control" placeholder="Telp Sekolah" value="<?php echo $sekolah->telp; ?>">
						</div>

						<div class="form-group">
							<label>Akreditasi Sekolah</label>
							<input type="text" name="akreditasi" class="form-control" placeholder="Akreditasi Sekolah" value="<?php echo $sekolah->akreditasi; ?>">
						</div>

						<div class="text-right">
							<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
						</div>
					</form>
				</div>
			</div>

		</div>

	</div>
</div>