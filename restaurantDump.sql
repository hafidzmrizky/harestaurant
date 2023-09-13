-- -------------------------------------------------------------
-- TablePlus 5.3.9(502)
--
-- https://tableplus.com/
--
-- Database: restaurant
-- Generation Time: 2023-09-13 22:32:15.5660
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `karyawan` (
  `id_karyawan` int NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `tipeMenu` varchar(255) NOT NULL,
  `statusMenu` varchar(255) NOT NULL,
  `image` text,
  `deskripsi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `transaksi` (
  `idTransaksi` int NOT NULL AUTO_INCREMENT,
  `nomorTransaksi` varchar(255) DEFAULT NULL,
  `waktuTransaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `nomorMeja` int DEFAULT NULL,
  `statusPesanan` varchar(30) DEFAULT NULL,
  `metodePembayaran` varchar(50) DEFAULT NULL,
  `statusPembayaran` varchar(25) DEFAULT NULL,
  `idKaryawan` int DEFAULT NULL,
  PRIMARY KEY (`idTransaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `transaksiDetail` (
  `idTransaksi` int DEFAULT NULL,
  `idMenu` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `statusPesananMenu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `alamat`, `no_hp`, `email`, `gender`, `jabatan`) VALUES
(1, 'Hafidz', 'Kebantenan III, Jakarta Utara, Indonesia', '082310835022', 'hafidzmrizky@gmail.com', 'Laki-laki', 'Teknisi'),
(3, 'Muhammad', ' Kebantenan', '0829211242211', 'hafidzmrizzky@example.com', 'Laki-laki', 'Koki'),
(4, 'Ky', ' Gandaria City, Kebayoran', '0895212287422', 'kyyy@example.com', 'Perempuan', 'Teknisi');

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(1, 'hafidzmrizky@gmail.com', '57f842286171094855e51fc3a541c1e2');

INSERT INTO `menu` (`id`, `nama`, `harga`, `tipeMenu`, `statusMenu`, `image`, `deskripsi`) VALUES
(1, 'mie ayam bakso', 13000, 'Makanan', 'Tersedia', '../assets/images/35847f336a9110587cbe76af389bd501MIE_AYAM_BAKSO_CEKER_KINTAMANI.jpg', 'Mie bakso dengan ceker ayam, mie kuning dan dengan sayur'),
(2, 'bakso', 15000, 'Makanan', 'Tersedia', '../assets/images/0d0bc1d3676a93efb00f344166b19a7309A884E1-7CD8-4220-83EB-983C927FD122_1_105_c.jpeg', 'Bakso dengan pangsit dan sayur dengan mie kuning ekstra.'),
(3, 'es teh manis', 5000, 'Minuman', 'Tersedia', '../assets/images/08f8cd8c957aa6fa348956cdaa454cc1OIP (3).jpeg', NULL),
(4, 'es teh tawar', 3000, 'Minuman', 'Tidak Tersedia', '../../assets/images/06b87933e710a5bda7f578bda5569b45tehtawar.jpg', ''),
(5, 'kerupuk', 2500, 'Makanan', 'Tersedia', '../assets/images/5c325699396104c2886b8d5591dad4e6OIP (4).jpeg', NULL),
(6, 'Es Leci', 5000, 'Minuman', 'Tidak Tersedia', '../assets/images/4250c2b2e22c38ccc7c5000bdfd71ce3es_leci1.jpg', NULL),
(8, 'Jus Apel', 10000, 'Minuman', 'Tersedia', '../assets/images/d5bbb1b7809d05df42ebf853e2e903c9food-apples-green-milk-apple-sliced-fruit-juice-green-background.jpg', NULL),
(10, 'Es Batu Goreng', 1000, 'Makanan', 'Tersedia', '../assets/images/9d673bd90e7673f7a685fadb6bf47d9feksperimen-es-batu-digoreng_20170903_174032.jpg', NULL),
(11, 'Mie Aceh', 50000, 'Makanan', 'Tersedia', '../../assets/images/07203404f840e4baad564aa5b1d48390Mie_Aceh_with_beef.jpg', 'Mie Aceh dengan Daging USDA Prime');

INSERT INTO `transaksi` (`idTransaksi`, `nomorTransaksi`, `waktuTransaksi`, `nomorMeja`, `statusPesanan`, `metodePembayaran`, `statusPembayaran`, `idKaryawan`) VALUES
(1, 'A0001', '2023-09-03 20:11:14', 2, 'pending', 'cash', 'paid', 1),
(2, NULL, '2023-09-10 17:27:28', 2, 'ready', 'transfer', 'paid', 1),
(3, NULL, '2023-09-10 17:29:28', 9, 'ready', 'transfer', 'paid', 1),
(4, NULL, '2023-09-10 17:51:42', 2, 'ready', 'qris', 'paid', 1),
(5, 'A000.5', '2023-09-10 17:53:09', 6, 'ready', 'transfer', 'paid', 1),
(6, 'A0006', '2023-09-10 17:56:42', 6, 'ready', 'qris', 'paid', 1),
(7, 'A0007', '2023-09-11 09:09:05', 75, 'pending', 'qris', 'pending', 1),
(8, 'A0008', '2023-09-11 12:06:22', 13, 'ready', 'cash', 'paid', 1),
(9, 'A0009', '2023-09-13 08:28:55', 3, 'pending', 'cash', 'pending', 1),
(10, 'A00010', '2023-09-13 08:37:19', 76, 'pending', 'qris', 'pending', 1);

INSERT INTO `transaksiDetail` (`idTransaksi`, `idMenu`, `quantity`, `statusPesananMenu`) VALUES
(1, 3, 2, 'pending'),
(1, 4, 1, 'reject'),
(2, 1, 1, 'ready'),
(2, 2, 1, 'ready'),
(3, 1, 1, 'ready'),
(3, 2, 1, 'ready'),
(4, 2, 1, 'ready'),
(5, 3, 1, 'ready'),
(6, 5, 1, 'ready'),
(6, 10, 1, 'ready'),
(6, 11, 1, 'ready'),
(7, 2, 2, 'reject'),
(7, 1, 2, 'pending'),
(7, 10, 1, 'pending'),
(7, 11, 1, 'pending'),
(7, 5, 4, 'pending'),
(8, 1, 1, 'ready'),
(8, 11, 2, 'reject'),
(9, 1, 2, 'pending'),
(10, 2, 1, 'pending'),
(10, 10, 2, 'pending');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;