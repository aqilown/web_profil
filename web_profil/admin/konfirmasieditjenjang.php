<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_master_jenjang'])) {
    $id_master_jenjang = $_SESSION['id_master_jenjang'];
    $jenjang = $_POST['jenjang'];
    if (empty($jenjang)) {
        header("Location:editjenjang.php?data=" . $id_master_jenjang . "&notif=editkosong");
    } else {
        $sql = "update `master_jenjang` set `jenjang`='$jenjang' where `id_master_jenjang`='$id_master_jenjang'";
        mysqli_query($koneksi, $sql);
        unset($_SESSION['id_master_jenjang']);
        header("Location:jenjang.php?notif=editberhasil");
    }
}
?>