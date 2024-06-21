-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2023 pada 05.37
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daengcamp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_produk`
--

CREATE TABLE `detail_produk` (
  `id_detail_produk` int(11) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `harga_barang` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_produk`
--

INSERT INTO `detail_produk` (`id_detail_produk`, `jumlah`, `harga_barang`, `id_produk`, `id_transaksi`) VALUES
(164, '5', '100000', 23, 122),
(165, '3', '100000', 23, 123),
(166, '2', '50000', 20, 125),
(167, '2', '50000', 20, 127),
(168, '3', '50000', 20, 128),
(169, '1', '50000', 20, 130),
(170, '1', '100000', 21, 131),
(171, '1', '100000', 21, 132),
(172, '3', '100000', 21, 133),
(173, '3', '50000', 20, 133),
(174, '1', '100000', 21, 135),
(175, '2', '100000', 21, 136),
(176, '1', '100000', 21, 138),
(177, '1', '50000', 20, 139),
(178, '12', '100000', 21, 140),
(179, '6', '100000', 21, 141),
(180, '3', '100000', 21, 142),
(181, '1', '100000', 21, 143),
(182, '1', '150000', 22, 144),
(183, '1', '50000', 20, 145),
(184, '1', '50000', 20, 146),
(185, '1', '50000', 20, 147),
(186, '1', '15000', 20, 148),
(187, '1', '5000', 26, 149),
(188, '1', '15000', 20, 150);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `gambar_kategori` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `gambar_kategori`) VALUES
(5, 'Semua Produk', 'Semua Product.png'),
(6, 'Paket Lengkap', 'Paket Lengkap.png'),
(7, 'Paket Hemat', 'Paket Hemat.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `stok` varchar(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `keterangan`, `stok`, `harga`, `gambar`, `id_kategori`) VALUES
(20, 'Hammock', 'Hammock adalah jenis tempat tidur yang tergantung yang ideal untuk bersantai dan menikmati waktu luang di luar ruangan. Terbuat dari kain yang kuat dan nyaman, hammock memberikan pengalaman tidur yang santai dan menyenangkan dengan sensasi berayun yang menenangkan. Cocok untuk berbagai kesempatan, seperti berkemah, acara piknik, pantai, taman, atau sebagai pilihan tidur', '1', 15000, 'Hammock.jpg', 5),
(21, 'Flysheet', 'Flysheet, juga dikenal sebagai tenda luar, adalah salah satu komponen penting dalam peralatan camping. Flysheet adalah lapisan luar tenda yang berfungsi sebagai pelindung dari elemen-elemen cuaca seperti hujan, angin, dan sinar matahari. Flysheet umumnya terbuat dari bahan tahan air dan tahan lama untuk menjaga kekeringan dan kenyamanan di dalam tenda.', '5', 15000, 'Flyshit.jpg', 5),
(22, 'Paket Lengkap 50K', 'Berisi\r\n- Tenda 2P\r\n-Flysheet\r\n-Matras\r\n-Hammock', '15', 50000, 'Paket L 50k.jpg', 6),
(23, 'Paket Lengkap 75K', 'Berisi\r\n- Tenda 2P\r\n-Flysheet\r\n-Matras\r\n-Hammock', '20', 75000, 'Paket L 75K.jpg', 6),
(24, 'Paket Lengkap 100K', 'Berisi\r\n- Tenda 2P\r\n-Flysheet\r\n-Matras\r\n-Hammock\r\n-Alat Masak\r\n-Kompor', '20', 100000, 'Paket L 100K.jpg', 6),
(26, 'Bantal Angin', 'Bantal angin adalah salah satu peralatan camping yang populer digunakan untuk memberikan kenyamanan ekstra saat tidur di tenda. Bantal angin dirancang secara khusus untuk memungkinkan pengguna mengatur tingkat kekenyamanan sesuai dengan preferensi individu. Alat ini terbuat dari bahan yang ringan dan dapat diisi dengan udara untuk menciptakan bantal yang empuk dan mendukung kepala dan leher dengan baik.', '16', 5000, 'Bantal Angin.jpg', 5),
(27, 'EGG Holder', 'Egg holder, juga dikenal sebagai penyimpan telur, adalah wadah khusus yang dirancang untuk melindungi telur selama perjalanan camping. Egg holder biasanya terbuat dari bahan yang kokoh dan dilengkapi dengan pemisah atau tray berlubang yang membantu menjaga telur tetap aman dan utuh. Alat ini dirancang untuk memungkinkan Anda membawa telur dalam keadaan utuh dan mencegah mereka pecah selama perjalanan.', '13', 5000, 'Egg holder.jpg', 5),
(28, 'Matras', 'Matras adalah salah satu peralatan camping yang penting untuk memberikan kenyamanan tidur di alam terbuka. Matras umumnya terbuat dari bahan yang empuk dan dapat mengisi ruang di antara tubuh dan permukaan tanah yang keras. Ini membantu dalam meningkatkan isolasi termal dan memberikan dukungan ergonomis untuk tubuh saat tidur di tenda.', '28', 10000, 'Matras.jpg', 5),
(29, 'Windshield', 'Windshield, juga dikenal sebagai penghalang angin atau pembatas angin, adalah peralatan camping yang digunakan untuk melindungi api unggun atau kompor dari angin. Windshield umumnya terbuat dari bahan yang tahan panas seperti logam atau aluminium foil yang dapat dipasang di sekitar api unggun atau kompor untuk mengurangi pengaruh angin yang dapat mengganggu atau memadamkan api.', '24', 5000, 'Windshiled.jpg', 5),
(30, 'Kursi lipat', 'Kursi lipat adalah salah satu peralatan camping yang praktis dan nyaman digunakan saat berada di alam terbuka. Kursi ini dirancang agar mudah dilipat dan portabel, sehingga memudahkan Anda membawanya saat berkemah, piknik, atau kegiatan outdoor lainnya. Terbuat dari bahan yang ringan dan kuat, kursi lipat memberikan tempat duduk yang stabil dan nyaman di lokasi camping.', '19', 15000, 'Kursi Lipat.jpg', 5),
(31, 'Tabung Gas', 'Tabung gas adalah peralatan camping yang digunakan sebagai sumber energi untuk kompor  saat berada di luar ruangan. Alat ini memainkan peran penting dalam menyediakan sumber energi yang aman dan efisien untuk memasak  selama camping.', '51', 15000, 'Tabung Gas.jpg', 5),
(32, 'Alat masak', 'Alat masak adalah peralatan camping yang digunakan untuk memasak makanan saat berada di alam terbuka. Peralatan ini dirancang khusus untuk keperluan memasak di luar ruangan dan terbuat dari bahan yang tahan panas dan ringan. Alat masak meliputi wajan, panci dan spatula untuk memasak dan menyiapkan hidangan saat camping.', '17', 15000, 'alat masak.jpg', 5),
(33, 'Kompor', 'Kompor adalah salah satu peralatan camping yang digunakan untuk memasak makanan saat berada di alam terbuka. Kompor camping dirancang khusus agar dapat digunakan di luar ruangan dan biasanya menggunakan bahan bakar gas seperti butana atau propana. Kompor ini memiliki mekanisme yang aman dan efisien dalam menghasilkan api yang dapat digunakan untuk memasak, merebus air, atau menghangatkan makanan saat camping.', '31', 20000, 'kompor.jpg', 5),
(34, 'Tenda Kapasitas 3-4 Orang', 'Tenda kapasitas 3-4 orang adalah peralatan camping yang dirancang untuk memberikan tempat tinggal yang nyaman dan perlindungan dari cuaca saat berada di alam terbuka. Tenda ini memiliki ukuran yang ideal untuk menampung 3 hingga 4 orang dewasa dengan peralatan tidur dan barang bawaan yang cukup. Terbuat dari bahan yang tahan air dan tahan angin, tenda ini memberikan ruang privasi dan keamanan selama camping.', '100', 50000, 'Tenda Kap 4.jpg', 5),
(35, 'Tenda kapasitas 2 orang ', 'Tenda kapasitas 2 orang adalah peralatan camping yang dirancang untuk memberikan tempat tinggal yang nyaman dan perlindungan dari cuaca saat berada di alam terbuka. Tenda ini memiliki ukuran yang ideal untuk menampung 2 orang dewasa dengan peralatan tidur dan barang bawaan yang cukup. Terbuat dari bahan yang tahan air dan tahan angin, tenda ini memberikan ruang privasi dan keamanan selama camping.', '100', 30000, 'Tenda Kap 2.jpg', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `telpon` int(14) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `tanggal_ambil` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `lama_sewa` int(255) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `name`, `telpon`, `lokasi`, `tanggal_ambil`, `status`, `lama_sewa`, `total_harga`, `id_user`) VALUES
(122, 'Erick', 2147483647, 'samarinda', '2023-05-25 00:00:00', 'cancel', 2, 1000000, 6),
(123, 'Agus', 2147483647, 'jawi', '2023-05-25 00:00:00', 'cancel', 1, 300000, 6),
(124, 'Agus', 2147483647, 'jawi', '2023-05-25 00:00:00', 'cancel', 1, 0, 6),
(125, 'Asep', 821921981, 'pantai', '2023-05-25 00:00:00', 'cancel', 1, 100000, 6),
(126, 'Asep', 821921981, 'pantai', '2023-05-25 00:00:00', 'cancel', 1, 0, 6),
(127, 'Ikhsan', 2147483647, 'd', '2023-05-25 00:00:00', 'cancel', 2, 200000, 6),
(128, 'Adrian', 819191919, 'eeee', '2023-05-25 00:00:00', 'cancel', 1, 150000, 6),
(129, 'Adrian', 819191919, 'eeee', '2023-05-25 00:00:00', 'cancel', 1, 0, 6),
(130, 'asep2', 819191919, 'sss', '2023-05-25 00:00:00', 'cancel', 2, 100000, 6),
(131, 'agoess', 191919191, 'gunungg', '2023-05-25 00:00:00', 'cancel', 1, 100000, 6),
(132, 'user1', 2147483647, 'ssss', '2023-05-25 00:00:00', 'cancel', 2, 200000, 5),
(133, 'agus', 66666, 'bpppp', '2023-05-09 00:00:00', 'paid', 2, 900000, 5),
(134, 'agus', 66666, 'bpppp', '2023-05-09 00:00:00', 'cancel', 2, 0, 5),
(135, 'ad', 45, 'sa', '2023-05-25 00:00:00', 'paid', 3, 300000, 5),
(136, 'zuhri', 5565656, 'ddd', '2023-05-25 00:00:00', 'cancel', 2, 400000, 5),
(137, 'zuhri', 5565656, 'ddd', '2023-05-25 00:00:00', 'cancel', 2, 0, 5),
(138, 'kk', 909, 'samarinda', '2023-05-25 00:00:00', 'cancel', 1, 100000, 5),
(139, 'awkkw', 2147483647, 'esteh', '2023-07-28 00:00:00', 'cancel', 1, 50000, 6),
(140, 'anj', 2147483647, 'pantai', '2023-05-31 00:00:00', 'cancel', 2, 2400000, 5),
(141, 'test ', 281812, 'f', '2023-10-24 00:00:00', 'cancel', 2, 1200000, 5),
(142, 'tes', 921921, 'tes', '2023-05-29 00:00:00', 'cancel', 2, 600000, 5),
(143, 'ajaj', 909, 'dd', '2023-02-28 00:00:00', 'cancel', 1, 100000, 6),
(144, 'adrian', 192191021, 'ss', '2023-05-29 00:00:00', 'cancel', 2, 300000, 6),
(145, 'test', 128019812, 's', '2023-05-30 12:00:00', 'cancel', 2, 100000, 6),
(146, 'tes2', 2147483647, 'ss', '2023-05-31 13:00:00', 'cancel', 2, 100000, 6),
(147, 'test5', 82198281, 'ss', '2023-05-31 12:00:00', 'cancel', 2, 100000, 5),
(148, 'diki', 2147483647, 'BPP', '2023-05-30 13:00:00', 'Pending', 1, 15000, 5),
(149, 'Salman', 790809, 'Bpp', '2023-06-01 12:05:00', 'paid', 1, 5000, 5),
(150, 'diki', 324242, 'BPP', '2023-06-22 12:00:00', 'Pending', 1, 15000, 5),
(151, 'diki', 324242, 'BPP', '2023-06-22 12:00:00', 'Pending', 1, 0, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `alamat`, `no_hp`, `email`, `password`, `user_type`) VALUES
(4, 'admin', 'admin', '123', 'admin@gmail.com', '$2y$10$P2KHIlWezJ.M.61nRE1p1OOZHtwzcL.o7/RXfqUkzMrJEtFYHGxBi', 'admin'),
(5, 'user', 'user', '81919191', 'user@gmail.com', '$2y$10$mvZyUjq0K2QABtfNgLegjeCwUtlUZjzk0C6Uoph8KFWR80lw0PZl.', 'user'),
(6, 'user2', 'jajajajajajajaj', '0821212112', 'user2@gmail.com', '$2y$10$x5w/IaYVw96xfTlQT7RSK.dRXzHJe5USjXZkyV1goe8CH84eOaq2S', 'user'),
(7, 'Erick', 'Jl. Manunggal', '0812929121921', 'firmansyaherick41@gmail.com', '$2y$10$t3imXh3jRMyqrJBGA51apOMh3D.SC1ldFkqr0A8zQZZ0UG9k0089K', 'admin'),
(8, 'User 3', 'okwakwaoka', '081276537551', 'user3@gmail.com', '$2y$10$19dLHQtfKF82gRiCp8WxZu9gxfVm05IVBGJHg4nCrpbDFoiZYJjmi', 'user'),
(10, 'user5', 'oakawkak', '092019092', 'user5@gmail.com', '$2y$10$V4xbDTkKATY/1/Q2EkmTEuGy91ybpiYAcvZL6CEpvXaJeucPjyp3W', 'admin'),
(11, 'Admin2', 'jalan', '08291299219', 'admin2@gmail.com', '$2y$10$4UP5jUZULTEeyFkVbbB3zORd1uXtuzX.88jIfPJoIutJjx/1l9waq', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD PRIMARY KEY (`id_detail_produk`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_produk`
--
ALTER TABLE `detail_produk`
  MODIFY `id_detail_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD CONSTRAINT `detail_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`),
  ADD CONSTRAINT `detail_produk_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
