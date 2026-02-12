-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2026 at 08:06 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wheel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `prizes`
--

CREATE TABLE `prizes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `h1` varchar(255) DEFAULT '',
  `h2` varchar(255) DEFAULT '',
  `image1` varchar(255) DEFAULT '',
  `probability` int(11) NOT NULL DEFAULT 10,
  `P` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prizes`
--

INSERT INTO `prizes` (`id`, `title`, `image`, `active`, `h1`, `h2`, `image1`, `probability`, `P`) VALUES
(1, '-10%', '', 1, 'Papildu -10% atlaide', 'Apsveicam! Tu laimēji papildu 10% atlaidi šim pirkumam!', '../img_for_cards//img_697b2cdc1fc82.jpeg', 30, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(2, '-5%', '', 1, 'Papildu -5% atlaide', 'Apsveicam! Tu laimēji papildu 5% atlaidi šim pirkumam!', '../img_for_cards//img_697b4d97674ee.jpeg', 70, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(3, '', '../svg icons//img_697b3d9e2e9e3.svg', 1, '10 EUR dāvanu karte', 'Apsveicam! Tu laimēji 10 EUR dāvanu karti savam nākamajam pirkumam!', '../img_for_cards//img_697b2d20d3218.jpeg', 1, 'Dāvanu karti var izmantot Rosmes fiziskajos veikalos.'),
(4, '-10%', '', 1, 'Papildu -10% atlaide', 'Apsveicam! Tu laimēji papildu 10% atlaidi šim pirkumam!', '../img_for_cards//img_697b3bbdb8438.jpeg', 30, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(5, '-5%', '', 1, 'Papildu -5% atlaide', 'Apsveicam! Tu laimēji papildu 5% atlaidi šim pirkumam!', '../img_for_cards//img_697b2d6879997.jpeg', 70, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(6, '-15%', '', 1, 'Papildu -15% atlaide', 'Apsveicam! Tu laimēji papildu 15% atlaidi šim pirkumam!', '../img_for_cards//img_697b2d284cd69.jpeg', 10, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(7, '-10%', '', 1, 'Papildu -10% atlaide', 'Apsveicam! Tu laimēji papildu 10% atlaidi šim pirkumam!', '../img_for_cards//img_697b2ceb13a96.jpeg', 30, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(8, '-5%', '', 1, 'Papildu -5% atlaide', 'Apsveicam! Tu laimēji papildu 5% atlaidi šim pirkumam!', '../img_for_cards//img_697b2d5ca6405.jpeg', 70, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(9, '', '../svg icons//img_697b5dbc0f365.svg', 1, 'Rosmes iepirkumu soma', 'Apsveicam! Tu laimēji Rosmes iepirkumu somu dāvanā pie šī pirkuma!', '../img_for_cards//img_697b2ecc26685.jpeg', 10, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(10, '-10%', '', 1, 'Papildu -10% atlaide', 'Apsveicam! Tu laimēji papildu 10% atlaidi šim pirkumam', '../img_for_cards//img_69846db435bcf.jpeg', 30, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(11, '-5%', '', 1, 'Papildu -5% atlaide', 'Apsveicam! Tu laimēji papildu 5% atlaidi šim pirkumam!', '../img_for_cards//img_6979fa3b593e0.jpeg', 70, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.'),
(12, '-15%', '', 1, 'Papildu -15% atlaide', 'Apsveicam! Tu laimēji papildu 15% atlaidi šim pirkumam!', '../img_for_cards//img_697b2d130fa16.jpeg', 10, 'Atlaide piemērojama tikai šim pirkumam un summējas ar vienu citu piedāvājumu vai atlaidi. Citas atlaides un piedāvājumi savā starpā nesummējas.');

-- --------------------------------------------------------

--
-- Table structure for table `wheel_settings`
--

CREATE TABLE `wheel_settings` (
  `id` int(11) NOT NULL,
  `spin_count` int(11) DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wheel_settings`
--

INSERT INTO `wheel_settings` (`id`, `spin_count`) VALUES
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prizes`
--
ALTER TABLE `prizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheel_settings`
--
ALTER TABLE `wheel_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wheel_settings`
--
ALTER TABLE `wheel_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
