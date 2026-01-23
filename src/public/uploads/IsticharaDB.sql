-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 20, 2026 at 11:15 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IsticharaDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `disponibilite`
--

CREATE TABLE `disponibilite` (
  `id` int NOT NULL,
  `professionnel_id` int NOT NULL,
  `jour` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int NOT NULL,
  `fullname` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `experience` int NOT NULL,
  `tarif` decimal(10,0) NOT NULL,
  `speciality` text,
  `consultate_online` enum('yes','no') DEFAULT 'no',
  `type_actes` enum('signification','excecution','constat') DEFAULT NULL,
  `ville_id` int DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('admin','client','professionnel') NOT NULL,
  `type_professionnel` enum('avocat','huissier') DEFAULT NULL,
  `fichier_acceptation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `fullname`, `email`, `phone`, `experience`, `tarif`, `speciality`, `consultate_online`, `type_actes`, `ville_id`, `password`, `role`, `type_professionnel`, `fichier_acceptation`) VALUES
(96, 'Hicham Naciri', 'hnaciri@avocat.ma', '212600123456', 22, 1500, 'Droit des affaires', 'yes', NULL, 2, '', 'admin', NULL, NULL),
(97, 'Kamal Nasrollah', 'knasrollah@avocat.ma', '212600234567', 20, 1400, 'Droit des affaires', 'yes', NULL, 1, '', 'admin', NULL, NULL),
(98, 'El Mehdi Ezzouate', 'emehdi@avocat.ma', '212600345678', 10, 1200, 'Contentieux des affaires', 'yes', NULL, 1, '', 'admin', NULL, NULL),
(99, 'Driss El Yazami', 'delyazami@avocat.ma', '212600456789', 30, 1300, 'Droit des droits humains', 'no', NULL, 2, '', 'admin', NULL, NULL),
(100, 'Kaoutar Badrane', 'kbadrane@avocat.ma', '212600567890', 17, 1000, 'Droit international', 'yes', NULL, 3, '', 'admin', NULL, NULL),
(101, 'Laila Slassii', 'laslassi@avocat.ma', '212600678901', 6, 58200, 'Droit des affaires', 'yes', NULL, 1, '', 'admin', NULL, NULL),
(102, 'Victor Erlich', 'verlich@euroconsult.ma', '212600789012', 12, 1100, 'Conseil juridique international', 'no', NULL, 3, '', 'admin', NULL, NULL),
(103, 'Myriame El Khiati', 'mekhiati@ekavocats.ma', '212600890123', 15, 1250, 'Droit commercial & transports', 'yes', NULL, 1, '', 'admin', NULL, NULL),
(104, 'Mohammed Atouilila', 'contact@huissier-ma.ma', '212764446431', 8, 800, NULL, NULL, 'signification', 1, '', 'admin', NULL, NULL),
(107, 'Robyn Mayert-Kihn', 'your.email+fakedata25927@gmail.com', '512-467-7128', 8, 5428, NULL, NULL, 'constat', 3, '', 'admin', NULL, NULL),
(108, 'Anas lakhal', 'anaslkhl123@gmail.com', '0651984514', 5, 15000, 'Droit international', 'yes', NULL, 2, '', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `professionnel_id` int NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `statut` enum('en_attente','valide','refuse') DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ville`
--

CREATE TABLE `ville` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ville`
--

INSERT INTO `ville` (`id`, `nom`) VALUES
(1, 'Marrakech'),
(2, 'Demnate'),
(3, 'Casablanca'),
(4, 'Agadir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professionnel_id` (`professionnel_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ville_id` (`ville_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `professionnel_id` (`professionnel_id`);

--
-- Indexes for table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD CONSTRAINT `disponibilite_ibfk_1` FOREIGN KEY (`professionnel_id`) REFERENCES `person` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`ville_id`) REFERENCES `ville` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `person` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`professionnel_id`) REFERENCES `person` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
