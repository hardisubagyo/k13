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
					<form action="<?php echo site_url('Pegawai/ubah'); ?>" method="post">
						<div class="form-group">
							<label>NIP</label>
							<input type="text" name="nip" class="form-control" placeholder="NIP" value="<?php echo $pegawai->NIP; ?>" required readonly>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $pegawai->nama_pegawai; ?>" required>
						</div>

						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo $pegawai->email; ?>">
						</div>

						<div class="form-group">
							<label>Akses</label>
							<select class="form-control" name="id_akses">
								<?php foreach($akses as $item){ ?>
									<option value="<?php echo $item->id_akses; ?>" <?php if($item->id_akses == $pegawai->id_akses){ echo "selected";}else{} ?>><?php echo $item->nama_akses; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Kelas</label>
							<select class="form-control" name="id_kelas">
								<?php foreach($kelas as $item){ ?>
									<option value="<?php echo $item->id_kelas; ?>" <?php if($item->id_kelas == $pegawai->id_kelas){ echo "selected";}else{} ?>><?php echo $item->kelas; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Kategori</label>
							<select class="form-control" name="id_kategori">
								<?php foreach($kategori as $item){ ?>
									<option value="<?php echo $item->id_kategori; ?>" <?php if($item->id_kategori == $pegawai->id_kategori){ echo "selected";}else{} ?>><?php echo $item->nama_kategori; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
							<span class="form-text text-danger">Isi Jika Ingin Merubah Password</span>
						</div>

						<div class="form-group">
							<label>RePassword</label>
							<input type="password" name="repassword" class="form-control" placeholder="RePassword">
							<span class="form-text text-danger">Isi Jika Ingin Merubah Password</span>
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