-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 05:06 PM
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
-- Database: `losmirrores`
--

-- --------------------------------------------------------

--
-- Table structure for table `avaliacao`
--

CREATE TABLE `avaliacao` (
  `avail_id` int(11) NOT NULL,
  `avail_estrelas` int(1) NOT NULL,
  `avail_descricao` varchar(300) DEFAULT NULL,
  `avail_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `prod_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carrinho`
--

CREATE TABLE `carrinho` (
  `car_id` int(11) NOT NULL,
  `car_qtde` int(4) NOT NULL DEFAULT 1,
  `prod_id` int(11) NOT NULL,
  `ped_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carrinho`
--

INSERT INTO `carrinho` (`car_id`, `car_qtde`, `prod_id`, `ped_id`) VALUES
(34, 3, 38, 19),
(35, 6, 39, 19),
(36, 4, 40, 19),
(37, 3, 41, 19),
(38, 2, 42, 19),
(39, 6, 43, 19),
(40, 1, 44, 19),
(41, 3, 38, 20),
(42, 6, 39, 20),
(43, 4, 40, 20),
(44, 3, 41, 20),
(45, 2, 42, 20),
(46, 6, 43, 20),
(47, 1, 44, 20),
(48, 3, 38, 21),
(49, 6, 39, 21),
(50, 4, 40, 21),
(51, 3, 41, 21),
(52, 2, 42, 21),
(53, 6, 43, 21),
(54, 1, 44, 21),
(55, 3, 38, 22),
(56, 6, 39, 22),
(57, 4, 40, 22),
(58, 3, 41, 22),
(59, 2, 42, 22),
(60, 6, 43, 22),
(61, 1, 44, 22);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `cat_id` int(11) NOT NULL,
  `cat_nome` varchar(20) NOT NULL,
  `cat_desc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`cat_id`, `cat_nome`, `cat_desc`) VALUES
(1, 'Computadores', ''),
(2, 'Marcas', ''),
(3, 'Acessórios', ''),
(5, 'Monitores', ''),
(6, 'Processadores', ''),
(7, 'Placas de Vídeo', '');

-- --------------------------------------------------------

--
-- Table structure for table `endereco`
--

CREATE TABLE `endereco` (
  `end_id` int(11) NOT NULL,
  `end_regiao` varchar(12) NOT NULL,
  `end_estado` varchar(19) NOT NULL,
  `end_cidade` varchar(30) NOT NULL,
  `end_cep` varchar(9) NOT NULL,
  `end_num` varchar(3) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `endereco`
--

INSERT INTO `endereco` (`end_id`, `end_regiao`, `end_estado`, `end_cidade`, `end_cep`, `end_num`, `user_id`) VALUES
(1, 'Sudeste', 'Minas Gerais', 'Cataguases', '12345', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `filtro`
--

CREATE TABLE `filtro` (
  `fltr_id` int(11) NOT NULL,
  `fltr_nome` varchar(30) NOT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filtro`
--

INSERT INTO `filtro` (`fltr_id`, `fltr_nome`, `cat_id`) VALUES
(13, 'Dell', 2),
(14, 'Samsung', 2),
(15, 'Mouse', 3),
(17, 'Teclado', 3),
(18, 'Suporte de Notebook', 3),
(20, 'Cabo', 3),
(22, 'Carregador', 3),
(23, '21\"', 5),
(30, '19\"', 5),
(31, '17\"', 5),
(32, '15\"', 5),
(33, '14\"', 5),
(34, '13\"', 5),
(35, '23\"', 5),
(36, '24\"', 5),
(37, '28\"', 5),
(38, 'Philco', 2),
(40, 'Xiaomi', 2),
(41, 'Nvidia', 2),
(42, 'Intel', 2),
(43, 'Suporte', 3),
(44, 'Redragon', 2),
(45, 'Mouse pad', 3),
(46, 'Asus', 2),
(47, 'Acer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `funcionario`
--

CREATE TABLE `funcionario` (
  `func_id` int(11) NOT NULL,
  `func_salario` decimal(7,2) NOT NULL,
  `func_cargo` varchar(30) NOT NULL,
  `func_admissao` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funcionario`
--

INSERT INTO `funcionario` (`func_id`, `func_salario`, `func_cargo`, `func_admissao`, `user_id`) VALUES
(1, '99999.00', 'Gerente', '2023-05-31', 1),
(4, '99999.00', 'Gerente', '2023-05-29', 9);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `ped_id` int(11) NOT NULL,
  `ped_status` char(20) NOT NULL DEFAULT 'Processando',
  `ped_data` timestamp NOT NULL DEFAULT current_timestamp(),
  `ped_pag` varchar(20) NOT NULL DEFAULT 'Boleto',
  `ped_total` decimal(59,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `end_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`ped_id`, `ped_status`, `ped_data`, `ped_pag`, `ped_total`, `user_id`, `end_id`) VALUES
(19, 'Processando', '2023-05-30 21:20:14', 'Boleto', NULL, 1, 1),
(20, 'Processando', '2023-05-30 21:20:57', 'Boleto', '3882.98', 1, 1),
(21, 'Processando', '2023-05-30 21:21:38', 'Boleto', '3882.98', 1, 1),
(22, 'Processando', '2023-05-30 21:21:39', 'Boleto', '3882.98', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `prod_id` int(11) NOT NULL,
  `prod_nome` varchar(100) NOT NULL,
  `prod_desc` varchar(3000) NOT NULL,
  `prod_preco` decimal(59,2) NOT NULL DEFAULT 0.01,
  `prod_dscnt` int(2) DEFAULT 0,
  `prod_qtde` int(4) NOT NULL DEFAULT 0,
  `prod_criado` timestamp NOT NULL DEFAULT current_timestamp(),
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produto`
--

INSERT INTO `produto` (`prod_id`, `prod_nome`, `prod_desc`, `prod_preco`, `prod_dscnt`, `prod_qtde`, `prod_criado`, `cat_id`) VALUES
(38, 'SUPORTE PARA HEADSET REDRAGON SCEPTER RGB PRO HA300', 'led', '139.00', 5, 765, '2023-05-30 00:19:28', 3),
(39, 'Mouse Pad Gamer Iluminado led Rgb Grande 80 cm por 30 com Mousepad gamer Led com em volta superficie', 'led em tudo', '62.00', 5, 626, '2023-05-30 00:22:22', 3),
(40, 'Monitor Gamer Samsung 28\" FHD,75Hz, HDMI, VGA, Freesync,Preto, Série T350', 'Eco Saving Plus, Eye Saver Mode, Flicker Free, Game mode, Image Size, FreeSync, Off Timer Plus\r\nRecurso Gerais -Eco Saving Plus: Sim -Eye Saver Mode:Sim -Flicker Free: Sim -Modo Game: Sim -Tamanho da Imagem: Sim -Certificação Windows: Windows 10 -FreeSync:Sim -Off Timer Plus: Sim Interface -Display sem fio: Não -D-Sub: 1 EA -DVI: Não -Dual Link DVI: Não -Display Port: Não -Versão do Display Port: Não -Display Port Out: Não -Versão da saída do Display Port: Não -Mini-Display Port: Não -HDMI: 1 EA -Versão HDMI: 1.4 -Entrada de áudio:Não -Fones de ouvido: Não -Portas USB: Não -Versão hub USB: Não -USB-C: Não -USB-C Charging Power: Não\r\nÁudio: -Alto-falante: Não -Soundbar USB (pronto): Não Condições Operacionais -Temperatura: 10%u2103 40%u2103 -Umidade: 10% 80% sem condensação Design -Cor: AZUL-ESCURO ACINZENTADO -Suporte Base: Simples -Inclinação Ajustável: -2 ~ 20 -Montagem de parede: 100 x 100 Eco -Recycled Plastic: Não Alimentação -Alimentação de Energia: AC 100~240V -Tipo: Adaptador externo\r\nExplore a nossa gama de produtos', '1089.99', 9, 879, '2023-05-30 00:26:08', 5),
(41, 'Smart Monitor Samsung 24\", FHD, Plataforma Tizen™, Tap View, HDMI, Bluetooth, HDR, Preto, Série M5', 'Eye Saver Mode, Flicker Free, Game Mode, Auto Source Switch+, Adaptive Picture, Ultrawide Game View\r\nMarca: Samsung\r\nPaís de origem do produto: CN\r\nFabricante :SAMSUNG ELETRONICA DA AMAZONIA LTDA', '1099.99', 6, 373, '2023-05-30 00:30:50', 5),
(42, 'Mouse LED Ergonômico 1600dpi 6 botões - PC e Laptop - Verto Mouse 22885 - Trust', 'Trabalhe confortavelmente por longos períodos de tempo, evitando mal-estar no braço e pulso\r\nApoio confortável para polegar e revestimento em borracha para uma aderência perfeita\r\nBotão seletor de velocidade (1000/1600 DPI)\r\n2 botões de polegar: Retroceder e avançar no navegador\r\nAtraente iluminação LED azul', '74.00', 4, 763, '2023-05-30 00:34:05', 3),
(43, 'Placa de Vídeo ASUS TUF Gaming - GeForce GTX 1650, 4GB DDR6', 'Desing sofisticado\r\nUltrarápido GDDR6 com mais de 50% mais de largura de banda de memória para jogos de alta velocidade; a GeForce Experience permite que você capture e compartilhe vídeos, capturas de tela e saídas com amigos, mantenha os drivers GeForce atualizados e otimize facilmente suas configurações no jogo\r\nModelo de placa de vídeo NVIDIA GeForce GTX 1650\r\nExplore a nossa gama de produtos', '1248.00', 9, 653, '2023-05-30 00:38:15', 7),
(44, 'CARREGADOR SAMSUNG TA800 25W S. FAST CHARGE', 'O Carregador de Viagem Super Fast Charging 25W foi especialmente desenvolvido para recarregar a bateria de Tablets e Smartphones com mais rapidez e segurança. Tem a função de Carregamento Super Rápido (compatível com o Galaxy Note 10+/Note10, A70 e futuros flagships). Esta função permite recarregar o telefone mais rápido que um carregador tradicional.', '170.00', 4, 742, '2023-05-30 00:44:46', 3),
(45, 'Processador AMD Ryzen 5 5600G, 3.9GHz (4.4GHz Max Turbo), AM4, Vídeo Integrado, 6 Núcleos', 'Processador AMD Ryzen 5 5600G 3.9 até 4.4GHZ 19MB AM4 Wraith Stealth Radeon - PN:100-100000252BOX\r\nUm produto de verdadeiro desempenho\r\nProdutos com garantia de qualidade', '865.00', 4, 6436, '2023-05-30 00:53:39', 2),
(46, 'Teclado Gamer Mecânico para Pc Computador Adamantiun Excalibur Marrom Led Rainbow Switch Brown Marro', 'Switch Brown com feedback tátil\r\nApoio de punhos magnético\r\nMemória integrada, mantém as configurações de led e macro salvas\r\nBotão giratório, controle do brilho e do volume de áudio no PC\r\nBotões com função multimídia avançar e retroceder\r\nÉ Full Anti-Ghosting, reconhece todas as pressionadas juntas\r\nEscolha de tecla iluminada, personalize do seu jeito!', '300.00', 8, 986, '2023-05-30 00:55:31', 3),
(47, 'Suporte P/Notebook - Regulável, Ergonômico e Portátil (PRETO)', 'Totalmente portátil – Suporte extremamente leve (250g) e compacto (retrátil)\r\nPronto para usar – não é necessário uso de parafusos ou qualquer ferramenta\r\nDisponível em 3 cores: Rosa, Branco e Preto.\r\nO Suporte mantém o notebook em um nível elevado da mesa, permitindo a livre circulação do ar abaixo do aparelho garantindo uma boa refrigeração e ajudando', '21.00', 1, 244, '2023-05-30 00:58:07', 3),
(48, 'ACER Notebook Gamer Nitro 5 AN515-57-585H, CI5 11400H, 8GB, 1TB SDD, (NVIDIA GTX 1650) Windows 11. 1', 'Processador Intel Core i5-11400H - Six Core – 11ª Geração\r\nTela de 15,6” IPS de 144HZ com resolução Full HD\r\nSistema Operacional Windows 11\r\nGPU Nvidia GeForce GTX 1650 com 4 GB de memória dedicada GDDR6 (TGP de 50W)\r\nTecnologia DTS X: Ultra Áudio', '5625.00', 8, 235, '2023-05-30 01:06:34', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produto_filtro`
--

CREATE TABLE `produto_filtro` (
  `pf_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `fltr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produto_filtro`
--

INSERT INTO `produto_filtro` (`pf_id`, `prod_id`, `fltr_id`) VALUES
(18, 38, 44),
(19, 38, 43),
(20, 39, 45),
(21, 40, 14),
(22, 40, 37),
(23, 41, 14),
(24, 41, 36),
(25, 42, 15),
(26, 43, 46),
(27, 44, 14),
(28, 44, 20),
(29, 46, 17),
(30, 47, 18),
(31, 48, 47);

-- --------------------------------------------------------

--
-- Table structure for table `produto_galeria`
--

CREATE TABLE `produto_galeria` (
  `img_id` int(11) NOT NULL,
  `img_link` varchar(2048) NOT NULL,
  `prod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produto_galeria`
--

INSERT INTO `produto_galeria` (`img_id`, `img_link`, `prod_id`) VALUES
(27, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/1838526684512.jpg', 38),
(28, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/9067478254152.jpg', 39),
(29, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/333945268323.jpg', 39),
(30, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/989622345839.jpg', 40),
(31, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/9172020180925.jpg', 40),
(32, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/8387161244423.jpg', 41),
(33, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/2671654753770.jpg', 41),
(34, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/121282565956.jpg', 42),
(35, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/1415252510592.jpg', 42),
(36, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/7380567345365.jpg', 43),
(37, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/15217991099.jpg', 43),
(38, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/279422284320.jpg', 44),
(39, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/9922249400047.jpg', 44),
(40, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/8382034776406.jpg', 45),
(41, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/4809382764883.jpg', 46),
(42, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/7729132114540.jpg', 46),
(43, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/5695545639632.jpg', 47),
(44, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/4632811016843.jpg', 47),
(45, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/4906868529493.jpg', 48),
(46, 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/3115459108915.jpg', 48);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `user_id` int(11) NOT NULL,
  `user_nome` varchar(100) NOT NULL,
  `user_email` varchar(320) NOT NULL,
  `user_senha` varchar(20) NOT NULL,
  `user_nascimento` date NOT NULL,
  `user_sexo` char(1) DEFAULT NULL,
  `user_telefone` char(19) DEFAULT NULL,
  `user_cpf` char(14) DEFAULT NULL,
  `user_rg` char(13) DEFAULT NULL,
  `user_criado` timestamp NULL DEFAULT current_timestamp(),
  `user_pfp` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`user_id`, `user_nome`, `user_email`, `user_senha`, `user_nascimento`, `user_sexo`, `user_telefone`, `user_cpf`, `user_rg`, `user_criado`, `user_pfp`) VALUES
(1, 'Gabriel Cavalhiere', 'gabrielcavalhiere2@gmail.com', 'asdfasdf', '2023-05-25', NULL, NULL, NULL, NULL, '2023-05-26 02:48:36', 'http://localhost/TechorAko/Los-Mirrores/assets/prod_img/5279086434155.jpg'),
(9, 'Odranoel Adrecal', 'odreanoel.adrecal@hotmail.com', '12345678', '2023-05-29', NULL, NULL, '', '', '2023-05-30 00:07:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`avail_id`),
  ADD UNIQUE KEY `prod_id` (`prod_id`,`user_id`),
  ADD KEY `fk_avaliacao_usuario` (`user_id`);

--
-- Indexes for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`end_id`),
  ADD KEY `fk_endereco_usuario` (`user_id`);

--
-- Indexes for table `filtro`
--
ALTER TABLE `filtro`
  ADD PRIMARY KEY (`fltr_id`),
  ADD KEY `fk_filtro_categoria` (`cat_id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`func_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ped_id`),
  ADD KEY `tk_pedido_usuario` (`user_id`),
  ADD KEY `tk_pedido_endereco` (`end_id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`prod_id`),
  ADD UNIQUE KEY `prod_nome` (`prod_nome`),
  ADD KEY `fk_produto_categoria` (`cat_id`);

--
-- Indexes for table `produto_filtro`
--
ALTER TABLE `produto_filtro`
  ADD PRIMARY KEY (`pf_id`),
  ADD KEY `fk_pf_filtro` (`fltr_id`),
  ADD KEY `fk_pf_produto` (`prod_id`);

--
-- Indexes for table `produto_galeria`
--
ALTER TABLE `produto_galeria`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `fk_imagens_produtos` (`prod_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `avail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `end_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `filtro`
--
ALTER TABLE `filtro`
  MODIFY `fltr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `func_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ped_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `produto_filtro`
--
ALTER TABLE `produto_filtro`
  MODIFY `pf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `produto_galeria`
--
ALTER TABLE `produto_galeria`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_produto` FOREIGN KEY (`prod_id`) REFERENCES `produto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_avaliacao_usuario` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_carrinho_pedido` FOREIGN KEY (`ped_id`) REFERENCES `pedido` (`ped_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_carrinho_produto` FOREIGN KEY (`prod_id`) REFERENCES `produto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_usuario` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filtro`
--
ALTER TABLE `filtro`
  ADD CONSTRAINT `fk_filtro_categoria` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_usuario` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `tk_pedido_endereco` FOREIGN KEY (`end_id`) REFERENCES `endereco` (`end_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tk_pedido_usuario` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produto_filtro`
--
ALTER TABLE `produto_filtro`
  ADD CONSTRAINT `fk_pf_filtro` FOREIGN KEY (`fltr_id`) REFERENCES `filtro` (`fltr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pf_produto` FOREIGN KEY (`prod_id`) REFERENCES `produto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produto_galeria`
--
ALTER TABLE `produto_galeria`
  ADD CONSTRAINT `fk_imagens_produtos` FOREIGN KEY (`prod_id`) REFERENCES `produto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
