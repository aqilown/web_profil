<?php
include('../koneksi/koneksi.php');

if (isset($_POST['id_konfigurasi_web'])) {
    $id_konfigurasi_web = $_POST['id_konfigurasi_web'];
    $logo = $_POST['logo'];
    $nama_web = $_POST['nama_web'];
    $tahun = $_POST['tahun'];

    if (empty($logo) || empty($nama_web) || empty($tahun)) {
        header("Location:editkonfigurasiweb.php?data=$id_konfigurasi_web&notif=editkosong");
        exit(); // Stop execution after redirect
    } else {
        $sql = "UPDATE `konfigurasi_web` 
            SET `logo`='$logo', `nama_web`='$nama_web', `tahun`='$tahun' 
            WHERE `id_konfigurasi_web`='$id_konfigurasi_web'";
        mysqli_query($koneksi, $sql);
        header("Location:konfigurasiweb.php?notif=editberhasil");
        exit(); // Stop execution after redirect
    }
}
?>