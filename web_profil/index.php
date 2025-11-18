<?php
include('koneksi/koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Website Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <body>
    <nav class="navbar  navbar-expand-lg pt-4 pb-4" style="border-bottom: 2px solid blue">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="AlphaBeta" height="50" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ps-lg-4">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#profil">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#pendidikan">Pendidikan dan Pekerjaan</a>
                  </li>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                  </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="profil">
      <?php
      //pemanggilan data nama dan deskripsi user
      $sql_u = "SELECT `nama`,`deskripsi` FROM `user` WHERE `id_user`='1'";
      $query_u = mysqli_query($koneksi,$sql_u)
      or die(mysqli_error($koneksi));
      $data_u = mysqli_fetch_row($query_u);
      $nama_user = $data_u[0];
      $deskripsi_user = $data_u[1];
      ?>
      <div class="container pt-4 pb-4">
        <div class="row align-items-center">
          <div id="profil-content" class="col-md-8 col-xs-12 float-sm-end">
            <!--menampilkan data nama user-->
            <h3 class="text-white">Hai, <?php echo $nama_user;?></h3>
            <!--menampilkan data deskripsi user-->
            <p class="fs-2"> <?php echo $deskripsi_user;?></p>
          </div>
          <div id="profil-img" class="col-md-4 col-xs-12 float-sm-start">

          <img class="img-fluid" src="images/images.png">
        </div>
      </div>
    </div>
  </section>
    <section id="pendidikan">
        <div class="container border-bottom border-dark pt-3 py-5 my-5">
            <div class="row">
              <div class="col-md-8 col-xs-12">
              <h4>Riwayat Pendidikan</h4>
              <div class="table-responsive mb-4">
                <table class="table table-bordered border-dark">
                  <thead>
                    <tr>
                      <th rowspan="2">Tahun</th>
                      <th colspan="2">Pendidikan</th>
                    </tr>
                    <tr>
                      <th>Jurusan</th>
                      <th>Universitas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php //pemanggilan data pendidikan dari database
                    $sql_rp = "SELECT `rp`.`tahun`,`mj`.`jenjang`,`rp`.`jurusan`,
                    `mu`.`nama_universitas` FROM
                    `riwayat_pendidikan` `rp`
                    INNER JOIN `master_jenjang` `mj`
                    ON `rp`.`id_master_jenjang` =
                    `mj`.`id_master_jenjang`
                    INNER JOIN `master_universitas` `mu`
                    ON `rp`.`id_master_universitas` =
                    `mu`.`id_master_universitas`
                    ORDER BY `id_riwayat_pendidikan`";
                    $query_rp = mysqli_query($koneksi, $sql_rp)
                    or die(mysqli_error($koneksi));
                    while($data_rp = mysqli_fetch_row($query_rp)){
                    $tahun = $data_rp[0];
                    $jenjang = $data_rp[1];
                    $jurusan = $data_rp[2];
                    $nama_universitas = $data_rp[3];
                    ?>
                    <tr>
                      <td><?php echo $tahun; ?></td>
                      <td><?php echo $jenjang.' '.$jurusan; ?></td>
                      <td><?php echo $nama_universitas; ?></td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
    
                <h4>Riwayat Pekerjaan</h4>
                <div class="table-responsive">
                  <table class="table table-bordered border-dark">
                    <thead>
                      <tr>
                          <th>Tahun</th>
                          <th>Posisi</th>
                          <th>Perusahaan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td>2019-2021</td>
                          <td>Junior Web Developer</td>
                          <td>XYZ Corp</td>
                      </tr>
                      <tr>
                          <td>2021-2023</td>
                          <td>Senior Web Developer</td>
                          <td>ABC Ltd.</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-4 col-xs-12">
                <aside class="p-4">
                <h4>Soft Skills</h4>
                <ol>
                <?php //pemanggilan data dari tabel soft skill
                $sql_ss = "SELECT `ms`.`soft_skill`
                FROM `soft_skill` `s`

                INNER JOIN `master_soft_skill` `ms`
                ON `s`.`id_master_soft_skill`
                =`ms`.`id_master_soft_skill`
                WHERE `s`.`id_user`='1' ";
                $query_ss = mysqli_query($koneksi,$sql_ss)

                or die(mysqli_error($koneksi));

                while($data_ss = mysqli_fetch_row($query_ss)){
                $soft_skill = $data_ss[0];
                ?>
                <li><?php echo $soft_skill;?></li>
                <?php }?>
              </ol>
          
              <h4>Hard Skills</h4>
                <ol>
                <?php //pemanggilan data dari tabel soft skill
                $sql_hs = "SELECT `mh`.`hard_skill`
                FROM `hard_skill` `h`

                INNER JOIN `master_hard_skill` `mh`
                ON `h`.`id_master_hard_skill`
                =`mh`.`id_master_hard_skill`
                WHERE `h`.`id_user`='1' ";
                $query_hs = mysqli_query($koneksi,$sql_hs)

                or die(mysqli_error($koneksi));

                while($data_hs = mysqli_fetch_row($query_hs)){
                $hard_skill = $data_hs[0];
                ?>
                <li><?php echo $hard_skill;?></li>
                <?php }?>
              </ol>
                </aside>
              </div>
            </div>
        </div>
    </section>
    <section id="kontak" class="pt-3">
        <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-12">
              <h3>Kontak Kami</h3>
              <div id="form-kontak">
                <!--tambahkan notif jika berhasil kirim pesan-->
                <?php if(!empty($_GET['notif'])){?>
                  <?php if($_GET['notif']=="kirimberhasil"){?>
                    <div class="alert alert-success" role="alert">Data Pesan Berhasil Disimpan</div>
                    <?php }?>
                    <?php }?>
                    <!--tambahkan method dan action form-->
                    <form method="post" action="konfirmpesan.php">
                      <div class="row mb-3">
                        <label for="nama" class="col-sm-2
                        col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <!--tambahkan name field nama-->
                          <input type="text" class="form-control"
                          id="nama" name="nama">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="email" class="col-sm-2
                        col-form-label">Email</label>
                        <div class="col-sm-10">
                          <!--tambahkan name field email-->
                          <input type="email" class="form-control"
                          id="email" name="email">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="topik" class="col-sm-2 col-form-label">Topik</label>
                        <div class="col-sm-10">
                          <!--tambahkan name field topik-->
                          <select class="form-select" id="topik" name="topik">
                            <!--tampilkan pilihan topik dari tabel topik (database)-->
                            <option selected>Pilih Topik</option>
                            <?php
                            $sql_t = "SELECT `id_master_topik`,`topik`
                            FROM `master_topik` ORDER BY `topik`";
                            $query_t = mysqli_query($koneksi,$sql_t)

                            or die(mysqli_error($koneksi));

                            while($data_t = mysqli_fetch_row($query_t)){
                            $id_master_topik = $data_t[0];
                            $topik = $data_t[1];
                            ?>
                            <option value="<?php echo $id_master_topik;?>">

                            <?php echo $topik;?></option>

                            <?php }?>
                          </select>
                        </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <label for="saran" class="col-sm-2 col-form-label">Pesan</label>
                            <div class="col-sm-10">
                              <!--tambahkan name field pesan-->
                              <textarea rows="5" class="form-control"
                              id="saran" name="pesan"></textarea>
                            </div>
                          </div>
                          <!--tambahkan name dan value field button submit-->
                          <button type="submit" class="btn btn-primary"
                          name="kirim" value="kirim">Kirim</button>
                        </form>
                </div>
              </div>
            </div>
        </div>
    </section>
    <footer class="mt-5">
        <div class="container py-4">
            <div class="row">
              <div class="col text-center text-white">&copy; 2025 WebQ. Semua hak cipta dilindungi.</div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>