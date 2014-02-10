-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2013 at 05:08 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_musik`
--
CREATE DATABASE `db_musik` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_musik`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `nama_album` varchar(50) NOT NULL,
  `musik` varchar(50) NOT NULL,
  `artis` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `tgl_upload` date NOT NULL,
  `download` int(11) NOT NULL,
  `suka` int(11) NOT NULL,
  `ket_album` text NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `id_user`, `nama_album`, `musik`, `artis`, `file`, `id_jenis`, `tgl_upload`, `download`, `suka`, `ket_album`) VALUES
(44, 1, 'bondan', 'Bondan_-_Kita_Selamanya.mp3', 'bondan', 'Bondan_-_Kita_Selamanya.mp3', 1, '2013-12-10', 0, 0, ''),
(49, 20, 'ada band', 'Ada_Band_-_Haruskah_Ku_Mati.mp3', 'ada band', 'Ada_Band_-_Haruskah_Ku_Mati.mp3', 1, '2013-12-10', 0, 0, ''),
(46, 1, 'bondan', 'BONDAN_fEaT_F2B_Bogor_and_Jakarta.mp3', 'bondan', 'BONDAN_fEaT_F2B_Bogor_and_Jakarta.mp3', 1, '2013-12-10', 0, 0, ''),
(47, 6, 'i will', '01_i_will_always_love_you.mp3', 'i will', '01_i_will_always_love_you.mp3', 3, '2013-12-10', 0, 0, ''),
(48, 6, 'awd', '02._lenka_-_the_show_.mp3', 'dwdw', '02._lenka_-_the_show_.mp3', 3, '2013-12-10', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `chapca`
--

CREATE TABLE IF NOT EXISTS `chapca` (
  `id_chapca` int(11) NOT NULL AUTO_INCREMENT,
  `chapca` varchar(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id_chapca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `chapca`
--

INSERT INTO `chapca` (`id_chapca`, `chapca`, `value`) VALUES
(1, '96 + 56', 152),
(3, '98 + 28', 126),
(4, '34 + 49', 83),
(5, '63 + 58', 121),
(6, '44 + 89', 133),
(8, '98 - 46', 52),
(9, '89 - 64', 25),
(10, '69 - 19', 50),
(12, '97 + 108', 205),
(13, '63 + 98', 161);

-- --------------------------------------------------------

--
-- Table structure for table `coment`
--

CREATE TABLE IF NOT EXISTS `coment` (
  `id_coment` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `coment` text NOT NULL,
  `tgl` datetime NOT NULL,
  `view` enum('aktif','tidak') NOT NULL,
  PRIMARY KEY (`id_coment`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `coment`
--


-- --------------------------------------------------------

--
-- Table structure for table `jenis_lagu`
--

CREATE TABLE IF NOT EXISTS `jenis_lagu` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `jenis_lagu`
--

INSERT INTO `jenis_lagu` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Pop'),
(2, 'Rock'),
(3, 'Barat'),
(7, 'Dangdut');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `status` enum('aktif','tidak') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `username`, `password`, `email`, `foto`, `level`, `status`) VALUES
(1, 'ladesta', 'aldis', 'fac52c7d221a9332be62e0ce880a8e84', 'aldis@yahoo.com', 'aldis.jpg', 'admin', 'aktif'),
(18, 'misda', 'misda', '6b64321a8cfdc48cd5468e82fb60f06e', 'misda@yahoo.com', 'Hydrangeas.jpg', 'user', 'aktif'),
(19, 'Yuni', 'Yuni', '6b9d6ba55e4f27b1eb5ab5ca05d160a4', 'yuni@yahoo.com', 'Penguins.jpg', 'user', 'aktif'),
(6, 'Galih', 'galih', 'b685594c6fbcc69ce76d144d67e1ae63', 'galih@yahoo.com', 'Desert.jpg', 'user', 'aktif');
