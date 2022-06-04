-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2022 pada 17.51
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_obat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoriobat`
--

CREATE TABLE `kategoriobat` (
  `idkategori` int(5) NOT NULL,
  `namakategori` varchar(40) NOT NULL,
  `deskripsikategori` text NOT NULL,
  `gambarkategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategoriobat`
--

INSERT INTO `kategoriobat` (`idkategori`, `namakategori`, `deskripsikategori`, `gambarkategori`) VALUES
(10, 'Obat anak', 'Obat anak ....', '443b39c634c08d0df00c43781081f1ab-Kategori-anak.png'),
(11, 'Obat Dewasa', 'Obat Dewasa .................', '23e9e2d472bdd7dedc9eae10a7fc0385-Kategori-dewasa.png'),
(13, 'Obat ibu', 'Kategori ibu ...........', '006d277c183d6ba54ad12c94b4471f9a-Kategori-ibu.png'),
(14, 'Obat Lansia', 'Obat Lansia .............', '93180fcfb336e0550820b218d317a39e-kategori-lansia.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderproduk`
--

CREATE TABLE `orderproduk` (
  `idorder` int(5) NOT NULL,
  `namapel` varchar(40) NOT NULL,
  `alamatpel` text NOT NULL,
  `kodepospel` int(6) NOT NULL,
  `telponpel` varchar(15) NOT NULL,
  `emailpel` varchar(40) NOT NULL,
  `catatanpel` text NOT NULL,
  `jumlahorder` int(15) NOT NULL,
  `tagihanorder` varchar(15) NOT NULL,
  `statusorder` int(15) NOT NULL,
  `linkproduk` text NOT NULL,
  `idobat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderproduk`
--

INSERT INTO `orderproduk` (`idorder`, `namapel`, `alamatpel`, `kodepospel`, `telponpel`, `emailpel`, `catatanpel`, `jumlahorder`, `tagihanorder`, `statusorder`, `linkproduk`, `idobat`) VALUES
(1, 'test nama', 'alamat', 98089, '908098098', '104', 'dasd catatan', 1, '12312312', 2, 'adasdasd', 1),
(3, 'sd xxx', 'xxxxxx', 123, '123', '123', '123123', 3, 'tambah insert', 2, '1', 72),
(10, 'asdasd bv', 'alamat', 2379, '2379', '2379', '123123', 4, 'asdasd tambah o', 2, '1', 72),
(21, 'Depan belakang', 'bumiayu jalan jalan', 8908, '8908', '8908', '8089080980', 2, 'Tambah tablet k', 207, '1', 72),
(22, 'Hasyim Asyari', 'Bumiayu bumiayu Bumiayu bumiayuBumiayu bumiayuBumiayu bumiayu', 798, '798', '798', '9879987', 2, 'ada tambah byun', 2, '1', 72),
(26, 'asd asd', 'asd', 123, '1231', 'asdasd@gmail.com', 'asdasd', 3, '69369369', 1, 'http://localhost/daribintangbikinappapotik/index-detailproduk.php?idobat=70', 70);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produkobat`
--

CREATE TABLE `produkobat` (
  `idobat` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namaobat` varchar(255) NOT NULL,
  `hargaobat` varchar(255) NOT NULL,
  `gambarobat` text NOT NULL,
  `deskripsiobat` text NOT NULL,
  `stokobat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produkobat`
--

INSERT INTO `produkobat` (`idobat`, `idkategori`, `namaobat`, `hargaobat`, `gambarobat`, `deskripsiobat`, `stokobat`) VALUES
(70, 13, 'PARAMEX FLU & BATUK PE TABLET (Per Strip isi 4 Tablet) (per Strip)x', '7000', 'e528fafa36ff1357b37814dac516bb7e-obatbatuk.jpg', 'Tablet obat aflu yang disertai batuk tidak berdahak', 87),
(72, 10, 'IBU DAN ANAK OBAT BATUK 150ML (per Botol)', '51000', '9a1f9fa27ccde05fc3adf645436efd54-obatbatuk.jpg', 'melegakan tenggorokan, batuk, batuk berdahak, dan suara hilang.', 0),
(74, 10, 'PARACETAMOL MEF 500MG TABLET (per Strip)', '30000', '28f8c438d0de2913a043829a44a34427-apotek_online_k24klik_2020102202003123085_Edit-Produk-13.jpg', 'Paracetamol Mef 500 mg Tab 100 S obat apa?  Paracetamol Mef memiliki kandungan bahan aktif Paracetamol yang bekerja dengan cara mengurangi kadar prostaglandin di dalam tubuh, sehingga tanda peradangan seperti demam dan nyeri akan berkurang. Obat ini digunakan untuk meringankan rasa sakit seperti sakit kepala, sakit gigi serta menurunkan demam.\r\n\r\nParacetamol Mef 500 mg Tab 100 S dapat dikonsumsi sesudah makan. Konsultasikan terlebih dahulu kepada dokter apabila akan digunakan pada pasien dengan kondisi:\r\n• Riwayat alergi terhadap kandungan obat ini.\r\n• Pasien dengan penyakit gangguan hati berat.\r\n• Pasien yang mengonsumsi alkohol dapat meningkatkan potensi kerusakan hati.\r\n• Pasien dengan penyakit gangguan ginjal.', 0),
(75, 14, 'asdasd', '123', '80ac7b660b7b16e5375dc3e7135d074d-obatbatuk.jpg', '12', 123),
(76, 14, 'sdasd', '122', '2a6ac4f2cd8d6e4c56c8195d9871f1cd-apotek_online_k24klik_2020102202003123085_Edit-Produk-13.jpg', 'daasd', 12),
(77, 13, 'asdad', '213', 'ba7c6465cbc4364e63515e42b45f62c4-obatbatuk.jpg', 'aad', 123),
(78, 13, 'asdasd', '213', '893acfc2227255b7f10d5b0541400eba-obatbatuk.jpg', 'adad', 123),
(79, 13, 'asdasd', '123', '26d032a31700e0629d80eecb64a09fce-20220110032234Paramex-FB-Pe-3.png', 'asdad', 213),
(80, 10, 'adasd', '123', '0d28ec6779db744a746e4826731dcea0-obatbatuk.jpg', 'asdad', 123);

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `idset` int(4) NOT NULL,
  `setlogo` text NOT NULL,
  `seticon` text NOT NULL,
  `setalamat` text NOT NULL,
  `setphone` varchar(15) NOT NULL,
  `setemail` varchar(25) NOT NULL,
  `setfb` varchar(15) NOT NULL,
  `setig` varchar(15) NOT NULL,
  `settwit` varchar(15) NOT NULL,
  `setpin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`idset`, `setlogo`, `seticon`, `setalamat`, `setphone`, `setemail`, `setfb`, `setig`, `settwit`, `setpin`) VALUES
(1, 'f9c60c96af516c44c2a7903cf303681f-logo.png', 'f9c60c96af516c44c2a7903cf303681f-icon.png', 'jgjagsdj', '897897', 'email#fdasd.com', 'afasd', 'jgjg', 'gjasgj', 'jgjg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namauser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `namauser`) VALUES
(1, 'admin', 'admin', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategoriobat`
--
ALTER TABLE `kategoriobat`
  ADD PRIMARY KEY (`idkategori`) USING BTREE;

--
-- Indeks untuk tabel `orderproduk`
--
ALTER TABLE `orderproduk`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `idobat` (`idobat`);

--
-- Indeks untuk tabel `produkobat`
--
ALTER TABLE `produkobat`
  ADD PRIMARY KEY (`idobat`),
  ADD KEY `idkategori` (`idkategori`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`idset`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategoriobat`
--
ALTER TABLE `kategoriobat`
  MODIFY `idkategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `orderproduk`
--
ALTER TABLE `orderproduk`
  MODIFY `idorder` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `produkobat`
--
ALTER TABLE `produkobat`
  MODIFY `idobat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `idset` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produkobat`
--
ALTER TABLE `produkobat`
  ADD CONSTRAINT `produkobat_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategoriobat` (`idkategori`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
