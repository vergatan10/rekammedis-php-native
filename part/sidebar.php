<?php

$sessionid = $_SESSION['id_pegawai'];

if(!isset($sessionid)){
  header('location:auth');
}
$nama = mysqli_query($conn, "SELECT * FROM pegawai WHERE id=$sessionid");
$output = mysqli_fetch_array($nama);

$judul = "aplikasi rekam medis";
$pecahjudul = explode(" ", $judul);
$acronym = "";

foreach ($pecahjudul as $w) {
  $acronym .= $w[0];
}
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.php"><?php echo $judul; ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.php"><?php echo $acronym; ?></a>
    </div>
    <ul class="sidebar-menu">
      <li <?php echo ($page == "Dashboard") ? "class=active" : ""; ?>><a class="nav-link" href="index.php"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <?php
          if($output["pekerjaan"] == "1"){ ?>
      <li class="menu-header">Menu</li>

      <li <?php echo ($page == "Rawat Jalan") ? "class=active" : ""; ?>><a class="nav-link" href="rawat_jalan.php"><i class="fas fa-stethoscope"></i> <span>Tambah Pasien</span></a></li>
      <li <?php echo ($page == "Edit Profile") ? "class=active" : ""; ?>><a class="nav-link" href="ubahdata.php"><i class="fas fa-user-injured"></i> <span>Ubah Data</span></a></li>
      <li <?php echo ($page == "Data Pasien" || @$page1 == "det") ? "class=active" : ""; ?>><a class="nav-link" href="pasien.php"><i class="fas fa-user-injured"></i> <span>Data Pasien</span></a></li>
      <li <?php echo ($page == "Update MSA Treatment") ? "class=active" : ""; ?>><a class="nav-link" href="updatemsa.php"><i class="fas fa-briefcase-medical"></i> <span>Update MSA Treatment</span></a></li>
      <li <?php echo ($page == "Update Bulanan") ? "class=active" : ""; ?>><a class="nav-link" href="updatebulanan.php"><i class="fas fa-briefcase-medical"></i> <span>Update Bulanan</span></a></li>
      <li <?php echo ($page == "Data Pegawai") ? "class=active" : ""; ?>><a href="pegawai.php" class="nav-link"><i class="fas fa-users"></i> <span>Data Pegawai</span></a></li>
    <?php }else{?>
      <li class="menu-header">Menu</li>

      <li <?php echo ($page == "Rawat Jalan") ? "class=active" : ""; ?>><a class="nav-link" href="rawat_jalan.php"><i class="fas fa-stethoscope"></i> <span>Tambah Pasien</span></a></li>
      <li <?php echo ($page == "Edit Profile") ? "class=active" : ""; ?>><a class="nav-link" href="ubahdata.php"><i class="fas fa-user-injured"></i> <span>Ubah Data</span></a></li>
      <li <?php echo ($page == "Data Pasien" || @$page1 == "det") ? "class=active" : ""; ?>><a class="nav-link" href="pasien.php"><i class="fas fa-user-injured"></i> <span>Data Pasien</span></a></li>
      <li <?php echo ($page == "Update MSA Treatment") ? "class=active" : ""; ?>><a class="nav-link" href="updatemsa.php"><i class="fas fa-briefcase-medical"></i> <span>Update MSA Treatment</span></a></li>
      <li <?php echo ($page == "Update Bulanan") ? "class=active" : ""; ?>><a class="nav-link" href="updatebulanan.php"><i class="fas fa-briefcase-medical"></i> <span>Update Bulanan</span></a></li>
    <?php } ?>
  </aside>
</div>