<?php
include('../koneksi/koneksi.php');
if ((isset($_GET['aksi'])) && (isset($_GET['data']))) {
  if ($_GET['aksi'] == 'hapus') {
    $id_master_jenjang = $_GET['data'];
    $sql_dh = "delete from `master_jenjang` where `id_master_jenjang` = '$id_master_jenjang'";
    mysqli_query($koneksi, $sql_dh);
    header("Location:jenjang.php?notif=hapusberhasil");
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
              <h3><i class="fas fa-jenjang"></i> Jenjang Pendidikan</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> Jenjang Pendidikan</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Jenjang Pendidikan</h3>
            <div class="card-tools">
              <a href="tambahjenjang.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Tambah Jenjang Pendidikan</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
              <form method="get" action="jenjang.php">
                <div class="row">
                  <div class="col-md-4 bottom-10">
                    <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                  </div>
                  <div class="col-md-5 bottom-10">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                  </div>
                </div><!-- .row -->
              </form>
            </div><br>
            <div class="col-sm-12">
              <?php if (!empty($_GET['notif'])) { ?>
                <?php if ($_GET['notif'] == "tambahberhasil") { ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                <?php } else if ($_GET['notif'] == "editberhasil") { ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                <?php } else if ($_GET['notif'] == "hapusberhasil") { ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
                <?php } ?>
              <?php } ?>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="80%">Jenjang Pendidikan</th>
                  <th width="15%">
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $batas = 2;
                if(!isset($_GET['halaman'])){
                  $posisi = 0;
                  $halaman = 1;
                }else {
                  $halaman = $_GET['halaman'];
                  $posisi = ($halaman - 1) * $batas;
                }

                $sql_jum = "SELECT `id_master_jenjang`,`jenjang` FROM `master_jenjang` ORDER BY `jenjang`";
                $query_jum = mysqli_query($koneksi, $sql_jum);
                $jum_data = mysqli_num_rows($query_jum);
                $jum_halaman = ceil($jum_data / $batas);

                $sql_jum = "SELECT `id_master_jenjang`,`jenjang` FROM `master_jenjang`";
                if(isset($_GET["katakunci"])){
                  $katakunci_jenjang = $_GET["katakunci"];
                  $sql_jum .= " where `jenjang` LIKE '%$katakunci_jenjang%'";
                }
                $sql_jum .="ORDER BY `jenjang`";
                $query_u = mysqli_query($koneksi, $sql_jum);
                $no = $posisi + 1;
                while ($data_u = mysqli_fetch_row($query_u)) {
                  $id_master_jenjang = $data_u[0];
                  $jenjang = $data_u[1];
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $jenjang; ?></td>
                    <td align="center">
                      <a href="editjenjang.php?data=<?php echo $id_master_jenjang; ?>"
                        class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                      <a href="javascript:if(confirm('Anda yakin ingin menghapus data
                        <?php echo $jenjang; ?>?'))window.location.href ='jenjang.php?aksi=hapus&data=<?php echo $id_master_jenjang; ?>&notif=hapusberhasil'"
                        class="btn btn-xs btn-warning"><i class="fas fa-trash"></i>Hapus</a>
                    </td>
                  </tr>
                <?php $no++;
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <?php
              if ($jum_halaman == 0) {
                //tidak ada halaman
              } else if ($jum_halaman == 1) {
                echo "<li class='page-item'><a class='page-link'>1</a></li>";
              } else {
                $sebelum = $halaman - 1;
                $setelah = $halaman + 1;
                if (isset($_GET["katakunci"])) {
                  $katakunci_jenjang = $_GET["katakunci"];
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?katakunci=$katakunci_jenjang&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?katakunci=$katakunci_jenjang&halaman=$sebelum'>«</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i > $halaman - 5 and $i < $halaman + 5) {
                      if ($i != $halaman) {
                        echo "<li class='page-item'><a class='page-link'href='jenjang.php?katakunci=$katakunci_jenjang&halaman=$i'>$i</a></li>";
                      } else {
                        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?katakunci=$katakunci_jenjang&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?katakunci=$katakunci_jenjang&halaman=$jum_halaman'>Last</a></li>";
                  }
                } else {
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?halaman=$sebelum'>«</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i > $halaman - 5 and $i < $halaman + 5) {
                      if ($i != $halaman) {
                        echo "<li class='page-item'><a class='page-link'href='jenjang.php?halaman=$i'>$i</a></li>";
                      } else {
                        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='jenjang.php?halaman=$jum_halaman'>Last</a></li>";
                  }
                }
              } ?>
            </ul>
          </div>
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