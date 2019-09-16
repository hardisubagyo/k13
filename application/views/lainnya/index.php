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
		<div class="col-md-6">

			<div class="card">
				<div class="card-header bg-success text-white header-elements-inline">
					<h6 class="card-title"> <i class="icon-pencil6 icon-1x"></i> <?php echo $header_input; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>

				<?php if($this->session->flashdata('success')){ ?>
		          	<div class="alert alert-primary border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('success'); ?>
		          	</div>
		        <?php } ?>

				<form action="<?php echo site_url('Lainnya/form'); ?>" method="get" >
					<div class="card-body">
						
						<div class="form-group">
							<label>Tingkat</label>
							<select class="form-control" name="id_tingkat">
								<?php foreach($tingkat as $item) { ?>
									<option value="<?php echo $item->id_tingkat; ?>"><?php echo $item->tingkat; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Tahun Ajaran</label>
							<select class="form-control" name="id_tahunajaran">
								<?php foreach($tahunajaran as $item) { ?>
									<option value="<?php echo $item->id_tahunajaran; ?>"><?php echo $item->tahunajaran; ?></option>
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
					</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-success">Cari <i class="icon-search4 ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>

		<div class="col-md-6">

			<div class="card">
				<div class="card-header bg-success text-white header-elements-inline">
					<h6 class="card-title"><i class="icon-eye icon-1x"></i> <?php echo $header_view; ?></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>

				<?php if($this->session->flashdata('success')){ ?>
		          	<div class="alert alert-primary border-0 alert-dismissible">
		          		<a class="close" data-dismiss="alert" href="#">×</a>
		            	<?php echo $this->session->flashdata('success'); ?>
		          	</div>
		        <?php } ?>
		        
				<form action="<?php echo site_url('Lainnya/view'); ?>" method="get" >
					<div class="card-body">
						
						<div class="form-group">
							<label>Tingkat</label>
							<select class="form-control" name="id_tingkat">
								<?php foreach($tingkat as $item) { ?>
									<option value="<?php echo $item->id_tingkat; ?>"><?php echo $item->tingkat; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Tahun Ajaran</label>
							<select class="form-control" name="id_tahunajaran">
								<?php foreach($tahunajaran as $item) { ?>
									<option value="<?php echo $item->id_tahunajaran; ?>"><?php echo $item->tahunajaran; ?></option>
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
					</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-success">Cari <i class="icon-search4 ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>