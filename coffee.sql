-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.27-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando dados para a tabela coffee.administrador: ~1 rows (aproximadamente)
INSERT INTO `administrador` (`usuarioID`, `usuario`, `senha`) VALUES
	(1, 'Adm', '123');

-- Copiando dados para a tabela coffee.cat: ~5 rows (aproximadamente)
INSERT INTO `cat` (`catID`, `nome`) VALUES
	(1, 'Lanches'),
	(2, 'Almocos'),
	(3, 'Cafes'),
	(4, 'Bebidas'),
	(5, 'Sobremesas');

-- Copiando dados para a tabela coffee.pedidos: ~0 rows (aproximadamente)

-- Copiando dados para a tabela coffee.produtos: ~4 rows (aproximadamente)
INSERT INTO `produtos` (`produtoID`, `nome`, `descr`, `img`, `valor`, `catID`) VALUES
	(2, 'X-salada', 'PÃO ARTESANAL, CARNE, PRESUNTO, ALFACE, TOMATE E MOLHO ESPECIAL.', '2023.03.29-19.01.51.jpg', 12, 1),
	(6, 'Guarana Antarctica', 'Refrigerante Guaraná Lata 350ml', '2023.03.30-20.18.16.jpg', 5, 4),
	(7, 'Prato Feito', 'arroz, feijão, salada e bife', '2023.03.30-20.20.26.jpg', 25, 2),
	(8, 'Coca Cola Lata 269ml', 'Refrigerante coca cola lata 269ml', '2023.03.30-20.21.59.jpg', 5, 4);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
