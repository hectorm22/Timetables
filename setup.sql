PRAGMA foreign_keys = OFF;

DROP TABLE if exists user;
CREATE TABLE `user` (
   `user_id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
   `username` VARCHAR(30) NOT NULL UNIQUE,
   `password` TEXT DEFAULT NULL,
   CONSTRAINT `username_not_empty` CHECK (`username` <> '')
);

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE tasks (
    task_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    task_name TEXT NOT NULL,
    task_description TEXT,
    task_type int(11) DEFAULT 0,
    starting_time DATETIME,
    ending_time DATETIME,
    status int(11) DEFAULT 1, -- 0 = finished, 1 = in progress
    username TEXT,
    FOREIGN KEY (username) REFERENCES user(username)
);

insert into user (username, password) values("demo", "$2y$10$zpsK.4BBUOxKcg/MPyQ6F.4ZFZ7k9ec17gubI9Xjt/NjDk/8fI/5u");

PRAGMA foreign_keys = ON;