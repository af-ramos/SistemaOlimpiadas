--
-- Banco de dados: `olimpiada`
--

CREATE DATABASE `olimpiada`;
USE `olimpiada`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atleta`
--

CREATE TABLE `atleta` (
  `idAtleta` int(11) NOT NULL,
  `idade` int(11) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `altura` decimal(10,2) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `modalidade` varchar(30) NOT NULL,
  `pais_codigo` varchar(3) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `atleta`
--

INSERT INTO `atleta` (`idAtleta`, `idade`, `sexo`, `altura`, `peso`, `modalidade`, `pais_codigo`, `nome`) VALUES
(4, 24, 'M', '1.65', '63.30', 'Futebol', 'USA', 'Katherine'),
(23, 22, 'H', '1.75', '65.36', 'Basquete', 'BRA', 'Renato'),
(34, 22, 'M', '1.70', '70.00', 'Ginastica artistica', 'DEU', 'Sofie'),
(45, 23, 'H', '1.88', '77.88', 'Atletismo', 'FRA', 'Macron'),
(75, 21, 'H', '1.85', '78.23', 'Natacao', 'DNK', 'Rosjberg'),
(81, 23, 'H', '1.74', '67.56', 'Corrida', 'JPN', 'Toshimura Shigaraki'),
(99, 27, 'H', '1.98', '110.76', 'Levantamento de peso', 'MUS', 'Motomoto'),
(235, 28, 'F', '1.71', '59.61', 'Ginastica Ritmica', 'JPN', 'Aika Yamamoto'),
(365, 17, 'F', '1.91', '88.11', 'Tiro', 'DEU', 'Mia Ludwig'),
(1102, 21, 'F', '1.68', '46.25', 'Esgrima', 'FRA', 'Jamilla Durand'),
(1356, 32, 'M', '2.01', '90.12', 'Futebol de Campo', 'IRL', 'Gael O brien'),
(1357, 19, 'F', '1.71', '66.12', 'Natação', 'IRQ', 'Aisha Sabbah'),
(1456, 22, 'M', '1.81', '76.12', 'Boxe', 'ARG', 'Nicolás Diaz'),
(2016, 24, 'F', '1.61', '42.35', 'Ginastica Ritmica', 'BRA', 'Dayane dos Santos'),
(2035, 18, 'M', '1.89', '100.16', 'Halterofilismo', 'USA', 'Kevin Stone'),
(3126, 26, 'M', '1.74', '76.85', 'Revezamento', 'BRA', 'Felipe Souza');

--
-- Acionadores `atleta`
--
DELIMITER $$
CREATE TRIGGER `AtualizarNumAtletas_Delete` AFTER DELETE ON `atleta` FOR EACH ROW BEGIN
	UPDATE pais SET pais.numeroAtletas = pais.numeroAtletas - 1 WHERE pais.codigo = OLD.pais_codigo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AtualizarNumAtletas_Insert` AFTER INSERT ON `atleta` FOR EACH ROW BEGIN
	UPDATE pais SET pais.numeroAtletas = pais.numeroAtletas + 1 WHERE pais.codigo = NEW.pais_codigo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AtualizarNumAtletas_Update` AFTER UPDATE ON `atleta` FOR EACH ROW BEGIN
	UPDATE pais SET pais.numeroAtletas = pais.numeroAtletas + 1 WHERE pais.codigo = NEW.pais_codigo;
    UPDATE pais SET pais.numeroAtletas = pais.numeroAtletas - 1 WHERE pais.codigo = OLD.pais_codigo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `competir`
--

CREATE TABLE `competir` (
  `atleta_idAtleta` int(11) NOT NULL,
  `prova_data` date NOT NULL,
  `prova_horario` time NOT NULL,
  `local_codigo` int(11) NOT NULL,
  `olimpiada_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `competir`
--

