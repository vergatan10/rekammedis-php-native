-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 02:51 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `nama_pasien` varchar(200) NOT NULL,
  `tgl_lahir` varchar(200) NOT NULL,
  `tinggi_badan` text NOT NULL,
  `berat_badan` text NOT NULL,
  `alamat` text NOT NULL,
  `status` text NOT NULL,
  `kota` text NOT NULL,
  `provinsi` text NOT NULL,
  `kodepos` int(7) NOT NULL,
  `age` int(3) NOT NULL,
  `jabatan` text NOT NULL,
  `nomortlp` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `namakerabat` text NOT NULL,
  `nomortlpkerabat` varchar(15) NOT NULL,
  `idcard` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `nama_pasien`, `tgl_lahir`, `tinggi_badan`, `berat_badan`, `alamat`, `status`, `kota`, `provinsi`, `kodepos`, `age`, `jabatan`, `nomortlp`, `email`, `namakerabat`, `nomortlpkerabat`, `idcard`, `foto`) VALUES
(30, 'YOSEPH SUHARTONO', '1962-03-19', 'Laki - laki', 'O', 'DSN ORO-ORO OMBO RT/RW: 003/004, KEL/DESA: PAGUNG, KEC. SEMEN', 'Belum menikah', 'KEDIRI', 'JAWA TIMUR', 65316, 57, 'PENJAGA KOST', '081231870989', '-', 'MARIA RONY (KAKAK IPAR)', '082334145392', 2147483647, ''),
(31, 'SUMINTO', '1971-07-22', 'Laki - laki', 'B', 'PURI BINTARO HIJAU BLOK C.11/16, RT/RW: 006/012 PONDOK AREN', 'Menikah', 'TANGERANG SELATAN', 'BANTEN', 15222, 49, 'GURU', '081285796149', 'fsuminto@gmail.com', 'Mesya Aprilia', '082112135647', 2147483647, ''),
(32, 'HARJANTO WIRJOMARTONO', '1959-03-04', 'Laki - laki', 'AB', 'PURIANJASMORO H.I/2 RT/RW: 002/007, KEL. TAWANGSARI, KEC. SEMARANG BARAT', 'Menikah', 'SEMARANG', 'JAWA TENGAH', 50144, 62, 'KARYAWAN SWASTA', '0', '-', '-', '0', 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `alamat` varchar(360) NOT NULL,
  `pekerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `username`, `password`, `nama_pegawai`, `alamat`, `pekerjaan`) VALUES
(1, 'admin', 'admin', 'Admin', 'Tangerang', 1),
(3, 'user', 'user', 'User', 'user', 2);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_obat`
--

CREATE TABLE `riwayat_obat` (
  `id` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_obat` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgltind` varchar(200) NOT NULL,
  `tind` text NOT NULL,
  `dr` text NOT NULL,
  `rs` text NOT NULL,
  `perkembangan` text NOT NULL,
  `efeksamping` text NOT NULL,
  `gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_obat`
--

INSERT INTO `riwayat_obat` (`id`, `id_penyakit`, `id_pasien`, `id_obat`, `jumlah`, `tgltind`, `tind`, `dr`, `rs`, `perkembangan`, `efeksamping`, `gejala`) VALUES
(45, 57, 30, '-Agnioten (1x1)\r\n-Madopar (2x1)\r\n-Norvask (1x1)\r\n-Propanolol (3x1)', 0, '2020-10-04', 'Cek darah, MRI, Ronsen Thorax, Tensi darah', 'Prof. Suwandi', 'Rs. Medistra', '', '', ''),
(46, 58, 31, '.', 0, '2021-04-11', '.', '.', '.', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_penyakit`
--

CREATE TABLE `riwayat_penyakit` (
  `id` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `penyakit` varchar(300) NOT NULL,
  `diagnosa` text NOT NULL,
  `tgl` varchar(200) NOT NULL,
  `id_rawatinap` varchar(11) NOT NULL,
  `biaya_pengobatan` int(11) NOT NULL,
  `bulan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_penyakit`
--

INSERT INTO `riwayat_penyakit` (`id`, `id_pasien`, `penyakit`, `diagnosa`, `tgl`, `id_rawatinap`, `biaya_pengobatan`, `bulan`) VALUES
(57, 30, 'Parkinson', '<ul><li>Oktober 2015 di RS Babtis Kediri= dr. Novian mendiagnosa bukan stroke ringan melainkan parkinson.</li><li>2016 - 2018 di Klinik = Tidak ada perubahan dan tetap didiagnosa parkinson.</li><li>2018 di RS RKZ = Didiagnosa parkinson.</li><li>2018 Pengobatan alternatif = dr. dari Jepang juga mendiagnosa parkinson.</li><li>2019 Terapi listrik di Blitar = Didiagnosa parkinson</li><li>2020 Pengobatan alternatif (Akupuntur)</li></ul>', '2021-04-11', '0', 0, ''),
(58, 31, 'Parkinson', '<ul><li>Juli 2015 dr. Sigit dari Rs. Carolus melihat ada penyumbatan ringan di kepala (Stroke ringan).</li><li>Tahun 2018 Mulai tremor. dr. Dian dari Rs.Ichsan Medical Center (Rujukan dari BPJS) mengatakan bahwa Pak Minto bukan gejala stroke ringan lalu dr. Dian menyarankan Pak Minto untuk dirujuk untuk MRI ke Rs. Medika BSD.</li><li>Juli 2018 dr. Patricia (Spesialis Syaraf) dari Rs. Medika BSD mendiagnosa bahwa Pak Minto Parkinson. Setiap bulan Pak Minto melakukan kontrol dan rutin meminum obat selama 1 tahun tetapi tidak ada perubahan.</li><li>2019 dr. Patricia dari Rs. Medika BSD merujuk Pak Minto untuk dilakukan Fisioterapi. 3 Bulan fisioterapi di Rumah sakit dengan durasi Seminggu 2x terapi. Sekali terapi 1 Jam dengan rincian: 30 menit latihan motorik dan 30 jam dipanasi oleh infrared.</li><li>Juni 2019 Pak Minto mulai rawat jalan di Rs. Medika BSD. Diberikan obat Sifrol, Arkin, Trihexyphenidy, Suplemen vitamin untuk otak. Efek samping dari minum obat tersebut membuat Pak Minto seperti orang kecanduan obat/dosis ketinggian (Kliyengan) dan jika tidak minum obat tidak bisa jalan/kaku.</li></ul>', '2021-04-11', '0', 0, ''),
(66, 30, 'Parkinson', 'Seminggu setelah dilakukan pemeriksaan sampai stemcell tahap 1 di Rs. Medistra oleh Prof. Suwandi, kondisi Pak Yoseph mulai membaik, kaki dan tangan nya sudah terasa lebih ringan dibandingkan sebelum dilakukan tindakan stemcell. 2 minggu setelahnya di Apartemen, Pak Yoseph drop karena tidak diberikan obat madopar dan symmetrel, sehingga keadaan Pak Yoseph kembali seperti sebelum di steamcell selama 1 minggu.', '2021-04-11', '', 0, 'Oktober 2020'),
(67, 32, 'MSA ', '', '2021-04-11', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_pasien_2` (`id_pasien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_obat`
--
ALTER TABLE `riwayat_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `riwayat_penyakit`
--
ALTER TABLE `riwayat_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
