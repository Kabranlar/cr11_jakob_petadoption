-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 01:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petadoption`
--
CREATE DATABASE IF NOT EXISTS `petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `petadoption`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `species` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `age` int(3) NOT NULL,
  `size` varchar(20) NOT NULL,
  `image` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `hobbies` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `name`, `species`, `breed`, `description`, `age`, `size`, `image`, `location`, `hobbies`) VALUES
(14, 'Nicky', 'Dog', 'Promenadenmischung', 'My cousins dog.', 7, 'smol', 'https://bilder.t-online.de/b/68/46/80/46/id_68468046/610/tid_da/am-ende-ist-die-wahl-doch-herzenssache.jpg', 'ewige Jagdgründe', 'eating, pooping'),
(15, 'Phoebe', 'Cat', 'unknown', 'Ex cat.', 8, 'large', 'https://www.thehappycatsite.com/wp-content/uploads/2017/05/grey4.jpg', 'over there', 'drool'),
(16, 'Miel', 'Dog', 'don\'t know', 'Best dog evvvvaaaa', 13, 'large', 'https://images.squarespace-cdn.com/content/v1/539c4601e4b0baefd4e19bea/1485451877537-546NB1Y8P5S1VWNLN5FJ/ke17ZwdGBToddI8pDm48kMnHRrpWSlSCB9XabjgyantZw-zPPgdn4jUwVcJE1ZvWQUxwkmyExglNqGp0IvTJZUJFbgE-7XRK3dMEBRBhUpz4FkPJA585QYBg9EjPvRpkIxxB_SdP_xzqtxyFDizV5aadH9FfX0OATazAJGndjd8/image-asset.jpeg', 'Germany', 'lying around all day'),
(18, 'Wauwau', 'dog', 'Maltese', 'Smol dog.', 4, 'smol', 'https://www.pets4homes.co.uk/images/articles/5470/large/ten-things-you-need-to-know-about-the-maltese-dog-before-you-buy-one-5d25cc2034760.jpg', 'Here', 'Playing with her toys'),
(19, 'Mollrich', 'Dog', 'inbreed', 'Ugly, fluffy, stinky but friendly.', 12, 'smol', 'https://www.tierheim-franziskus.at/fileadmin/_processed_/b/f/csm_880_-1260727683_e1590ee990.jpg', 'Wien', 'Pooping'),
(20, 'Cutie McPie', 'Dog', 'Cuterino', 'Aaaaaaawwwwwwwwww.', 1, 'smol', 'https://images.theconversation.com/files/334095/original/file-20200511-49558-ni4d6y.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1200&h=900.0&fit=crop', 'Honeywell', 'Being breathtakingly cute.'),
(21, 'Gandog', 'Dog', 'Godly', 'Oh mi gawd.', 14, 'large', 'https://tractive.com/blog/wp-content/uploads/2020/02/how-to-deal-with-panting-shaking-seizures-in-old-dogs.jpg', 'Spirit Realm', 'Godly stuff'),
(22, 'Mietz', 'Cat', 'Feline', 'Oooooooold', 100, 'large', 'https://purrfectlove.net/wp-content/uploads/2016/05/oldcat.jpg', 'Retirement Home', 'Withering');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `admin`) VALUES
(6, 'admin', 'admin@mail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 1),
(7, 'Normalo', 'norm@normy.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 0),
(8, 'superman', 'super@admin.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
