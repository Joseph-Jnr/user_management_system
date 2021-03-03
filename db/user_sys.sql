-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 03, 2021 at 12:30 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `user_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` blob NOT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `img`, `lastlogin`) VALUES
(1, 'Donald Wilson', 'donald@gmail.com', '$2y$10$0xmG.7wdbxYb67atYo68ZOf7noNJoQmXD/82b87TIOC5Mkhvlac.2', 0x32303230303132305f3134343433392e6a706567, '2021-03-03 12:26:30'),
(2, 'Jonathan Baker', 'jonathan@mail.com', '$2y$10$BnJg9d0aZV.o6bIPlTdQCeQaiX6pzGHMpJBuZP1kFUXWhcbppkPSG', 0x32303230303132305f3134343433352e6a706567, '2021-03-03 07:24:12'),
(3, 'Koko Bass', 'koko@gmail.com', '$2y$10$YzEJ4xN6QmUlXCSU3/4PjuKeA16NKXKHqwxDgt7Faxb4C4xXqVq3u', 0x627573696e6573732d766973696f6e2d73746174656d656e742d6f7267616e697a6174696f6e2d636f6d70616e792d766973696f6e2d35313133666462356637343836353164613837373134366165653537663063342e706e67, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` blob NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `uid`, `email`, `img`) VALUES
(1, 'Alan Walker', 'R001234', 'alan@gmail.com', 0x3232353635313934366233336332622e6a7067),
(2, 'Greg Milton', 'R183025', 'greg@mail.com', 0x3132383070782d466c61675f6f665f4175737472616c69612e7376672e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;