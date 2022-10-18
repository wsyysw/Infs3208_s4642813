SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `projects` (
  `id` int(3) NOT NULL,
  `Full name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Short name` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `projects` (`id`, `Full name`, `Short name`) VALUES
(1, 'JAPN1011 Exam', 'JAPN1011E');


CREATE TABLE `tasks` (
  `id` int(3) NOT NULL,
  `project_short_name` varchar(4) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `project_task_num` int(3) NOT NULL,
  `task_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `task_desc` varchar(1000) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `state` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tasks` (`id`, `Full project_short_name`, `project_task_num`, 'task_name', 'task_desc', 'state') VALUES
(1, 'JAPN1011E', 'JAPN1011E', 1, 'Week13 Quiz', '10 mins quiz (MCQ)', 'In progress');



CREATE TABLE `users` (
  `id` int(2) NOT NULL,
  `login` varchar(16) CHARACTER SET latin1 NOT NULL,
  `password` varchar(16) CHARACTER SET latin1 NOT NULL,
  `admin` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `users` (`id`, `login`, `password`, `admin`) VALUES
(1, 'Shiyun', 's4642813', 'Administrator');


ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `projects`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;


ALTER TABLE `tasks`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;


ALTER TABLE `users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
