<?php
session_start();
include('../koneksi/koneksi.php');
$tahun = $_POST['tahun'];
$id_master_jenjang = $_POST['jenjang'];
$jurusan = $_POST['jurusan'];
$id_master_universitas = $_POST['universitas'];
if(empty($tahun)){
header("Location:tambahriwayatpendidikan.php?notif=tambahkosong&jenis=tahun");
}else if(empty($id_master_jenjang)){

header("Location:tambahriwayatpendidikan.php?notif=tambahkosong&jenis=jenjang");
}else if(empty($jurusan)){
header("Location:tambahriwayatpendidikan.php?notif=tambahkosong&jenis=jurusan");
}else if(empty($id_master_universitas)){
header("Location:tambahriwayatpendidikan.php?notif=tambahkosong&jenis=universitas");
}else{
$sql = "INSERT INTO `riwayat_pendidikan`
(`tahun`,`id_master_jenjang`,`jurusan`,`id_master_universitas`)
VALUES
('$tahun','$id_master_jenjang','$jurusan','$id_master_universitas')";
mysqli_query($koneksi,$sql);
header("Location:riwayatpendidikan.php?notif=tambahberhasil");
}
?>