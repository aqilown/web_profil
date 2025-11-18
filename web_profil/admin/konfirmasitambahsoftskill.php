<?php
include('../koneksi/koneksi.php');
$soft_skill = $_POST['softskill'];
if (empty($soft_skill)) {
    header("Location:tambahsoftskill.php?notif=tambahkosong");
} else {
    $sql = "insert into `master_soft_skill` (`soft_skill`)
values ('$soft_skill ')";
    mysqli_query($koneksi, $sql);
    header("Location:softskill.php?notif=tambahberhasil");
}
?>