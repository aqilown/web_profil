<?php
include('../koneksi/koneksi.php');
$nama_universitas = $_POST['universitas'];
if(empty($nama_universitas)){
    header("Location:tambahuniversitas.php?notif=tambahkosong");
}else{
    $sql = "insert into `master_universitas` (`nama_universitas`)
    values ('$nama_universitas ')";
    mysqli_query($koneksi,$sql);
    header("Location:universitas.php?notif=tambahberhasil");
}
?>