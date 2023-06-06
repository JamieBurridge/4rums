CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`)
);

INSERT INTO `topics` (name, description) VALUES
("Anime", "A place to discuss anime"),
("Programming", "Coders unite!")

INSERT INTO `users` VALUES
(16,'andy','$2y$10$pS8mgVdnJ5gOglLmYMbyjO6YI/Aa6tugkvOZScqVgkFyJEGNvWqeC'),
(17,'karen','$2y$10$FjPmDCfD/0NA779qGxZ9I.i1ecNDgR1Af9nBOwnCBZeBm1/k3GE02'),
(18,'rebecca','$2y$10$zsLn0VUlcpT23cyzgef46.Dkm4MFMWUiPD41l/eqi.fh1gqq4aZOi'),
(19,'kathleen','$2y$10$/T4nT/dNGIHdAjZiLjEp7uQEq3Kjnz9nJpzDpJY5BwZhx6w9s5yFK'),
(26,'johnson','$2y$10$9fhbPAx2CNOq6cIXAMtDd.2OhBarPsgLhkADsGcF0LveFl8LjUR1a'),
(29,'derek','$2y$10$YVDQuzQqsbduP6XfXL0gLuWzjJ/MNnzTFrnglkwnfxm4lrbY6v9om');
