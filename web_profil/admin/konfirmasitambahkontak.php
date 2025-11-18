<?php
// Koneksi ke database
include('../koneksi/koneksi.php');

// Mengambil data dari form
if (isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['topik']) && isset($_POST['pesan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $topik = $_POST['topik'];
    $pesan = $_POST['pesan'];

    // Validasi form
    if (empty($nama) || empty($email) || empty($pesan)) {
        header("Location:tambahkontak.php?notif=tambahkosong");
    } else {
        // Query untuk menambahkan data
        $sql = "INSERT INTO kontak (nama, email, topik, pesan) VALUES ('$nama', '$email', '$topik', '$pesan')";

        // Eksekusi query
        mysqli_query($koneksi, $sql);

        // Redirect ke halaman riwayat pekerjaan dengan notifikasi
        header("Location:kontak.php?notif=tambahberhasil");
    }
} else {
    // Jika akses langsung ke halaman ini tanpa melalui form
    header("Location:tambahkontak.php");
}
?>