-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2015 at 01:00 AM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs4750jci5kb`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `Action`
--
CREATE TABLE IF NOT EXISTS `Action` (
`movie_id` int(11)
,`title` varchar(50)
,`genre` varchar(50)
,`user_rating` double
,`year` int(4)
,`runtime` int(11)
,`critic_rating` double
);

-- --------------------------------------------------------

--
-- Table structure for table `Actor`
--

CREATE TABLE IF NOT EXISTS `Actor` (
  `first_name` varchar(50) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `last_name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Actor`
--

INSERT INTO `Actor` (`first_name`, `actor_id`, `last_name`) VALUES
('Matt', 1, 'Damon'),
('Ben', 2, 'Affleck'),
('Tom', 3, 'Hanks'),
('Amy', 4, 'Adams'),
('Ben', 5, 'Stiller'),
('Jack', 6, 'Black'),
('Leonardo ', 7, 'Dicaprio'),
('Eddie', 8, 'Murphy'),
('Michael', 9, 'Myers'),
('Cameron', 10, 'Diaz'),
('Jeremy', 11, 'Renner'),
('Jennifer', 12, 'Lawrence'),
('Amy', 13, 'Adams'),
('Minnie', 14, 'Driver'),
('Conrad', 15, 'Vermon'),
('John', 16, 'Lithgow');

-- --------------------------------------------------------

--
-- Stand-in structure for view `Comedies`
--
CREATE TABLE IF NOT EXISTS `Comedies` (
`movie_id` int(11)
,`title` varchar(50)
,`genre` varchar(50)
,`user_rating` double
,`year` int(4)
,`runtime` int(11)
,`critic_rating` double
);

-- --------------------------------------------------------

--
-- Table structure for table `Directed`
--

CREATE TABLE IF NOT EXISTS `Directed` (
  `director_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Directed`
--

INSERT INTO `Directed` (`director_id`, `movie_id`) VALUES
(1, 2),
(3, 3),
(2, 6),
(4, 5),
(5, 1),
(2, 4),
(6, 9),
(6, 8),
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `Director`
--

CREATE TABLE IF NOT EXISTS `Director` (
  `director_first_name` varchar(50) NOT NULL,
  `director_id` int(11) NOT NULL,
  `director_last_name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Director`
--

INSERT INTO `Director` (`director_first_name`, `director_id`, `director_last_name`) VALUES
('Doug', 1, 'Liman'),
('Ben', 2, 'Stiller'),
('Robert', 3, 'Zemeckis'),
('Steven', 4, 'Spielberg'),
('Gus', 5, 'Van Sant'),
('Conrad', 6, 'Vernon'),
('David', 7, 'Russell');

-- --------------------------------------------------------

--
-- Stand-in structure for view `Dramas`
--
CREATE TABLE IF NOT EXISTS `Dramas` (
`movie_id` int(11)
,`title` varchar(50)
,`genre` varchar(50)
,`user_rating` double
,`year` int(4)
,`runtime` int(11)
,`critic_rating` double
);

-- --------------------------------------------------------

--
-- Table structure for table `Favorites`
--

CREATE TABLE IF NOT EXISTS `Favorites` (
  `username` varchar(25) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Favorite_Actors`
--

