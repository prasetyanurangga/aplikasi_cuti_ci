-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2019 at 08:12 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuti_db`
--



-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(50) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `golongan` varchar(50) DEFAULT NULL,
  `unit_kerja` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `jabatan`, `golongan`, `unit_kerja`, `status`, `password`) VALUES
('197602201998031001', 'HENDRO NUGROHO, ST, M.Si', 'Kepala Bagian Sumber Daya Manusia', '(IV/a) Pembina', 'Bagian Sumber Daya Manusia', 'atasan', 'hendro'),
('198204042008012035', 'AJENG INDRIA SARI, S.Psi', 'Kepala Sub Bagian Perencanaan dan Pengembangan SDM', 'III/d', 'Sub Bagian Perencanaan dan Pengembangan SDM', 'pegawai', 'ajeng');

-- --------------------------------------------------------


--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id_cuti` varchar(22) NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `jenis_cuti` varchar(20) DEFAULT NULL,
  `tempat_cuti` varchar(20) DEFAULT NULL,
  `alamat_nohp` text,
  `keperluan` text,
  `lama_cuti` int(11) DEFAULT NULL,
  `id_pegawai` varchar(50) DEFAULT NULL,
  `id_atasan` varchar(50) DEFAULT NULL,
  `status_cuti` int(11) DEFAULT NULL,
  `dokumen_cuti` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id_cuti`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_pengajuan`, `jenis_cuti`, `tempat_cuti`, `alamat_nohp`, `keperluan`, `lama_cuti`, `id_pegawai`, `id_atasan`, `status_cuti`, `dokumen_cuti`) VALUES
('C-00000000000000000001', '2019-05-24', '2019-05-28', '2019-05-23', 'Cuti Tahunan', 'Dalam Negeri', 'banjar', 'jalan jalan', 4, '198204042008012035', '197602201998031001', 2, 'sdsadsdasd'),
('C-00000000000000000002', '2019-12-30', '2020-01-03', '2019-07-25', 'Cuti Tahunan', 'Dalam Negeri', 'aasdasd', 'asdasdasd', 5, '198204042008012035', '197602201998031001', 2, 'sqaasd'),
('C-00000000000000000003', '2018-12-30', '2019-01-02', '2018-11-22', 'Cuti Tahunan', 'Dalam Negeri', 'dasdasdas', 'asdasdasd', 3, '198204042008012035', '197602201998031001', 3, 'sdasdsdasd'),
('C-00000000000000000004', '2019-05-24', '2019-05-28', '2019-05-23', 'Cuti Tahunan', 'Dalam Negeri', 'i', 'j', 3, '198204042008012035', '197602201998031001', 1, 'Screenshot_from_2019-05-05_01-37-19.png'),
('C-00000000000000000005', '2019-05-24', '2019-05-24', '2019-05-24', 'Cuti Tahunan', 'Dalam Negeri', 'hgfdsa', 'ghhgfd', 1, '198204042008012035', '197602201998031001', 2, 'Screenshot_from_2019-04-25_05-50-04.png');

-- --------------------------------------------------------