INSERT INTO `competir` (`atleta_idAtleta`, `prova_data`, `prova_horario`, `local_codigo`, `olimpiada_nome`) VALUES
(4, '2020-08-19', '18:30:00', 45346, 'Toquio'),
(23, '2020-08-23', '13:00:00', 32453, 'Toquio'),
(45, '2020-08-02', '15:30:00', 98235, 'Toquio'),
(75, '2020-08-15', '18:30:00', 54675, 'Toquio'),
(99, '2020-08-02', '12:30:00', 234532, 'Toquio'),
(235, '2016-08-22', '09:15:00', 74235, 'Rio'),
(1102, '2016-08-16', '21:15:00', 789512, 'Rio'),
(2016, '2016-08-20', '08:45:00', 34664, 'Rio'),
(2035, '2016-08-16', '19:10:00', 324523, 'Rio'),
(3126, '2016-08-26', '21:45:00', 7895, 'Rio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE `local` (
  `capacidade` int(11) NOT NULL,
  `endereco` varchar(30) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `pais_codigo` varchar(3) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`capacidade`, `endereco`, `nome`, `pais_codigo`, `codigo`) VALUES
(15, 'Barra da Tijuca, Rio de Janeir', 'Estádio Aquático Olímpico, ', 'BRA', 7895),
(68, 'Shinjuku City, Toquio', 'Toquio OLYMPIC STADIUM, ', 'JPN', 32453),
(9, 'Barra da Tijuca, Rio de Janeir', 'Riocentro, ', 'BRA', 34664),
(24, 'Shibuya City, Toquio', 'YOYOGI NATIONAL GYMNASIUM, ', 'JPN', 45346),
(45, 'Chiyoda City, Toquio', 'NIPPON BUDOKAN, ', 'JPN', 54675),
(44, 'Engenho de Dentro, Rio de Jane', 'Estádio Olímpico Nilton Santos', 'BRA', 74235),
(28, 'Koto City, Toquio', 'Ariake Arena, ', 'JPN', 74545),
(32, 'Koto City, Toquio', 'Toquio AQUATICS CENTRE, ', 'JPN', 98235),
(10, 'Sumida City, Toquio', 'KOKUGIKAN ARENA, ', 'JPN', 234532),
(16, 'Barra da Tijuca, Rio de Janeir', 'Arena Carioca 1, ', 'BRA', 324523),
(79, 'Maracanã, Rio de Janeiro', 'Estádio do Maracana, ', 'BRA', 789512);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medalha`
--

CREATE TABLE `medalha` (
  `tipoMedalha` enum('Ouro','Prata','Bronze') NOT NULL,
  `atleta_idAtleta` int(11) NOT NULL,
  `prova_data` date NOT NULL,
  `prova_horario` time NOT NULL,
  `local_codigo` int(11) NOT NULL,
  `olimpiada_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medalha`
--

INSERT INTO `medalha` (`tipoMedalha`, `atleta_idAtleta`, `prova_data`, `prova_horario`, `local_codigo`, `olimpiada_nome`) VALUES
('Ouro', 4, '2020-08-19', '18:30:00', 45346, 'Toquio'),
('Ouro', 23, '2020-08-23', '13:00:00', 32453, 'Toquio'),
('Bronze', 45, '2020-08-02', '15:30:00', 98235, 'Toquio'),
('Ouro', 75, '2020-08-15', '18:30:00', 54675, 'Toquio'),
('Bronze', 99, '2020-08-02', '12:30:00', 234532, 'Toquio'),
('Prata', 235, '2016-08-22', '09:15:00', 74235, 'Rio'),
('Bronze', 1102, '2016-08-16', '21:15:00', 789512, 'Rio'),
('Prata', 2016, '2016-08-20', '08:45:00', 34664, 'Rio'),
('Prata', 2035, '2016-08-16', '19:10:00', 324523, 'Rio'),
('Prata', 3126, '2016-08-26', '21:45:00', 7895, 'Rio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `olimpiada`
--

CREATE TABLE `olimpiada` (
  `nome` varchar(30) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_termino` date NOT NULL,
  `primeiro` varchar(3) DEFAULT NULL,
  `segundo` varchar(3) DEFAULT NULL,
  `terceiro` varchar(3) DEFAULT NULL,
  `ano` int(4) NOT NULL,
  `pais_codigo` varchar(3) NOT NULL,
  `qtdPaises` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `olimpiada`
