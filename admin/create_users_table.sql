
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `approved` tinyint(1) DEFAULT 0,
  `radio_name` varchar(100) DEFAULT NULL,
  `radio_role` varchar(100) DEFAULT NULL,
  `radio_website` varchar(255) DEFAULT NULL,
  `interest_reason` text DEFAULT NULL,
  `referral_source` varchar(100) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin user (password: admin123)
INSERT INTO `users` (`username`, `email`, `password_hash`, `role`, `approved`) VALUES
('Admin', 'admin@sintoniza.plus', '$2y$10$8.j/M/9.j/M/9.j/M/9.j/M/9.j/M/9.j/M/9.j/M/9.j/M/9.', 'admin', 1)
ON DUPLICATE KEY UPDATE `id`=`id`;
