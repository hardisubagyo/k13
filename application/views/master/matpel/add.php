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

				<div class="card-body">
					<form action="<?php echo site_url('Matpel/simpan'); ?>" method="post">
						<div class="form-group">
							<label>Nama Mata Pelajaran</label>
							<input type="text" name="nama_matpel" class="form-control" placeholder="Nama Mata Pelajaran">
						</div>

						<div class="form-group">
							<label>Jenis Mata Pelajaran</label>
							<select class="form-control" name="id_jenis_matpel">
								<?php foreach($jenis_matpel as $item){ ?>
									<option value="<?php echo $item->id_jenis_matpel; ?>"><?php echo $item->nama_jenis_matpel; ?></option>
								<?php } ?>
							</select>
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