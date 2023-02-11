<?php
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
      <a href="../index.php"><?php echo $judul; ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="../index.php"><?php echo $acronym; ?></a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Menu</li>
      <li <?php echo ($page == "Data Pasien" || @$page1 == "det") ? "class=active" : ""; ?>><a class="nav-link" href="pasien.php"><i class="fas fa-user-injured"></i> <span>Data Pasien</span></a></li>

  </aside>
</div>