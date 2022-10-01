-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 12:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentaluyeee`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `emailAdmin` varchar(150) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `emailAdmin`, `nama`, `password`, `role`) VALUES
('admin', 'admin@rentaluyeee.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
('pemilik', 'pemilik@rentaluyeee.com', 'pemilik', '58399557dae3c60e23c78606771dfa3d', 99);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(10) NOT NULL,
  `wa` varchar(25) NOT NULL,
  `fb` varchar(200) NOT NULL,
  `twt` varchar(200) NOT NULL,
  `ig` varchar(200) NOT NULL,
  `alamatRental` text NOT NULL,
  `emailRental` varchar(150) NOT NULL,
  `teleponRental` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `wa`, `fb`, `twt`, `ig`, `alamatRental`, `emailRental`, `teleponRental`) VALUES
(1, '6287885641799', 'https://facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'ini adalah alamat rental kami', 'contactus@rentaluyeee.com', '6287885641799');

-- --------------------------------------------------------

--
-- Table structure for table `masukan`
--

CREATE TABLE `masukan` (
  `id` int(10) NOT NULL,
  `namaPengirim` varchar(100) NOT NULL,
  `emailPengirim` varchar(150) NOT NULL,
  `teleponPengirim` varchar(25) NOT NULL,
  `masukan` text NOT NULL,
  `status` int(2) NOT NULL,
  `tglMasukan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masukan`
--

INSERT INTO `masukan` (`id`, `namaPengirim`, `emailPengirim`, `teleponPengirim`, `masukan`, `status`, `tglMasukan`) VALUES
(1, 'aaa', 'aaa@aaa.com', '6287885641799', 'halooooooooooooooooooooooooooooooooooo', 0, '2022-05-23 04:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `idMerk` int(10) NOT NULL,
  `namaMerk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`idMerk`, `namaMerk`) VALUES
(1, 'Bajaj'),
(2, 'KTM'),
(3, 'Honda');

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `idMotor` int(10) NOT NULL,
  `namaMotor` varchar(100) NOT NULL,
  `idMerk` int(10) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(12) NOT NULL,
  `bahanBakar` varchar(50) DEFAULT NULL,
  `tahunBuat` int(10) DEFAULT NULL,
  `tempatDuduk` int(5) DEFAULT NULL,
  `gambar1` varchar(300) DEFAULT NULL,
  `abs` int(2) DEFAULT NULL,
  `led` int(2) DEFAULT NULL,
  `crashSensor` int(2) DEFAULT NULL,
  `ridingMode` int(2) DEFAULT NULL,
  `fi` int(2) DEFAULT NULL,
  `tcs` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`idMotor`, `namaMotor`, `idMerk`, `deskripsi`, `harga`, `bahanBakar`, `tahunBuat`, `tempatDuduk`, `gambar1`, `abs`, `led`, `crashSensor`, `ridingMode`, `fi`, `tcs`) VALUES
