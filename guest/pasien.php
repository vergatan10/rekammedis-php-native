<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Data Pasien";
  session_start();
  include '../auth/connect.php';
  include "part/head.php";
  include "part_func/tgl_ind.php";
  include "part_func/umur.php";

  if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tgl = $_POST['tgl'];

    $up2 = mysqli_query($conn, "UPDATE pasien SET nama_pasien='$nama', tgl_lahir='$tgl', berat_badan='$berat', tinggi_badan='$tinggi' WHERE id='$id'");
    echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Pasien berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
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
                    <h4>Pasien yang telah terdaftar</h4>
                    <div class="card-header-action">
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Usia</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM pasien");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            $idpasien = $row['id'];
                            $i++;
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <th><?php echo ucwords($row['nama_pasien']); ?>
                                <div class="table-links">
                                  <?php
                                  $rekam = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idpasien'");
                                  $cekrekam = mysqli_num_rows($rekam);
                                  if ($cekrekam == 0) {
                                    echo '<a>Pasien belum memiliki catatan medis</a>';
                                  } else { ?>
                                    <form method="POST" action="printmsa.php" target="_blank">
                                      <input type="hidden" name="id" value="<?php echo $row['nama_pasien']; ?>">
                                      <button type="submit" id="btn-link" name="printall">MSA Treatment</button>
                                    </form>
                                  <?php }
                                  ?>
                                </div>
                              </th>
                              <td><?php if ($row['tgl_lahir'] == "") {
                                    echo "-";
                                  } else {
                                    echo tgl_indo($row['tgl_lahir']);
                                  } ?></td>
                              <td><?php if ($row['tgl_lahir'] == "") {
                                    echo "-";
                                  } else {
                                    umur($row['tgl_lahir']);
                                  } ?></td>
                                  <td align="center">
                                <form method="POST" action="detail_pasien.php">
                                  <input type="hidden" name="id" value="<?php echo $row['nama_pasien']; ?>">
                                  <button type="submit" class="btn btn-info btn-action mr-1" title="Detail Pasien" data-toggle="tooltip" name="submit"><i class="fas fa-info-circle"></i></button>
                                </form>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
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
  <?php include "../part/all-js.php"; ?>

  <script>
    $('#editPasien').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var nama = button.data('nama')
      var id = button.data('id')
      var tgl = button.data('lahir')
      var berat = button.data('berat')
      var tinggi = button.data('tinggi')
      var modal = $(this)
      modal.find('#getId').val(id)
      modal.find('#getNama').val(nama)
      modal.find('#getTgl').val(tgl)
      modal.find('#getBerat').val(berat)
      modal.find('#getTinggi').val(tinggi)
    })
  </script>
</body>

</html>