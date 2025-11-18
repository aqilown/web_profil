<?php
include('../koneksi/koneksi.php');

if (isset($_POST['id_riwayat_pekerjaan'])) {
    $id_riwayat_pekerjaan = $_POST['id_riwayat_pekerjaan'];
    $tahun = $_POST['tahun'];
    $posisi = $_POST['posisi'];
    $perusahaan = $_POST['perusahaan'];

    if (empty($tahun) || empty($posisi) || empty($perusahaan)) {
        header("Location:editriwayatpekerjaan.php?data=$id_riwayat_pekerjaan&notif=editkosong");
    } else {
        $sql = "UPDATE `riwayat_pekerjaan` 
            SET `tahun`='$tahun', `posisi`='$posisi', `perusahaan`='$perusahaan' 
            WHERE `id_riwayat_pekerjaan`='$id_riwayat_pekerjaan'";
        mysqli_query($koneksi, $sql);
        header("Location:riwayatpekerjaan.php?notif=editberhasil");
    }
}
?>