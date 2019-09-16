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
					<form action="<?php echo site_url('Kd/ubah'); ?>" method="post">
						<div class="form-group">
							<label>Nama Nomor Kompentsi Dasar</label>
							<input type="text" name="no_kd" class="form-control" placeholder="Nama Nomor Kompentsi Dasar" value="<?php echo $kd->no_kd; ?>">
						</div>

						<div class="form-group">
							<label>Mata Pelajaran</label>
							<select class="form-control" name="id_matpel">
								<?php foreach($matpel as $item) { ?>
									<option value="<?php echo $item->id_matpel; ?>" <?php if($item->id_matpel == $kd->id_matpel){ echo "selected";}else{} ?>><?php echo $item->nama_matpel; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Jenis Kompetensi Dasar</label>
							<select class="form-control" name="id_jenis_kd">
								<?php foreach($jenis_kd as $item) { ?>
									<option value="<?php echo $item->id_jenis_kd; ?>" <?php if($item->id_jenis_kd == $kd->id_jenis_kd){ echo "selected";}else{} ?>><?php echo $item->nama_jenis_kd; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Deskripsi Kompentsi Dasar</label>
							<textarea name="deskripsi_kd" class="form-control" placeholder="Deskripsi Kompentsi Dasar"><?php echo $kd->deskripsi_kd; ?></textarea>
						</div>
						<input type="hidden" name="id_kd" value="<?php echo $kd->id_kd; ?>">

						<div class="text-right">
							<button type="submit" class="btn btn-primary">Simpan <i class="icon-paperplane ml-2"></i></button>
						</div>
					</form>
				</div>
			</div>

		</div>

	</div>
</div>