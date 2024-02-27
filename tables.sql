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

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE tasks (
    task_id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    task_name TEXT NOT NULL,
    task_description TEXT,
    task_type int(11) DEFAULT 0,
    starting_time DATETIME,
    ending_time DATETIME,
    status int(11) DEFAULT 0,
    username TEXT,
    FOREIGN KEY (username) REFERENCES user(username)
);

UPDATE tasks
SET username = (
    SELECT username
    FROM user
    ORDER BY RANDOM()
    LIMIT 1
)
WHERE tasks.rowid = (SELECT abs(random()) % (SELECT max(rowid) FROM user) + 1);

update tasks 
set username = (
  select username 
  from user 
  order by random() 
  limit 1
) 
where task_id = (
  select rowid from tasks
);

SELECT count(*)
FROM tasks
WHERE starting_time <= CURRENT_TIMESTAMP AND ending_time >= CURRENT_TIMESTAMP;

SELECT count(*)
FROM tasks
WHERE DATE(starting_time) <= DATE(CURRENT_TIMESTAMP) AND DATE(ending_time) >= DATE(CURRENT_TIMESTAMP);

SELECT count(*)
FROM tasks
WHERE strftime('%H:%M:%S', starting_time) <= strftime('%H:%M:%S', CURRENT_TIMESTAMP)
  AND strftime('%H:%M:%S', ending_time) >= strftime('%H:%M:%S', CURRENT_TIMESTAMP);












PRAGMA foreign_keys = ON;
