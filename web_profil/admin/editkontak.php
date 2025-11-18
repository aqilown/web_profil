<?php
include('../koneksi/koneksi.php');
if (isset($_GET['data'])) {
    $id_kontak = $_GET['data'];
    // Check if we need to modify the table structure
    $check_column = mysqli_query($koneksi, "SHOW COLUMNS FROM `kontak` LIKE 'topik'");
    if(mysqli_num_rows($check_column) == 0) {
        // Add topik column if it doesn't exist
        mysqli_query($koneksi, "ALTER TABLE `kontak` ADD COLUMN `topik` VARCHAR(100) DEFAULT NULL AFTER `email`");
    }
    
    // Get kontak data
    $sql_k = "SELECT `id_kontak`, `nama`, `email`, `topik`, `pesan` 
              FROM `kontak` WHERE `id_kontak`='$id_kontak'";
    $query_k = mysqli_query($koneksi, $sql_k);
    while($data_k = mysqli_fetch_row($query_k)){
        $id_kontak = $data_k[0];
        $nama = $data_k[1];
        $email = $data_k[2];
        $topik = $data_k[3];
        $pesan = $data_k[4];
    }
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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3><i class="fas fa-edit"></i> Edit Kontak</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="kontak.php">Kontak</a></li>
                <li class="breadcrumb-item active">Edit Kontak</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Kontak
            </h3>
            <div class="card-tools">
              <a href="kontak.php" class="btn btn-sm btn-warning float-right">
                <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          </br>
          <div class="col-sm-10">
            <?php if (!empty($_GET['notif'])) { ?>
              <?php if ($_GET['notif'] == "editkosong") { ?>
                <div class="alert alert-danger" role="alert">
                  Maaf data nama, email, atau pesan wajib di isi</div>
              <?php } ?>
            <?php } ?>
          </div>
          <form class="form-horizontal" method="post" action="konfirmasieditkontak.php">
            <div class="card-body">
              <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="topik" class="col-sm-3 col-form-label">Topik</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="topik" id="topik" value="<?php echo isset($topik) ? $topik : ''; ?>">
                  <!-- Topik will be stored as text until topik table is created -->
                </div>
              </div>
              <div class="form-group row">
                <label for="pesan" class="col-sm-3 col-form-label">Pesan</label>
                <div class="col-sm-7">
                  <textarea class="form-control" name="pesan" id="pesan" rows="5"><?php echo $pesan; ?></textarea>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="col-sm-10">
                <input type="hidden" name="id_kontak" value="<?php echo $id_kontak; ?>">
                <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
              </div>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("includes/footer.php") ?>
  </div>
  <!-- ./wrapper -->
  <?php include("includes/script.php") ?>
</body>
</html>