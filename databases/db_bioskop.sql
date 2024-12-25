-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 12:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bioskop`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL COMMENT 'Duration in minutes',
  `rating` float DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `poster_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `genre`, `duration`, `rating`, `release_date`, `description`, `poster_url`) VALUES
(1, 'The Matrix', 'Sci-Fi', 136, 8.7, '1999-03-31', 'A computer hacker learns about the true nature of reality.', 'https://example.com/images/the_matrix.jpg'),
(2, 'Inception', 'Sci-Fi', 148, 8.8, '2010-07-16', 'A thief enters dreams to steal secrets.', 'https://example.com/images/inception.jpg'),
(3, 'The Dark Knight', 'Action', 152, 9, '2008-07-18', 'Batman faces the Joker in Gotham City.', 'https://example.com/images/the_dark_knight.jpg'),
(4, 'Interstellar', 'Sci-Fi', 169, 8.6, '2014-11-07', 'A group of explorers travel through a wormhole in space.', 'https://example.com/images/interstellar.jpg'),
(5, 'Titanic', 'Romance', 195, 7.8, '1997-12-19', 'A love story aboard the Titanic.', 'https://example.com/images/titanic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `studio_id` int(11) DEFAULT NULL,
  `show_time` datetime DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `movie_id`, `studio_id`, `show_time`, `price`) VALUES
(1, 1, 1, '2024-12-25 14:00:00', 50000.00),
(2, 2, 2, '2024-12-25 16:00:00', 60000.00),
(3, 3, 3, '2024-12-25 18:00:00', 70000.00),
(4, 4, 4, '2024-12-25 20:00:00', 80000.00),
(5, 5, 1, '2024-12-26 14:00:00', 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `studio_id` int(11) DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `studio_id`, `seat_number`) VALUES
(1, 1, 'A1'),
(2, 1, 'A2'),
(3, 1, 'A3'),
(4, 1, 'A4'),
(5, 1, 'A5'),
(6, 2, 'B1'),
(7, 2, 'B2'),
(8, 2, 'B3'),
(9, 2, 'B4'),
(10, 2, 'B5');

-- --------------------------------------------------------

--
-- Table structure for table `studios`
--

CREATE TABLE `studios` (
  `studio_id` int(11) NOT NULL,
  `studio_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`studio_id`, `studio_name`) VALUES
(1, 'Studio 1'),
(2, 'Studio 2'),
(3, 'Studio 3'),
(4, 'Studio 4');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL,
  `status` enum('available','booked') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `schedule_id`, `seat_id`, `status`) VALUES
(1, 1, 1, 'available'),
(2, 1, 2, 'booked'),
(3, 1, 3, 'available'),
(4, 1, 4, 'available'),
(5, 1, 5, 'booked'),
(6, 2, 6, 'available'),
(7, 2, 7, 'available'),
(8, 2, 8, 'booked'),
(9, 2, 9, 'available'),
(10, 2, 10, 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `user_id`, `ticket_id`, `transaction_date`, `total_price`) VALUES
(1, 2, 2, '2024-12-24 15:01:13', 50000.00),
(2, 3, 5, '2024-12-24 15:01:13', 50000.00),
(3, 4, 8, '2024-12-24 15:01:13', 60000.00),
(4, 5, 10, '2024-12-24 15:01:13', 60000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@bioskop.com', 'adminpass', 'admin', '2024-12-24 15:01:13'),
(2, 'John Doe', 'john@example.com', 'password123', 'customer', '2024-12-24 15:01:13'),
(3, 'Jane Smith', 'jane@example.com', 'password123', 'customer', '2024-12-24 15:01:13'),
(4, 'Alice Johnson', 'alice@example.com', 'password123', 'customer', '2024-12-24 15:01:13'),
(5, 'Bob Brown', 'bob@example.com', 'password123', 'customer', '2024-12-24 15:01:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `studios`
--
ALTER TABLE `studios`
  ADD PRIMARY KEY (`studio_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studios`
--
ALTER TABLE `studios`
  MODIFY `studio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`studio_id`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`studio_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`schedule_id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
