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
