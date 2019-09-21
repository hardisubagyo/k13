<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title; ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/temp/global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/temp/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/temp/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/temp/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/temp/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/temp/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/main/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/ui/slinky.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/pickers/daterangepicker.js"></script>

	<script src="<?php echo base_url(); ?>assets/temp/assets/js/app.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/demo_pages/dashboard.js"></script>
	<!-- /theme JS files -->

	<!-- Form -->
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/forms/selects/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/demo_pages/form_layouts.js"></script>

	<!-- Datatables -->
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/demo_pages/datatables_basic.js"></script>

	<!-- Datepicker -->
	<link href="<?php echo base_url(); ?>assets/temp/global_assets/date/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/date/dist/js/bootstrap-datepicker.min.js"></script>

	
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/notifications/pnotify.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/demo_pages/form_multiselect.js"></script>

	<script src="<?php echo base_url(); ?>assets/temp/global_assets/js/demo_pages/form_select2.js"></script>

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand wmin-0 mr-5">
			<a href="<?php echo base_url(); ?>" class="d-inline-block">
				<img src="<?php echo base_url(); ?>assets/temp/global_assets/images/logo_light.png" alt="">
			</a>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Secondary navbar -->
	<div class="navbar navbar-expand-md navbar-light">
		<div class="text-center d-md-none w-100">
			<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-navigation">
				<i class="icon-unfold mr-2"></i>
				Navigation
			</button>
		</div>

		<div class="navbar-collapse collapse" id="navbar-navigation">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="<?php echo base_url(); ?>" class="navbar-nav-link">
						<i class="icon-home4 mr-2"></i>
						Dashboard
					</a>
				</li>

				<?php
					if(($this->session->userdata('id_akses') == '3') || ($this->session->userdata('id_akses') == '4')){
				?>
				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<i class="icon-office mr-2"></i>
						Data Master
					</a>

					<div class="dropdown-menu">
						<div class="dropdown-header">Data Master</div>
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo site_url('Agama'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Agama
								</a>
								<a href="<?php echo site_url('Akses'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Akses
								</a>
								<a href="<?php echo site_url('Ekstra'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Ekstra
								</a>
								<a href="<?php echo site_url('Kelas'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Kelas
								</a>
								<a href="<?php echo site_url('JenisKd'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Jenis Kompetensi Dasar
								</a>
								<a href="<?php echo site_url('MataPelajaran'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Jenis Mata Pelajaran
								</a>
								<a href="<?php echo site_url('Manajemen'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Manajemen Pengajar
								</a>
							</div>
							<div class="col-md-6">
								<a href="<?php echo site_url('Matpel'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Mata Pelajaran
								</a>
								<a href="<?php echo site_url('Kd'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Kompetensi Dasar
								</a>
								<a href="<?php echo site_url('Kelamin'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Jenis Kelamin
								</a>
								
								<a href="<?php echo site_url('Kategori'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Kategori
								</a>	
								<a href="<?php echo site_url('Pegawai'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Pegawai
								</a>
								<a href="<?php echo site_url('TahunAjaran'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Tahun Ajaran
								</a>
								<a href="<?php echo site_url('Walikelas'); ?>" class="dropdown-item">
									<i class="icon-primitive-square"></i> Master Walikekas
								</a>
							</div>
						</div>
					</div>
				</li>

				<?php 
					}else{}
				?>

				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<i class="icon-city mr-2"></i>
						Data Utama
					</a>

					<div class="dropdown-menu dropdown-menu-left dropdown-content wmin-md-350">
						<div class="dropdown-content-body p-1">
							<div class="row no-gutters">

								<?php
									if(($this->session->userdata('id_akses') == '3') || ($this->session->userdata('id_akses') == '4')){
								?>
									<div class="col-12 col-sm-4">
										<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
											<i class="icon-home7 icon-2x"></i>
											<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Data Sekolah</div>
										</a>
									</div>

									<div class="col-12 col-sm-4">
										<a href="<?php echo site_url('Siswa'); ?>" class="d-block text-default text-center ripple-dark rounded p-3">
											<i class="icon-users4 icon-2x"></i>
											<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Data Siswa</div>
										</a>
									</div>
								<?php 
									}else{
								?>
									<div class="col-12 col-sm-4">
										<a href="<?php echo site_url('Nilai'); ?>" class="d-block text-default text-center ripple-dark rounded p-3">
											<i class="icon-book3 icon-2x"></i>
											<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Nilai Siswa</div>
										</a>
									</div>
								<?php
									} 
								?>

							</div>
						</div>
					</div>
				</li>
				
				<?php
					if(($this->session->userdata('id_akses') == '3') || ($this->session->userdata('id_akses') == '4')){
				?>
				<li class="nav-item nav-item-levels mega-menu-full">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<i class="icon-book2 mr-3"></i>
						Input Nilai
					</a>

					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-body">
							<div class="row">
								<?php
									if(($this->session->userdata('id_akses') == '2') || ($this->session->userdata('id_akses') == '3') || ($this->session->userdata('id_akses') == '4')){
								?>
								<div class="col-md-3">
									<div class="font-size-sm line-height-sm font-weight-semibold text-uppercase mt-1">Nilai Sikap</div>
									<div class="dropdown-divider mb-2"></div>
									<div class="dropdown-item-group mb-3 mb-md-0">
										<ul class="list-unstyled">
											<li>
												<a href="<?php echo site_url('Spiritual'); ?>" class="dropdown-item rounded">
													<i class="icon-book3 mr-3"></i>Sikap Spriritual
												</a>
											</li>
											<li>
												<a href="<?php echo site_url('Sosial'); ?>" class="dropdown-item rounded">
													<i class="icon-book3 mr-3"></i>Sikap Sosial
												</a>
											</li>
										</ul>
									</div>
								</div>
								<?php }else{} ?>

								<div class="col-md-3">
									<?php
										$id_matpel = str_replace(array('[',']'),'',json_encode($this->session->userdata('id_matpel')));
									?>
									<div class="font-size-sm line-height-sm font-weight-semibold text-uppercase mt-1">MATA PELAJARAN <?php echo $this->session->userdata('id_akses'); ?></div>
									<div class="dropdown-divider mb-2"></div>
									<div class="dropdown-item-group mb-3 mb-md-0">
										<ul class="list-unstyled">
											<?php
												if($this->session->userdata('id_akses') == '2' || ($this->session->userdata('id_akses') == '1')){
													$pengetahuan = $this->db->query("SELECT * FROM tm_matpel WHERE id_matpel IN ($id_matpel) ORDER BY nama_matpel ASC")->result();
												}else{
													$pengetahuan = $this->db->query("SELECT * FROM tm_matpel ORDER BY nama_matpel ASC")->result();
												}
												
												foreach($pengetahuan as $item){ 
											?>
											<li>
												<a href="<?php echo site_url('Input/Matpel/'.base64_encode($item->id_matpel)); ?>" class="dropdown-item rounded">
													<i class="icon-book3 mr-3"></i><?php echo $item->nama_matpel; ?>
												</a>
											</li>
											<?php } ?>
										</ul>
									</div>
								</div>

								<?php
									if(($this->session->userdata('id_akses') == '2') || ($this->session->userdata('id_akses') == '3') || ($this->session->userdata('id_akses') == '4')){
								?>
								<div class="col-md-3">
									<div class="font-size-sm line-height-sm font-weight-semibold text-uppercase mt-1">Lainnya</div>
									<div class="dropdown-divider mb-2"></div>
									<div class="dropdown-item-group mb-3 mb-md-0">
										<ul class="list-unstyled">
											<li>
												<a href="<?php echo site_url('Lainnya'); ?>" class="dropdown-item rounded">
													<i class="icon-book3 mr-3"></i>Nilai Lainnya
												</a>
											</li>
										</ul>
									</div>
								</div>
								<?php }else{} ?>
							</div>
						</div>
					</div>
				</li>
				<?php }else{} ?>
				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<i class="icon-graduation mr-2"></i>
						Output Rapor
					</a>

					<div class="dropdown-menu dropdown-menu-left dropdown-content wmin-md-350">
						<div class="dropdown-content-body p-1">
							<div class="row no-gutters">
								
								<div class="col-12 col-sm-4">
									<a href="#" class="d-block text-default text-center ripple-dark rounded p-3">
										<i class="icon-clippy icon-2x"></i>
										<div class="font-size-sm font-weight-semibold text-uppercase mt-2">Rapor Siswa</div>
									</a>
								</div>

							</div>
						</div>
					</div>
				</li>

			</ul>

			<ul class="navbar-nav ml-md-auto">
				

				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="d-md-none ml-2">Settings</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?php echo site_url('Auth/Out'); ?>" class="dropdown-item"><i class="icon-user-lock"></i> Keluar</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /secondary navbar -->