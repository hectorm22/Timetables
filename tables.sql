PRAGMA foreign_keys = OFF;

DROP TABLE if exists user;
CREATE TABLE `user` (
   `user_id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
   `username` VARCHAR(30) NOT NULL UNIQUE,
   `password` TEXT DEFAULT NULL,
   CONSTRAINT `username_not_empty` CHECK (`username` <> '')
);


DROP TABLE IF EXISTS `user_history`;
CREATE TABLE `user_history` (
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `changed_on` datetime DEFAULT current_timestamp()
);

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE
);




PRAGMA foreign_keys = ON;
