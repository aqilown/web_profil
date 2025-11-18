<?php
session_start();
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

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3><i class="fas fa-user-lock"></i> Ubah Password</h3>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="far fa-list-alt"></i> Form Pengaturan Password</h3>
          </div>

          <div class="col-sm-12">

          </div>

          <form class="form-horizontal" method="post" action="konfirmasieditpassword.php">
            <div class="card-body">
              <?php if (!empty($_GET['notif'])): ?>
                <?php if ($_GET['notif'] == 'berhasil'): ?>
                  <div class="alert alert-success">Password berhasil diubah.</div>
                <?php elseif ($_GET['notif'] == 'passwordlama_salah'): ?>
                  <div class="alert alert-danger">Password lama tidak cocok.</div>
                <?php elseif ($_GET['notif'] == 'konfirmasisalah'): ?>
                  <div class="alert alert-danger">Konfirmasi password tidak cocok.</div>
                <?php elseif ($_GET['notif'] == 'kosong' && isset($_GET['jenis'])): ?>
                  <div class="alert alert-danger"><?php echo $_GET['jenis']; ?> wajib diisi.</div>
                <?php endif; ?>
              <?php endif; ?>

              <div class="form-group row">
                <label for="pass_lama" class="col-sm-3 col-form-label">Password Lama</label>
                <div class="col-sm-7">
                  <input type="text" name="pass_lama" class="form-control" id="pass_lama">
                </div>
              </div>

              <div class="form-group row">
                <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru</label>
                <div class="col-sm-7">
                  <input type="text" name="pass_baru" class="form-control" id="pass_baru">
                </div>
              </div>

              <div class="form-group row">
                <label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                <div class="col-sm-7">
                  <input type="text" name="konfirmasi" class="form-control" id="konfirmasi">
                </div>
              </div>
            </div>

            <div class="card-footer">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>

    <?php include("includes/footer.php") ?>
  </div>

  <?php include("includes/script.php") ?>
</body>

</html>