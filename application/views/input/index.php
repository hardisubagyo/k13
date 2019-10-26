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
					<h6 class="card-title"><?php echo $title . ' <b>' . $matpel->nama_matpel; ?></b></h6>
					<div class="header-elements">
						<div class="list-icons">
	                		<a class="list-icons-item" data-action="collapse"></a>
	                	</div>
                	</div>
				</div>
				<form action="<?php echo site_url('Input/nilai'); ?>" method="get" >
					<div class="card-body">
						<div class="form-group">
							<label>Jenis Kompetensi Dasar</label>
							<select class="form-control" name="id_jenis_kd">
								<?php foreach($kd as $item) { ?>
									<option value="<?php echo $item->id_jenis_kd; ?>"><?php echo $item->nama_jenis_kd; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Kelas</label>
							<select class="form-control" name="id_kelas">
								<?php foreach($kelas as $item) { ?>
									<option value="<?php echo $item->id_kelas; ?>"><?php echo $item->kelas; ?></option>
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

						<div class="form-group">
							<label>Nilai</label>
							<select class="form-control" name="nilai">
								<option value="Harian">Harian</option>
								<option value="UTS">UTS</option>
								<option value="UAS">UAS</option>
							</select>
						</div>

						<input type="hidden" name="id_matpel" value="<?php echo $this->uri->segment(3); ?>">
					</div>

					<div class="card-footer">
						<button type="submit" class="btn btn-success">Input <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>