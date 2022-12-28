-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2022 at 07:14 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekat_fruits`
--

-- --------------------------------------------------------

--
-- Table structure for table `fruit`
--

CREATE TABLE `fruit` (
  `id` int(6) UNSIGNED NOT NULL,
  `ime` varchar(30) NOT NULL,
  `cena` float NOT NULL,
  `kilaza` int(50) NOT NULL,
  `slika` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fruit`
--

INSERT INTO `fruit` (`id`, `ime`, `cena`, `kilaza`, `slika`) VALUES
(1, 'Orange', 130, 88, '../images/f-1.jpg'),
(2, 'Blueberry', 160, -56, '../images/f-2.jpg'),
(3, 'Banana', 120, 102, '../images/f-3.jpg'),
(4, 'Apple', 110, 54, '../images/f-4.jpg'),
(5, 'Mango', 210, 76, '../images/f-5.jpg'),
(6, 'Strawberry', 160, 56, '../images/f-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(6) UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `firstname`, `lastname`, `email`, `pass`) VALUES
(1, 'Andrija', 'Bascarevic', 'bascarevic.andrija22@gmail.com', 'Sifra1');

-- --------------------------------------------------------

--
-- Table structure for table `porudzbina`
--

CREATE TABLE `porudzbina` (
  `id` int(6) UNSIGNED NOT NULL,
  `idf` int(6) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `trazeni_kg` int(6) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `porudzbina`
--

INSERT INTO `porudzbina` (`id`, `idf`, `email`, `trazeni_kg`, `reg_date`) VALUES
(1, 2, 'bascarevic.andrija22@gmail.com', 2, '2022-12-27 20:06:27'),
(2, 6, 'bascarevic.andrija22@gmail.com', 3, '2022-12-27 20:07:17'),
(3, 2, 'bascarevic.andrija22@gmail.com', 90, '2022-12-27 20:13:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fruit`
--
ALTER TABLE `fruit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `porudzbina`
--
ALTER TABLE `porudzbina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idf` (`idf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fruit`
--
ALTER TABLE `fruit`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `porudzbina`
--
ALTER TABLE `porudzbina`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `porudzbina`
--
ALTER TABLE `porudzbina`
  ADD CONSTRAINT `porudzbina_ibfk_1` FOREIGN KEY (`idf`) REFERENCES `fruit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
