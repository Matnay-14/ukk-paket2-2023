<?php
session_start();
if(empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    $nik = $_SESSION['nik'];
    $nama = $_SESSION['nama'];
    $username = $_SESSION['username'];
    $telp = $_SESSION['telp'];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('../../assets/header.php'); ?>
<body data-background-color="bg1">
    <div class="wrapper">
        
        <?php include('../../assets/menu.php'); ?>

        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-header">
                                    <i class="fas fa-user-circle"><strong>Profile</strong></i>
                                </div>
                                <div class="card-header">NIK : <?= $nik ?></div>
                                <div class="card-header">Nama : <?= $nama ?></div>
                                <div class="card-header">Username : <?= $username ?></div>
                                <div class="card-header">Telp :<?= $telp ?></div>
                            </div>
                        </div>
                    </div>

				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									12RPL1
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2023, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://instagram.com/zen_all23?igshid=ZDdkNTZiNTM=">Alwi Matondang</a>
					</div>				
				</div>
			</footer>
		</div>
            
        <?php include('../../assets/footer.php'); ?>
    </div>

    <?php include('../../assets/script.php') ?>
</body>
</html>