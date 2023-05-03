-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 05:05 PM
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

--
-- Dumping data for table `avaliacao`
--

INSERT INTO `avaliacao` (`ID`, `Stars`, `Desc`, `prod_id`, `user_id`) VALUES
(25, 0, 'asdfg', 9, 57),
(26, 0, 'asdfg', 9, 57),
(27, 2, 'asdfg', 8, 58),
(42, 0, 'adfhadf', 9, 58),
(43, 2, 'abobrinha', 8, 57);

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

--
-- Dumping data for table `carrinho`
--

INSERT INTO `carrinho` (`ID`, `QuantidadeItem`, `Prod_id`, `Ped_id`) VALUES
(94, '1', 11, 12);

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
(1, 'Computador', NULL),
(2, '', 'tubarao te amo'),
(3, 'ola', 'batata'),
(5, 'brinquedo', 'brinque direito\r\n-woody toy story');

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `CEP` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `No_Cmplt` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rua` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Bairro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Apelido` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`ID`, `CEP`, `No_Cmplt`, `Rua`, `Bairro`, `Apelido`, `user_id`) VALUES
(1, '', '', '', '', 'Alecrim', 57),
(2, '117847296', '999', 'tem', 'tem tbm', 'lulu da quebrada', 58),
(3, '45645644', '999', 'tem', 'tem tbm', 'lua', 59),
(4, '346235', '102', 'aeghadfh', 'adfhgadfhg', 'adfhadfh', 59);

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
(10, '2023-04-10', '0', 'Gerente', 57),
(16, '2023-04-24', '9999999', 'Gerente', 58),
(19, '2023-04-24', '7000', 'Mercadologo', 59);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `ID` int(11) NOT NULL,
  `Data` datetime NOT NULL DEFAULT current_timestamp(),
  `Pag` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Boleto',
  `Total` decimal(59,0) DEFAULT NULL,
  `clid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`ID`, `Data`, `Pag`, `Total`, `clid_id`) VALUES
(7, '2023-04-22 00:00:00', 'Boleto', NULL, 1),
(12, '2020-02-28 00:00:00', 'Boleto', NULL, 1),
(14, '2023-03-15 00:00:00', 'Pix', NULL, 3);

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
(8, 'Computador Asus i9 8GB RAM Nvidia 1080', 'É um computador de última geração... Muitos youtubers utilizam deste aparato contemporâneo nestes tempos... Muito legal e divertido... Dura pra sempre... Mentira... Mas dura por bastante tempo... Faz café.', '4959.99', '0', 999, 'imagens/foto7277911087231.jpg', 1),
(9, 'Abacate GAYmer', 'é uma goiaba gaymer.', '967456.00', '1', 9999, 'imagens/foto4824688534895.jpg', 1),
(10, 'Felipe Neto', 'olaaaaaaaaaaaaaa eu sou o felipe neto e seja benvido para mais uma compra, almoço completo é com felipe neto', '0.02', '7', 1, '', 3),
(11, 'woody toy story boneco', 'Nos brinquedos podemos ver tudinho então brinque direito', '6666.66', '5', 666, 'imagens/foto7216543414345.jpg', 5);

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
(57, 'gabrielcavalhiere2@gmail.com', '12345678', 'Gabriel Cavalhiere', NULL, '+55 (32) 99127-7540', NULL, '', '0303-10-30', '2023-04-10 19:32:20'),
(58, 'odranoel.adrecal@hotmail.com', '12345678', 'Odranoel Adrecal', NULL, '', '', NULL, '2023-04-24', '2023-04-24 05:32:19'),
(59, 'luaduarte@gmail.com', 'peixe123', 'Lua duarte Lacerda', 'F', '(32) 98877-5522', '55555555555', 'MG-12.345.67', '2020-02-08', '2023-04-24 09:13:30'),
(60, 'alessandrajesus@gmail.com', '12345678', 'Alessandra Jesus', 'M', '+55 (32) 12345-1234', '543.543.215-01', 'BA-12.345.234', '2008-10-14', '2023-05-03 04:57:13');

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
  ADD KEY `fk_tbCarrinho_tbProduto` (`Prod_id`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_tbAvailacao_tbUsuario` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbAvaliacao_tbProduto` FOREIGN KEY (`prod_id`) REFERENCES `produto` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
