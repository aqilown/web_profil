<?php
// Koneksi ke database
include('../koneksi/koneksi.php');

// Mengambil data dari form
if (isset($_POST['tahun']) && isset($_POST['posisi']) && isset($_POST['perusahaan'])) {
    $tahun = $_POST['tahun'];
    $posisi = $_POST['posisi'];
    $perusahaan = $_POST['perusahaan'];

    // Validasi form
    if (empty($tahun) || empty($posisi) || empty($perusahaan)) {
        header("Location:tambahriwayatpekerjaan.php?notif=tambahkosong");
    } else {
        // Query untuk menambahkan data
        $sql = "INSERT INTO riwayat_pekerjaan (tahun, posisi, perusahaan)
                VALUES ('$tahun', '$posisi', '$perusahaan')";

        // Eksekusi query
        mysqli_query($koneksi, $sql);

        // Redirect ke halaman riwayat pekerjaan dengan notifikasi
        header("Location:riwayatpekerjaan.php?notif=tambahberhasil");
    }
} else {
    // Jika akses langsung ke halaman ini tanpa melalui form
    header("Location:tambahriwayatpekerjaan.php");
}
?>