<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Update Bulanan";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  @$nama = $_POST['nama'];
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$nama' OR id='$nama'");
  $cekrow = mysqli_num_rows($cek);
  $tokne = mysqli_fetch_array($cek);
  $tglnow = date('Y-m-d');

  if (isset($_POST['jalan1'])) {
    if ($cekrow == 0) {
      mysqli_query($conn, "INSERT INTO pasien (nama_pasien) VALUES ('$nama')");
      echo '<script> location.reload(); </script>';
    } else {
      echo '<script>
      setTimeout(function() {
        swal({
          title: "Pasien Telah Terdaftar!",
          text: "Pasien yang bernama ' . ucwords($tokne['nama_pasien']) . ' sudah terdaftar, silahkan lanjutkan ke menu selanjutnya",
          icon: "success"
          });
          }, 500);
          </script>';
        }
      }

      if (isset($_POST['jalan3'])) {
        $idpasien = $_POST['id'];
        $penyakit = $_POST['penyakit'];
        $bulan = $_POST['bulan'];
        $diagnosa = $_POST['diagnosa'];

        mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, penyakit, diagnosa, tgl, bulan) VALUES ('$idpasien', '$penyakit', '$diagnosa', '$tglnow', '$bulan')");
      }

      if (isset($_POST['jalan3'])) {
        $idpasien = $_POST['id'];
        $penyakit = $_POST['penyakit'];

        $tolologi = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE penyakit='$penyakit' AND id_pasien='$idpasien' ORDER BY id DESC LIMIT 1");
        $lol = mysqli_fetch_array($tolologi);
        $tolologi2 = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$idpasien'");
        $lol2 = mysqli_fetch_array($tolologi2);
        $penyyy = $lol['id'];
        $passs = $lol2['nama_pasien'];
      }
      ?>
    </head>

    <body>
      <div id="app">
        <div class="main-wrapper main-wrapper-1">
          <div class="navbar-bg"></div>

          <?php
          include 'part/navbar.php';
          include 'part/sidebar.php';
          ?>

          <!-- Main Content -->
          <div class="main-content">
            <section class="section">
              <div class="section-header">
                <h1><?php echo $page; ?></h1>
              </div>

              <div class="section-body">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Update Bulanan</h4>
                      </div>
                      <div class="card-body">
                        <div class="row mt-4">
                          <div class="col-12 col-lg-8 offset-lg-1">
                            <div class="wizard-steps">
                              <div class="wizard-step wizard-step-active">
                                <div class="wizard-step-icon">
                                  <i class="far fa-user"></i>
                                </div>
                                <div class="wizard-step-label">
                                  Identitas Pasien
                                </div>
                              </div>
                              <div class="wizard-step <?php echo (isset($_POST['jalan1']) ||isset($_POST['jalan2']) || isset($_POST['jalan3']) || isset($_POST['pesanobat']) || isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                                <div class="wizard-step-icon">
                                  <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="wizard-step-label">
                                  Pemeriksaan
                                </div>
                              </div>
                              <div class="wizard-step <?php echo (isset($_POST['jalan3'])) ? "wizard-step-active" : ""; ?>">
                                <div class="wizard-step-icon">
                                  <i class="fas fa-print"></i>
                                </div>
                                <div class="wizard-step-label">
                                  Cetak
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <form class="wizard-content mt-2 needs-validation" novalidate="" method="POST" autocomplete="off" enctype="multipart/form-data">
                          <div class="wizard-pane">
                            <?php if (empty($_POST)) { ?>

                              <!-- PART 1 -->

                              <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-left">Nama Lengkap / ID</label>
                                <div class="col-lg-4 col-md-6">
                                  <input id="myInput" type="text" class="form-control" name="nama" placeholder="Nama / ID Calon Pasien">
                                  <div class="invalid-feedback">
                                    Mohon data diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-lg-4 col-md-6 text-right">
                                  <button class="btn btn-icon icon-right btn-primary" name="jalan1">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                                </div>
                              </div>
                            <?php }
                            if (isset($_POST['jalan1'])) { ?>

                              <!-- PART 3 -->

                              <div class="card-body">
                                <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penyakit</label>
                                  <div class="col-sm-12 col-md-7">
                                    <input type="hidden" class="form-control" name="id" required="" value="<?php echo $tokne['id']; ?>">
                                    <input type="text" class="form-control" name="penyakit">
                                  </div>
                                </div>
                                <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bulan</label>
                                  <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="bulan">
                                  </div>
                                </div>
                                <div class="form-group row mb-4">
                                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kesimpulan</label>
                                  <div class="col-sm-12 col-md-7">
                                    <textarea placeholder="Wajib" class="summernote" name="diagnosa">Wajib Diisi</textarea>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-6"></div>
                                  <div class="col-lg-4 col-md-6 text-right">
                                    <button class="btn btn-icon icon-right btn-primary" name="jalan3">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                                  </div>
                                </div>
                              <?php }?>
                              </div>
                            </div>
                        </div>
                      </form>
                      <?php if (isset($_POST['jalan3'])) { ?>

                        <!-- PART 5 -->
                        <div class="wizard-pane text-center">
                          <form method="POST" action="print.php" target="_blank">
                            <input type="hidden" name="id" value="<?php echo $passs; ?>">
                            <input type="hidden" name="idriwayat" value="<?php echo $penyyy; ?>">
                            <div class="btn-group">
                              <a href="index.php"class="btn btn-info" title="Ke Menu Utama" data-toggle="tooltip">Ke Menu Utama</a>
                              <button type="submit" class="btn btn-primary" name="printone" title="Print" data-toggle="tooltip"><i class="fas fa-print"></i> Print Data </button>
                            </div>
                          </form>
                        </div>
                      <?php } ?>
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
    <?php include "part/all-js.php";
    include "part/autocomplete.php"; ?>
  </body>

  </html>