<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pengaduan_masyarakat";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// if($con) {
//     echo "koneksi berhasil";
// } else {
//     echo "koneksi Gagal! : ". mysqli_connect_error();
// }