/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - db_kasukm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_kasukm` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_kasukm`;

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `idJbtn` int(11) NOT NULL AUTO_INCREMENT,
  `namaJbtn` varchar(25) NOT NULL,
  PRIMARY KEY (`idJbtn`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jabatan` */

insert  into `jabatan`(`idJbtn`,`namaJbtn`) values 
(1,'Ketua'),
(2,'Wakil Ketua'),
(3,'Sekretaris 1'),
(4,'Sekeretaris 2'),
(5,'Bendahara 1'),
(6,'Bendahara 2'),
(7,'Anggota');

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `idJrs` int(11) NOT NULL AUTO_INCREMENT,
  `namaJrs` varchar(50) NOT NULL,
  PRIMARY KEY (`idJrs`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jurusan` */

insert  into `jurusan`(`idJrs`,`namaJrs`) values 
(1,'TI - Manajemen Teknik Informatika'),
(2,'TI - Komputer Akuntansi & Bisnis'),
(4,'TI - Digital Grafis Multimedia'),
(14,'TI - Sistem Komputer');

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `nimMhs` int(11) NOT NULL,
  `namaMhs` varchar(50) NOT NULL,
  `tglLahirMhs` date NOT NULL,
  `jkMhs` int(11) NOT NULL,
  `telpMhs` varchar(20) NOT NULL,
  `emailMhs` varchar(50) NOT NULL,
  `idJbtn` int(11) NOT NULL,
  `idJrs` int(11) NOT NULL,
  PRIMARY KEY (`nimMhs`),
  KEY `fk_jabatan` (`idJbtn`),
  KEY `fk_jurusan` (`idJrs`),
  CONSTRAINT `fk_jabatan` FOREIGN KEY (`idJbtn`) REFERENCES `jabatan` (`idJbtn`),
  CONSTRAINT `fk_jurusan` FOREIGN KEY (`idJrs`) REFERENCES `jurusan` (`idJrs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`nimMhs`,`namaMhs`,`tglLahirMhs`,`jkMhs`,`telpMhs`,`emailMhs`,`idJbtn`,`idJrs`) values 
(19101290,'I Gede Yoga Permana Putra','2020-06-10',1,'081289171','igdyogapermana@gmail.com',2,4),
(19101291,'Nyoman Maniko Pasugi Nanta','2020-06-16',1,'08214219','maniko@gmail.com',7,1),
(19101292,'Selvi Ulandari','2020-06-10',0,'01810410','selvi@gmail.com',7,1),
(19101293,'Alvin Limawan Susanto','2020-06-08',1,'02702391','alvin@gmail.com',7,1),
(19101294,'Abielvan Meidialmo','2020-06-09',1,'09701','abi@gmail.com',1,14);

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `idByr` int(11) NOT NULL AUTO_INCREMENT,
  `nimMhs` int(11) NOT NULL,
  `jumlahByr` double NOT NULL,
  `bulanByr` varchar(20) NOT NULL,
  `tglByr` date NOT NULL,
  PRIMARY KEY (`idByr`),
  KEY `fk_mahasiswabayar` (`nimMhs`),
  CONSTRAINT `fk_mahasiswabayar` FOREIGN KEY (`nimMhs`) REFERENCES `mahasiswa` (`nimMhs`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pembayaran` */

insert  into `pembayaran`(`idByr`,`nimMhs`,`jumlahByr`,`bulanByr`,`tglByr`) values 
(1,19101290,10000,'2020-06','2020-06-24'),
(2,19101293,10000,'2020-05','2020-05-20'),
(3,19101294,10000,'2020-06','2020-06-11');

/*Table structure for table `roleuser` */

DROP TABLE IF EXISTS `roleuser`;

CREATE TABLE `roleuser` (
  `idRole` int(11) NOT NULL AUTO_INCREMENT,
  `namaRole` varchar(15) NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roleuser` */

insert  into `roleuser`(`idRole`,`namaRole`) values 
(1,'Admin'),
(2,'Member');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `nimMhs` int(11) NOT NULL,
  `passUsers` varchar(250) NOT NULL,
  `idRole` int(11) NOT NULL,
  `imgUsers` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idUsers`),
  KEY `fk_roleuser` (`idRole`),
  KEY `fk_mahasiswa` (`nimMhs`),
  CONSTRAINT `fk_mahasiswa` FOREIGN KEY (`nimMhs`) REFERENCES `mahasiswa` (`nimMhs`) ON DELETE CASCADE,
  CONSTRAINT `fk_roleuser` FOREIGN KEY (`idRole`) REFERENCES `roleuser` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`idUsers`,`nimMhs`,`passUsers`,`idRole`,`imgUsers`) values 
(4,19101290,'19101290',1,'default.jpg'),
(6,19101291,'19101291',2,'default.jpg'),
(7,19101292,'19101292',2,'default.jpg'),
(8,19101293,'19101293',2,'default.jpg'),
(9,19101294,'19101294',1,'default.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
