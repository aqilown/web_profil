<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_GET['data'])) {

  $id_master_hard_skill = $_GET['data'];
  $_SESSION['id_master_hard_skill'] = $id_master_hard_skill;
  //get data hardskill
  $sql_d = "select `hard_skill` from `master_hard_skill` where `id_master_hard_skill` = '$id_master_hard_skill'";
  $query_d = mysqli_query($koneksi, $sql_d);
  while ($data_d = mysqli_fetch_row($query_d)) {
    $hard_skill = $data_d[0];
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
              <h3><i class="fas fa-edit"></i> Edit Hard Skill</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="hardskill.php">Hard Skill</a></li>
                <li class="breadcrumb-item active">Edit Hard Skill</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Hard Skill</h3>
            <div class="card-tools">
              <a href="hardskill.php" class="btn btn-sm btn-warning float-right"><i
                  class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          </br>

          <?php if (!empty($_GET['notif'])) { ?>
            <?php if ($_GET['notif'] == "editkosong") { ?>
              <div class="alert alert-danger" role="alert">
                Maaf data hardskill wajib di isi</div>
            <?php } ?>
          <?php } ?>

          <form class="form-horizontal" method="post" action="konfirmasiedithardskill.php">
            <div class="card-body">
              <div class="form-group row">
                <label for="hardskill" class="col-sm-3 col-form-label">Hard Skill</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" id="hardskill" name="hardskill" 
                  value="<?php echo $nama_universitas; ?>">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="col-sm-10">
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