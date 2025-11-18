<?php
session_start();
include('../koneksi/koneksi.php');

// Proses hapus
if (isset($_GET['aksi']) && isset($_GET['data'])) {
  if ($_GET['aksi'] == 'hapus') {
    $id_konfigurasi_web = $_GET['data'];
    $sql_dh = "delete from `konfigurasi_web` where `id_konfigurasi_web` = '$id_konfigurasi_web'";
    mysqli_query($koneksi, $sql_dh);
  }
}

// Inisialisasi variabel dengan nilai default
$id_konfigurasi_web = '';
$logo = '';
$nama_web = '';
$tahun = '';

// Ambil data konfigurasi web (asumsikan hanya satu data, id = 1)
$sql = "SELECT `id_konfigurasi_web`, `logo`, `nama_web`, `tahun` FROM `konfigurasi_web` WHERE `id_konfigurasi_web` = 1";
$query = mysqli_query($koneksi, $sql);

// Cek apakah query berhasil dan ada data
if ($query && mysqli_num_rows($query) > 0) {
  $data = mysqli_fetch_assoc($query);
  $id_konfigurasi_web = $data['id_konfigurasi_web'] ?? '';
  $logo = $data['logo'] ?? '';
  $nama_web = $data['nama_web'] ?? '';
  $tahun = $data['tahun'] ?? '';
}
?>

<!DOCTYPE html>
<html>
<head>
  <?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include("includes/header.php") ?>
  <?php include("includes/sidebar.php") ?>

  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-user-tie"></i> Konfigurasi Web</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Konfigurasi Web</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <div class="card-tools">
            <a href="editkonfigurasiweb.php" class="btn btn-sm btn-info float-right">
              <i class="fas fa-edit"></i> Edit Konfigurasi Web
            </a>
          </div>
        </div>

        <div class="card-body">
          <table class="table table-bordered">
            <tbody>  
              <tr>
                <td colspan="2"><i class="fas fa-user-circle"></i> <strong>KONFIGURASI WEB</strong></td>
              </tr> 
              <tr>
                <td width="20%"><strong>Logo</strong></td>
                <td width="80%">
                  <?php if (!empty($logo)): ?>
                    <img src="image/<?php echo htmlspecialchars($logo); ?>" class="img-fluid" width="400px;">
                  <?php else: ?>
                    <span class="text-muted">Logo tidak tersedia</span>
                  <?php endif; ?>
                </td>
              </tr>                
              <tr>
                <td width="20%"><strong>Nama Web</strong></td>
                <td width="80%"><?php echo htmlspecialchars($nama_web); ?></td>
              </tr>                
              <tr>
                <td width="20%"><strong>Tahun</strong></td>
                <td width="80%"><?php echo htmlspecialchars($tahun); ?></td>
              </tr> 
            </tbody>
          </table>  
        </div>

        <div class="card-footer clearfix">&nbsp;</div>
      </div>
    </section>

  </div>

  <?php include("includes/footer.php") ?>
</div>

<?php include("includes/script.php") ?>
</body>
</html>