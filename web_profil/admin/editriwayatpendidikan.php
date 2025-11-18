<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_GET['data'])) {
  $id_riwayat_pendidikan = $_GET['data'];
  $_SESSION['id_riwayat_pendidikan'] = $id_riwayat_pendidikan;
  
  //get data riwayat pendidikan
  $sql_m = "SELECT `id_riwayat_pendidikan`, `tahun`, `id_master_jenjang`, `jurusan`, `id_master_universitas` FROM `riwayat_pendidikan` WHERE `id_riwayat_pendidikan`='$id_riwayat_pendidikan'";
  $query_m = mysqli_query($koneksi, $sql_m);
  while ($data_m = mysqli_fetch_row($query_m)) {
    $id_riwayat_pendidikan = $data_m[0];
    $tahun = $data_m[1];
    $ID_MasterJenjang = $data_m[2];
    $jurusan = $data_m[3];
    $ID_MasterUniversitas = $data_m[4];
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
              <h3><i class="fas fa-edit"></i> Edit Data Riwayat Pendidikan</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="riwayatpendidikan.php">Data Riwayat Pendidikan</a></li>
                <li class="breadcrumb-item active">Edit Data Riwayat Pendidikan</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Riwayat Pendidikan</h3>
            <div class="card-tools">
              <a href="riwayatpendidikan.php" class="btn btn-sm btn-warning float-right">
                <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
            </div>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          </br></br>

          <form class="form-horizontal" action="konfirmasieditriwayatpendidikan.php" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="tahun" id="tahun" value="<?php echo $tahun; ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="jenjang" class="col-sm-3 col-form-label">Jenjang Pendidikan</label>
                <div class="col-sm-7">
                  <select class="form-control" id="jenjang" name="jenjang">
                    <option value="">- Pilih Jenjang Pendidikan -</option>
                    <?php
                    $sql_j = "SELECT `id_master_jenjang`,`jenjang` FROM `master_jenjang` ORDER BY `id_master_jenjang`";
                    $query_j = mysqli_query($koneksi, $sql_j);
                    while ($data_j = mysqli_fetch_row($query_j)) {
                      $id_master_jenjang = $data_j[0];
                      $jenjang = $data_j[1];
                      ?>
                      <option value="<?php echo $id_master_jenjang; ?>" <?php if ($id_master_jenjang == $ID_MasterJenjang) { ?>
                          selected<?php } ?>>
                        <?php echo $jenjang; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="jurusan" id="jurusan" value="<?php echo $jurusan;?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="universitas" class="col-sm-3 col-form-label">Universitas</label>
                <div class="col-sm-7">
                  <select class="form-control" id="universitas" name="universitas">
                    <option value="">- Pilih Universitas -</option>
                    <?php
                    $sql_u = "SELECT `id_master_universitas`,`nama_universitas` FROM `master_universitas` ORDER BY `nama_universitas`";
                    $query_u = mysqli_query($koneksi, $sql_u);
                    while($data_u = mysqli_fetch_row($query_u)){
                      $id_master_universitas = $data_u[0];
                      $nama_universitas = $data_u[1];
                    ?>
                      <option value="<?php echo $id_master_universitas;?>" <?php if($id_master_universitas==$ID_MasterUniversitas){?> selected<?php }?>>
                        <?php echo $nama_universitas;?>
                      </option>
                    <?php }?>
                  </select>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="col-sm-12">
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