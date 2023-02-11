<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Rawat Jalan";
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
      if (isset($_POST['jalan2'])){
        $foto = $_FILES['gambar']['name'];
        $ukuran = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $file_tmp = $_FILES['gambar']['tmp_name'];

        $ekstensi_diperbolehkan = ['png', 'jpg', 'jpeg'];
        $x = explode('-', $foto);
        $x = strtolower(end($x));

        if(in_array($x, $ekstensi_diperbolehkan) === true) {
          if ($ukuran < 1044070){
            move_uploaded_file($file_tmp, 'img/' . $foto);
            $sql = mysqli_query($conn, "INSERT INTO pasien (foto) VALUES('$foto')");
          }
        }
      }
      if (isset($_POST['jalan2'])) {
        $namamu = $_POST['nama'];
        @$tgl = $_POST['tgl'];
        $berat = $_POST['berat'];
        $tinggi = $_POST['tinggi'];
        $status = $_POST['status'];
        $alam = $_POST['alamat'];
        $kota = $_POST['kota'];
        $provinsi = $_POST['provinsi'];
        $kodepos  = $_POST['kodepos'];
        $age = $_POST['age'];
        $idcard = $_POST['idcard'];
        $jabatan = $_POST['jabatan'];
        $nomortlp = $_POST['nomortlp'];
        $email = $_POST['email'];
        $namakerabat = $_POST['namakerabat'];
        $nomortlpkerabat = $_POST['nomortlpkerabat'];
        
        //$foto = $_FILES['gambar']['name'];
        $extensi = explode('-', $_FILES['gambar']['name']);
        $gambar = "foto-".$namamu."-".end($extensi);
        $sumber = $_FILES['gambar']['tmp_name'];
        $upload = move_uploaded_file($sumber, "img/".$gambar);
        if ($upload){
          mysqli_query($conn, "UPDATE pasien SET foto='$gambar' WHERE nama_pasien='$namamu'");
        }else{
          //echo "<script>alert('Gagal Upload!')</script>";
        }
        
        mysqli_query($conn, "UPDATE pasien SET foto='$foto' idcard='$idcard', status='$status', kota='$kota', provinsi='$provinsi', kodepos='$kodepos', age='$age', jabatan='$jabatan', nomortlp='$nomortlp', email='$email', namakerabat='$namakerabat', nomortlpkerabat='$nomortlpkerabat', alamat='$alam', tgl_lahir='$tgl', berat_badan='$berat', tinggi_badan='$tinggi' WHERE nama_pasien='$namamu'"); 
      }

      if (isset($_POST['jalan3'])) {
        $idpasien = $_POST['id'];
        $penyakit = $_POST['penyakit'];
        $bulan = $_POST['bulan'];
        $diagnosa = $_POST['diagnosa'];

        mysqli_query($conn, "INSERT INTO riwayat_penyakit (id_pasien, penyakit, diagnosa, tgl, bulan) VALUES ('$idpasien', '$penyakit', '$diagnosa', '$tglnow', '$bulan')");
      }


      if (isset($_POST['pesanobat'])) {
        $idpasien = $_POST['id'];
        $penyakit = $_POST['penyakit'];
        $cekriwayat = mysqli_query($conn, "SELECT * FROM `riwayat_penyakit` WHERE penyakit='$penyakit' AND id_pasien='$idpasien' ORDER BY id DESC LIMIT 1");
        $datapasien = mysqli_fetch_array($cekriwayat);
        $idpas = $datapasien['id_pasien'];
        $idpeny = $datapasien['id'];
        $tgltind = $_POST['tgltind'];
        $tind = $_POST['tind'];
        $dr = $_POST['dr'];
        $rs = $_POST['rs'];
        $efeksamping = $_POST['efeksamping'];
        $perkembangan = $_POST['perkembangan'];
        $gejala = $_POST['gejala'];

        if (isset($_POST["obat"])) {
          foreach ($_POST['obat'] as $obat) {
            mysqli_query($conn, "INSERT INTO riwayat_obat (id_penyakit, id_pasien, id_obat, tgltind, gejala, tind, dr, rs, perkembangan, efeksamping) VALUES ('$idpeny', '$idpas', '$obat', '$tgltind', '$gejala', '$tind', '$dr', '$rs', '$perkembangan', '$efeksamping')");
          }
        }
                //echo '<script>
                //setTimeout(function() {
                  //swal({
                    //title: "Obat Dibeli!",
                    //text: "Obat berhasil dibeli",
                    //icon: "success"
                    //});
                    //}, 500);
                   //</script>';
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
                        <h4>Create New</h4>
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
                              <div class="wizard-step <?php echo (isset($_POST['jalan1']) || isset($_POST['jalan2']) || isset($_POST['jalan3']) || isset($_POST['pesanobat']) || isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                                <div class="wizard-step-icon">
                                  <i class="fas fa-server"></i>
                                </div>
                                <div class="wizard-step-label">
                                  Informasi Umum
                                </div>
                              </div>
                              <div class="wizard-step <?php echo (isset($_POST['jalan2']) || isset($_POST['jalan3']) || isset($_POST['pesanobat']) || isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
                                <div class="wizard-step-icon">
                                  <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="wizard-step-label">
                                  Pemeriksaan
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
                              <div class="wizard-step <?php echo (isset($_POST['print'])) ? "wizard-step-active" : ""; ?>">
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
                                <div class="col-md-4"></div>
                                <div class="col-lg-4 col-md-6 text-right">
                                  <button class="btn btn-icon icon-right btn-primary" name="jalan1">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                                </div>
                              </div>
                            <?php }
                            if (isset($_POST['jalan1'])) { ?>

                              <!-- PART 2 -->

                              <div class="form-group row align-items-center">
                                <label class="col-md-4 text-md-right text-left">Nama Lengkap</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="hidden" name="nama" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>">
                                  <input type="text" class="form-control" required="" value="<?php echo $tokne['nama_pasien']; ?>" disabled>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Tanggal lahir</label>
                                <div class="col-lg-2 col-md-6">
                                  <input type="text" class="form-control datepicker" name="tgl" required="" value="<?php echo $tokne['tgl_lahir']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left col-form-label">Gender</label>
                                <div class="col-sm-6 col-lg-4">
                                  <input type="text" class="form-control" name="tinggi" required="" value="<?php echo $tokne['tinggi_badan']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left col-form-label">Golongan Darah</label>
                                <div class="input-group col-sm-2 col-lg-4">
                                  <input type="text" class="form-control" name="berat" required="" value="<?php echo $tokne['berat_badan']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Status Pernikahan</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="text" class="form-control" name="status" required="" value="<?php echo $tokne['status']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Alamat</label>
                                <div class="col-lg-4 col-md-6">
                                  <textarea type="text" class="form-control" name="alamat" required=""><?php echo $tokne['alamat']; ?></textarea>
                                  <div class="invalid-feedback">
                                    Mohon data diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Kota</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="text" class="form-control" name="kota" required="" value="<?php echo $tokne['kota']; ?>">
                                  <div class="invalid-feedback">
                                    Mohon data diisi!
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Provinsi</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="text" class="form-control" name="provinsi" required="" value="<?php echo $tokne['provinsi']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Kode Pos</label>
                                <div class="col-lg-2 col-md-6">
                                  <input type="number" class="form-control" name="kodepos" required="" value="<?php echo $tokne['kodepos']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Umur</label>
                                <div class="col-lg-2 col-md-6">
                                  <input type="number" class="form-control" name="age" required="" value="<?php echo $tokne['age']; ?>">
                                </div>
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    Tahun
                                  </div>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">ID Card Number</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="number" class="form-control" name="idcard" required="" value="<?php echo $tokne['idcard']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Jabatan</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="text" class="form-control" name="jabatan" required="" value="<?php echo $tokne['jabatan']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Nomor Telepon</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="number" class="form-control" name="nomortlp" required="" value="<?php echo $tokne['nomortlp']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Email</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="text" class="form-control" name="email" required="" value="<?php echo $tokne['email']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-6 text-md-right text-center">Kontak Darurat</label>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Nama Kerabat</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="text" class="form-control" name="namakerabat" required="" value="<?php echo $tokne['namakerabat']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left">Nomor Telepon Kerabat</label>
                                <div class="col-lg-4 col-md-6">
                                  <input type="number" class="form-control" name="nomortlpkerabat" required="" value="<?php echo $tokne['nomortlpkerabat']; ?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-md-4 text-md-right text-left col-form-label">Upload</label>
                                <div class="col-sm-6 col-lg-4">
                                  <form method="post" enctype="multipart/form-data" action="">
                                    <input type="file" class="form-control" name="gambar" id="gambar" required="required" multiple="multiple"/>
                                  </form>
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-lg-4 col-md-6 text-right">
                                  <button class="btn btn-icon icon-right btn-primary" name="jalan2">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                                </div>
                              </div>
                            <?php }
                            if (isset($_POST['jalan2'])) { ?>

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
                                    <input type="hidden" class="form-control" name="id" required="" value="<?php echo $tokne['id']; ?>">
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
                                            <input type="text" class="form-control datepicker" name="tgltind" required="" value="">
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
                                            <input type="hidden" class="form-control" name="id" required="" value="<?php echo $tokne['id']; ?>">
                                            <input type="text" class="form-control" name="rs">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Obat</label>
                                          <div class="col-lg-7 col-md-7">
                                            <input type="hidden" class="form-control" name="id" required="" value="<?php echo $idpasien; ?>">
                                            <input type="hidden" class="form-control" name="penyakit" required="" value="<?php echo $penyakit; ?>">
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
                                        <input type="hidden" class="form-control" name="print" value="Selesai">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      </form>
                      <?php if (isset($_POST['print']) || isset($_POST['pesanobat'])) { ?>

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