<?php
session_start();
include('../../config/koneksi.php');
if(empty('username')) {
    @header('location:../modul-auth/index.php');
}

if(isset($_POST['edit'])) {
    $status = $_POST['status'];
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "UPDATE `masyarakat` SET verifikasi = '$status' WHERE nik = '$nik'");
}

if(isset($_POST['hapus'])) {
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "DELETE FROM `masyarakat` WHERE nik = '$nik'");
}

if(isset($_POST['update'])) {
    $nikLama = $_POST['nikLama'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $password = md5($_POST['password']);
    if($password == ''){
        $q = mysqli_query($con, "UPDATE `masyarakat` SET nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    } else {
        $q = mysqli_query($con, "UPDATE `masyarakat` SET `password` = '$password', nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    }
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
					
                <div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Table Masyarakat</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="multi-filter-select" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>NIK</th>
													<th>Nama</th>
													<th>Username</th>
													<th>Telp</th>
													<th>Status</th>
													<th>Update</th>
													<th>Hapus</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>NIK</th>
													<th>Nama</th>
													<th>Username</th>
													<th>Telp</th>
													<th>Status</th>
													<th>Update</th>
													<th>Hapus</th>
												</tr>
											</tfoot>
											<tbody>
                                                <?php 
                                                $q = mysqli_query($con, "SELECT * FROM `masyarakat`");
                                                $no = 1;
                                                while ($d = mysqli_fetch_object($q)) { ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $d->nik ?></td>
                                                    <td><?= $d->nama ?></td>
                                                    <td><?= $d->username ?></td>
                                                    <td><?= $d->telp ?></td>
                                                    <td><?php if ($d->verifikasi == 0) {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $d->nik . '"><input name="status" type="hidden" value="1"><button name="edit" type="submit" class="btn btn-danger"><i class="fa fa-ban"></i></button></form>';
                                                    } else {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $d->nik . '"><input name="status" type="hidden" value="0"><button name="edit" type="submit" class="btn btn-info"><i class="fa fa-check"></i></button></form>';
                                                    } ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?= $d->nik ?>">
	                                                        <i class="fa fa-pen"></i>
                                                        </button</td>
                                                    <td>
                                                    <form action="" method="post"><input type="hidden" name="nik" value="<?= $d->nik ?>"><button name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="exampleModalCenter<?= $d->nik ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered<?= $d->nik ?>" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="nikLama" value="<?= $d->nik ?>">
                                                                
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="nik">Nik</label>
                                                                        <input class="form-control" type="text" name="nik" value="<?= $d->nik ?>">
                                                                    </div>
                                                                    <div class="form-group muted-text">
                                                                        <label for="nik">Nama</label>
                                                                        <input class="form-control" type="text" name="nama" value="<?= $d->nama ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nik">Username</label>
                                                                        <input class="form-control" type="text" name="username" value="<?= $d->username ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nik">New Password</label>
                                                                        <input class="form-control" type="password" name="password" value="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nik">Telepon</label>
                                                                        <input class="form-control" type="number" name="telp" value="<?= $d->telp ?>">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="update">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $no++;
                                                }
                                                ?>
											</tbody>
										</table>
									</div>
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