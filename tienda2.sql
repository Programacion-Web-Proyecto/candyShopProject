-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Dec 10, 2022 at 07:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda2`
--

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(30) NOT NULL,
  `categoria` varchar(15) NOT NULL,
  `descripcion` varchar(144) NOT NULL,
  `existencia` int(3) NOT NULL,
  `precio` int(3) NOT NULL,
  `archIMG` varchar(25) NOT NULL,
  `ventas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`idProducto`, `nombreProducto`, `categoria`, `descripcion`, `existencia`, `precio`, `archIMG`, `ventas`) VALUES
(111111, 'Skittles', 'Ácidos', 'dulces suaves confitados de diferentes sabores frutales.', 134, 423, 'Skittles.png', 565),
(212024, 'M&M', 'Chocolates', 'pequeños pedazos de chocolate con leche revestidos de azúcar.', 768, 544, 'M&M.png', 789),
(291339, 'Sour Patch Kids', 'Ácidos', 'Pequeños dulces masticables, primero son ácidos, luego dulces.', 25, 29, 'Sour Patch.png', 897),
(293264, 'KitKat', 'Chocolates', 'Chocolatina consistente en una galleta o barquillo de chocolate con leche', 10, 100, 'KitKat.png', 389),
(333333, 'War Heads', 'Ácidos', 'Gomitas de frutas de sabores variados, amargos por fuera con un centro masticable y gomoso.', 645, 765, 'WarHeads.png', 231),
(423670, 'Kisses', 'Chocolates', 'Chocolate con leche de HERSHEYS KISSES con forma de gota', 654, 875, 'Kisses.png', 895),
(564365, 'Crunch', 'Chocolates', 'Chocolatina que consiste en la combinación de cremoso chocolate con leche y arroz inflado', 664, 782, 'Crunch.png', 212),
(564580, 'Hersheys', 'Chocolates', 'chocolate con leche de HERSHEYS.', 879, 543, 'Hersheys.png', 535),
(650980, 'Xtremes', 'Ácidos', 'caramelo acidulado en forma de tiras de colores', 768, 768, 'Xtremes.png', 768),
(676671, 'Nerds', 'Ácidos', 'Consisten en varios sabores y colores, que van desde muy dulce a extremadamente ácido.', 763, 432, 'Nerds.jpg', 334),
(786766, 'Lucas Muecas acido', 'Ácidos', 'golosina de caramelo sabor manzana verde con polvo acidito', 897, 575, 'LucasMuecasAcido.png', 876),
(870006, 'Ferrero', 'Chocolates', 'Avellana entera, sumergida en un relleno suave, cubierta de chocolate con leche y finos trozos de avellana', 874, 424, 'Ferrero.png', 421);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
