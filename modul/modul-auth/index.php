<?php 
include ('../../config/koneksi.php');
if(isset($_POST['cek'])) {
    $pilihan = $_POST['pilihan'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if ($pilihan == 'masyarakat') {
        $q = mysqli_query($con, "SELECT *FROM `masyarakat` WHERE username = '$username' AND password = '$password' AND verifikasi = 1");
        $r = mysqli_num_rows($q);
        if ($r == 1) {
            $d = mysqli_fetch_array($q);
            @session_start();
            $_SESSION['nik'] = $d['nik'];
            $_SESSION['username'] = $d['username'];
            $_SESSION['nama'] = $d['nama'];
            $_SESSION['telp'] = $d['telp'];
            $_SESSION['level'] = 'masyarakat';
            @header('location:../../modul/modul-profile/'); 
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Data Salah atau Belum Diverifikasi!!
            </div>';
        }
    } else if ($pilihan == 'petugas') {
        $q = mysqli_query ($con, "SELECT * FROM `petugas` WHERE username = '$username' AND password = '$password'");
        $r = mysqli_num_rows($q);
        if ($r == 1) {
            $d = mysqli_fetch_object($q);
            @session_start();
            $_SESSION['username'] = $d -> username;
            $_SESSION['password'] = $d -> password;
            $_SESSION['id_petugas'] = $d -> id_petugas;
            @header('location:../../modul/modul-petugas/'); 
        }
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

                    <div class="card-header card-primary">
                        <h3 class="card-title">
                            login
                            <small>SISPEMAS</small>
                        </h3>
                    </div>

                    <form action="" method="post">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                            </div>

                            <label for="pilihan">LOGIN SEBAGAI</label>
                            <div class="form-group">
                                <select name="pilihan" class="form-control">
                                    <option value="masyarakat">Masyarakat</option>
                                    <option value="petugas">Petugas</option>
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <span class="text">Sudah terverifikasi?</span> 
                                Coba daftar
                                <a href="register.php">disini</a>
                            </div>

                            <div class="card-footer">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary " name="cek">Masuk</button>
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