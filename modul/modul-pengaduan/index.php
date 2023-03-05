<?php

session_start();
include('../../config/koneksi.php');
if (empty($_SESSION['username'])) {
    @header('location:../modul-auth/index.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    }
}
// CRUD
if (isset($_POST['tambahPengaduan'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $tgl = $_POST['tgl_pengaduan'];
    //upload
    $ekstensi_diperbolehkan = array('jpg', 'png');
    $foto = $_FILES['foto']['name'];
    print_r($foto);
    $x = explode(".", $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '$foto', '0')";
            $r = mysqli_query($con, $q);
            if ($r) {
                move_uploaded_file($file_tmp, '../../assets/images/masyarakat/' . $foto);
            }
        }
    } else {
        $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '', '0')";
        $r = mysqli_query($con, $q);
    }
}

// hapus pengaduan
if (isset($_POST['hapus'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    if ($id_pengaduan != '') {
        $q = "SELECT `foto` FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
        $r = mysqli_query($con, $q);
        $d = mysqli_fetch_object($r);
        unlink('../../assets/images/masyarakat/' . $d->foto);
    }
    $q = "DELETE FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
    $r = mysqli_query($con, $q);
}

// rubah status pengaduan
if (isset($_POST['proses_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];
    $q = "UPDATE `pengaduan` SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'";
    $r = mysqli_query($con, $q);
}
?>
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
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Pengaduan</h3><br>
									<?php if ($_SESSION['level'] == 'masyarakat') { ?>

										<div class="card">
											<div class="card-header">
												<button data-toggle="modal" data-target="#modal-lg" class="btn btn-success">buat pengaduan&nbsp;<i class="fa fa-pen"></i></button>
											</div>
										</div>

									<?php } ?>
									<div class="modal fade" id="modal-lg">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													Buat Pengaduan
												</div>
												<div class="modal-body">
													<form action="" method="post" enctype="multipart/form-data">
														<input type="hidden" name="nik" value="">
														<div class="form-group">
															<label for="isi_laporan">Isi Laporan</label>
															<textarea name="isi_laporan" class="form-control" cols="30" rows="10"></textarea>
														</div>
														<div class="form-group">
															<label for="tgl_pengaduan">Tanggal Pengaduan</label>
															<input type="date" name="tgl_pengaduan" class="form-control">
														</div>
														<div class="form-group">
															<label for="foto">Foto</label>
															<input type="file" name="foto" class="form-control">
														</div>
														<input type="submit" name="tambahPengaduan" value="simpan" class="btn btn-success">
													</form>
												</div>
												<!-- /.modal-dialog -->
											</div>
										</div>
									</div>
									<div class="card-body">
										<table id="dataTablesNya" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No.</th>
													<th>Tanggal</th>
													<th>Nik</th>
													<th>Isi Laporan</th>
													<th>Foto</th>
													<th>Status</th>
													<th>hapus</th>
													<th>proses Pengaduan</th>
												</tr>
											</thead>
											<?php  ?>
											<tbody>
												<?php
												if ($_SESSION['level'] == 'masyarakat') {
													$q = "SELECT * FROM `pengaduan` WHERE `nik` = $nik";
												} else {
													$q = "SELECT * FROM `pengaduan`";
												}
												$r = mysqli_query($con, $q);
												$no = 1;
												while ($d = mysqli_fetch_object($r)) {
												?>
													<tr>
														<td><?= $no ?></td>
														<td><?= $d->tgl_pengaduan ?></td>
														<td><?= $d->nik ?></td>
														<td><?= $d->isi_laporan ?></td>
														<td><?php if ($d->foto == '') {
																echo '<img style="max-height:100px" class="img img-thumbnail" src="../../assets/images/no-foto.png">';
															} else {
																echo '<img style="max-height:100px" class="img img-thumbnail" src="../../assets/images/masyarakat/' . $d->foto . '">';
															} ?></td>
														<td><?= $d->status ?></td>
														<td>
															<?php if ($_SESSION['level'] == 'masyarakat') { ?>
																<form action="" method="post"><input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>"><button type="submit" name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
															<?php } ?>
														</td>
														<td><?php if ($_SESSION['level'] == 'petugas') { ?>
																<form action="" method="post">
																	<input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>">
																	<select class="form-control" name="status">
																		<option value="0"> 0 </option>
																		<option value="proses"> proses </option>
																		<option value="selesai"> selesai </option>
																	</select><br>
																	<button type="submit" name="proses_pengaduan" class="btn btn-success form-control">ubah</button>
																</form>
															<?php } ?>
														</td>
													</tr>
												<?php $no++;
												} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer mt-4" >
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