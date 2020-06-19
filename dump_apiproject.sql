-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para apiproject
CREATE DATABASE IF NOT EXISTS `apiproject` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `apiproject`;

-- Copiando estrutura para tabela apiproject.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(255) NOT NULL,
  `emailCliente` varchar(255) NOT NULL,
  `telCliente` varchar(50) DEFAULT NULL,
  `ufCliente` varchar(255) NOT NULL,
  `cidadeCliente` varchar(255) NOT NULL,
  `dtNascCliente` date NOT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `emailCliente_UNIQUE` (`emailCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela apiproject.clientes: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`idCliente`, `nomeCliente`, `emailCliente`, `telCliente`, `ufCliente`, `cidadeCliente`, `dtNascCliente`) VALUES
	(1, 'Claudianus Boast', 'cboast0@fastcompany.com', '(19) 957645371', 'São Paulo', 'Araraquara', '1993-06-07'),
	(2, 'Loni Jennions', 'ljennions1@va.gov', '(19) 905613161', 'São Paulo', 'Limeira', '1985-05-09'),
	(3, 'Margi Gilhouley', 'mgilhouley2@telegraph.co.uk', '(19) 966290104', 'São Paulo', 'Araraquara', '1984-09-13'),
	(4, 'Lexy Sprulls', 'lsprulls3@moonfruit.com', '(19) 976121601', 'São Paulo', 'Rio Claro', '1999-10-19'),
	(5, 'Marie Shatliff', 'mshatliff4@cbslocal.com', '(19) 991376354', 'São Paulo', 'Rio Claro', '1990-07-20'),
	(6, 'Graig Mouncey', 'gmouncey5@so-net.ne.jp', '(19) 941806149', 'São Paulo', 'Araraquara', '1990-03-27'),
	(7, 'Laurice Liger', 'lliger0@php.net', '(35) 971740954', 'Minas Gerais', 'Areado', '1992-10-25'),
	(8, 'Kendrick Sooper', 'ksooper1@slate.com', '(31) 944324086', 'Minas Gerais', 'Belo Horizonte', '1981-06-02'),
	(9, 'Gordon Levington', 'glevington2@hpost.com ', '(31) 922405868', 'Minas Gerais ', 'Belo Horizonte ', '1993-11-25'),
	(10, 'Noam Scolland', 'nscolland3@mozilla.org', '(35) 996817669', 'Minas Gerais', 'Areado', '1999-12-31'),
	(11, 'Lindon Skehens', 'lskehens4@npr.org', '(35) 967671104', 'Minas Gerais', 'Areado', '1985-01-10'),
	(12, 'Kimbra Rase', ' krase5@topsy.com', '(35) 999428030', 'Minas Gerais', 'Areado', '1999-05-05'),
	(13, 'Lorenzo Fisk', 'lfisk6@businessweek.com', '(31) 912695467', 'Minas Gerais', 'Belo Horizonte', '1985-12-22'),
	(14, 'Bourke Flavelle', 'bflavelle7@fc2.com', '(35) 959386145', 'Minas Gerais', 'Itapeva', '1984-04-10'),
	(15, 'Curran McSharry', 'cmcsharry8@webeden.co.uk', '(35) 902916131', 'Minas Gerais', 'Itapeva', '1983-01-15'),
	(16, 'Aveline Dowtry', 'adowtry9@miibeian.gov.cn', '(31) 945227500', 'Minas Gerais', 'Belo Horizonte', '1994-12-23'),
	(17, 'John Sebastian', 'jsebastiana@cbslocal.com', '(31) 907366740', 'Minas Gerais', 'Belo Horizonte', '1998-04-06'),
	(18, 'Reynolds Greenan', 'rgreenanb@bloomberg.com', '(35) 923551410', 'Minas Gerais', 'Itapeva', '1985-07-19');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Copiando estrutura para tabela apiproject.clientesplanos
CREATE TABLE IF NOT EXISTS `clientesplanos` (
  `idCliente` int(11) unsigned NOT NULL,
  `idPlano` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idCliente`,`idPlano`),
  KEY `fk_idPlano_clientesplanos_idx` (`idPlano`),
  CONSTRAINT `fk_idCliente_clientesplanos` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`) ON UPDATE CASCADE,
  CONSTRAINT `fk_idPlano_clientesplanos` FOREIGN KEY (`idPlano`) REFERENCES `planos` (`idPlano`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela apiproject.clientesplanos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `clientesplanos` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientesplanos` ENABLE KEYS */;

-- Copiando estrutura para tabela apiproject.planos
CREATE TABLE IF NOT EXISTS `planos` (
  `idPlano` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nomePlano` varchar(255) NOT NULL,
  `mensalidadePlano` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`idPlano`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela apiproject.planos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
INSERT INTO `planos` (`idPlano`, `nomePlano`, `mensalidadePlano`) VALUES
	(1, 'Free', 0.00),
	(2, 'Basic', 100.00),
	(3, 'Plus', 187.00);
/*!40000 ALTER TABLE `planos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
