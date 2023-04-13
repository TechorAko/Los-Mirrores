-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 04:13 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `avaliacao`
--

CREATE TABLE `avaliacao` (
  `ID` int(11) NOT NULL,
  `Stars` int(1) NOT NULL,
  `Desc` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carrinho`
--

CREATE TABLE `carrinho` (
  `ID` int(11) NOT NULL,
  `QuantidadeItem` decimal(59,0) NOT NULL DEFAULT 1,
  `Prod_id` int(11) NOT NULL,
  `Ped_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Desc` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`ID`, `Nome`, `Desc`) VALUES
(1, 'Computador', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `CEP` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `No_Complt` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rua` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bairro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Apelido` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funcionario`
--

CREATE TABLE `funcionario` (
  `ID` int(11) NOT NULL,
  `Admissao` date NOT NULL,
  `Salario` decimal(7,0) NOT NULL,
  `Cargo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `funcionario`
--

INSERT INTO `funcionario` (`ID`, `Admissao`, `Salario`, `Cargo`, `user_id`) VALUES
(8, '2023-04-08', '9999', 'Gerente', 41),
(9, '2023-04-08', '0', 'Gerente', 33),
(10, '2023-04-10', '0', 'Gerente', 57);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `ID` int(11) NOT NULL,
  `Data` datetime NOT NULL DEFAULT current_timestamp(),
  `Pag` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Boleto',
  `Total` decimal(59,0) NOT NULL,
  `clid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Desc` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `Preco` decimal(59,2) NOT NULL,
  `Desconto` decimal(3,0) NOT NULL,
  `Qtde` int(4) NOT NULL,
  `Imagem` varchar(2048) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`ID`, `Nome`, `Desc`, `Preco`, `Desconto`, `Qtde`, `Imagem`, `cat_id`) VALUES
(8, 'Computador Asus i9 8GB RAM Nvidia 1080', 'É um computador de última geração... Muitos youtubers utilizam deste aparato contemporâneo nestes tempos... Muito legal e divertido... Dura pra sempre... Mentira... Mas dura por bastante tempo... Faz café.', '4959.99', '0', 999, 'imagens/foto7277911087231.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `Email` varchar(320) COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Sexo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefone` char(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CPF` char(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `RG` char(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nascimento` date NOT NULL,
  `DataCriacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID`, `Email`, `Senha`, `Nome`, `Sexo`, `Telefone`, `CPF`, `RG`, `Nascimento`, `DataCriacao`) VALUES
(33, 'eawewqeqw@gmail.com', 'dasdasdasd', 'wadcadfawsedfaws', 'M', '(31) 23123-1234', '312.312.312-31', 'AC-31.231.231', '0000-00-00', '2023-04-09 12:46:02'),
(34, 'werferwtfgwetgwe', '4231123412312', 'awsdfawfawefaw', 'M', '(31) 23124-1241', '123.312.312-31', 'AC-12.321.312', '2023-04-04', '2023-04-09 12:46:15'),
(41, 'teste1@email.com', '12345678', 'Teste$', NULL, NULL, NULL, NULL, '2020-01-01', '2023-04-08 19:53:58'),
(57, 'gabrielcavalhiere2@gmail.com', '12345678', 'Gabriel Cavalhiere', NULL, '+55 (32) 99127-7540', NULL, '', '0303-10-30', '2023-04-10 19:32:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_tbAvaliacao_tbProduto` (`prod_id`),
  ADD KEY `fk_tbAvailacao_tbUsuario` (`user_id`);

--
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_tbCarrinho_tbProduto` (`Prod_id`),
  ADD KEY `tk_tbCarrinho_tbPedido` (`Ped_id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nome` (`Nome`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY ` fk_user_id` (`user_id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Data` (`Data`),
  ADD KEY `fk_cli_id` (`clid_id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nome` (`Nome`),
  ADD KEY `fk_tbProduto_tbCategoria` (`cat_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Telefone` (`Telefone`),
  ADD UNIQUE KEY `CPF` (`CPF`),
  ADD UNIQUE KEY `RG` (`RG`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_tbAvailacao_tbUsuario` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbAvaliacao_tbProduto` FOREIGN KEY (`prod_id`) REFERENCES `avaliacao` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_tbCarrinho_tbProduto` FOREIGN KEY (`Prod_id`) REFERENCES `produto` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tk_tbCarrinho_tbPedido` FOREIGN KEY (`Ped_id`) REFERENCES `pedido` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT ` fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_cli_id` FOREIGN KEY (`clid_id`) REFERENCES `cliente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_tbProduto_tbCategoria` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
