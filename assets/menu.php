		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="dark2">
				
				<a href="#" class="logo">
					<!-- <img src="../../template/assets/img/logo.svg" alt="navbar brand" class="navbar-brand"> -->
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
					</ul>
						<li class="nav-item">
							<a href="/pengaduan_masyarakat/modul/modul-auth/logout.php">
								<i class="fas fa-sign-out-alt"></i>
							</a>
						</li>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2" data-background-color="dark2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../../template/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?= $_SESSION['username'] ?>
									<span class="user-level"><?= $_SESSION['level'] ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li class="nav-item">
										<?php if($_SESSION['level'] == 'masyarakat') {?>
										<a href="/pengaduan_masyarakat/modul/modul-profile/">
											<i class="fas fa-id-card"></i>
											<p>My Profile</p>
										</a>
										<?php } ?>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>

						<li class="nav-item">
							<a href="/pengaduan_masyarakat/modul/modul-pengaduan/">
								<i class="fas fa-envelope"></i>
								<p>Pengaduan</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="/pengaduan_masyarakat/modul/modul-masyarakat">
								<i class="fas fa-users"></i>
								<p>Masyarakat</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="/pengaduan_masyarakat/modul/modul-tanggapan/">
								<i class="fas fa-comment-dots"></i>
								<p>Tanggapan</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="/pengaduan_masyarakat/modul/modul-petugas/">
								<i class="fas fa-headset"></i>
								<p>Petugas</p>
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->