<!DOCTYPE html>
<html lang="en" id="demo">

<head>

	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="Spruha -  Admin Panel HTML Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

	<!-- Favicon -->
	<link rel="icon" href="<?php echo base_url('/assets/img/brand/favicon.ico'); ?>" type="image/x-icon" />

	<!-- Title -->
	<title><?= $title ?></title>

	<!-- Bootstrap css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

	<!-- DATA TABLE CSS -->
	<link href="<?= base_url('assets/plugins/datatable/css/dataTables.bootstrap5.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/plugins/datatable/css/buttons.bootstrap5.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/plugins/datatable/css/responsive.bootstrap5.css') ?>" rel="stylesheet" />


	<!-- Icons css-->
	<link href="<?php echo base_url('assets/plugins/web-fonts/icons.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/plugins/web-fonts/font-awesome/font-awesome.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/plugins/web-fonts/plugin.css') ?>" rel="stylesheet" />

	<!-- Style css-->
	<link href="<?php echo base_url('assets/css/stylish.css') ?>" rel="stylesheet">

	<!-- Select2 css-->
	<link href="<?php echo base_url('assets/plugins/select2/css/select2.min.css') ?>" rel="stylesheet">

	<!-- Mutipleselect css-->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/multipleselect/multiple-select.css') ?>">

	<!-- datatables -->
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/simple-datatables/style.css') ?>">

</head>

<body class="ltr main-body leftmenu">

	<!-- Page -->
	<div class="page">


		<!-- Main Header-->
		<div class="main-header side-header sticky">
			<div class="main-container container-fluid">
				<div class="main-header-left">
					<a class="main-header-menu-icon" href="javascript:void(0)" id="mainSidebarToggle"><span></span></a>
					<div class="hor-logo">
						<a class="main-logo" href="<?= base_url('admin') ?>">
							<img src="<?php echo base_url('assets/img/brand/apehipo_white.png') ?>" class="header-brand-img desktop-logo" alt="logo">
							<img src="<?php echo base_url('assets/img/brand/apehipo_white_just.png') ?>" class="header-brand-img desktop-logo-dark" alt="logo">
						</a>
					</div>
				</div>
				<div class="main-header-center">
					<div class="responsive-logo">
						<a href="<?= base_url('admin') ?>"><img src="<?php echo base_url('assets/img/brand/apehipo_hijau.png') ?>" width="50%" class="mobile-logo" alt="logo"></a>
						<a href="<?= base_url('admin') ?>"><img src="<?php echo base_url('assets/img/brand/apehipo_white_just.png') ?>" width="50%" class="mobile-logo-dark" alt="logo"></a>
					</div>
				</div>
				<div class="main-header-right">
					<button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
					</button><!-- Navresponsive closed -->
					<div class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
						<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
							<div class="d-flex order-lg-2 ms-auto">
								<!-- Profile -->
								<div class="dropdown main-profile-menu">
									<a class="d-flex" href="javascript:void(0)">
											<div class="card-item-icon card-icon">
												<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
													<path d="M0 0h24v24H0V0z" fill="none" />
													<path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3" />
													<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z" />
												</svg>
											</div>
									</a>
									<div class="dropdown-menu">
										<div class="header-navheading">
											<h6 class="main-notification-title">Tasyalia Fajrina</h6>
											<p class="main-notification-text">Admin APEHIPO</p>
										</div>
										<a class="dropdown-item" href="logout">
											<i class="fe fe-power"></i> Sign Out
										</a>
									</div>
								</div>
								<!-- Profile -->

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Main Header-->

        <!-- sidebar -->
    <?= $this->include('layouts/sidebar') ?>
        <!-- end sidebar -->

        <!-- main content -->
        <?= $this->renderSection('content') ?>
        <!-- end main content -->


        			<!-- Main Footer-->
			<div class="main-footer text-center">
				<div class="container">
					<div class="row row-sm">
						<div class="col-md-12">
							<span>Copyright © 2023 <a href="javascript:void(0)">APEHIPO</a>. All rights reserved.</span>
						</div>
					</div>
				</div>
			</div>
			<!--End Footer-->


		</div>
		<!-- End Page -->

		<!-- Back-to-top -->
		<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>






		<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

		<!-- Bootstrap js-->
		<script src="<?php echo base_url('assets/plugins/bootstrap/js/popper.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

		<!-- Internal Chart.Bundle js-->
		<script src="<?php echo base_url('assets/plugins/chart.js/Chart.bundle.min.js') ?>"></script>

		<!-- Peity js-->
		<script src="<?php echo base_url('assets/plugins/peity/jquery.peity.min.js') ?>"></script>

		<!-- Select2 js-->
		<script src="<?php echo base_url('assets/plugins/select2/js/select2.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/select2.js') ?>"></script>

		<!-- Perfect-scrollbar js -->
		<script src="<?php echo base_url('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>

		<!-- Sidemenu js -->
		<script src="<?php echo base_url('assets/plugins/sidemenu/sidemenu.js') ?>"></script>

		<!-- Sidebar js -->
		<script src="<?php echo base_url('assets/plugins/sidebar/sidebar.js') ?>"></script>

		<!-- Internal Morris js -->
		<script src="<?php echo base_url('assets/plugins/raphael/raphael.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/plugins/morris.js/morris.min.js') ?>"></script>

		<!-- Circle Progress js-->
		<script src="<?php echo base_url('assets/js/circle-progress.min.js') ?>"></script>
		<script src="<?php echo base_url('assets/js/chart-circle.js') ?>"></script>

		<!-- Color Theme js -->
		<script src="<?php echo base_url('assets/js/themeColors.js') ?>"></script>

		<!-- Sticky js -->
		<script src="<?php echo base_url('assets/js/sticky.js') ?>"></script>

		<!-- Custom js -->
		<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>

		<!-- Internal Dashboard js-->
		<!-- Internal Data Table js -->
		<script src="<?= base_url('assets/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/js/dataTables.bootstrap5.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/js/dataTables.buttons.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/js/buttons.bootstrap5.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/js/jszip.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/pdfmake/pdfmake.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/pdfmake/vfs_fonts.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/js/buttons.html5.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/js/buttons.print.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/js/buttons.colVis.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/dataTables.responsive.min.js') ?>"></script>
		<script src="<?= base_url('assets/plugins/datatable/responsive.bootstrap5.min.js') ?>"></script>
		<script src="<?= base_url('assets/js/table-data.js') ?>"></script>
		<script src="<?= base_url('assets/js/select2.js') ?>"></script>

		<script src="<?= base_url('assets/js/script.js') ?>">
		</script>
		
		
</body>

</html>