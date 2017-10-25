-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 20 Jun 2017 pada 09.09
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p2d4ti06_test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_book`
--

CREATE TABLE `daftar_book` (
  `id` int(10) UNSIGNED NOT NULL,
  `homestay` int(10) UNSIGNED DEFAULT NULL,
  `id_transaksi` int(10) UNSIGNED DEFAULT NULL,
  `nama_pemesan` varchar(255) DEFAULT NULL,
  `jumlah_kamar` int(255) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL,
  `permintaan_khusus` text,
  `jumlah_tamu` int(10) DEFAULT NULL,
  `total_harga` int(10) DEFAULT NULL,
  `lama_menginap` int(10) DEFAULT NULL,
  `extrabed` int(2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar_book`
--

INSERT INTO `daftar_book` (`id`, `homestay`, `id_transaksi`, `nama_pemesan`, `jumlah_kamar`, `tanggal_mulai`, `tanggal_berakhir`, `permintaan_khusus`, `jumlah_tamu`, `total_harga`, `lama_menginap`, `extrabed`, `status`) VALUES
(29, 9, NULL, 'Andre Sitorus', 2, '2017-06-22', '2017-06-22', NULL, 4, 330000, 1, 1, 1),
(30, 9, NULL, 'Kevin Siahaan', 2, '2017-06-24', '2017-06-24', NULL, 3, 630000, 2, 1, 1),
(31, 9, NULL, 'Evrin Lumban Tobing', 3, '2017-07-13', '2017-07-13', NULL, 4, 930000, 2, 1, 1),
(33, 13, 40, 'Sudarsono Sianipar', 2, '2017-06-23', '2017-06-25', 'Serapan Pagi', 4, 660000, 2, 2, 0),
(36, 9, 43, 'Sudarsono Sianipar', 2, '2017-06-22', '2017-06-24', 'Serapan Pagi', 4, 630000, 2, 1, 0),
(37, 9, 44, 'Sudarsono Sianipar', 1, '2017-07-12', '2017-07-14', 'Kopi di pagi hari', 2, 300000, 2, 0, 0),
(38, 9, 45, 'Lesa Lesuu ', 1, '2017-07-13', '2017-07-16', 'Kopi di pagi hari', 2, 450000, 3, 0, 0),
(39, 9, 46, 'Ranti Veronika Sidauruk', 1, '2017-06-19', '2017-06-20', 'Bantalnya besar', 1, 210000, 1, 2, 0),
(41, 9, 48, 'Patresia Ratu Wetti Sitanggang', 1, '2017-07-13', '2017-07-15', 'Kamar yang bersih', 2, 300000, 2, 0, 0),
(42, 9, 49, 'Febby Simanjuntak', 1, '2017-08-14', '2017-08-17', 'Kopi Pahit ', 2, 480000, 3, 1, 0),
(44, 13, 51, 'Lesa Lesuu ', 1, '2017-08-10', '2017-08-13', 'Kopi di pagi hari', 2, 480000, 3, 1, 0),
(45, 13, 52, 'kamna', 1, '2017-06-16', '2017-06-18', 'air panas selama nginap', 1, 330000, 2, 1, 0),
(46, 13, 53, 'Abdi Elman Daniel Aruan', 1, '2017-07-31', '2017-08-20', 'Saya mau setiap malam ada gadis menemani saya tidur.', 1, 3030000, 21, 1, 0),
(49, 13, 56, 'meva gustina sidauruk', 1, '2017-06-17', '2017-06-18', 'sarapan dan makan \r\nkamar bersih dan harum, ber-AC', 2, 150000, 1, 0, 0),
(50, 9, 57, 'Lesa Lesuu ', 2, '2017-07-14', '2017-07-17', 'kopi', 2, 930000, 3, 1, 0),
(52, 9, 59, 'Lesa Lesuu ', 2, '2017-08-24', '2017-08-27', 'terdasdsada', 4, 900000, 3, 0, 0),
(53, 13, 64, 'Angelika Simanjuntak', 1, '2017-07-08', '2017-07-10', '', 1, 300000, 2, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dinaspariwisata`
--

CREATE TABLE `dinaspariwisata` (
  `id_pegawai` int(10) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `divisi_pegawai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `dinaspariwisata`
--

INSERT INTO `dinaspariwisata` (`id_pegawai`, `nama_pegawai`, `divisi_pegawai`, `created_at`, `updated_at`) VALUES
(2, 'Juliper', 'Homestay', '2017-05-03 01:19:00', '2017-05-03 01:19:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pemilik_homestay` int(10) UNSIGNED DEFAULT NULL,
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `feedback` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `id_pemilik_homestay`, `id_pelanggan`, `feedback`, `created_at`, `updated_at`) VALUES
(4, 6, 2, 'Sesuatu banget ya homestay nya suka deh....', '2017-05-21 19:41:41', '2017-05-21 19:41:41'),
(5, 6, 6, 'Layanan nya Ok banget :)', '2017-06-10 00:38:07', '2017-06-10 00:38:07'),
(6, 6, 6, 'Lingkungannya ok, dan Memuaskan :)', '2017-06-14 19:13:30', '2017-06-14 19:13:30'),
(7, 18, 7, 'Pelayanan nya harus di tingkatkan lagi', '2017-06-17 04:13:58', '2017-06-17 04:14:04'),
(8, 25, 9, 'Nice cuy :)', '2017-06-17 04:14:36', '2017-06-17 04:14:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `homestay`
--

CREATE TABLE `homestay` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pemilik` int(10) UNSIGNED DEFAULT NULL,
  `nama_homestay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `harga` double NOT NULL,
  `fasilitas` text COLLATE utf8_unicode_ci,
  `gambar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `homestay`
--

INSERT INTO `homestay` (`id`, `id_pemilik`, `nama_homestay`, `owner`, `alamat`, `jumlah_kamar`, `harga`, `fasilitas`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(9, 6, 'Mawar Homestay', 'Palti Sinaga', 'Balige', 4, 150000, 'Homestay kami menyediakan jasa transportasi yaitu rental kereta, juga bahan-bahan untuk bakar ikan. kami juga menyediakan air panas untuk air mandi. Terdapat juga kasur tambahan jika anda ingin menambah kasur.', 'slide-01.jpg', '----', '2017-05-08 02:51:28', '2017-06-12 07:00:00'),
(13, 18, 'Dion Homestay', 'Dion Marpaung', 'Lumban Bul Bul', 4, 150000, NULL, 'ririn_slide.jpg', '----', '2017-06-12 06:35:42', '2017-06-12 06:43:40'),
(18, 25, 'Blessing Homestay', 'Balata Simangunsong', 'Lumban Bulbul', 3, 150000, ' ', 'balata_slide-01.jpg', '---', '2017-06-15 00:52:03', '2017-06-15 00:54:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_homestay` int(10) UNSIGNED DEFAULT NULL,
  `id_transaksi` int(10) UNSIGNED DEFAULT NULL,
  `nomor_kamar` int(10) UNSIGNED NOT NULL,
  `jumlah_bed` int(10) DEFAULT NULL,
  `fasilitas` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `tamu_per_kamar` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id`, `id_homestay`, `id_transaksi`, `nomor_kamar`, `jumlah_bed`, `fasilitas`, `gambar`, `tamu_per_kamar`) VALUES
(8, 9, 1, 1, 3, '', '20170506_121535.jpg', 3),
(9, 9, 1, 2, 2, '', '20170506_121556.jpg', 3),
(10, 9, 1, 3, 1, '', '20170506_121048.jpg', 3),
(11, 9, NULL, 4, 2, '', '20170506_121311.jpg', 3),
(22, 13, NULL, 1, 2, '', '20170506_124200.jpg', NULL),
(23, 13, NULL, 2, 2, 'Tempat tidur untuk 2 orang', '20170506_124225.jpg', NULL),
(24, 13, NULL, 3, 2, '', '20170506_124239.jpg', NULL),
(25, 13, NULL, 4, 2, '', '20170506_124121.jpg', NULL),
(40, 18, NULL, 1, 2, '', 'kamarB.jpg', NULL),
(41, 18, NULL, 2, 2, '', 'kamarA.png', NULL),
(42, 18, NULL, 3, 2, '', 'kamarC.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategorifasilitas`
--

CREATE TABLE `kategorifasilitas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_fasilitas` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategorifasilitas`
--

INSERT INTO `kategorifasilitas` (`id`, `nama_fasilitas`) VALUES
(1, 'Kamar Tidur'),
(2, 'Perlatan Kamar Mandi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_04_19_090402_Pelanggan', 2),
(4, '2017_04_19_090837_Admin', 2),
(5, '2017_04_19_091320_DinasPariwisata', 2),
(6, '2017_04_19_091651_PemilikiHomestay', 2),
(7, '2017_04_19_092041_Homestay', 2),
(8, '2017_04_19_101431_Pemesanan', 2),
(9, '2017_04_20_092606_Pembayaran', 2),
(10, '2017_04_22_074954_Feedback', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('sudar@gmail.com', '622e3e0cd4a12d559a0f4da520c3acc69bff5425bd67d084ce473cecd26eeab7', '2017-06-10 00:12:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_Akun` int(10) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_telepon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(2555) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `id_Akun`, `nama`, `alamat`, `no_telepon`, `pekerjaan`, `foto`, `created_at`, `updated_at`) VALUES
(2, 14, 'Lesa Lesuu ', 'Medan Bung', '082134657865', 'Panortor Profesional', NULL, '2017-05-09 02:32:54', '2017-05-09 21:46:55'),
(6, 28, 'Sudarsono Sianipar', 'Siborong borong', '082272194654', 'Mahasiswa', NULL, '2017-06-10 00:04:53', '2017-06-10 00:20:12'),
(7, 37, 'Anggiat', 'Jakarta', '082145658976', 'CEO Trans', NULL, '2017-06-15 00:32:34', '2017-06-15 00:34:53'),
(8, 39, 'Ranti Veronika Sidauruk', 'Onan Raja, Balige', '1234', 'Mahasiswa', NULL, '2017-06-15 20:52:34', '2017-06-15 20:53:30'),
(9, 40, 'Bayu', '---', '---', '---', NULL, '2017-06-15 21:00:19', '2017-06-15 21:00:19'),
(10, 41, 'Patresia Ratu Wetti Sitanggang', '---', '---', '---', NULL, '2017-06-15 21:11:59', '2017-06-15 21:11:59'),
(11, 42, 'Febby Simanjuntak', '---', '---', '---', NULL, '2017-06-15 21:22:07', '2017-06-15 21:22:07'),
(12, 43, 'andi', '---', '---', '---', NULL, '2017-06-15 21:40:57', '2017-06-15 21:40:57'),
(13, 44, 'kamna', '---', '---', '---', NULL, '2017-06-15 22:16:41', '2017-06-15 22:16:41'),
(14, 45, 'Abdi Elman Daniel Aruan', '---', '---', '---', NULL, '2017-06-15 22:30:24', '2017-06-15 22:30:24'),
(15, 46, 'meva gustina sidauruk', '---', '---', '---', NULL, '2017-06-15 23:38:43', '2017-06-15 23:38:43'),
(16, 47, 'tina', '---', '---', '---', NULL, '2017-06-16 00:54:13', '2017-06-16 00:54:13'),
(17, 48, 'Herbert Siamanjuntak', '---', '---', '---', NULL, '2017-06-18 06:03:28', '2017-06-18 06:03:28'),
(18, 49, 'Herbert Siamanjuntak', '---', '---', '---', NULL, '2017-06-18 06:06:05', '2017-06-18 06:06:05'),
(19, 50, 'Martupa', '---', '---', '---', NULL, '2017-06-18 06:06:58', '2017-06-18 06:06:58'),
(20, 51, 'Jordan Parapat', '---', '---', '---', NULL, '2017-06-18 20:46:59', '2017-06-18 20:46:59'),
(21, 52, 'Jonatan Parapat', '---', '---', '---', NULL, '2017-06-18 20:48:33', '2017-06-18 20:48:33'),
(22, 53, 'Angelika Simanjuntak', '---', '---', '---', NULL, '2017-06-18 20:49:54', '2017-06-18 20:49:54'),
(23, 54, 'Yesica Tampubolon', '---', '---', '---', NULL, '2017-06-18 20:51:02', '2017-06-18 20:51:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilikhomestay`
--

CREATE TABLE `pemilikhomestay` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_akun` int(10) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_telepon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pemilikhomestay`
--

INSERT INTO `pemilikhomestay` (`id`, `id_akun`, `nama`, `alamat`, `pekerjaan`, `no_telepon`, `no_rekening`, `foto`, `created_at`, `updated_at`) VALUES
(6, 5, 'Marlina Siamangunsong', 'Balige', 'Petani', '6282272194654', '12345678981', 'bulbul-01_gdsl53-1.jpg', '2017-04-29 08:07:38', '2017-06-15 20:20:13'),
(18, 30, 'Dion Marpaung', 'Lumban Bulbul', 'Wiraswasta', '6282272194654', '3123412431', 'map.JPG', '2017-06-12 06:34:07', '2017-06-15 22:27:09'),
(25, 38, 'Balata Simangunsong', 'Lumban Bulbul', 'Wiraswasta', '6282272194654', '1234567898765', 'lesa2.jpg', '2017-06-15 00:52:03', '2017-06-15 22:28:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `requestfasilitas`
--

CREATE TABLE `requestfasilitas` (
  `id` int(11) NOT NULL,
  `id_pemilik_homestay` int(10) UNSIGNED DEFAULT NULL,
  `id_kategori_fasiltas` int(10) UNSIGNED DEFAULT NULL,
  `nama_request_fasilitas` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `notif` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `requestfasilitas`
--

INSERT INTO `requestfasilitas` (`id`, `id_pemilik_homestay`, `id_kategori_fasiltas`, `nama_request_fasilitas`, `deskripsi`, `jumlah`, `gambar`, `pesan`, `status`, `notif`) VALUES
(1, 6, 1, 'Keramik Pecah', ' Terjadi Gempa dan mengakibatkan keramik kamar homestay retak yang menyebabkan ketidak nyaman pelanggan', 100, 'images2.jpg', ' ini adalah kepentingan anda', 2, 2),
(2, 18, 1, 'Asbes Bocor', ' Hujan deras mengguyur perkampungan lumban bul bul selama 2 minggu', 4, 'download (1).jpg', '', 2, 2),
(3, 6, 1, 'Keramik Pecah', 'Terjadi Gempa Berkepanjangan ', 100, 'Agar-Keramik-Tidak-Meledak.jpg', ' Ini bukan tanggung jawab Dinas Pariwisata', 2, 2),
(4, 6, 1, 'Penambahan Bunkbed', 'Kekurangan Bunkbed', 3, NULL, NULL, 1, 2),
(5, 6, 2, 'Keramik Pecah', ' Terjadi Gempa', 100, 'Agar-Keramik-Tidak-Meledak.jpg', ' Bukan Urusan Kami !!!', 2, 2),
(6, 18, 1, 'Keramik Pecah', 'Terjadi Gempa dasyat', 1000, 'Agar-Keramik-Tidak-Meledak.jpg', 'Saya tdak bis menolerir', 0, 0),
(7, 6, 1, 'Keramik Pecah', ' terjadi gempa', 100, 'Agar-Keramik-Tidak-Meledak.jpg', NULL, 1, 2),
(8, 6, 1, 'Keramik Pecah', ' asdf', 3, 'Agar-Keramik-Tidak-Meledak.jpg', '', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pelanggan` int(10) UNSIGNED NOT NULL,
  `id_homestay` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `jumlah_kamar` int(10) NOT NULL,
  `lama_menginap` int(10) NOT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `total_pembayaran` int(10) DEFAULT NULL,
  `jumlah_tamu` int(5) DEFAULT NULL,
  `permintaan_khusus` text,
  `extrabed` int(2) DEFAULT NULL,
  `tanggal_konfirmasi` date DEFAULT NULL,
  `status` int(1) UNSIGNED ZEROFILL DEFAULT NULL,
  `notif` int(1) DEFAULT '0',
  `pesan` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `id_homestay`, `tanggal_mulai`, `tanggal_berakhir`, `jumlah_kamar`, `lama_menginap`, `bukti_pembayaran`, `total_pembayaran`, `jumlah_tamu`, `permintaan_khusus`, `extrabed`, `tanggal_konfirmasi`, `status`, `notif`, `pesan`) VALUES
(31, 6, 9, '2017-06-16', '2017-06-17', 1, 3, NULL, 450000, 1, 'Penydiaan Kopi di malam Hari', NULL, NULL, 2, 1, ''),
(38, 2, 13, '2017-06-16', '2017-06-19', 2, 3, '17125558_400556056985554_5641874030777597952_n.jpg', 930000, 4, 'Kopi di pagi hari', 1, NULL, 1, 1, ''),
(39, 6, 9, '2017-07-05', '2017-07-08', 2, 3, '17125558_400556056985554_5641874030777597952_n.jpg', 900000, 2, 'Sarapan Pagi', 0, NULL, 1, 1, ''),
(40, 6, 13, '2017-06-23', '2017-06-25', 2, 2, 'bukti-transfer-ke-rekening-nikita.jpg', 660000, 4, 'Serapan Pagi', 2, NULL, 1, 1, ''),
(41, 7, 13, '2017-06-15', '2017-06-17', 1, 2, NULL, 330000, 2, 'Makan Malam dengan Lauk Napinadar', 1, NULL, 2, 1, ''),
(42, 6, 9, '2017-06-20', '2017-06-22', 1, 2, '17125558_400556056985554_5641874030777597952_n.jpg', 330000, 2, 'Pemanas Air', 1, NULL, 2, 1, ''),
(43, 6, 9, '2017-06-22', '2017-06-24', 2, 2, NULL, 630000, 4, 'Serapan Pagi', 1, NULL, 0, 0, ''),
(44, 6, 9, '2017-07-12', '2017-07-14', 1, 2, NULL, 300000, 2, 'Kopi di pagi hari', 0, NULL, 0, 0, ''),
(45, 2, 9, '2017-07-13', '2017-07-16', 1, 3, NULL, 450000, 2, 'Kopi di pagi hari', 0, NULL, 0, 0, ''),
(46, 8, 9, '2017-06-19', '2017-06-20', 1, 1, 'bukti-transfer-ke-rekening-nikita.jpg', 210000, 1, 'Bantalnya besar', 2, NULL, 1, 1, ''),
(47, 9, 9, '2017-06-29', '2017-07-04', 1, 5, 'anggiat.jpg', 780000, 2, 'kamar ada cewe nya, ups', 1, NULL, 2, 1, ''),
(48, 10, 9, '2017-07-13', '2017-07-15', 1, 2, '17125558_400556056985554_5641874030777597952_n.jpg', 300000, 2, 'Kamar yang bersih', 0, NULL, 1, 1, ''),
(49, 11, 9, '2017-08-14', '2017-08-17', 1, 3, '17125558_400556056985554_5641874030777597952_n.jpg', 480000, 2, 'Kopi Pahit ', 1, NULL, 1, 1, ''),
(50, 12, 9, '2017-07-20', '2017-07-22', 1, 2, '17125558_400556056985554_5641874030777597952_n.jpg', 300000, 2, 'kipas angimnn', 0, NULL, 1, 1, ''),
(51, 2, 13, '2017-08-10', '2017-08-13', 1, 3, '17125558_400556056985554_5641874030777597952_n.jpg', 480000, 2, 'Kopi di pagi hari', 1, NULL, 1, 1, ''),
(52, 13, 13, '2017-06-16', '2017-06-18', 1, 2, '17125558_400556056985554_5641874030777597952_n.jpg', 330000, 1, 'air panas selama nginap', 1, NULL, 1, 1, ''),
(53, 14, 13, '2017-07-31', '2017-08-20', 1, 20, '17125558_400556056985554_5641874030777597952_n.jpg', 3030000, 1, 'Saya mau setiap malam ada gadis menemani saya tidur.', 1, NULL, 1, 1, ''),
(54, 2, 13, '2017-07-20', '2017-07-23', 1, 3, NULL, 450000, 2, 'SERAPAN PAGI !!', 0, NULL, 2, 0, ''),
(55, 6, 9, '2017-07-20', '2017-07-23', 2, 3, NULL, 900000, 4, 'kopi', 0, NULL, 2, 0, ' dasda'),
(56, 15, 13, '2017-06-17', '2017-06-18', 1, 1, 'resi1.jpg', 150000, 2, 'sarapan dan makan \r\nkamar bersih dan harum, ber-AC', 0, NULL, 1, 1, ''),
(57, 2, 9, '2017-07-14', '2017-07-17', 2, 3, '17125558_400556056985554_5641874030777597952_n.jpg', 930000, 2, 'kopi', 1, NULL, 1, 1, ''),
(58, 6, 9, '2017-08-17', '2017-08-20', 1, 3, NULL, 450000, 2, '', 0, NULL, 2, 0, ''),
(59, 2, 9, '2017-08-24', '2017-08-27', 2, 3, NULL, 900000, 4, 'terdasdsada', 0, NULL, 1, 1, ''),
(60, 6, 13, '2017-08-03', '2017-08-06', 1, 3, '17125558_400556056985554_5641874030777597952_n.jpg', 450000, 1, 'Serapan Pagi', 0, NULL, 1, 1, ''),
(61, 16, 9, '2017-07-05', '2017-07-08', 2, 3, '17125558_400556056985554_5641874030777597952_n.jpg', 900000, 3, 'sarapan', 0, NULL, 2, 0, NULL),
(62, 22, 13, '2017-06-28', '2017-06-30', 1, 2, NULL, 300000, 1, 'Serapan Pagi', 0, NULL, 2, 0, ''),
(63, 2, 9, '2017-08-03', '2017-08-05', 1, 2, '17125558_400556056985554_5641874030777597952_n.jpg', 360000, 1, '', 2, NULL, 2, 0, ''),
(64, 22, 13, '2017-07-08', '2017-07-10', 1, 2, '17125558_400556056985554_5641874030777597952_n.jpg', 300000, 1, '', 0, NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `foto`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Juliper', 'admin', 'admin@del.ac.id', '$2y$10$nnnUgQAnb9FnDb3DNTlwaehkE5GiJ6piv8Yg/LXyXypdgaxigpHVe', 'gravatar.png', 'DinasPariwisata', 'u5CvHMxdx6GUmvCsVXTHbNOzcfJAN9UsOL3PiaHmgbisoX159yJmWcoK7P6n', '2017-04-22 02:30:14', '2017-06-19 20:43:12'),
(5, 'Marlina Siamangunsong', 'mawar', 'palti1@gmail.com', '$2y$10$2XX4mgDpJX7GjCInI2lqd.mfVcgGlT/8v67HjqLbCi0.wCEoZkytq', 'bulbul-01_gdsl53-1.jpg', 'Owner', 'glgBrKiPRbX8k0ni4RdTAmP1Hed02UCkuVgaA0qznQsTIgyE752BVSVUMDFO', '2017-04-29 08:07:38', '2017-06-19 23:48:49'),
(14, 'Lesa Lesuu ', 'lesa', 'lesa@gmail.com', '$2y$10$zudTTxc6.lENGpFKwp093u9SuvEjidfYExLHk3vsOvZISDma1HChW', 'anonymous1.jpg', 'Customer', 'Jg9DWiNrNvjgxXJyq9u5pGnaMzeIUE92GufmVNAGuXTege0gDw473f2lFycC', '2017-05-09 02:41:21', '2017-06-19 03:50:42'),
(28, 'Sudarsono Sianipar', 'sudaraja', 'sudar@gmail.com', '$2y$10$pT.It3G0VrMqlYG5X4C6o.U/34qBTo8KTV3WwMB/IRxlByxGwwR7i', '1469993_725963404098414_1076561403_n.jpg', 'Customer', 'UizqHZLTSUT9mEfE7kwYitSIyeR46S5rViz3zi9SeftHZ6p0HZDd0jqrHxIu', '2017-06-10 00:04:53', '2017-06-17 06:00:39'),
(30, 'Dion Marpaung', 'dionmarpa', 'dion@gmail.com', '$2y$10$sZxys5lQucdsSd3ahMbi7esS8qDhBdt3AF4.QRnWXm0Ho.qrtCRr.', 'map.JPG', 'Owner', 'grt2fILIQ49PivPO45ALV5rAw9Ht8twwnFBR8YXJqBa3TzKJNRx66Zoa3hBU', '2017-06-12 06:34:07', '2017-06-20 00:00:51'),
(37, 'Anggiat', 'anggiat', 'anggiat@gmail.com', '$2y$10$qk1D1kypJ6B.syioRwmHUeq71KCNBewPMDXxLTtV.rB4yhIxGRKoK', 'anggiat.jpg', 'Customer', 'vZDhTCr0vPQRiBbMpKsfNLg6NGnOQNZiPvy3z4SFFzY5SmLMSyxzZFry5vww', '2017-06-15 00:32:34', '2017-06-17 02:03:53'),
(38, 'Balata Simangunsong', 'balata', 'balata@gmail.com', '$2y$10$8CkZ/1cNwfFj5tA1.InreuzKnxPO11xGi8EipLC3MyAHJEzatbVVi', 'lesa2.jpg', 'Owner', '2BxDxn3OaqHh2HJu6q4hi4FasjlDUSGwlkEyM4Czi4gfDkOycaAdeu6815hn', '2017-06-15 00:52:03', '2017-06-19 07:00:42'),
(39, 'Ranti Veronika Sidauruk', 'rantisidauruk', 'vsranti@gmail.com', '$2y$10$XqUXtrKaYuxbQqTsPBJ0f.xuADmCyeDBmCo..rCigghICRxcLtq4O', 'gravatar.png', 'Customer', 'DHLak4sIr740aq8cyiv7pCLdzfGti1MhI00HjCpS8ziXElouwCPU99gRo3GA', '2017-06-15 20:52:34', '2017-06-15 20:57:38'),
(40, 'Bayu', 'bayu', 'bayu@yahoo.com', '$2y$10$jMBjam7qnWLzT.rOp9wlqOmxZw8y9F5jBXgvsHVCAXv4R21tWc7Di', 'gravatar.png', 'Customer', 'yDc0A5Cs2mlTdQsRsTba94jiSSPcIKhO7Z3NxPH3yFyfYarieIZsaNl6jJvP', '2017-06-15 21:00:19', '2017-06-15 21:08:50'),
(41, 'Patresia Ratu Wetti Sitanggang', 'Cia', 'mrs15010@students.del.ac.id', '$2y$10$YrrvJhjaPWB9p1VgXKzYL.py7ok/PDxAsfdDejzYtnqpr9KrHrT1q', 'gravatar.png', 'Customer', 'lmRwTqz53YIQpgdOTxlxxEaEirEWIc5coQarK29TTiXCfwKpuIS1oZ2SPSpK', '2017-06-15 21:11:59', '2017-06-15 21:18:10'),
(42, 'Febby Simanjuntak', 'iss16017', 'febbysimanjuntak123@gmail.com', '$2y$10$Hl3RTnw62PMb8xMccMkYmO62JPf8bZqXQoSWQB9/N8oE2U2NjnNM2', 'gravatar.png', 'Customer', 'aBOXgeXqv11op5su37BdLvZGHal9XHP2bN8etAtYJ4VPGhgDjRc2u1qiG4pv', '2017-06-15 21:22:07', '2017-06-15 21:30:52'),
(44, 'kamna', 'kamnaet', 'nataliakamna@gmail.com', '$2y$10$pcqDj4U5a./yc01F7.BFeOtxnts3RKUxm3SfcdXrlqL.uHMiE1/1u', 'gravatar.png', 'Customer', 'Fuu8k6yW33zzsmimNyzYlFIFi4mIpKwiLSs9pt40floVzWZ9EIfo3aywmRRU', '2017-06-15 22:16:40', '2017-06-15 22:26:36'),
(45, 'Abdi Elman Daniel Aruan', 'reboot', 'abdiaruan99@gmail.com', '$2y$10$WygNPwoK7eBm3z385zQCkuLIMFReS9jAZFJtLZ4vkO7yFYRvQvbJq', 'gravatar.png', 'Customer', 'QBJT6TlgsLpnisTiqwObvTeDLPaCjmN3BbAGAsGzfvu5tVpVHkHyVCU8Y0Ah', '2017-06-15 22:30:24', '2017-06-15 22:36:39'),
(46, 'meva gustina sidauruk', 'mevagsidauruk', 'mevagustina@gmail.com', '$2y$10$TbyUZbF0lOEfhZ1yROGy.uWsApGT0m01p6vfzJTZx2sFCsKacNOfS', 'gravatar.png', 'Customer', 'VmJegvycQVVv2dNIwK2OXficiO5znbP4BRgDwFqyC0oS1VlqXxqnkYr1fwFD', '2017-06-15 23:38:43', '2017-06-15 23:53:45'),
(47, 'tina', 'tina', 'tina@gmail.com', '$2y$10$OcKcuY9HqoFjZ6NqoOzRaueBSPQAJUklauEaQUKQGYtppnqC8syne', 'gravatar.png', 'Customer', 'LtDD0ckpRfvMLxNDMfWdbqpAZkI6RpnVEd0NpeYY9gLkdVsrZkv2e8XI9weL', '2017-06-16 00:54:13', '2017-06-16 01:15:24'),
(49, 'Herbert Siamanjuntak', 'herbet', 'herbet@gmail.com', '$2y$10$CcJhSFISR0o1XdEz8sr3BOaGMPYjiQYT7LYJz2z7XprLCJoPEfQKS', 'gravatar.png', 'Customer', NULL, '2017-06-18 06:06:05', '2017-06-18 06:06:05'),
(50, 'Martupa', 'martupa', 'tupa@gmail.com', '$2y$10$OBlUA8cOM1DKMsKdADbiaeXiwY/2hW3tsnJA8HansN/U14gmXfv6e', 'gravatar.png', 'Customer', '6RNs8EcbiwLd3GVqRJBsLP5DYjWbIZuaWLAIWRUDoSKwUc6MJpltOCgDVyGG', '2017-06-18 06:06:58', '2017-06-18 06:50:40'),
(51, 'Jordan Parapat', 'jordan', 'jordan@gmail.com', '$2y$10$FsAAG/mVPA/ebiweGXH.quGwUD8D31QltR2QjdJnxk.EyMm2Rn9.y', 'gravatar.png', 'Customer', '8qrNKC0yGx4rxl3excstF8bbEWVLJMIZqHl6igMPpapx12JGVd7kEWoUSsSI', '2017-06-18 20:46:59', '2017-06-18 20:49:04'),
(52, 'Jonatan Parapat', 'jonatan', 'jonatan@gmail.com', '$2y$10$wKlxCWprzZolSKAi0UGO4./cEzgnurVcXTL8sGberUUgAJrdV/546', 'gravatar.png', 'Customer', NULL, '2017-06-18 20:48:33', '2017-06-18 20:48:33'),
(53, 'Angelika Simanjuntak', 'angelika', 'angelika@gmail.com', '$2y$10$HHbCNEOwEfS71Dcly3CkBerm2BUtnklcPN5aTH/k.JYLtC.Sc6J9C', 'gravatar.png', 'Customer', '0ofGQe9mAedEzSFezvFtNNkzEgHT0Xov1ZOsYRcXYmCd4KjW4tmyXeUzsKEz', '2017-06-18 20:49:54', '2017-06-20 00:00:23'),
(54, 'Yesica Tampubolon', 'yesica', 'yesica@gmail.com', '$2y$10$eNpYWTwpBFncBslPabHz.uYD3N7X/.w2YW7j8SlSohgYKhwYSgAie', 'gravatar.png', 'Customer', 'AfNzUzIkXgdJhKRXDjazpl9izivPVCvJ45jXjpc7UyW9VOq0qGo3NoiGhDOn', '2017-06-18 20:51:02', '2017-06-18 20:51:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_book`
--
ALTER TABLE `daftar_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homestay` (`homestay`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `dinaspariwisata`
--
ALTER TABLE `dinaspariwisata`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPelanggan` (`id_pelanggan`),
  ADD KEY `id_pemilikHomestay` (`id_pemilik_homestay`);

--
-- Indexes for table `homestay`
--
ALTER TABLE `homestay`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama_homestay`),
  ADD UNIQUE KEY `id_owner` (`owner`),
  ADD KEY `id_owner_2` (`owner`),
  ADD KEY `idPemilik` (`id_pemilik`),
  ADD KEY `nama_2` (`nama_homestay`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPemesanan` (`id_transaksi`),
  ADD KEY `idHomestay` (`id_homestay`);

--
-- Indexes for table `kategorifasilitas`
--
ALTER TABLE `kategorifasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemilikhomestay`
--
ALTER TABLE `pemilikhomestay`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `id_Akun` (`id_akun`);

--
-- Indexes for table `requestfasilitas`
--
ALTER TABLE `requestfasilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategoriFasiltas` (`id_kategori_fasiltas`),
  ADD KEY `id_pemilik_homestay` (`id_pemilik_homestay`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_homestay` (`id_homestay`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_book`
--
ALTER TABLE `daftar_book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `dinaspariwisata`
--
ALTER TABLE `dinaspariwisata`
  MODIFY `id_pegawai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `homestay`
--
ALTER TABLE `homestay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `kategorifasilitas`
--
ALTER TABLE `kategorifasilitas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `pemilikhomestay`
--
ALTER TABLE `pemilikhomestay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `requestfasilitas`
--
ALTER TABLE `requestfasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `daftar_book`
--
ALTER TABLE `daftar_book`
  ADD CONSTRAINT `daftar_book_ibfk_1` FOREIGN KEY (`homestay`) REFERENCES `homestay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_book_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id_pemilik_homestay`) REFERENCES `pemilikhomestay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `homestay`
--
ALTER TABLE `homestay`
  ADD CONSTRAINT `homestay_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilikhomestay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_2` FOREIGN KEY (`id_homestay`) REFERENCES `homestay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemilikhomestay`
--
ALTER TABLE `pemilikhomestay`
  ADD CONSTRAINT `pemilikhomestay_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `requestfasilitas`
--
ALTER TABLE `requestfasilitas`
  ADD CONSTRAINT `requestfasilitas_ibfk_1` FOREIGN KEY (`id_pemilik_homestay`) REFERENCES `pemilikhomestay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requestfasilitas_ibfk_2` FOREIGN KEY (`id_kategori_fasiltas`) REFERENCES `kategorifasilitas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_homestay`) REFERENCES `homestay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
