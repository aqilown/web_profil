<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_master_universitas'])) {
    $id_master_universitas = $_SESSION['id_master_universitas'];
    $nama_universitas = $_POST['universitas'];
    if (empty($nama_universitas)) {
        header("Location:edituniversitas.php?data=" . $id_master_universitas . "&notif=editkosong");
    } else {
        $sql = "update `master_universitas` set `nama_universitas`='$nama_universitas' where `id_master_universitas`='$id_master_universitas'";
        mysqli_query($koneksi, $sql);
        unset($_SESSION['id_master_universitas']);
        header("Location:universitas.php?notif=editberhasil");
    }
}
?>