(1, 'SS400', 1, 'Slowly spreading its cards this year, the Ace of Bajaj Autos is still not on the table. With the expectations like Pulsar 400SS or Pulsar SS400, the Ace (400SS) would be the commander of the Pulsar series. It would be a benchmark for the other motorcycle manufacturers as the competition for more performance oriented bikes will definitely rise this year.', 100000, 'Pertamax Turbo', 2022, 2, 'ss400-kuning.jpg', 1, 1, 1, NULL, 1, NULL),
(2, 'Duke390', 2, 'The KTM 390 DUKE breathes life into values that have made motorcycling so amazing for decades. It combines maximum riding pleasure with optimum user value and comes out on top wherever nimble handling counts. Light as a feather, powerful and packed with state-of-the-art technology, it guarantees a thrilling ride, whether youre in the urban jungle or a forest of bends. 390 DUKE – nowhere you will find more motorcycle per euro.', 200000, 'Pertamax Turbo', 2020, 2, 'duke390-putihorange.jpg', 1, 1, 1, 1, 1, 1),
(3, 'RS200', 1, 'The Pulsar is by far the most successful brand Bajaj has managed to create in the recent past.It is also fast, no doubt. But, its true highlight is its easy to ride nature. ', 75000, 'Pertalite', 2017, 2, 'rs200-putihbiru.png', 1, NULL, 1, NULL, 1, NULL),
(4, 'Beat', 3, 'Beat 110cc, Warna Merah, Transmisi Otomatis Kapasitas Tangki Bahan Bakar 4.2 Liter', 20000, 'Pertalite', 2014, 2, 'beat-merahputih.jpg', NULL, NULL, NULL, NULL, 1, NULL),
(5, 'Pcx', 3, 'Pcx 155cc, Warna Silver, Tipe Transimi : Otomatis V - Matic Kapasitas Tangki Bahan Bakar 8,1 liter\r\n', 50000, 'Pertamax', 2021, 2, 'pcx-navy.jpg', 1, 1, NULL, NULL, 1, NULL),
(6, 'Vario 125', 3, 'MVario 125cc, Warna Putih, Tipe Tranmisi Otomatis V - Matic, Kapasitas Tangki Bahan Bakar 5,5 liter', 40000, 'Pertalite', 2018, 2, 'vario-putihmerah.jpg', NULL, 1, NULL, NULL, 1, NULL),
(7, 'Supra X 125', 3, 'Supra X FI 125cc, Warna Hitam, Tipe Tranmisi 4 Speed Rotary, Kapasitas Tangki Bahan Bakar 4 Liter', 30000, 'Pertalite', 2018, 2, 'supra-hitamkuning.jpg', NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `idPemesanan` int(50) NOT NULL,
  `emailPenyewa` varchar(150) NOT NULL,
  `idMotor` int(10) DEFAULT NULL,
  `dariTgl` date DEFAULT NULL,
  `sampaiTgl` date DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `tanggalPemesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `jmlHari` int(10) DEFAULT NULL,
  `totalHarga` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`idPemesanan`, `emailPenyewa`, `idMotor`, `dariTgl`, `sampaiTgl`, `pesan`, `status`, `tanggalPemesanan`, `jmlHari`, `totalHarga`) VALUES
(19, 'coba@gmail.com', 1, '2022-05-28', '2022-05-30', 'confirm', 1, '2022-05-28 08:07:35', 3, '300000'),
(20, 'coba@gmail.com', 3, '2022-05-28', '2022-05-30', 'reject', 2, '2022-05-28 08:14:50', 3, '225000'),
(21, 'coba@gmail.com', 4, '2022-05-28', '2022-05-31', 'qqqqqqqqqqqqqqqq', 0, '2022-05-28 08:15:19', 4, '80000'),
(22, 'coba@gmail.com', 5, '2022-05-28', '2022-05-28', '1 hari', 2, '2022-05-28 12:27:48', 1, '50000');

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `emailPenyewa` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namaPenyewa` varchar(150) NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `tglDaftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`emailPenyewa`, `username`, `password`, `namaPenyewa`, `telepon`, `alamat`, `tglDaftar`) VALUES
('ayuwandira@gmail.com', 'ayuwandira', 'f49e512c760ddb9e4bcf0c31d633f451', 'Ayuwandira', '111', 'alamat ayuwandira', '2022-05-28 13:59:55'),
('coba@gmail.com', 'coba', '4124bc0a9335c27f086f24ba207a4912', 'cobaaa', '123', 'ini alamat', '2022-05-22 06:31:39'),
('fidel@gmail.com', 'fidel', 'fa1776fe544c44fad1cf2bec71a14464', 'Fidel', '222', 'alamat fidel', '2022-05-28 13:59:55'),
('imam@gmail.com', 'imam', 'eaccb8ea6090a40a98aa28c071810371', 'Imam', '333', 'alamat imam', '2022-05-28 13:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `idTestimoni` int(10) NOT NULL,
  `emailPenyewa` varchar(150) NOT NULL,
  `testimoni` text NOT NULL,
  `status` int(5) DEFAULT NULL,
  `tglTestimoni` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testimoni`
--

INSERT INTO `testimoni` (`idTestimoni`, `emailPenyewa`, `testimoni`, `status`, `tglTestimoni`) VALUES
(1, 'coba@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco', 1, '2022-05-21 13:22:18'),
(2, 'coba@gmail.com', 'lorem ipsum dolor sit amet', 1, '2022-05-22 15:25:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`emailAdmin`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masukan`
--
ALTER TABLE `masukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`idMerk`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`idMotor`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`idPemesanan`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`emailPenyewa`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`idTestimoni`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masukan`
--
ALTER TABLE `masukan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `idMerk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `idMotor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `idPemesanan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `idTestimoni` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
