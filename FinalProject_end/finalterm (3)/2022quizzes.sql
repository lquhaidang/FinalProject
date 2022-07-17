-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 17, 2022 lúc 03:12 AM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `2022quizzes`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `answer_text` text COLLATE utf8_unicode_ci NOT NULL,
  `is_correct` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`,`question_id`,`quiz_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `quiz_id`, `answer_text`, `is_correct`) VALUES
(1, 1, 1, 'Hippopotamus', 1),
(2, 1, 1, 'Shark', 0),
(3, 1, 1, 'Lion', 0),
(4, 1, 1, 'Panda', 0),
(1, 2, 1, 'A house', 0),
(2, 2, 1, 'an ice cube', 0),
(3, 2, 1, 'A pebble', 1),
(4, 2, 1, 'A house', 0),
(1, 3, 1, '9 months and 10 days', 0),
(2, 3, 1, '22 Months', 1),
(3, 3, 1, '1 Year', 0),
(4, 3, 1, '24 Months', 0),
(1, 4, 1, 'The anteater', 0),
(2, 4, 1, 'the duck-billed platypus', 0),
(3, 4, 1, 'The anteater & the duck-billed platypus', 1),
(4, 4, 1, 'I have no idea', 0),
(1, 1, 83, 'Mesosphere', 1),
(2, 1, 83, 'Troposphere', 0),
(3, 1, 83, 'Exosphere', 0),
(4, 1, 83, 'Stratosphere', 0),
(1, 2, 83, 'Acacia leave', 0),
(2, 2, 83, 'Bamboo', 0),
(3, 2, 83, 'Grass', 1),
(4, 2, 83, 'Sap tree', 0),
(1, 3, 83, 'Plants living in water', 0),
(2, 3, 83, 'Very small plants and animals living in water', 1),
(3, 3, 83, 'Very small animals living on land', 0),
(4, 3, 83, 'Plants on land', 0),
(1, 4, 83, 'Mesosphere', 0),
(2, 4, 83, 'Thermosphere', 0),
(3, 4, 83, 'Exosphere', 0),
(4, 4, 83, 'Troposphere', 1),
(1, 5, 83, 'Siberian tiger', 0),
(2, 5, 83, 'Loggerhead turtle', 0),
(3, 5, 83, 'The Maned Wolf.', 1),
(4, 5, 83, 'African Wild Dog', 0),
(1, 1, 84, '19 inches', 0),
(2, 1, 84, '24 inches', 0),
(3, 1, 84, '10 inches', 0),
(4, 1, 84, '18 inches', 1),
(1, 2, 84, '5 years', 0),
(2, 2, 84, '8 years', 0),
(3, 2, 84, '4 years', 1),
(4, 2, 84, '9 years', 0),
(1, 3, 84, 'Soccer', 1),
(2, 3, 84, 'Badminton', 0),
(3, 3, 84, 'Tennis', 0),
(4, 3, 84, 'Basketball', 0),
(1, 4, 84, '10', 0),
(2, 4, 84, '18', 1),
(3, 4, 84, '20', 0),
(4, 4, 84, '5', 0),
(1, 5, 84, '2000, soccer', 0),
(2, 5, 84, '1900, tennis', 1),
(3, 5, 84, '1900, soccer', 0),
(4, 5, 84, '2000, tennis', 0),
(1, 1, 85, '2', 0),
(2, 1, 85, '5', 1),
(3, 1, 85, '7', 0),
(4, 1, 85, '1', 0),
(1, 2, 85, 'Yena', 1),
(2, 2, 85, 'Kirgin', 0),
(3, 2, 85, 'Topchok', 0),
(4, 2, 85, 'Tugrik', 0),
(1, 3, 85, 'Turkmenistan', 1),
(2, 3, 85, 'Azerbaijan', 0),
(3, 3, 85, 'Bulgaria', 0),
(4, 3, 85, 'Iceland', 0),
(1, 4, 85, 'Indonesia', 0),
(2, 4, 85, 'Russia', 0),
(3, 4, 85, 'Australia', 0),
(4, 4, 85, 'Canada', 1),
(1, 5, 85, 'Ho Chi Minh City', 1),
(2, 5, 85, 'Pattaya', 0),
(3, 5, 85, 'Saigon City', 0),
(4, 5, 85, 'Hanoi', 0),
(1, 1, 86, 'Mecury', 1),
(2, 1, 86, 'Earth', 0),
(3, 1, 86, 'Jupiter', 0),
(4, 1, 86, 'Uranus', 0),
(1, 2, 86, 'Molten Iron', 0),
(2, 2, 86, 'Rock', 0),
(3, 2, 86, 'Lava', 0),
(4, 2, 86, 'Gas', 1),
(1, 3, 86, 'Venus', 0),
(2, 3, 86, 'Mecury', 1),
(3, 3, 86, 'Earth', 0),
(4, 3, 86, 'Neptune', 0),
(1, 4, 86, '13', 0),
(2, 4, 86, '1', 0),
(3, 4, 86, '2', 1),
(4, 4, 86, '50', 0),
(1, 5, 86, 'Bright and Sunny', 0),
(2, 5, 86, 'Cold and Wet', 0),
(3, 5, 86, 'Cold and Snowy', 0),
(4, 5, 86, 'Hot and Poisonous', 1),
(1, 1, 87, '2000', 1),
(2, 1, 87, '20', 0),
(3, 1, 87, '50', 0),
(4, 1, 87, '50000', 0),
(1, 2, 87, 'UNIVAC', 0),
(2, 2, 87, 'NASA', 1),
(3, 2, 87, 'ENIAC', 0),
(4, 2, 87, 'SAGE', 0),
(1, 3, 87, 'Bill Gates', 0),
(2, 3, 87, 'Sheryl Sandberg', 0),
(3, 3, 87, 'Sundar Pichai', 0),
(4, 3, 87, 'Steve Jobs', 1),
(1, 4, 87, 'Motherboard', 1),
(2, 4, 87, 'Mouse', 0),
(3, 4, 87, 'Monitor', 0),
(4, 4, 87, 'Keyboard', 0),
(1, 5, 87, 'Wide Width Wickets', 0),
(2, 5, 87, 'Worldwide Weather', 0),
(3, 5, 87, 'World Wide Web', 1),
(4, 5, 87, 'Western Washington World', 0),
(1, 1, 88, 'China', 0),
(2, 1, 88, 'Turkey', 1),
(3, 1, 88, 'Palau ', 0),
(4, 1, 88, 'Chile', 0),
(1, 2, 88, 'Venezuela', 0),
(2, 2, 88, 'Argentina', 0),
(3, 2, 88, 'Finland', 0),
(4, 2, 88, 'Belgium', 1),
(1, 3, 88, 'India', 1),
(2, 3, 88, 'Italy', 0),
(3, 3, 88, 'Indonesia', 0),
(4, 3, 88, 'Ireland', 0),
(1, 4, 88, 'Norway', 0),
(2, 4, 88, 'Paraguay', 0),
(3, 4, 88, 'Lesotho', 0),
(4, 4, 88, 'Scotland', 1),
(1, 5, 88, 'Saudi Arabia', 0),
(2, 5, 88, 'Yemen', 1),
(3, 5, 88, 'Pakistan', 0),
(4, 5, 88, 'Tonga', 0),
(1, 1, 89, 'Saudi Arabia', 0),
(2, 1, 89, 'Yemen', 1),
(3, 1, 89, 'Pakistan', 0),
(4, 1, 89, 'Tonga', 0),
(1, 2, 89, 'Computer worms', 0),
(2, 2, 89, 'Spyware', 0),
(3, 2, 89, 'Malware', 1),
(4, 2, 89, 'Network Security Devices', 0),
(1, 3, 89, 'Neptune', 0),
(2, 3, 89, 'Mecury', 1),
(3, 3, 89, 'Mars', 0),
(4, 3, 89, 'Uranus', 0),
(1, 4, 89, 'South Africa', 0),
(2, 4, 89, 'Fiji', 0),
(3, 4, 89, 'Australia', 1),
(4, 4, 89, 'New Zealand', 0),
(1, 5, 89, '2 million', 0),
(2, 5, 89, '5 million', 0),
(3, 5, 89, '12 million', 0),
(4, 5, 89, '8 million', 1),
(1, 6, 89, '2', 0),
(2, 6, 89, '5', 1),
(3, 6, 89, '7', 0),
(4, 6, 89, '1', 0),
(1, 7, 89, '27', 0),
(2, 7, 89, '28', 1),
(3, 7, 89, '26', 0),
(4, 7, 89, '25', 0),
(1, 1, 90, 'Animation', 0),
(2, 1, 90, 'Japan animation', 1),
(3, 1, 90, 'Cartoon', 0),
(4, 1, 90, 'Web drama', 0),
(1, 2, 90, 'Boys love', 0),
(2, 2, 90, 'Girls love', 0),
(3, 2, 90, 'Boy with many girls', 1),
(4, 2, 90, 'All of them', 0),
(1, 3, 90, 'Drama', 0),
(2, 3, 90, 'Adventure', 1),
(3, 3, 90, 'Horror', 0),
(4, 3, 90, 'Romance', 0),
(1, 4, 90, 'Sword Art Online', 1),
(2, 4, 90, 'Samsung and Oppo', 0),
(3, 4, 90, 'Sworrd Art Online', 0),
(4, 4, 90, 'Soccer and Oppa', 0),
(1, 5, 90, 'A pirate', 0),
(2, 5, 90, 'A ninja', 1),
(3, 5, 90, 'A fighter', 0),
(4, 5, 90, 'Sakura\'s boyfriend', 0),
(1, 6, 90, 'Attack on Titan', 1),
(2, 6, 90, 'Art Oppai Tennis', 0),
(3, 6, 90, 'Artifact Of Technology', 0),
(4, 6, 90, 'Dont know.', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`question_id`,`quiz_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`question_id`, `quiz_id`, `question_text`) VALUES
(1, 1, 'Which mammal is known to have the most powerful bite in the world?'),
(2, 1, 'What object does a male penguin often gift to a female penguin to win her over?'),
(3, 1, 'How long is an elephant pregnant before it gives birth?'),
(4, 1, 'What are the only two mammals are the only ones known to lay eggs?'),
(1, 83, 'Which one of the following is NOT a primary layer of the atmosphere?'),
(2, 83, 'The major diet of pandas is'),
(3, 83, 'What are planktons?'),
(4, 83, 'What atmospheric layer has most of the clouds?'),
(5, 83, 'Which of the following is not an endangered animal?'),
(1, 84, 'Whatâ€™s the diameter of a basketball hoop in inches?'),
(2, 84, 'The Olympics are held every how many years?'),
(3, 84, 'What sport is best known as the â€˜king of sportsâ€™?'),
(4, 84, 'How many holes are played in an average round of golf?'),
(5, 84, 'In what year were women allowed to compete in the modern Olympic games and in what sport?'),
(1, 85, 'How many stars are there on the flag of China?'),
(2, 85, 'What is the currency of Mongolia?'),
(3, 85, 'In which country is there a natural gas pit nicknamed the â€˜Door to Hellâ€™ that has been on fire since 1971?'),
(4, 85, 'Which country has the longest coastline in the world?'),
(5, 85, 'In 1976, Saigon changed its name to â€¦?'),
(1, 86, 'Which one of these planets is the smallest?'),
(2, 86, 'What is the sun mainly made from?'),
(3, 86, 'Which is the closest planet to the sun?'),
(4, 86, 'How many moons does Mars have?'),
(5, 86, 'Which of these best describes the atmosphere surrounding Venus?'),
(1, 87, 'About how many computer languages are in use?'),
(2, 87, 'Which of these is not an early computer?'),
(3, 87, 'Who founded Apple Computer?'),
(4, 87, 'Which of these is not a \"peripheral\", in computer terms?'),
(5, 87, 'What does the Internet prefix WWW stand for?'),
(1, 88, 'In what country would you find shish kebab as an everyday food?'),
(2, 88, 'What country is renowned for chocolate?'),
(3, 88, 'To what country is the mung bean native?'),
(4, 88, 'In what country might you eat haggis?'),
(5, 88, 'What country does the word \"mocha\" come from?'),
(1, 89, 'What country does the word \"mocha\" come from?'),
(2, 89, 'Computer trojans are an example of?'),
(3, 89, 'During the day this planet gets hot enough to melt lead, but at night the temperature drops to -290Â°F??'),
(4, 89, 'The Great Barrier Reef is off the coast of which country?'),
(5, 89, 'What is the population of Switzerland?'),
(6, 89, 'How many stars are there on the flag of China?'),
(7, 89, 'How many sports were included in the 2008 Summer Olympics?'),
(1, 90, 'What is Anime?'),
(2, 90, 'Harem Gerne is.....'),
(3, 90, 'What is the gerne of One Piece? '),
(4, 90, 'S.A.O is...'),
(5, 90, 'Who is Naruto?'),
(6, 90, 'A.O.T is....');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quiz_blogs`
--

DROP TABLE IF EXISTS `quiz_blogs`;
CREATE TABLE IF NOT EXISTS `quiz_blogs` (
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_title` text COLLATE utf8_unicode_ci NOT NULL,
  `quiz_description` text COLLATE utf8_unicode_ci NOT NULL,
  `quiz_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quiz_blogs`
--

INSERT INTO `quiz_blogs` (`user_id`, `quiz_id`, `quiz_title`, `quiz_description`, `quiz_img`, `date_created`) VALUES
(1, 1, 'Animal Trivia', 'Test your knowledge to see that if you had know all about the animals', 'https://static.parade.com/wp-content/uploads/2021/08/animal-trivia.jpg', '2022-06-23 10:45:37'),
(15, 83, 'Environment', 'This quiz is about Environment knowlegde', 'images/itec_62d3740b7e7f3.jpeg', '2022-07-16 22:17:20'),
(1, 84, 'Sports', 'Asking about Sport Knowlegde', 'images/itec_62d2d8a1bc11d.jpeg', '2022-07-16 22:26:25'),
(1, 85, 'The World', 'About Knowlegde around you.', 'images/itec_62d3743a533a8.png', '2022-07-16 22:46:18'),
(1, 86, 'Planets', 'About Planets Knowlegde', 'images/itec_62d2e13eec24c.jpeg', '2022-07-16 23:03:10'),
(1, 87, 'Computers and Technology', 'Knowlegde About IT', 'images/itec_62d2e39c8c779.jpeg', '2022-07-16 23:13:16'),
(15, 88, 'Culinary', 'About food Knowlegde', 'images/itec_62d2e8d838149.jpeg', '2022-07-16 23:35:36'),
(15, 89, 'Knowlegde Test', 'Test your knowlegde', 'images/itec_62d2edbeee080.jpeg', '2022-07-16 23:56:30'),
(15, 90, 'Anime', 'Test your knowlegde about Anime', 'images/itec_62d2f1a4857c8.jpeg', '2022-07-17 00:13:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '2',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`, `date_created`, `date_updated`) VALUES
(1, 'admin', 'sam@gmail.com', '$2y$10$xkZ9CFoY/NDZOL7V7XdxOOPD5ojc826bHMcqYSFVL4LwMEGG9K5/K', 1, '2022-05-21 14:28:07', NULL),
(9, 'sam10', 'sam@gmail.com', '$2y$10$SFEXoinwiTG8l8dvjg4Ep.nYBv5hFWGSV21XcQ3EisyqigO5Fxuo.', 2, '2022-05-25 16:31:01', NULL),
(10, 'randoman', 'sam@gmail.com', '$2y$10$FVnSCl1aX7fs4zNYF.vKTupUKDPQLFXoBJyq2VyU9zQpTzB2qdrlO', 2, '2022-05-27 11:39:47', NULL),
(11, 'hoangLongPham', 'TobiXiaomi@gmail.com', '$2y$10$f7irHKPYsKrZK1I3w8o/Nu/kGxmgN1u0dq9kxBTxiWiZUvLbPc1t.', 2, '2022-07-03 23:02:52', NULL),
(12, 'AmongUs', 'fujikoFfujio@gmail.com', '$2y$10$SWY5MMPGH0jf/umI781he.2GTEVhmwzmMpvIyRRiZ6UmnOCHvx/AG', 2, '2022-07-03 23:19:59', '2022-07-10 00:54:47'),
(13, 'change username', 'blablabla', '$2y$10$R7pEsPNeR8VxvwprdJGGF.2sa9.slTIPiy2K5oswmX7UyQQJvo6HC', 2, '2022-07-05 19:56:19', '2022-07-09 21:16:20'),
(14, 'Name has been changed', 'narutovsluffy09@gmail.com', '$2y$10$rwN6EKZA9ZDbY1o1UfITg.LNrw3VKZMDK.XcPRqXvTRofj0lt1rQO', 2, '2022-07-05 23:14:57', NULL),
(15, 'huu_nghiep_0209', 'nnghiep292002@gmail.com', '$2y$10$Kv99/vfWAEZPLZqJLwUXQ.0bHHB5K3Ep75UMyUz4e/00hfG8YHlEC', 2, '2022-07-16 21:59:09', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
