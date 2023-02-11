<?php
$idnama = $_POST['id'];
$page1 = "det";
$page = "Detail Pasien : " . $idnama;
session_start();
include 'auth/connect.php';
include "part/head.php";
include 'part_func/umur.php';
include 'part_func/tgl_ind.php';

//All SQL Syntax
$cek = mysqli_query($conn, "SELECT * FROM pasien WHERE nama_pasien='$idnama'");
$pasien = mysqli_fetch_array($cek);
$idid = $pasien['id'];

if (isset($_POST['printall'])) {
	$riwayatpenyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' ORDER BY tgl ASC");
	$obat2an = mysqli_query($conn, "SELECT * FROM riwayat_obat WHERE id_pasien='$idid'");
} elseif (isset($_POST['printone']) || isset($_POST['detail'])) {
	$idriwayat = $_POST['idriwayat'];
  $riwayatpenyakit = mysqli_query($conn, "SELECT * FROM riwayat_penyakit WHERE id_pasien='$idid' AND id='$idriwayat'"); //AND id='$idriwayat'
  $obat2an = mysqli_query($conn, "SELECT * FROM riwayat_obat WHERE id_pasien='$idid' AND id_penyakit='$idriwayat'");//AND id='$idriwayat'
}
?>

<div class="section-body">
	<?php if (isset($_POST['print_foto'])) { ?>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="gallery gallery-md">
							<?php
							if (mysqli_num_rows($sqlimg) == "0") {
								echo 'Tidak ada data';
							} else {
								while ($img = mysqli_fetch_array($sqlimg)) {
									$dirimg = $img['directory'];

									echo '<img src="' . $dirimg . '" width="100%" style="margin-bottom: 200px;">';
								}
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4>Info Pasien</h4>
						<div class="card-header-action">
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
										<td> : <?php echo $pasien['namakerabat']; ?> / <?php echo $pasien['nomortlpkerabat']; ?></td>
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
						<div class="card-header-action">
							<?php 
							if ($pasien['foto'] == NULL){
								echo '';
							} else { ?>
								<img src="img/<?php echo $pasien['foto']; ?>" width="150px"><?php
							}
							?>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered" id="table-1">
								<thead>
									<tr>
										<th>Tanggal Update</th>
										<th>Gejala</th>
										<th>Tindakan</th>
										<th>Dokter</th>
										<th>Rumahsakit</th>
										<th>Obat</th>
										<th>Efek Samping</th>
										<th>Perkembangan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									while ($row = mysqli_fetch_array($riwayatpenyakit) AND $row2 = mysqli_fetch_array($obat2an)) {
										$idpenyakit = $row['id'];
										?>
										<tr>
											<td><?php echo $row2['tgltind'];?>
											<td><?php echo $row2['gejala']; ?></td>
											<td><?php echo $row2['tind'];?></td>
											<td><?php echo $row2['dr'];?></td>
											<td><?php echo $row2['rs'];?></td>
											<td><?php echo $row2['id_obat'];?>
											<td><?php echo $row2['efeksamping'];?>
											<td><?php echo $row2['perkembangan'];?>
										</td>
									</tr>
								<?php } ?>
								<tr>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php }
if (!isset($_POST['detail'])) {
	if (!isset($_POST['print_foto'])) {
		echo '<footer class="main-footer">
		<div class="footer-left">
		Struk ini dicetak pada tanggal ' . tgl_indo(date('Y-m-d')) . '
		</div>
		</footer>';
	}
	echo '<script> window.print(); </script>';
} ?>