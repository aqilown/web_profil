<?php
include('../koneksi/koneksi.php');
if ((isset($_GET['aksi'])) && (isset($_GET['data']))) {
  if ($_GET['aksi'] == 'hapus') {
    $id_riwayat_pekerjaan = $_GET['data'];
    //hapus data
    $sql_dp = "DELETE from `riwayat_pekerjaan` where `id_riwayat_pekerjaan` = '$id_riwayat_pekerjaan'";
    mysqli_query($koneksi, $sql_dp);
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
              <h3><i class="fa fa-suitcase"></i> Riwayat Pekerjaan</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> Riwayat Pekerjaan</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Riwayat Pekerjaan</h3>
            <div class="card-tools">
              <a href="tambahriwayatpekerjaan.php" class="btn btn-sm btn-info float-right">
                <i class="fas fa-plus"></i> Tambah Riwayat Pekerjaan</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
              <form method="get" action="riwayatpekerjaan.php ">
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
                  <div class="alert alert-success" role="alert">
                    Data Berhasil Ditambahkan</div>
                <?php } else if ($_GET['notif'] == "editberhasil") { ?>
                  <div class="alert alert-success" role="alert">
                    Data Berhasil Diubah</div>
                <?php } else if ($_GET['notif'] == "hapusberhasil") { ?>
                  <div class="alert alert-success" role="alert">
                    Data Berhasil DIhapus</div>
                <?php } ?>
              <?php } ?>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="20%">Tahun</th>
                  <th width="30%">Posisi</th>
                  <th width="30%">Perusahaan</th>
                  <th width="15%">
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $batas = 2;
                if (!isset($_GET['halaman'])) {
                  $posisi = 0;
                  $halaman = 1;
                } else {
                  $halaman = $_GET['halaman'];
                  $posisi = ($halaman - 1) * $batas;
                }
                $sql_jum = "SELECT `id_riwayat_pekerjaan`,`tahun`, `posisi`, `perusahaan` FROM `riwayat_pekerjaan` ORDER BY `tahun`";
                $query_jum = mysqli_query($koneksi, $sql_jum);
                $jum_data = mysqli_num_rows($query_jum);
                $jum_halaman = ceil($jum_data / $batas);
                
                $sql_jum = "SELECT `id_riwayat_pekerjaan`, `tahun`, `posisi`, `perusahaan` FROM `riwayat_pekerjaan`";
                if(isset($_GET["katakunci"])){
                  $katakunci_riwayat_pekerjaan = $_GET["katakunci"];
                  $sql_jum .= "where `tahun` LIKE '%$katakunci_riwayat_pekerjaan%' or `posisi` LIKE '%$katakunci_riwayat_pekerjaan%' or `perusahaan` LIKE '%$katakunci_riwayat_pekerjaan%'" ;
                }
                $sql_jum .="ORDER BY `posisi`";
                $query_b = mysqli_query($koneksi, $sql_jum);
                $no = $posisi + 1;
                while ($data_b = mysqli_fetch_row($query_b)) {
                  $id_riwayat_pekerjaan = $data_b[0];
                  $tahun = $data_b[1];
                  $posisi = $data_b[2];
                  $perusahaan = $data_b[3];
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $tahun; ?></td>
                    <td><?php echo $posisi; ?></td>
                    <td><?php echo $perusahaan; ?></td>
                    <td align="center">
                      <a href="editriwayatpekerjaan.php?data= <?php echo $id_riwayat_pekerjaan; ?>"
                        class="btn btn-xs btn-info" title="Edit">
                        <i class="fas fa-edit"></i></a>

                      <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $tahun; ?>?'))
                      window.location.href = 'riwayatpekerjaan.php?aksi=hapus&data=<?php echo $id_riwayat_pekerjaan; ?>&notif=hapusberhasil'"

                        class="btn btn-xs btn-warning">

                        <i class="fas fa-trash" title="Hapus"></i>
                      </a>
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
                  $katakunci_topik = $_GET["katakunci"];
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?katakunci=$katakunci_riwayat_pekerjaan&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?katakunci=$katakunci_riwayat_pekerjaan&halaman=$sebelum'>«</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i > $halaman - 5 and $i < $halaman + 5) {
                      if ($i != $halaman) {
                        echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?katakunci=$katakunci_riwayat_pekerjaan&halaman=$i'>$i</a></li>";
                      } else {
                        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?katakunci=$katakunci_riwayat_pekerjaan&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?katakunci=$katakunci_riwayat_pekerjaan&halaman=$jum_halaman'>Last</a></li>";
                  }
                } else {
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?halaman=$sebelum'>«</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i > $halaman - 5 and $i < $halaman + 5) {
                      if ($i != $halaman) {
                        echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?halaman=$i'>$i</a></li>";
                      } else {
                        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='riwayatpekerjaan.php?halaman=$jum_halaman'>Last</a></li>";
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