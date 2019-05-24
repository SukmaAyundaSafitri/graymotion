-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 14 Des 2018 pada 05.13
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `graymotion`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE IF NOT EXISTS `akun` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `level`, `status`) VALUES
(52, 'admin', '$2y$10$eJkU6SOpHWSfc/BeYOZJJeq0iHRp1VdqY4KKGgjD9iij.I/BwXFlq', 1, 1),
(53, 'yuda', '$2y$10$krdNFTwb1O2Yq0SJdzOTyeNyXzRfoq215VDSTWz0MydEVe.4MO6ce', 2, 1),
(54, 'dika', '$2y$10$m1haSQz7BUjYLySl9GA2deaf1U/kEGAEqW6IQg2B0smLm9yCigEiO', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_terbit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permalink` varchar(255) NOT NULL,
  `id_akun` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`permalink`),
  KEY `id_akun` (`id_akun`),
  KEY `id_kategori` (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `img`, `isi`, `status`, `tgl_terbit`, `permalink`, `id_akun`, `id_kategori`) VALUES
(13, 'Minuman Yakult Setiap Hari', 'Minuman.jpg', '<p>Lebih dari 100 penyakit berasal dari usus!! yakult dengan L casel Shirota strain, dapat menekan pertumbuhan bakteri jahat. &ndash; Cintai ususmu, Minum yakult tiap hari.!!</p>', 1, '2018-11-23 11:20:10', 'Minuman', 52, 16),
(15, ' TEH PUCUK TEH MN PUCUK HARUM BTL 1.5L (PCS)', 'Minuman1.jpg', '<p><br />Dari Pucuk teh terbaik ada di teh pucuk harum, rasanya pas, nggak kemanisan<br />Teh Pucuk Harum, Rasa teh terbaik ada dipucuknya.</p>', 1, '2018-11-23 11:26:21', 'Minuman1', 52, 16),
(16, ' Nuvo family baru', 'Sabun.jpg', '<p>Nuvo family baru, dengan 3x perlindungan, TCC. melindungi kuman dan bakteri<br />moisturizingnya lembutkan kulit . kekuatan body shield melindungi sesudah mandi sampai mandi berikutnya, keluarga bebas bereksplorasi, generasi sehat, Generasi Nuvo Family.</p>', 1, '2018-11-23 12:05:05', 'Sabun', 52, 17),
(17, ' PENCUCI LANTAI SO KLIN LANTAI', 'PENCUCI LANTAI.jpg', '<p><br />so klin lantai kini 7 kali harum lebih lama. dengan nano technology basmi kuman sampai terkecil<br />nikmati sensasi parfume aromatic, hanya dari soklin lantai. tetap pilihan nomor satu keluarga indonesia</p>', 1, '2018-11-23 12:10:49', 'PENCUCI LANTAI', 52, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `berat` float NOT NULL,
  `harga` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_ditambah` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permalink` varchar(100) NOT NULL,
  `id_akun` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_akun` (`id_akun`),
  KEY `id_akun_2` (`id_akun`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `deskripsi`, `berat`, `harga`, `status`, `tgl_ditambah`, `permalink`, `id_akun`, `id_kategori`) VALUES
(27, 'Baju T-shirt Terbaru', '<p>Kaos oblong atau disebut juga sebagai <strong>T</strong>-<strong>shirt</strong> adalah jenis pakaian yang menutupi sebagian lengan, seluruh dada, bahu, dan perut.</p>', 1, 110000, 1, '2018-11-19 12:03:58', 'T-shirt', 52, 14),
(28, 'Baju Kemeja Termurah', '<p><strong>Kemeja</strong> adalah sebuah baju yang biasanya di kenakan oleh kaum pria. Pada umumnya <strong>kemeja</strong> menutupi bagian lengan, dada, bahu, berkerah dam menutupi tubuh sampai bagian perut. <strong>Kemeja</strong> biasanya dibuat menurut selera orang yang mengenakannya, kadang <strong>kemeja</strong> bisa dibuat berlengan panjang maupun berlengan pendek</p>', 1, 120000, 1, '2018-11-19 12:09:29', 'Kemeja', 52, 14),
(29, 'Jaket Murah Meriah', '<p><strong>Jaket</strong> adalah baju luar yang panjangnya hingga pinggang atau pinggul, dipakai untuk menahan angin dan cuaca dingin</p>', 2, 150000, 1, '2018-11-19 12:15:04', 'Jaket', 52, 14),
(30, 'Topi awet', '<p><strong>Topi</strong> adalah suatu jenis penutup kepala. Penggunaan <strong>Topi</strong> dimaksudkan untuk beberapa alasan. Umumnya digunakan sebagai aksesoris pakaian dan sebagai pelindung dari sinar matahari</p>', 1, 110000, 1, '2018-11-19 12:21:13', 'Topi', 52, 2),
(32, 'tas-mini-back', '<p>Biasanya digunakan untuk membawa pakaian, buku, dan lain-lain.</p>', 1, 130000, 1, '2018-11-19 12:39:55', 'Tas-mini', 52, 3),
(33, 'backpack-ransel-0', '<p>Backpack dengan bahan Nylon kombinasi PU Leather berkualitas pada <em>handle</em> yang membuat tampilan lebih percaya diri. Dengan <em>back sleeve</em> yang dapat di gunakan pada<em> handle</em> koper. Cocok di gunakan untuk aktivitas harian.</p>', 2, 130000, 1, '2018-11-19 12:46:46', 'tasr', 52, 3),
(34, 'Palomino Navya Backpack - Black', '<p>Backpack dengan bahan Nylon kombinasi PU Leather berkualitas pada <em>handle</em> yang membuat tampilan lebih percaya diri. Cocok di gunakan untuk aktivitas harian</p>', 2, 2000000, 1, '2018-11-19 12:49:03', 'tass', 52, 3),
(35, 'Palomino Livy Backpack - Black', '<p>Backpack dengan bahan Nylon kombinasi PU Leather berkualitas pada <em>handle</em> yang membuat tampilan lebih percaya diri. Dilengkapi dengan aksen aksesories <em>pompom charm</em>. Cocok di gunakan untuk aktivitas harian</p>', 1, 150000, 1, '2018-11-19 12:51:39', 'tass1', 52, 3),
(36, 'Eiger Ethnicap Topi Pria', '<ul>\r\n<li>Cocok digunakan untuk beraktivitas sehari-hari maupun traveling</li>\r\n</ul>', 1, 110000, 1, '2018-11-19 12:56:40', 'Topi1', 52, 2),
(38, 'Tas khas Graymotion', '<p><br />Cocok digunakan untuk beraktivitas sehari-hari maupun travelingTas adalah wadah tertutup yang dapat dibawa bepergian. Materi untuk membuat tas antara lain adalah kertas, plastik, kulit, kain, dan lain-lain. Biasanya digunakan untuk membawa pakaian, buku, dan lain-lain</p>', 2, 130000, 1, '2018-11-19 13:23:46', 'tas', 52, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_akun`
--

CREATE TABLE IF NOT EXISTS `detil_akun` (
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text,
  `id_akun` int(5) NOT NULL,
  UNIQUE KEY `email` (`email`),
  KEY `id_akun` (`id_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil_akun`
--

INSERT INTO `detil_akun` (`nama`, `no_hp`, `email`, `alamat`, `id_akun`) VALUES
('Admin ', '085', 'admin@graymotion.com', 'Banyuwangi, Jatim', 52),
('mahardika suryawan', '085257654222', 'mahardikasuryawan@gmai;.com', 'Banyuwangi', 54),
('Yuda Maulana', '085257556623', 'yudamaulanapolije@gmail.com', 'Kajar Tenggarang Bondowoso', 53);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_transaksi`
--

CREATE TABLE IF NOT EXISTS `detil_transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `id_stok` int(5) NOT NULL,
  `ukuran` char(3) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `qty` int(3) NOT NULL,
  `harga_satuan` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_barang` (`id_barang`),
  KEY `id_stok` (`id_stok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `detil_transaksi`
--

INSERT INTO `detil_transaksi` (`id`, `id_transaksi`, `id_barang`, `id_stok`, `ukuran`, `warna`, `qty`, `harga_satuan`) VALUES
(1, 1, 29, 163, 'M', 'Navy', 1, 150000),
(2, 2, 38, 240, 'L', 'Merah', 1, 130000),
(3, 3, 38, 238, 'S', 'Merah', 1, 130000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE IF NOT EXISTS `kabupaten` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_propinsi` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_propinsi` (`id_propinsi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `id_propinsi`, `nama`) VALUES
(1, 1, 'Bojonegoro'),
(2, 1, 'Kediri'),
(3, 1, 'Gresik'),
(4, 2, 'Bandung'),
(5, 2, 'Bekasi'),
(6, 2, 'Bogor'),
(7, 3, 'Semarang'),
(8, 3, 'Solo'),
(9, 3, 'Sukoharjo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `tipe`) VALUES
(2, 'Topi', 'produk'),
(3, 'Tas', 'produk'),
(14, 'Baju', 'produk'),
(16, 'Minuman', 'artikel'),
(17, 'Sabun', 'artikel'),
(18, 'Pencuci Lantai', 'artikel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `biaya` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kabupaten` (`id_kabupaten`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `id_kabupaten`, `nama`, `biaya`) VALUES
(1, 1, 'Bubulan', 5000),
(2, 1, 'Dander', 6000),
(3, 2, 'Badas', 6000),
(4, 2, 'Grogol', 5000),
(5, 3, 'Tambak', 6000),
(6, 3, 'Sidayu', 7000),
(7, 4, 'Arjasari', 3000),
(8, 4, 'Banjaran', 8000),
(9, 5, 'Babelan', 2000),
(10, 5, 'Setu', 3000),
(11, 6, 'Dramaga', 6000),
(12, 6, 'Nanggung', 7000),
(13, 7, 'Jambu', 2000),
(14, 7, 'Getasan', 1000),
(15, 8, 'Sewu', 2000),
(16, 8, 'Jagalan', 2000),
(17, 9, 'Nguter', 9000),
(18, 9, 'Kartasura', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `isi` text NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_komentar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_page` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_page` (`id_page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_unik` varchar(10) NOT NULL,
  `bank` varchar(10) NOT NULL,
  `foto_bukti` varchar(100) NOT NULL,
  `ket` text NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_konfirmasi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `kode_unik` (`kode_unik`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`id`, `kode_unik`, `bank`, `foto_bukti`, `ket`, `status`, `tgl_konfirmasi`) VALUES
(1, 'MCQkFgwTYE', 'BRI', 'MCQkFgwTYE.jpg', 'sudah bos', 1, '2018-11-19 22:26:25'),
(2, 'mnXseUM7BB', 'Mandiri', 'mnXseUM7BB.jpg', 'kirim', 1, '2018-11-27 08:43:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `propinsi`
--

CREATE TABLE IF NOT EXISTS `propinsi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `propinsi`
--

INSERT INTO `propinsi` (`id`, `nama`) VALUES
(1, 'Jawa Timur'),
(2, 'Jawa Barat'),
(3, 'Jawa Tengah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nilai` int(1) NOT NULL,
  `id_akun` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_akun` (`id_akun`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `warna` varchar(30) NOT NULL,
  `ukuran` varchar(3) NOT NULL,
  `stok` int(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=242 ;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id`, `id_barang`, `warna`, `ukuran`, `stok`, `foto`) VALUES
(126, 27, 'Putih', 'S', 12, 'T-shirt-Jh05P.jpeg'),
(127, 27, 'Putih', 'M', 21, 'T-shirt-Jh05P.jpeg'),
(128, 27, 'Putih', 'L', 22, 'T-shirt-Jh05P.jpeg'),
(129, 27, 'Putih', 'XL', 9, 'T-shirt-Jh05P.jpeg'),
(130, 27, 'Biru', 'S', 23, 'T-shirt-WYzHQ.jpeg'),
(131, 27, 'Biru', 'M', 24, 'T-shirt-WYzHQ.jpeg'),
(132, 27, 'Biru', 'L', 12, 'T-shirt-WYzHQ.jpeg'),
(133, 27, 'Biru', 'XL', 6, 'T-shirt-WYzHQ.jpeg'),
(134, 27, 'Hijau', 'S', 6, 'T-shirt-5WmOE.jpeg'),
(135, 27, 'Hijau', 'M', 7, 'T-shirt-5WmOE.jpeg'),
(136, 27, 'Hijau', 'L', 8, 'T-shirt-5WmOE.jpeg'),
(137, 27, 'Hijau', 'XL', 9, 'T-shirt-5WmOE.jpeg'),
(138, 28, 'Hitam', 'S', 7, 'Kemeja-PDt4t.jpeg'),
(139, 28, 'Hitam', 'M', 7, 'Kemeja-PDt4t.jpeg'),
(140, 28, 'Hitam', 'L', 6, 'Kemeja-PDt4t.jpeg'),
(141, 28, 'Hitam', 'XL', 23, 'Kemeja-PDt4t.jpeg'),
(142, 28, 'Merah', 'S', 23, 'Kemeja-TtCer.jpeg'),
(143, 28, 'Merah', 'M', 34, 'Kemeja-TtCer.jpeg'),
(144, 28, 'Merah', 'L', 22, 'Kemeja-TtCer.jpeg'),
(145, 28, 'Merah', 'XL', 8, 'Kemeja-TtCer.jpeg'),
(146, 28, 'Putih', 'S', 12, 'Kemeja-rhvFk.jpeg'),
(147, 28, 'Putih', 'M', 42, 'Kemeja-rhvFk.jpeg'),
(148, 28, 'Putih', 'L', 12, 'Kemeja-rhvFk.jpeg'),
(149, 28, 'Putih', 'XL', 21, 'Kemeja-rhvFk.jpeg'),
(150, 29, 'Merah', 'S', 12, 'Jaket-BRy3j.jpeg'),
(151, 29, 'Merah', 'M', 21, 'Jaket-BRy3j.jpeg'),
(152, 29, 'Merah', 'L', 22, 'Jaket-BRy3j.jpeg'),
(153, 29, 'Merah', 'XL', 8, 'Jaket-BRy3j.jpeg'),
(154, 29, 'Biru', 'S', 12, 'Jaket-PsjwX.jpeg'),
(155, 29, 'Biru', 'M', 32, 'Jaket-PsjwX.jpeg'),
(156, 29, 'Biru', 'L', 12, 'Jaket-PsjwX.jpeg'),
(157, 29, 'Biru', 'XL', 12, 'Jaket-PsjwX.jpeg'),
(158, 29, 'Hitam', 'S', 11, 'Jaket-IFt34.jpeg'),
(159, 29, 'Hitam', 'M', 22, 'Jaket-IFt34.jpeg'),
(160, 29, 'Hitam', 'L', 3, 'Jaket-IFt34.jpeg'),
(161, 29, 'Hitam', 'XL', 5, 'Jaket-IFt34.jpeg'),
(162, 29, 'Navy', 'S', 12, 'Jaket-ZDgZB.jpeg'),
(163, 29, 'Navy', 'M', 20, 'Jaket-ZDgZB.jpeg'),
(164, 29, 'Navy', 'L', 22, 'Jaket-ZDgZB.jpeg'),
(165, 29, 'Navy', 'XL', 12, 'Jaket-ZDgZB.jpeg'),
(166, 30, 'Merah ati', 'S', 22, 'Topi-66M5s.jpeg'),
(167, 30, 'Merah ati', 'M', 12, 'Topi-66M5s.jpeg'),
(168, 30, 'Merah ati', 'L', 5, 'Topi-66M5s.jpeg'),
(169, 30, 'Merah ati', 'XL', 6, 'Topi-66M5s.jpeg'),
(170, 30, 'Abu-abu', 'S', 5, 'Topi-xkB3s.jpeg'),
(171, 30, 'Abu-abu', 'M', 21, 'Topi-xkB3s.jpeg'),
(172, 30, 'Abu-abu', 'L', 6, 'Topi-xkB3s.jpeg'),
(173, 30, 'Abu-abu', 'XL', 8, 'Topi-xkB3s.jpeg'),
(174, 30, 'Hitam', 'S', 11, 'Topi-aSbSa.jpeg'),
(175, 30, 'Hitam', 'M', 12, 'Topi-aSbSa.jpeg'),
(176, 30, 'Hitam', 'L', 5, 'Topi-aSbSa.jpeg'),
(177, 30, 'Hitam', 'XL', 7, 'Topi-aSbSa.jpeg'),
(178, 30, 'Hijau', 'S', 4, 'Topi-FznzP.jpeg'),
(179, 30, 'Hijau', 'M', 5, 'Topi-FznzP.jpeg'),
(180, 30, 'Hijau', 'L', 6, 'Topi-FznzP.jpeg'),
(181, 30, 'Hijau', 'XL', 7, 'Topi-FznzP.jpeg'),
(182, 30, 'Merah', 'S', 11, 'Topi-CUUHg.jpeg'),
(183, 30, 'Merah', 'M', 4, 'Topi-CUUHg.jpeg'),
(184, 30, 'Merah', 'L', 5, 'Topi-CUUHg.jpeg'),
(185, 30, 'Merah', 'XL', 6, 'Topi-CUUHg.jpeg'),
(198, 32, 'Hitam', 'S', 12, 'Tas-mini-cJhPn.jpg'),
(199, 32, 'Hitam', 'M', 6, 'Tas-mini-cJhPn.jpg'),
(200, 32, 'Hitam', 'L', 4, 'Tas-mini-cJhPn.jpg'),
(201, 32, 'Hitam', 'XL', 3, 'Tas-mini-cJhPn.jpg'),
(202, 33, 'Abu', 'S', 12, 'tasr-7eQdU.jpg'),
(203, 33, 'Abu', 'M', 34, 'tasr-7eQdU.jpg'),
(204, 33, 'Abu', 'L', 8, 'tasr-7eQdU.jpg'),
(205, 33, 'Abu', 'XL', 8, 'tasr-7eQdU.jpg'),
(206, 34, 'Merah', 'S', 5, 'tass-tHCmX.jpg'),
(207, 34, 'Merah', 'M', 6, 'tass-tHCmX.jpg'),
(208, 34, 'Merah', 'L', 7, 'tass-tHCmX.jpg'),
(209, 34, 'Merah', 'XL', 9, 'tass-tHCmX.jpg'),
(210, 35, 'Hitam', 'S', 3, 'tass1-tr4o8.jpg'),
(211, 35, 'Hitam', 'M', 4, 'tass1-tr4o8.jpg'),
(212, 35, 'Hitam', 'L', 5, 'tass1-tr4o8.jpg'),
(213, 35, 'Hitam', 'XL', 4, 'tass1-tr4o8.jpg'),
(214, 36, 'Grey', 'S', 3, 'Topi1-B1r5K.jpg'),
(215, 36, 'Grey', 'M', 4, 'Topi1-B1r5K.jpg'),
(216, 36, 'Grey', 'L', 5, 'Topi1-B1r5K.jpg'),
(217, 36, 'Grey', 'XL', 6, 'Topi1-B1r5K.jpg'),
(230, 38, 'Merah biru', 'S', 3, 'tas-THgEc.jpeg'),
(231, 38, 'Merah biru', 'M', 4, 'tas-THgEc.jpeg'),
(232, 38, 'Merah biru', 'L', 5, 'tas-THgEc.jpeg'),
(233, 38, 'Merah biru', 'XL', 6, 'tas-THgEc.jpeg'),
(234, 38, 'Hitam', 'S', 3, 'tas-vuU5y.jpeg'),
(235, 38, 'Hitam', 'M', 4, 'tas-vuU5y.jpeg'),
(236, 38, 'Hitam', 'L', 5, 'tas-vuU5y.jpeg'),
(237, 38, 'Hitam', 'XL', 3, 'tas-vuU5y.jpeg'),
(238, 38, 'Merah', 'S', 5, 'tas-DCjPA.jpeg'),
(239, 38, 'Merah', 'M', 2, 'tas-DCjPA.jpeg'),
(240, 38, 'Merah', 'L', 4, 'tas-DCjPA.jpeg'),
(241, 38, 'Merah', 'XL', 5, 'tas-DCjPA.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_unik` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ongkir` int(15) NOT NULL,
  `id_kecamatan` int(5) NOT NULL,
  `id_akun` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_unik` (`kode_unik`),
  KEY `id_akun` (`id_akun`),
  KEY `id_kecamatan` (`id_kecamatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_unik`, `status`, `tgl_transaksi`, `ongkir`, `id_kecamatan`, `id_akun`) VALUES
(1, 'MCQkFgwTYE', 1, '2018-11-19 22:25:13', 3000, 7, 53),
(2, 'mnXseUM7BB', 0, '2018-11-27 08:42:29', 2000, 9, 54),
(3, '2CxVAnfwOP', 0, '2018-12-08 21:07:01', 3000, 7, 53);

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(10) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `id_page` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_page` (`id_page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_akun` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_akun` (`id_akun`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id`, `id_akun`, `id_barang`, `tanggal`) VALUES
(1, 53, 29, '2018-11-19 22:24:11'),
(2, 54, 38, '2018-11-27 08:41:29'),
(3, 53, 38, '2018-12-08 21:06:05');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `Artikel_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Artikel_ibfk_3` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `Barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Barang_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detil_akun`
--
ALTER TABLE `detil_akun`
  ADD CONSTRAINT `Detil_Akun_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detil_transaksi`
--
ALTER TABLE `detil_transaksi`
  ADD CONSTRAINT `detil_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Detil_Transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `Konfirmasi_ibfk_1` FOREIGN KEY (`kode_unik`) REFERENCES `transaksi` (`kode_unik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `Rating_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Rating_ibfk_2` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `Transaksi_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
