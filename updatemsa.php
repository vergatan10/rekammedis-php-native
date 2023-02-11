<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Update MSA Treatment";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  @$nama = $_POST['nama'];
  $cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$nama' OR id='$nama'");
  $cekrow = mysqli_num_rows($cek);
  $tokne = mysqli_fetch_array($cek);
  $tglnow = date('Y-m-d');



  if (isset($_POST['jalan3'])) {
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

      if (isset($_POST['pesanobat'])) {
        $idpasien = $_POST['id'];
        $penyakit = $_POST['penyakit'];
        mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, penyakit, tgl) VALUES ('$idpasien', '$penyakit', '$tglnow')");
      }


      if (isset($_POST['pesanobat'])) {
        $idpasien = $_POST['id'];
        $penyakit = $_POST['penyakit'];
        $cekriwayat = mysqli_query($conn, "SELECT * FROM `riwayat_penyakit` WHERE penyakit='$penyakit' AND id_pasien='$idpasien' ORDER BY id DESC LIMIT 1");
        $datapasien = mysqli_fetch_array($cekriwayat);
        $idpas = $datapasien['id_pasien'];
        $idpeny = $datapasien['id'];
        $tgltind = $_POST['tgltind'];
        $gejala = $_POST['gejala'];
        $tind = $_POST['tind'];
        $dr = $_POST['dr'];
        $rs = $_POST['rs'];
        $efeksamping = $_POST['efeksamping'];
        $perkembangan = $_POST['perkembangan'];

        if (isset($_POST["obat"])) {
          foreach ($_POST['obat'] as $obat) {
            mysqli_query($conn, "INSERT INTO riwayat_obat (id_penyakit, id_pasien, id_obat, tgltind, gejala, tind, dr, rs, perkembangan, efeksamping) VALUES ('$idpeny', '$idpas', '$obat', '$tgltind', '$gejala', '$tind', '$dr', '$rs', '$perkembangan', '$efeksamping')");
          }
        }
      }

      if (isset($_POST['pesanobat'])) {
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
                        <h4>Update MSA</h4>
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
                              <div class="wizard-step <?php echo (isset($_POST['jalan3']) || isset($_POST['pesanobat']) || isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                                <div class="wizard-step-icon">
                                  <i class="fas fa-briefcase-medical"></i>
                                </div>
                                <div class="wizard-step-label">
                                  Tindakan yang dilakukan
                                </div>
                              </div>
                              <div class="wizard-step <?php echo (isset($_POST['pesanobat'])) ? "wizard-step-active" : ""; ?>">
                                <div class="wizard-step-icon">
                                  <i class="fas fa-print"></i>
                                </div>
                                <div class="wizard-step-label">
                                  Cetak Struk
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
                                <form method="POST" action="">
                                  <div class="col-md-4"></div>
                                  <div class="col-lg-4 col-md-6 text-right">
                                    <button class="btn btn-icon icon-right btn-primary" name="jalan3">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                                  </div>
                                </form>
                              </div>
                            <?php }
                            if (isset($_POST['jalan3'])) { ?>

                              <!-- PART 4 -->

                              <div class="row">
                                <div class="col-12 col-sm-12 col-md-8">
                                  <div class="tab-content no-padding" id="myTab2Content">
                                    <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                                      <div class="form-group row">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="text" class="form-control datepicker" name="tgltind" value="">
                                        </div>
                                      </div>
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gejala</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="text" class="form-control" name="gejala">
                                        </div>
                                      </div>
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tindakan</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="text" class="form-control" name="tind">
                                        </div>
                                      </div>
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dokter</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="text" class="form-control" name="dr">
                                        </div>
                                      </div>
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rumah Sakit</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="text" class="form-control" name="rs">
                                          <input type="hidden" class="form-control" name="id" value="<?php echo $tokne['id']; ?>">
                                          <input type="hidden" class="form-control" name="penyakit" value=" ">
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Obat</label>
                                        <div class="col-lg-7 col-md-7">
                                          <textarea type="text" class="form-control" name="obat[]" required=""></textarea>
                                          <div class="invalid-feedback">
                                            Mohon data diisi!
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Efek Samping</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="text" class="form-control" name="efeksamping">
                                        </div>
                                      </div>
                                      <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Perkembangan</label>
                                        <div class="col-sm-12 col-md-7">
                                          <input type="text" class="form-control" name="perkembangan">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-md-6"></div>
                                    <div class="col-lg-4 col-md-6 text-right">
                                      <input type="submit" class="btn btn-icon icon-center btn-success" name="pesanobat" value="Selesai">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </form>
                    <?php if (isset($_POST['pesanobat'])) { ?>

                      <!-- PART 5 -->
                      <div class="wizard-pane text-center">
                        <form method="POST" action="printmsa.php" target="_blank">
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