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
              <h3><i class="fas fa-plus"></i> Tambah Hard Skill</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="hardskill.php">Hard Skill</a></li>
                <li class="breadcrumb-item active">Tambah Hard Skill</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"><i class="far fa-list-alt"></i> Form Tambah Hard Skill</h3>
          </div>

          <?php if (!empty($_GET['notif'])) { ?>
            <?php if ($_GET['notif'] == "tambahkosong") { ?>
              <div class="alert alert-danger" role="alert">
                Maaf data hard Skill wajib di isi</div>
            <?php } ?>
          <?php } ?>

          <form class="form-horizontal" method="post" action="konfirmasitambahhardskill.php">
            <div class="card-body">
              <div class="form-group row">
                <label for="hardskill" class="col-sm-3 col-form-label">Nama Hard Skill</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="hardskill" name="hardskill" value="">
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-info float-right">
                <i class="fas fa-save"></i> Simpan
              </button>
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