-- --------------------------------------------------------

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cuti_setuju`  AS  select `cuti`.`id_cuti` AS `id_cuti`,`cuti`.`tanggal_mulai` AS `tanggal_mulai`,`cuti`.`tanggal_selesai` AS `tanggal_selesai`,`cuti`.`tanggal_pengajuan` AS `tanggal_pengajuan`,`cuti`.`jenis_cuti` AS `jenis_cuti`,`cuti`.`tempat_cuti` AS `tempat_cuti`,`cuti`.`alamat_nohp` AS `alamat_nohp`,`cuti`.`keperluan` AS `keperluan`,`cuti`.`lama_cuti` AS `lama_cuti`,`cuti`.`id_pegawai` AS `id_pegawai`,`cuti`.`id_atasan` AS `id_atasan`,`cuti`.`status_cuti` AS `status_cuti`,`cuti`.`dokumen_cuti` AS `dokumen_cuti` from `cuti` where (`cuti`.`status_cuti` = '2') ;

--
-- Structure for view `pegawai_cuti`
--
DROP TABLE IF EXISTS `pegawai_cuti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pegawai_cuti`  AS  select `P`.`nip` AS `nip`,`P`.`nama` AS `nama`,`P`.`jabatan` AS `jabatan`,`P`.`golongan` AS `golongan`,`P`.`unit_kerja` AS `unit_kerja`,`P`.`status` AS `status`,`P`.`password` AS `password`,`C`.`id_cuti` AS `id_cuti`,`C`.`tanggal_mulai` AS `tanggal_mulai`,`C`.`tanggal_selesai` AS `tanggal_selesai`,`C`.`tanggal_pengajuan` AS `tanggal_pengajuan`,`C`.`jenis_cuti` AS `jenis_cuti`,`C`.`tempat_cuti` AS `tempat_cuti`,`C`.`alamat_nohp` AS `alamat_nohp`,`C`.`keperluan` AS `keperluan`,`C`.`lama_cuti` AS `lama_cuti`,`C`.`id_pegawai` AS `id_pegawai`,`C`.`id_atasan` AS `id_atasan`,`C`.`status_cuti` AS `status_cuti`,`C`.`dokumen_cuti` AS `dokumen_cuti` from (`pegawai` `P` join `cuti` `C` on((`P`.`nip` = `C`.`id_pegawai`))) ;

-- --------------------------------------------------------

--
-- Structure for view `pegawai_cuti2`
--
DROP TABLE IF EXISTS `pegawai_cuti2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pegawai_cuti2`  AS  select `pegawai_cuti`.`id_cuti` AS `id_cuti`,`pegawai_cuti`.`nip` AS `nip`,`pegawai_cuti`.`nama` AS `nama`,`pegawai_cuti`.`jabatan` AS `jabatan`,`pegawai_cuti`.`tanggal_mulai` AS `tanggal_mulai`,`pegawai_cuti`.`tanggal_selesai` AS `tanggal_selesai`,`pegawai_cuti`.`tanggal_pengajuan` AS `tanggal_pengajuan`,`pegawai_cuti`.`lama_cuti` AS `lama_cuti`,`pegawai_cuti`.`tempat_cuti` AS `tempat_cuti`,`pegawai_cuti`.`jenis_cuti` AS `jenis_cuti`,(case when (`pegawai_cuti`.`status_cuti` = '1') then 'Usulan Baru' when (`pegawai_cuti`.`status_cuti` = '2') then 'Disetujui Atasan' else 'Ditolak Atasan' end) AS `status_cuti`,`pegawai_cuti`.`id_atasan` AS `id_atasan`,`pegawai_cuti`.`id_pegawai` AS `id_pegawai` from `pegawai_cuti` ;

-- --------------------------------------------------------

--
-- Structure for view `perhitungan_cuti`
--
DROP TABLE IF EXISTS `perhitungan_cuti`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `perhitungan_cuti`  AS  select `cuti_db`.`cuti_setuju`.`id_pegawai` AS `id_pegawai`,(case when (extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`) < extract(year from `cuti_db`.`cuti_setuju`.`tanggal_selesai`)) then (sum(`cuti_db`.`cuti_setuju`.`lama_cuti`) - ((5 * ((to_days(`cuti_db`.`cuti_setuju`.`tanggal_selesai`) - to_days(concat(extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`),'-12-31'))) DIV 7)) + substr('0123444401233334012222340111123400012345001234550',(((7 * weekday(concat(extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`),'-12-31'))) + weekday(`cuti_db`.`cuti_setuju`.`tanggal_selesai`)) + 1),1))) else (sum(`cuti_db`.`cuti_setuju`.`lama_cuti`) / 2) end) AS `j_tahun_mulai`,(case when (extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`) < extract(year from `cuti_db`.`cuti_setuju`.`tanggal_selesai`)) then ((5 * ((to_days(`cuti_db`.`cuti_setuju`.`tanggal_selesai`) - to_days(concat(extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`),'-12-31'))) DIV 7)) + substr('0123444401233334012222340111123400012345001234550',(((7 * weekday(concat(extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`),'-12-31'))) + weekday(`cuti_db`.`cuti_setuju`.`tanggal_selesai`)) + 1),1)) else (sum(`cuti_db`.`cuti_setuju`.`lama_cuti`) / 2) end) AS `j_tahun_selesai`,extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`) AS `tahun_mulai`,extract(year from `cuti_db`.`cuti_setuju`.`tanggal_selesai`) AS `tahun_selesai` from `cuti_db`.`cuti_setuju` group by `cuti_db`.`cuti_setuju`.`id_pegawai`,extract(year from `cuti_db`.`cuti_setuju`.`tanggal_mulai`),extract(year from `cuti_db`.`cuti_setuju`.`tanggal_selesai`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_atasan` (`id_atasan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`nip`),
  ADD CONSTRAINT `cuti_ibfk_2` FOREIGN KEY (`id_atasan`) REFERENCES `pegawai` (`nip`);
COMMIT;


DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ambil_cuti` (IN `tahn` INT, IN `id` VARCHAR(50))  READS SQL DATA
BEGIN
SELECT P.id_pegawai,P.tahun,COALESCE(SUM(P.jumlah),0) AS jumlah FROM 
(SELECT id_pegawai, CASE WHEN tahun_mulai = tahn AND tahun_selesai = tahn THEN j_tahun_mulai+j_tahun_selesai WHEN tahun_mulai = tahn AND tahun_selesai != tahn THEN j_tahun_mulai WHEN tahun_mulai != tahn AND tahun_selesai = tahn THEN j_tahun_selesai END AS jumlah, tahn AS tahun FROM `perhitungan_cuti` WHERE (tahun_mulai = tahn OR tahun_selesai = tahn) AND id_pegawai = id) AS P GROUP BY P.id_pegawai;

END$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
