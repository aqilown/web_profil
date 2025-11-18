<?php
include('../koneksi/koneksi.php');
if ((isset($_GET['aksi'])) && (isset($_GET['data']))) {
  if ($_GET['aksi'] == 'hapus') {
    $id_kontak = $_GET['data'];
    //hapus kontak
    $sql_dh = "delete from `kontak` where `id_kontak` = '$id_kontak'";
    mysqli_query($koneksi, $sql_dh);
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
              <h3><i class="fa fa-envelope-o"></i> Kontak</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> Kontak</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card">

          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
              <form method="" action="">
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
                        Data Berhasil Dihapus</div>
                <?php } ?>
              <?php } ?>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="20%">Nama</th>
                  <th width="20%">Email</th>
                  <th width="10%">Topik</th>
                  <th width="30%">Pesan</th>
                  <th width="15%">
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>

              <tbody>
                <?php
                //menampilkan data
                // First check if we need to modify the table structure
                $check_column = mysqli_query($koneksi, "SHOW COLUMNS FROM `kontak` LIKE 'topik'");
                if(mysqli_num_rows($check_column) == 0) {
                    // Add topik column if it doesn't exist
                    mysqli_query($koneksi, "ALTER TABLE `kontak` ADD COLUMN `topik` VARCHAR(100) DEFAULT NULL AFTER `email`");
                }
                
                $sql_b = "SELECT `id_kontak`, `nama`, `email`, `topik`, `pesan` 
                FROM `kontak`";
                $query_b = mysqli_query($koneksi, $sql_b);
                $no = 1;
                while ($data_b = mysqli_fetch_row($query_b)) {
                  $id_kontak = $data_b[0];
                  $nama = $data_b[1];
                  $email = $data_b[2];
                  $topik = $data_b[3];
                  $pesan = $data_b[4];
                  ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $topik; ?></td>
                    <td><?php echo $pesan; ?></td>
                    <td align="center">
                      <a href="editkontak.php?data=<?php echo $id_kontak; ?>"
                        class="btn btn-xs btn-info" title="Edit">
                        <i class="fas fa-edit"></i></a>
                      <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $nama; ?>?')) 
                      window.location.href = 'kontak.php?aksi=hapus&data=<?php echo
                        $id_kontak; ?>&notif=hapusberhasil'" class="btn btn-xs btn-warning">
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
              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
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