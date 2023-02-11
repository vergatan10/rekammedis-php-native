<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $idnama = $_POST['id'];
  $page1 = "det";
  $page = "Detail Pasien : " . $idnama;
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
  $pasien = mysqli_fetch_array($cek);
  $idid = $pasien['id'];
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      include 'part_func/umur.php';
      include 'part_func/tgl_ind.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Detail Pasien</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="pasien.php">Data Pasien</a></div>
              <div class="breadcrumb-item">Detail Pasien : <?php echo ucwords($idnama); ?></div>
            </div>
          </div>

          <div class="section-body">
            <?php include 'part/info_pasien.php'; ?>

            <div class="section-body">
              <div class="row">
                <div class="col-12 col-sm-6 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Info Pasien<!-- UNTUK MENAMPILKAN GAMBAR NYA -->
                        <?php 
                        if ($pasien['foto'] == NULL){
                          echo '</h4>';
                        } else { ?>
                          <img src="img/<?php echo $pasien['foto']; ?>" width="150px"></h4><?php
                        }
                        ?>
                      <div class="card-header-action">
                        <form method="POST" action="print.php" target="_blank">
                          <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                          <?php
                          $cekrekam = mysqli_num_rows($rekam);
                          if ($cekrekam == 0) {
                            echo '';
                          } else {
                            echo '<button type="submit" class="btn btn-primary" name="printall">Print Semua</button> &emsp;';
                          } ?>
                        </form>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="gallery">
                        <table class="table table-striped table-sm">
                          <tbody>
                            <tr>
                              <th scope="row">Nama Lengkap</th>
                              <td> : <?php echo ucwords($idnama); ?></td>
                              <th scope="row">Alamat</th>
                              <td> : <?php echo $pasien['alamat']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Tanggal Lahir</th>
                              <td> : <?php echo tgl_indo($pasien['tgl_lahir']); ?></td>
                              <th scope="row">Kota</th>
                              <td> : <?php echo $pasien['kota']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Umur</th>
                              <td> : <?php echo $pasien['age']; ?></td>
                              <th scope="row">Provinsi</th>
                              <td> : <?php echo $pasien['provinsi']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Gender</th>
                              <td> : <?php echo $pasien['tinggi_badan']; ?></td>
                              <th scope="row">Kode Pos</th>
                              <td> : <?php echo $pasien['kodepos']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Golongan Darah</th>
                              <td> : <?php echo $pasien['berat_badan']; ?></td>
                              <th scope="row">Nomor Telepon</th>
                              <td> : <?php echo $pasien['nomortlp']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Status Pernikahan</th>
                              <td> : <?php echo $pasien['status']; ?></td>
                              <th scope="row">Email</th>
                              <td> : <?php echo $pasien['email']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Jabatan</th>
                              <td> : <?php echo $pasien['jabatan']; ?></td>
                              <th scope="row">ID Card Number</th>
                              <td> : <?php echo $pasien['idcard']; ?></td>
                            </tr>
                            <tr>
                              <th scope="row">Nama/Telepon Kerabat</th>
                              <td> : <?php echo $pasien['namakerabat']; ?>/<?php echo $pasien['nomortlpkerabat']; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Catatan Riwayat Penyakit Pasien</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1">
                          <thead>
                            <tr>
                              <th>Penyakit</th>
                              <th>Bulan</th>
                              <th>Kesimpulan</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid'");
                            $i = 0;
                            while ($row = mysqli_fetch_array($sql)){
                              $idpenyakit = $row['id'];
                              ?>
                              <tr>
                                <td><?php echo ucwords($row['penyakit']); ?></td>
                                <td><?php echo ucwords($row['bulan']); ?></td>
                                <td><?php echo $row['diagnosa'];?></td>
                                <td>
                                  <form method="POST" action="printbln.php" target="_blank">
                                    <input type="hidden" name="id" value="<?php echo $idnama; ?>">
                                    <input type="hidden" name="idriwayat" value="<?php echo $idpenyakit ?>">
                                    <div class="btn-group">
                                      <button type="submit" class="btn btn-info" name="detail" title="Detail" data-toggle="tooltip"><i class="fas fa-info"></i></button>
                                      <button type="submit" class="btn btn-primary" name="printone" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i></button>
                                    </div>
                                  </form>
                                </td>
                              </tr>
                            <?php }  ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </section>
          </div>

          <?php include 'part/footer.php'; ?>
        </div>
      </div>
      <?php include "part/all-js.php"; ?>
    </body>

    </html>