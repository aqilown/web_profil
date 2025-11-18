<?php
include('../koneksi/koneksi.php');
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
              <h3><i class="fa fa-plus"></i> Tambah Kontak</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="kontak.php">Kontak</a></li>
                <li class="breadcrumb-item active">Tambah Kontak</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Kontak
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
              <?php if ($_GET['notif'] == "tambahkosong") { ?>
                <div class="alert alert-danger" role="alert">
                  Maaf data nama, email, atau pesan wajib di isi</div>
              <?php } ?>
            <?php } ?>
          </div>
          <form class="form-horizontal" method="post" action="konfirmasitambahkontak.php">
            <div class="card-body">
              <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="nama" id="nama" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="email" id="email" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="topik" class="col-sm-3 col-form-label">Topik</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="topik" id="topik" value="">
                  <!-- Topik akan disimpan sebagai text -->
                </div>
              </div>
              <div class="form-group row">
                <label for="pesan" class="col-sm-3 col-form-label">Pesan</label>
                <div class="col-sm-7">
                  <textarea class="form-control" name="pesan" id="pesan" rows="5"></textarea>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Tambah</button>
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