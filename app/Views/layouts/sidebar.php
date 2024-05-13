<!-- Sidemenu -->
<div class="sticky">
	<div class="main-menu main-sidebar main-sidebar-sticky side-menu">
		<div class="main-sidebar-header main-container-1 active">
			<div class="sidemenu-logo">
				<a class="main-logo" href="<?= base_url('admin') ?>">
					<img src="<?php echo base_url('assets/img/brand/apehipo_white.png') ?>" height="40"
						class="header-brand-img desktop-logo" alt="logo">
					<img src="<?php echo base_url('assets/img/brand/apehipo_white_just.png') ?>" height="40"
						class="header-brand-img icon-logo" alt="logo">
					<img src="<?php echo base_url('assets/img/brand/apehipo_white.png') ?>"
						class="header-brand-img desktop-logo theme-logo" alt="logo">
					<img src="<?php echo base_url('assets/img/brand/apehipo_white_just.png') ?>"
						class="header-brand-img icon-logo theme-logo" alt="logo">
				</a>
			</div>
			<div class="main-sidebar-body main-body-1">
				<div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
				<ul class="menu-nav nav">
					<li class="nav-header"><span class="nav-label">Dashboard</span></li>
					<li class="nav-item <?= ($title == 'Dashboard') ? 'active' : ''; ?>">
						<a class="nav-link" href="<?= base_url('admin') ?>">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-home sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Dashboard</span>
						</a>
					</li>
					<li class="nav-header"><span class="nav-label">Kelola</span></li>
					<li class="nav-item <?= ($title == 'Kelola Produk') ? 'active' : ''; ?>">
						<a class="nav-link" href="<?= base_url('kelola_produk') ?>">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-layout sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Kelola Produk</span>
						</a>
					</li>
					<li class="nav-item <?= ($title == 'Kelola Kebun') ? 'active' : ''; ?>">
						<a class="nav-link" href="<?= base_url('kelola_kebun') ?>">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-layout-tab-window sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Kelola Kebun</span>
						</a>
					</li>
					<li class="nav-item <?= ($title == 'Kelola User') ? 'active' : ''; ?>">
						<a class="nav-link" href="<?= base_url('kelola_user') ?>">
							<span class="shape1"></span>
							<span class="shape2"></span>
							<i class="ti-user sidemenu-icon menu-icon "></i>
							<span class="sidemenu-label">Kelola User</span>
						</a>
					</li>
				</ul>
				<div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
			</div>
		</div>
	</div>
</div>
<!-- End Sidemenu -->