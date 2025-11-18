<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_master_soft_skill'])) {
    $id_master_soft_skill = $_SESSION['id_master_soft_skill'];
    $soft_skill = $_POST['softskill'];
    if (empty($soft_skill)) {
        header("Location:editsoftskill.php?data=" . $id_master_soft_skill . "&notif=editkosong");
    } else {
        $sql = "update `master_soft_skill` set `soft_skill`='$soft_skill' where `id_master_soft_skill`='$id_master_soft_skill'";
        mysqli_query($koneksi, $sql);
        unset($_SESSION['id_master_soft_skill']);
        header("Location:softskill.php?notif=editberhasil");
    }
}
?>