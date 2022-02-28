CREATE TABLE `intentospagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cliente` varchar(128) NOT NULL,
  `monto` double NOT NULL,
  `fechaven` date NOT NULL,
  `estado` enum('ENV','PGD','CNL','ERR') NOT NULL DEFAULT 'ENV',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci