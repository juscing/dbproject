-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2015 at 05:32 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Actor`
--

INSERT INTO `Actor` (`first_name`, `actor_id`, `last_name`) VALUES
('Matt', 1, 'Damon'),
('Ben', 2, 'Affleck'),
('Tom', 3, 'Hanks'),
('Ben', 5, 'Stiller'),
('Jack', 6, 'Black'),
('Leonardo ', 7, 'Dicaprio'),
('Eddie', 8, 'Murphy');

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
(3, 4),
(2, 6),
(4, 5),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Director`
--

CREATE TABLE IF NOT EXISTS `Director` (
  `director_first_name` varchar(50) NOT NULL,
  `director_id` int(11) NOT NULL,
  `director_last_name` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Director`
--

INSERT INTO `Director` (`director_first_name`, `director_id`, `director_last_name`) VALUES
('Doug', 1, 'Liman'),
('Ben', 2, 'Stiller'),
('Robert', 3, 'Zemeckis'),
('Steven', 4, 'Spielberg'),
('Gus', 5, 'Van Sant');

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
  `critic_rating` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`movie_id`, `title`, `genre`, `user_rating`, `year`, `runtime`, `critic_rating`) VALUES
(1, 'Good Will Hunting', 'Drama', 8.3, 1997, 126, 9.1),
(2, 'The Bourne Identity', 'Action', 9.7, 2002, 119, 7.1),
(3, 'Forrest Gump', 'Drama', 8.8, 1994, 142, 8.2),
(4, 'Tropic Thunder', 'Comedy', 7, 2008, 107, 3.9),
(5, 'Catch Me If You Can', 'Drama', 8, 2002, 141, 7.7),
(6, 'Zoolander', 'Comedy', 6.6, 2001, 89, 3);

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
(7, 5);

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
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `Director`
--
ALTER TABLE `Director`
  MODIFY `director_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
