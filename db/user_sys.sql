-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 15, 2021 at 09:42 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `img`, `lastlogin`) VALUES
(1, 'Donald Wilson', 'dona@mail.com', '$2y$10$rgrp8nnRdl241JOX2TZB0.azyVqLGX/nR7e6wjx7TxtaRVjtdHPV.', 0x3337302d333730303932365f3135307831353078676e65742d636f72652d76616c7565732d69636f6e732d323031372d70617373696f6e2d707269766174652d6c696d697465642e706e67, '2021-03-15 21:41:23');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;