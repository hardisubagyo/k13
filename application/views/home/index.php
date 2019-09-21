<!-- Page header -->
<div class="page-header">
	<div class="page-header-content header-elements-md-inline">
		<div class="page-title d-flex">
			<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Dashboard</h4>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>

		<div class="header-elements d-none py-0 mb-3 mb-md-0">
			<div class="breadcrumb">
				<a href="<?php echo base_url(); ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Dashboard</span>
			</div>
		</div>
	</div>
</div>
<!-- /page header -->
	

<!-- Page content -->
<div class="page-content pt-0">

	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Content area -->
		<div class="content">
			
		<div class="row">
			<div class="col-lg-4">

				<!-- Members online -->
				<div class="card bg-teal-400">
					<div class="card-body">

									<p><i class="icon-users2 icon-2x d-inline-block text-info"></i></p>
									<h5 class="font-weight-semibold mb-0">2,345</h5>
									<span class="font-size-sm">users</span>
					</div>
				</div>
				<!-- /members online -->

			</div>

			<div class="col-lg-4">

				<!-- Current server load -->
				<div class="card bg-pink-400">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">49.4%</h3>
							<div class="list-icons ml-auto">
								<div class="list-icons-item dropdown">
									<a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a>
										<a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a>
										<a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
										<a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
									</div>
								</div>
							</div>
						</div>
						
						<div>
							Current server load
							<div class="font-size-sm opacity-75">34.6% avg</div>
						</div>
					</div>

					<div id="server-load"></div>
				</div>
				<!-- /current server load -->

			</div>

			<div class="col-lg-4">

				<!-- Today's revenue -->
				<div class="card bg-blue-400">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">$18,390</h3>
							<div class="list-icons ml-auto">
								<a class="list-icons-item" data-action="reload"></a>
							</div>
						</div>
						
						<div>
							Today's revenue
							<div class="font-size-sm opacity-75">$37,578 avg</div>
						</div>
					</div>

					<div id="today-revenue"></div>
				</div>
				<!-- /today's revenue -->

			</div>
		</div>
			
		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

</div>
<!-- /page content -->