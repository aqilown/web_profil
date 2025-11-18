<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_master_hard_skill'])) {
    $id_master_hard_skill = $_SESSION['id_master_hard_skill'];
    $hard_skill = $_POST['hardskill'];
    if (empty($hard_skill)) {
        header("Location:edithardskill.php?data=" . $id_master_hard_skill . "&notif=editkosong");
    } else {
        $sql = "update `master_hard_skill` set `hard_skill`='$hard_skill' where `id_master_hard_skill`='$id_master_hard_skill'";
        mysqli_query($koneksi, $sql);
        unset($_SESSION['id_master_hard_skill']);
        header("Location:hardskill.php?notif=editberhasil");
    }
}
?>