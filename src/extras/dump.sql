-- Copiando estrutura do banco de dados para todo_db
CREATE DATABASE IF NOT EXISTS `todo_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `todo_db`;

-- Copiando estrutura para tabela todo_db.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_title` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `status` enum('pendente','concluida') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela todo_db.tasks: ~1 rows (aproximadamente)

INSERT INTO `tasks` (`id`, `task_title`, `task_description`, `created_at`, `status`) VALUES
	(7, 'asda', 'asdaasd', '2023-08-08 19:29:06', 'pendente');

-- Copiando estrutura para tabela todo_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela todo_db.users: ~2 rows (aproximadamente)

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
	(1, 'Teste', 'teste@teste.com', '$2y$10$gTd54Sjix9zjA1IdZsma9enmelvzEqBzAd..xpFeGk4UTfe9sQVX2');