CREATE TABLE IF NOT EXISTS `Favorite_Actors` (
  `actor_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Favorite_Director`
--

CREATE TABLE IF NOT EXISTS `Favorite_Director` (
  `director_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE IF NOT EXISTS `Movie` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `user_rating` double NOT NULL,
  `year` int(4) NOT NULL,
  `runtime` int(11) NOT NULL,
  `critic_rating` double NOT NULL,
  `Plot` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`movie_id`, `title`, `genre`, `user_rating`, `year`, `runtime`, `critic_rating`, `Plot`) VALUES
(1, 'Good Will Hunting', 'Drama', 8.3, 1997, 126, 9.1, 'Will Hunting (Matt Damon) has a genius-level IQ but chooses to work as a janitor at MIT. When he solves a difficult graduate-level math problem, his talents are discovered by Professor Gerald Lambeau (Stellan Skarsgard), who decides to help the misguided youth reach his potential. When Will is arrested for attacking a police officer, Professor Lambeau makes a deal to get leniency for him if he will get treatment from therapist Sean Maguire (Robin Williams).'),
(2, 'The Bourne Identity', 'Action', 9.7, 2002, 119, 7.1, 'The story of a man (Matt Damon), salvaged, near death, from the ocean by an Italian fishing boat. When he recuperates, the man suffers from total amnesia, without identity or background... except for a range of extraordinary talents in fighting, linguistic skills and self-defense that speak of a dangerous past. He sets out on a desperate search-assisted by the initially rebellious Marie (Franka Potente) - to discover who he really is, and why he''s being lethally pursued by assassins.'),
(3, 'Forrest Gump', 'Drama', 8.8, 1994, 142, 8.2, 'Slow-witted Forrest Gump (Tom Hanks) has never thought of himself as disadvantaged, and thanks to his supportive mother (Sally Field), he leads anything but a restricted life. Whether dominating on the gridiron as a college football star, fighting in Vietnam or captaining a shrimp boat, Forrest inspires people with his childlike optimism. But one person Forrest cares about most may be the most difficult to save -- his childhood love, the sweet but troubled Jenny (Robin Wright).\n\nI LUV YOU JENNEYYYYY'),
(4, 'Tropic Thunder', 'Comedy', 7, 2008, 107, 3.9, 'Tugg Speedman (Ben Stiller), pampered action superstar, sets out for Southeast Asia to take part in the biggest, most-expensive war movie produced, but soon after filming begins, he and his co-stars, Oscar-winner Kirk Lazarus (Robert Downey Jr.), comic Jeff Portnoy (Jack Black) and the rest of the crew, must become real soldiers when fighting breaks out in that part of the jungle.'),
(5, 'Catch Me If You Can', 'Drama', 8, 2002, 141, 7.7, 'Frank Abagnale, Jr. (Leonardo DiCaprio) worked as a doctor, a lawyer, and as a co-pilot for a major airline -- all before his 18th birthday. A master of deception, he was also a brilliant forger, whose skill gave him his first real claim to fame: At the age of 17, Frank Abagnale, Jr. became the most successful bank robber in the history of the U.S. FBI Agent Carl Hanratty (Tom Hanks) makes it his prime mission to capture Frank and bring him to justice, but Frank is always one step ahead of him.'),
(6, 'Zoolander', 'Comedy', 6.6, 2001, 89, 3, 'Propelled to the top of the fashion world by a photogenic gaze he calls "Blue Steel," dimwitted male model Derek Zoolander (Ben Stiller) thinks he''s got a fourth consecutive win as Male Model of the Year in the bag. But, when his rival, Hansel (Owen Wilson), unexpectedly takes the crown, Derek is crushed. He becomes easy prey for fashion designer Jacobim Mugatu (Will Ferrell), who signs Derek to star in his "Derelicte" fashion show, then brainwashes him to kill Malaysia''s prime minister.'),
(7, 'American Hustle', 'Drama', 8, 2013, 138, 9, 'Irving Rosenfeld (Christian Bale) dabbles in forgery and loan-sharking, but when he falls for fellow grifter Sydney Prosser (Amy Adams), things change in a big way. Caught red-handed by FBI agent Richie DiMaso (Bradley Cooper), Irv and Sydney are forced to work under cover as part of DiMaso''s sting operation to nail a New Jersey mayor (Jeremy Renner). Meanwhile, Irv''s jealous wife (Jennifer Lawrence) may be the one to bring everyone''s world crashing down. Based on the 1970s Abscam case.'),
(8, 'Shrek', 'Comedy', 7.9, 2001, 95, 8, 'Once upon a time, in a far away swamp, there lived an ogre named Shrek (Mike Myers) whose precious solitude is suddenly shattered by an invasion of annoying fairy tale characters. They were all banished from their kingdom by the evil Lord Farquaad (John Lithgow). Determined to save their home -- not to mention his -- Shrek cuts a deal with Farquaad and sets out to rescue Princess Fiona (Cameron Diaz) to be Farquaad''s bride. Rescuing the Princess may be small compared to her deep, dark secret.'),
(9, 'Shrek 2', 'Comedy', 7, 2005, 93, 8, 'After returning from their honeymoon and showing home movies to their friends, Shrek and Fiona learn that her parents have heard that she has married her true love and wish to invite him to their kingdom, called Far Far Away. The catch is: Fiona''s parents are unaware of the curse that struck their daughter and have assumed she married Prince Charming, not a 700-pound ogre with horrible hygiene and a talking donkey pal.');

-- --------------------------------------------------------

--
-- Table structure for table `StarredIn`
--

CREATE TABLE IF NOT EXISTS `StarredIn` (
  `actor_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `StarredIn`
--

INSERT INTO `StarredIn` (`actor_id`, `movie_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(3, 3),
(3, 5),
(5, 6),
(5, 4),
(6, 4),
(7, 5),
(12, 7),
(13, 7),
(8, 8),
(9, 8),
(10, 8),
(8, 9),
(9, 9),
(10, 9),
(4, 7),
(11, 7),
(15, 8),
(16, 8);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `username` varchar(25) NOT NULL,
  `password` char(64) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`username`, `password`, `email`, `first_name`, `last_name`) VALUES
('jci5kb', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'jci5kb@virginia.edu', 'Justin', 'Ingram');

-- --------------------------------------------------------

--
-- Table structure for table `Watch`
--

CREATE TABLE IF NOT EXISTS `Watch` (
  `username` varchar(25) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `Action`
--
DROP TABLE IF EXISTS `Action`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs4750jci5kb`@`%` SQL SECURITY DEFINER VIEW `Action` AS select `Movie`.`movie_id` AS `movie_id`,`Movie`.`title` AS `title`,`Movie`.`genre` AS `genre`,`Movie`.`user_rating` AS `user_rating`,`Movie`.`year` AS `year`,`Movie`.`runtime` AS `runtime`,`Movie`.`critic_rating` AS `critic_rating` from `Movie` where (`Movie`.`genre` = 'action');

-- --------------------------------------------------------

--
-- Structure for view `Comedies`
--
DROP TABLE IF EXISTS `Comedies`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs4750jci5kb`@`%` SQL SECURITY DEFINER VIEW `Comedies` AS select `Movie`.`movie_id` AS `movie_id`,`Movie`.`title` AS `title`,`Movie`.`genre` AS `genre`,`Movie`.`user_rating` AS `user_rating`,`Movie`.`year` AS `year`,`Movie`.`runtime` AS `runtime`,`Movie`.`critic_rating` AS `critic_rating` from `Movie` where (`Movie`.`genre` = 'Comedy');

-- --------------------------------------------------------

--
-- Structure for view `Dramas`
--
DROP TABLE IF EXISTS `Dramas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`cs4750jci5kb`@`%` SQL SECURITY DEFINER VIEW `Dramas` AS select `Movie`.`movie_id` AS `movie_id`,`Movie`.`title` AS `title`,`Movie`.`genre` AS `genre`,`Movie`.`user_rating` AS `user_rating`,`Movie`.`year` AS `year`,`Movie`.`runtime` AS `runtime`,`Movie`.`critic_rating` AS `critic_rating` from `Movie` where (`Movie`.`genre` = 'Drama');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Actor`
--
ALTER TABLE `Actor`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `Directed`
--
ALTER TABLE `Directed`
  ADD KEY `director_id` (`director_id`), ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `Director`
--
ALTER TABLE `Director`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `Favorites`
--
ALTER TABLE `Favorites`
  ADD KEY `username` (`username`), ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `Favorite_Actors`
--
ALTER TABLE `Favorite_Actors`
  ADD KEY `username` (`username`), ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `Favorite_Director`
--
ALTER TABLE `Favorite_Director`
  ADD KEY `director_id` (`director_id`), ADD KEY `username` (`username`);

--
-- Indexes for table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `StarredIn`
--
ALTER TABLE `StarredIn`
  ADD KEY `actor_id` (`actor_id`), ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `Watch`
--
ALTER TABLE `Watch`
  ADD KEY `username` (`username`), ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Actor`
--
ALTER TABLE `Actor`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `Director`
--
ALTER TABLE `Director`
  MODIFY `director_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Directed`
--
ALTER TABLE `Directed`
ADD CONSTRAINT `Directed_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`),
ADD CONSTRAINT `Directed_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `Director` (`director_id`),
ADD CONSTRAINT `Directed_ibfk_3` FOREIGN KEY (`director_id`) REFERENCES `Director` (`director_id`),
ADD CONSTRAINT `Directed_ibfk_4` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`);

--
-- Constraints for table `Favorites`
--
ALTER TABLE `Favorites`
ADD CONSTRAINT `Favorites_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Users` (`username`),
ADD CONSTRAINT `Favorites_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`);

--
-- Constraints for table `Favorite_Actors`
--
ALTER TABLE `Favorite_Actors`
ADD CONSTRAINT `Favorite_Actors_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `Actor` (`actor_id`),
ADD CONSTRAINT `Favorite_Actors_ibfk_2` FOREIGN KEY (`username`) REFERENCES `Users` (`username`),
ADD CONSTRAINT `Favorite_Actors_ibfk_3` FOREIGN KEY (`actor_id`) REFERENCES `Actor` (`actor_id`);

--
-- Constraints for table `Favorite_Director`
--
ALTER TABLE `Favorite_Director`
ADD CONSTRAINT `Favorite_Director_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `Director` (`director_id`),
ADD CONSTRAINT `Favorite_Director_ibfk_2` FOREIGN KEY (`username`) REFERENCES `Users` (`username`);

--
-- Constraints for table `StarredIn`
--
ALTER TABLE `StarredIn`
ADD CONSTRAINT `StarredIn_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `Actor` (`actor_id`),
ADD CONSTRAINT `StarredIn_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`);

--
-- Constraints for table `Watch`
--
ALTER TABLE `Watch`
ADD CONSTRAINT `Watch_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Users` (`username`),
ADD CONSTRAINT `Watch_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`movie_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
