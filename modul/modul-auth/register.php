<?php 
include('../../config/koneksi.php');

if(isset($_POST['cek'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $telp = $_POST['telp'];

    $q = mysqli_query($con, "INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`, `verifikasi`) VALUES ('$nik   ', '$nama', '$username', '$password', '$telp', '0')");

    if($q){
        echo '<div class="alert alert-success" role="alert">
                Data Berhasil disimpan, Tunggu Di Verifikasi Oleh Admin
                </div';
    } else {
        echo '<div class="alert alert-danger" role="alert">
       Data Gagal Di Simpan, Periksa Kembali Data Dengan Benar!!!
        </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../../assets/header.php'); ?>
<body>
    
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-3" style="margin-top:5%">
                <div class="card">

                    <div class="card-header card-success">
                        <h3 class="card-title">
                            Registrasi
                            <small>SISPEMAS</small>
                        </h3>
                    </div>

                    <form action="" method="post">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" name="nik" class="form-control" placeholder="Masukan nik">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username ">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Telp</label>
                                <input type="text" name="telp" class="form-control" placeholder="Masuka Telp">
                            </div>

                            <div class="form-group mb-0">
                                <span class="text">Sudah verifikasi?</span> 
                                Coba Masuk
                                <a href="index.php">disini</a>
                            </div>

                            <div class="card-footer">
                                <div class="form-group">
                                    <button name="cek" type="submit" class="form-control btn btn-success">Masuk</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</body>
</html>