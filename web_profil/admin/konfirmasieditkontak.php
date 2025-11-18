<?php
include('../koneksi/koneksi.php');
if (isset($_POST['id_kontak'])) {
    $id_kontak = $_POST['id_kontak'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];
    $topik = isset($_POST['topik']) ? $_POST['topik'] : '';
    
    if (empty($nama) || empty($email) || empty($pesan)) {
        header("Location:editkontak.php?data=$id_kontak&notif=editkosong");
    } else {
        // Check if we should modify the kontak table first
        $check_column = mysqli_query($koneksi, "SHOW COLUMNS FROM `kontak` LIKE 'topik'");
        if(mysqli_num_rows($check_column) == 0) {
            // Add topik column if it doesn't exist
            mysqli_query($koneksi, "ALTER TABLE `kontak` ADD COLUMN `topik` VARCHAR(100) DEFAULT NULL AFTER `email`");
        }
        
        $sql = "UPDATE `kontak`
            SET `nama`='$nama', `email`='$email', `topik`='$topik', `pesan`='$pesan'
            WHERE `id_kontak`='$id_kontak'";
        
        mysqli_query($koneksi, $sql);
        header("Location:kontak.php?notif=editberhasil");
    }
}
?>