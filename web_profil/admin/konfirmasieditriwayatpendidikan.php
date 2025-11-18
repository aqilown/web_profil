<?php
session_start();
include('../koneksi/koneksi.php');
if(isset($_SESSION['id_riwayat_pendidikan'])){
$id_riwayat_pendidikan=$_SESSION['id_riwayat_pendidikan'];
$tahun = $_POST['tahun'];
$id_master_jenjang = $_POST['jenjang'];
$jurusan = $_POST['jurusan'];
$id_master_universitas = $_POST['universitas'];
if(empty($tahun)){
header("Location:editriwayatpendidikan.php?data=$id_riwayat_pendidikan&no
tif=editkosong&jenis=tahun");
}else if(empty($id_master_jenjang)){
header("Location:editriwayatpendidikan.php?data=$id_riwayat_pendidikan&no
tif =editkosong&jenis=jenjang");
}else if(empty($jurusan)){
header("Location:editriwayatpendidikan.php?data=$id_riwayat_pendidikan&no
tif =editkosong&jenis=jurusan");
}else if(empty($id_master_universitas)){
header("Location:editriwayatpendidikan.php?data=$id_riwayat_pendidikan&no
tif=editkosong&jenis=universitas");
}else{
$sql = "UPDATE `riwayat_pendidikan` set

`tahun`='$tahun',`id_master_jenjang`='$id_master_jenjang',
`jurusan`='$jurusan',`id_master_universitas`='$id_master_universitas'
WHERE `id_riwayat_pendidikan`='$id_riwayat_pendidikan'";
//echo $sql;
mysqli_query($koneksi,$sql);
header("Location:riwayatpendidikan.php?notif=editberhasil");
}
}
?>