<?php
include('koneksi/koneksi.php');
//jika button kirim pesan diklik
if(isset($_POST['kirim'])){
$nama = $_POST['nama'];
$email = $_POST['email'];
$id_topik = $_POST['topik'];
$pesan = $_POST['pesan'];
$sql_i = "INSERT INTO `kontak` (`nama`,`email`,`id_topik`,`pesan`)

VALUES ('$nama','$email','$id_topik','$pesan')";
mysqli_query($koneksi,$sql_i) or die(mysqli_error($koneksi));
header("Location:index.php?notif=kirimberhasil");
}
?>