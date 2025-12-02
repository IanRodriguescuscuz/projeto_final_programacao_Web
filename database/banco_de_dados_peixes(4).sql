-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 02, 2025 at 03:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco_de_dados_peixes`
--
CREATE DATABASE IF NOT EXISTS `banco_de_dados_peixes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `banco_de_dados_peixes`;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_peixe` int(11) NOT NULL,
  `data_aquisicao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`id`, `id_usuario`, `id_peixe`, `data_aquisicao`) VALUES
(6, 3, 5, '2025-12-02 10:02:39'),
(7, 3, 5, '2025-12-02 10:02:42'),
(8, 3, 5, '2025-12-02 10:02:43'),
(9, 3, 5, '2025-12-02 10:02:44'),
(10, 3, 5, '2025-12-02 10:09:58');

-- --------------------------------------------------------

--
-- Table structure for table `peixes`
--

CREATE TABLE `peixes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peixes`
--

INSERT INTO `peixes` (`id`, `nome`, `descricao`, `preco`, `foto`) VALUES
(5, 'das', 'das', 11.11, 'assets/224f937717ab62d3b81ce4d59911fcd8.jpg'),
(6, 'das', 'das', 11.11, 'assets/36031cb7ac36a789ea072025fa6b8f60.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `is_admin`) VALUES
(2, 'dsadsa', 'dasadsdsa@dassda.com', 1),
(3, 'robabrisa123', 'robabrisa@dasilva.com', 1),
(5, 'perdi80k', 'perdi80k@dasilva.com', 0),
(6, 'dsadsa', 'dsaadsds@gmail.com', 0),
(7, 'daniel', 'daniel@brandao.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_peixe` (`id_peixe`);

--
-- Indexes for table `peixes`
--
ALTER TABLE `peixes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `peixes`
--
ALTER TABLE `peixes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_peixe`) REFERENCES `peixes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
