<?php
include('../koneksi/koneksi.php');
$jenjang = $_POST['jenjang'];
if(empty($jenjang)){
header("Location:tambahjenjang.php?notif=tambahkosong");
}else{
$sql = "insert into `master_jenjang` (`jenjang`)
values ('$jenjang ')";
mysqli_query($koneksi,$sql);
header("Location:jenjang.php?notif=tambahberhasil");
}
?>