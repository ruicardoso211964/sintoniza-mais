-- Script de Criação da Tabela para Fontes de Conteúdo
-- Compatível com MySQL 5.7+ / 8.0

CREATE TABLE IF NOT EXISTS `fontes_conteudo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `url_base` VARCHAR(255) NOT NULL,
  `url_rss` VARCHAR(255) DEFAULT NULL,
  `categoria` VARCHAR(100) NOT NULL,
  `ativa` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