--

INSERT INTO `olimpiada` (`nome`, `data_inicio`, `data_termino`, `primeiro`, `segundo`, `terceiro`, `ano`, `pais_codigo`, `qtdPaises`) VALUES
('Paris', '2022-08-23', '2022-08-24', NULL, NULL, NULL, 2024, 'CHN', 0),
('Rio', '2016-08-05', '2016-08-21', 'BRA', 'JPN', 'USA', 2016, 'BRA', 9),
('Toquio', '2021-07-23', '2021-08-08', 'BRA', 'DNK', 'USA', 2020, 'JPN', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `nome` varchar(30) NOT NULL,
  `numeroAtletas` int(11) NOT NULL DEFAULT 0,
  `codigo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`nome`, `numeroAtletas`, `codigo`) VALUES
('Argentina', 1, 'ARG'),
('Bolivia', 0, 'BOL'),
('Brasil', 3, 'BRA'),
('China', 0, 'CHN'),
('Alemanha', 2, 'DEU'),
('Dinamarca', 1, 'DNK'),
('Franca', 2, 'FRA'),
('Grã-Bretanha', 0, 'GBR'),
('Grécia', 0, 'GRE'),
('Croacia', 0, 'HRV'),
('Irlanda', 1, 'IRL'),
('Iraque', 1, 'IRQ'),
('Japao', 2, 'JPN'),
('Mauricio', 1, 'MUS'),
('Paises baixos', 0, 'NLD'),
('Russia', 0, 'RUS'),
('Estados Unidos', 2, 'USA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participar`
--

CREATE TABLE `participar` (
  `pais_codigo` varchar(3) NOT NULL,
  `olimpiada_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `participar`
--

INSERT INTO `participar` (`pais_codigo`, `olimpiada_nome`) VALUES
('BRA', 'Rio'),
('BRA', 'Toquio'),
('DEU', 'Rio'),
('DEU', 'Toquio'),
('DNK', 'Rio'),
('DNK', 'Toquio'),
('FRA', 'Rio'),
('FRA', 'Toquio'),
('IRL', 'Rio'),
('IRL', 'Toquio'),
('JPN', 'Rio'),
('JPN', 'Toquio'),
('MUS', 'Rio'),
('MUS', 'Toquio'),
('NLD', 'Rio'),
('NLD', 'Toquio'),
('USA', 'Rio'),
('USA', 'Toquio');

--
-- Acionadores `participar`
--
DELIMITER $$
CREATE TRIGGER `AtualizarQtdPaises_Delete` AFTER DELETE ON `participar` FOR EACH ROW BEGIN
	UPDATE olimpiada SET qtdPaises = qtdPaises - 1 WHERE nome = OLD.olimpiada_nome;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AtualizarQtdPaises_Insert` AFTER INSERT ON `participar` FOR EACH ROW BEGIN
	UPDATE olimpiada SET qtdPaises = qtdPaises + 1 WHERE nome = NEW.olimpiada_nome;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AtualizarQtdPaises_Update` AFTER UPDATE ON `participar` FOR EACH ROW BEGIN
	UPDATE olimpiada SET qtdPaises = qtdPaises - 1 WHERE nome = OLD.olimpiada_nome;
    UPDATE olimpiada SET qtdPaises = qtdPaises + 1 WHERE nome = NEW.olimpiada_nome;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `patrocinador`
--

CREATE TABLE `patrocinador` (
  `nome` varchar(30) NOT NULL,
  `idEmpresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `patrocinador`
--

INSERT INTO `patrocinador` (`nome`, `idEmpresa`) VALUES
('Coca Cola', 1),
('Adidas', 2),
('Nike', 3),
('Red Bull', 4),
('Rolex', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `patrocinar`
--

CREATE TABLE `patrocinar` (
  `patrocinador_idEmpresa` int(11) NOT NULL,
  `olimpiada_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `patrocinar`
--

INSERT INTO `patrocinar` (`patrocinador_idEmpresa`, `olimpiada_nome`) VALUES
(1, 'Rio'),
(1, 'Toquio'),
(2, 'Rio'),
(2, 'Toquio'),
(3, 'Rio'),
(3, 'Toquio'),
(4, 'Rio'),
(4, 'Toquio'),
(5, 'Rio'),
(5, 'Toquio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prova`
--

CREATE TABLE `prova` (
  `modalidade` varchar(30) NOT NULL,
  `emEquipe` tinyint(1) NOT NULL,
  `tipoModalidade` varchar(30) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `olimpiada_nome` varchar(30) NOT NULL,
  `local_codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `prova`
--

INSERT INTO `prova` (`modalidade`, `emEquipe`, `tipoModalidade`, `data`, `horario`, `olimpiada_nome`, `local_codigo`) VALUES
('Corrida', 0, '100m', '2016-08-16', '19:10:00', 'Rio', 324523),
('Atletismo', 0, '10.000', '2016-08-16', '21:15:00', 'Rio', 789512),
('Natacao', 0, '200m livre', '2016-08-20', '08:45:00', 'Rio', 34664),
('Hipismo', 0, 'Hipismo', '2016-08-22', '09:15:00', 'Rio', 74235),
('Ginástica ', 1, 'Ginástica Ritmica', '2016-08-26', '21:45:00', 'Rio', 7895),
('Basquete', 1, 'Basquete', '2020-08-02', '12:30:00', 'Toquio', 234532),
('Futebol', 1, 'Futsal', '2020-08-02', '15:30:00', 'Toquio', 98235),
('Ginastica', 1, 'Ginastica artistica', '2020-08-15', '18:30:00', 'Toquio', 54675),
('Futebol', 1, 'Futebol de Campo', '2020-08-19', '18:30:00', 'Toquio', 45346),
('Luta', 0, 'Boxe', '2020-08-23', '13:00:00', 'Toquio', 32453),
('Luta', 1, 'Boxe', '2022-08-27', '04:00:00', 'Toquio', 32453);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atleta`
--
ALTER TABLE `atleta`
  ADD PRIMARY KEY (`idAtleta`),
  ADD KEY `pais_codigo` (`pais_codigo`);

--
-- Índices para tabela `competir`
--
ALTER TABLE `competir`
  ADD PRIMARY KEY (`atleta_idAtleta`,`prova_data`,`prova_horario`,`local_codigo`,`olimpiada_nome`),
  ADD KEY `prova_data` (`prova_data`,`prova_horario`,`olimpiada_nome`,`local_codigo`);

--
-- Índices para tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `pais_codigo` (`pais_codigo`);

--
-- Índices para tabela `medalha`
--
ALTER TABLE `medalha`
  ADD PRIMARY KEY (`atleta_idAtleta`,`prova_data`,`prova_horario`,`local_codigo`,`olimpiada_nome`);

--
-- Índices para tabela `olimpiada`
--
ALTER TABLE `olimpiada`
  ADD PRIMARY KEY (`nome`),
  ADD KEY `pais_codigo` (`pais_codigo`),
  ADD KEY `primeiro` (`primeiro`),
  ADD KEY `segundo` (`segundo`),
  ADD KEY `terceiro` (`terceiro`);

--
-- Índices para tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`codigo`);

--
-- Índices para tabela `participar`
--
ALTER TABLE `participar`
  ADD PRIMARY KEY (`pais_codigo`,`olimpiada_nome`),
  ADD KEY `fk_Olimpiada_nome` (`olimpiada_nome`);

--
-- Índices para tabela `patrocinador`
--
ALTER TABLE `patrocinador`
  ADD PRIMARY KEY (`idEmpresa`);

--
-- Índices para tabela `patrocinar`
--
ALTER TABLE `patrocinar`
  ADD PRIMARY KEY (`patrocinador_idEmpresa`,`olimpiada_nome`),
  ADD KEY `olimpiada_nome` (`olimpiada_nome`);

--
-- Índices para tabela `prova`
--
ALTER TABLE `prova`
  ADD PRIMARY KEY (`data`,`horario`,`olimpiada_nome`,`local_codigo`),
  ADD KEY `fk_local_codigo` (`local_codigo`),
  ADD KEY `olimpiada_nome` (`olimpiada_nome`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atleta`
--
ALTER TABLE `atleta`
  ADD CONSTRAINT `atleta_ibfk_1` FOREIGN KEY (`pais_codigo`) REFERENCES `pais` (`codigo`);

--
-- Limitadores para a tabela `competir`
--
ALTER TABLE `competir`
  ADD CONSTRAINT `competir_ibfk_1` FOREIGN KEY (`prova_data`,`prova_horario`,`olimpiada_nome`,`local_codigo`) REFERENCES `prova` (`data`, `horario`, `olimpiada_nome`, `local_codigo`),
  ADD CONSTRAINT `fk_atleta_idAtleta` FOREIGN KEY (`atleta_idAtleta`) REFERENCES `atleta` (`idAtleta`);

--
-- Limitadores para a tabela `local`
--
ALTER TABLE `local`
  ADD CONSTRAINT `local_ibfk_1` FOREIGN KEY (`pais_codigo`) REFERENCES `pais` (`codigo`);

--
-- Limitadores para a tabela `medalha`
--
ALTER TABLE `medalha`
  ADD CONSTRAINT `medalha_ibfk_1` FOREIGN KEY (`atleta_idAtleta`,`prova_data`,`prova_horario`,`local_codigo`,`olimpiada_nome`) REFERENCES `competir` (`atleta_idAtleta`, `prova_data`, `prova_horario`, `local_codigo`, `olimpiada_nome`);

--
-- Limitadores para a tabela `olimpiada`
--
ALTER TABLE `olimpiada`
  ADD CONSTRAINT `olimpiada_ibfk_1` FOREIGN KEY (`pais_codigo`) REFERENCES `pais` (`codigo`),
  ADD CONSTRAINT `olimpiada_ibfk_2` FOREIGN KEY (`primeiro`) REFERENCES `pais` (`codigo`),
  ADD CONSTRAINT `olimpiada_ibfk_3` FOREIGN KEY (`segundo`) REFERENCES `pais` (`codigo`),
  ADD CONSTRAINT `olimpiada_ibfk_4` FOREIGN KEY (`terceiro`) REFERENCES `pais` (`codigo`);

--
-- Limitadores para a tabela `participar`
--
ALTER TABLE `participar`
  ADD CONSTRAINT `fk_Olimpiada_nome` FOREIGN KEY (`olimpiada_nome`) REFERENCES `olimpiada` (`nome`),
  ADD CONSTRAINT `fk_Pais_codigo` FOREIGN KEY (`pais_codigo`) REFERENCES `pais` (`codigo`);

--
-- Limitadores para a tabela `patrocinar`
--
ALTER TABLE `patrocinar`
  ADD CONSTRAINT `fk_Patrocinador_idEmpresa` FOREIGN KEY (`patrocinador_idEmpresa`) REFERENCES `patrocinador` (`idEmpresa`),
  ADD CONSTRAINT `patrocinar_ibfk_1` FOREIGN KEY (`olimpiada_nome`) REFERENCES `olimpiada` (`nome`);

--
-- Limitadores para a tabela `prova`
--
ALTER TABLE `prova`
  ADD CONSTRAINT `fk_local_codigo` FOREIGN KEY (`local_codigo`) REFERENCES `local` (`codigo`),
  ADD CONSTRAINT `prova_ibfk_1` FOREIGN KEY (`olimpiada_nome`) REFERENCES `olimpiada` (`nome`);
COMMIT;
