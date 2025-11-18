<?php
session_start();
include('../koneksi/koneksi.php');

if (isset($_POST['pass_lama']) && isset($_POST['pass_baru']) && isset($_POST['konfirmasi'])) {
    $id_user = $_SESSION['id_user'];

    $pass_lama = $_POST['pass_lama'];
    $pass_baru = $_POST['pass_baru'];
    $konfirmasi = $_POST['konfirmasi'];

  
    if (empty($pass_lama)) {
        header("Location:ubahpassword.php?notif=kosong&jenis=Password Lama");
        exit();
    } elseif (empty($pass_baru)) {
        header("Location:ubahpassword.php?notif=kosong&jenis=Password Baru");
        exit();
    } elseif (empty($konfirmasi)) {
        header("Location:ubahpassword.php?notif=kosong&jenis=Konfirmasi Password");
        exit();
    }

   
    $sql = "SELECT password FROM user WHERE id_user = '$id_user'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($query);

   
    if (md5($pass_lama===$data['password'])) {

        if ($pass_baru !== $konfirmasi) {
            header("Location:ubahpassword.php?notif=konfirmasisalah");
            exit();
        } else {
         
            $pass_baru_md5 = md5($pass_baru);
   
            $sql_update = "UPDATE user SET password = '$pass_baru_md5' WHERE id_user = '$id_user'";
            mysqli_query($koneksi, $sql_update);

            header("Location:ubahpassword.php?notif=berhasil");
            exit();
        }
    } else {
        header("Location:ubahpassword.php?notif=passwordlama_salah");
        exit();
    }
}
?>