-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 30 Αυγ 2021 στις 13:10:35
-- Έκδοση διακομιστή: 10.4.20-MariaDB
-- Έκδοση PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `hotel`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `total_price`, `created_time`, `updated_time`) VALUES
(4, 32, 9, '2021-08-18', '2021-08-21', 900, '2021-08-13 10:52:00', '2021-08-13 10:52:00'),
(5, 32, 7, '2021-09-01', '2021-09-08', 1190, '2021-08-13 10:52:40', '2021-08-13 10:52:40'),
(6, 32, 6, '2021-09-13', '2021-09-15', 640, '2021-08-14 10:29:22', '2021-08-14 10:29:22'),
(7, 32, 7, '2021-08-06', '2021-08-28', 3740, '2021-08-14 11:34:07', '2021-08-14 11:34:07'),
(10, 33, 2, '2021-08-27', '2021-08-28', 500, '2021-08-24 13:00:14', '2021-08-24 13:00:14'),
(11, 33, 10, '2021-09-07', '2021-09-17', 4100, '2021-08-24 13:02:19', '2021-08-24 13:02:19'),
(14, 35, 3, '2021-08-27', '2021-08-28', 420, '2021-08-28 13:59:28', '2021-08-28 13:59:28'),
(15, 35, 6, '2021-10-21', '2021-10-23', 640, '2021-08-28 14:02:32', '2021-08-28 14:02:32'),
(16, 35, 1, '2021-09-01', '2021-09-04', 1050, '2021-08-29 12:24:18', '2021-08-29 12:24:18'),
(17, 35, 8, '2021-09-02', '2021-09-18', 4480, '2021-08-29 14:50:33', '2021-08-29 14:50:33'),
(18, 35, 4, '2021-09-09', '2021-09-13', 1000, '2021-08-30 11:02:32', '2021-08-30 11:02:32');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `favorite`
--

CREATE TABLE `favorite` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `favorite`
--

INSERT INTO `favorite` (`user_id`, `room_id`, `created_time`, `updated_time`) VALUES
(32, 1, '2021-08-20 10:36:25', '2021-08-20 10:36:25'),
(32, 2, '2021-08-11 16:29:09', '2021-08-11 16:29:09'),
(32, 3, '2021-08-13 13:50:31', '2021-08-13 13:50:31'),
(32, 7, '2021-08-22 11:37:49', '2021-08-22 11:37:49'),
(33, 1, '2021-08-14 12:34:52', '2021-08-14 12:34:52'),
(33, 2, '2021-08-24 12:57:41', '2021-08-24 12:57:41'),
(33, 4, '2021-08-24 12:54:41', '2021-08-24 12:54:41'),
(33, 7, '2021-08-24 13:03:21', '2021-08-24 13:03:21'),
(33, 8, '2021-08-24 13:04:17', '2021-08-24 13:04:17'),
(33, 9, '2021-08-24 13:16:26', '2021-08-24 13:16:26'),
(33, 10, '2021-08-24 13:02:23', '2021-08-24 13:02:23'),
(35, 1, '2021-08-28 13:56:07', '2021-08-28 13:56:07'),
(35, 3, '2021-08-28 13:59:24', '2021-08-28 13:59:24'),
(35, 4, '2021-08-30 11:02:18', '2021-08-30 11:02:18'),
(35, 6, '2021-08-26 16:27:36', '2021-08-26 16:27:36'),
(35, 8, '2021-08-29 14:50:29', '2021-08-29 14:50:29');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `review`
--

CREATE TABLE `review` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rate` int(10) UNSIGNED NOT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `review`
--

INSERT INTO `review` (`review_id`, `room_id`, `user_id`, `rate`, `comment`, `created_time`, `updated_time`) VALUES
(2, 2, 32, 4, 'Test Review for Megali Vretania Hotel..', '2021-08-12 12:45:41', '2021-08-12 12:45:41'),
(3, 1, 30, 4, 'Second test review for Holton Hotel ', '2021-08-12 12:46:53', '2021-08-12 12:46:53'),
(8, 1, 32, 1, 'New review with transaction and commit ', '2021-08-12 14:22:12', '2021-08-12 14:22:12'),
(21, 2, 32, 5, 'test', '2021-08-12 15:26:17', '2021-08-12 15:26:17'),
(22, 4, 32, 3, 'Review for room_id4', '2021-08-12 15:28:05', '2021-08-12 15:28:05'),
(28, 7, 32, 3, 'Beautiful view', '2021-08-13 08:20:26', '2021-08-13 08:20:26'),
(29, 3, 32, 5, 'Perfect Hotel!!!! ', '2021-08-13 13:50:26', '2021-08-13 13:50:26'),
(30, 7, 32, 5, 'New review for Airotel Galaxy Hotel  in Kavala', '2021-08-14 11:50:46', '2021-08-14 11:50:46'),
(31, 7, 32, 5, '', '2021-08-14 11:51:14', '2021-08-14 11:51:14'),
(32, 1, 32, 4, '', '2021-08-14 13:59:30', '2021-08-14 13:59:30'),
(33, 1, 32, 4, '', '2021-08-14 14:00:29', '2021-08-14 14:00:29'),
(34, 8, 32, 3, 'New post ', '2021-08-19 14:50:28', '2021-08-19 14:50:28'),
(35, 8, 32, 5, '', '2021-08-19 14:54:49', '2021-08-19 14:54:49'),
(44, 7, 32, 4, 'new with ajax', '2021-08-22 12:21:44', '2021-08-22 12:21:44'),
(45, 7, 32, 5, '', '2021-08-22 12:22:04', '2021-08-22 12:22:04'),
(46, 7, 32, 5, 'ajax', '2021-08-22 12:22:47', '2021-08-22 12:22:47'),
(59, 7, 32, 4, 'nlkDNb alknd;oialkdjaw;kdo\'asdas', '2021-08-22 12:53:05', '2021-08-22 12:53:05'),
(60, 7, 32, 3, 'adjnoadhniwnkljdiqwd', '2021-08-22 12:53:29', '2021-08-22 12:53:29'),
(61, 1, 33, 3, 'new with csrf ', '2021-08-24 11:59:40', '2021-08-24 11:59:40'),
(62, 1, 33, 3, 'CSRF FINAL ', '2021-08-24 12:00:05', '2021-08-24 12:00:05'),
(63, 1, 33, 5, '', '2021-08-24 12:01:03', '2021-08-24 12:01:03'),
(64, 1, 33, 4, '', '2021-08-24 12:01:17', '2021-08-24 12:01:17'),
(65, 1, 33, 5, '', '2021-08-24 12:22:57', '2021-08-24 12:22:57'),
(66, 1, 33, 3, '', '2021-08-24 12:23:06', '2021-08-24 12:23:06'),
(67, 1, 33, 4, '', '2021-08-24 12:23:17', '2021-08-24 12:23:17'),
(68, 1, 33, 3, '', '2021-08-24 12:24:03', '2021-08-24 12:24:03'),
(69, 4, 33, 3, '', '2021-08-24 12:28:29', '2021-08-24 12:28:29'),
(70, 4, 33, 4, '', '2021-08-24 12:28:44', '2021-08-24 12:28:44'),
(71, 4, 33, 4, 'new ', '2021-08-24 12:38:06', '2021-08-24 12:38:06'),
(72, 4, 33, 5, 'Final CSRF review ', '2021-08-24 12:38:45', '2021-08-24 12:38:45'),
(73, 9, 33, 5, 'Perfect hotel!!!!', '2021-08-24 13:01:14', '2021-08-24 13:01:14'),
(74, 9, 33, 4, 'Review with js injection <scripti>alert(\'Hello Christina\')</schript>', '2021-08-24 13:26:33', '2021-08-24 13:26:33'),
(75, 9, 33, 5, '\r\nJS injection <script>alert(\"Hello! I am an alert box!\");</script>', '2021-08-24 13:27:39', '2021-08-24 13:27:39'),
(76, 9, 33, 5, 'New injectio <script>alert(\"Hello! I am an alert box!\");</script>', '2021-08-24 13:32:06', '2021-08-24 13:32:06'),
(77, 9, 33, 4, 'JS injection <script>alert(\"Hello! I am an alert box!\");</script>', '2021-08-24 13:32:41', '2021-08-24 13:32:41'),
(78, 9, 33, 5, 'JS injection <script>alert(\"Hello! I am an alert box!\");</script>', '2021-08-24 13:33:55', '2021-08-24 13:33:55'),
(79, 1, 35, 4, '', '2021-08-28 13:47:21', '2021-08-28 13:47:21'),
(80, 6, 35, 3, '', '2021-08-29 14:10:36', '2021-08-29 14:10:36'),
(81, 6, 35, 3, 'New post ', '2021-08-29 14:16:03', '2021-08-29 14:16:03'),
(82, 6, 35, 2, '', '2021-08-29 14:23:45', '2021-08-29 14:23:45'),
(83, 8, 35, 4, 'Final ', '2021-08-29 14:50:46', '2021-08-29 14:50:46'),
(84, 4, 35, 4, '', '2021-08-30 11:02:27', '2021-08-30 11:02:27');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room`
--

CREATE TABLE `room` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `count_of_guests` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
  `location_lat` decimal(10,7) NOT NULL,
  `location_long` decimal(10,7) NOT NULL,
  `description_short` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description_long` text COLLATE utf8_unicode_ci NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `pet_friendly` tinyint(1) NOT NULL,
  `avg_reviews` decimal(10,7) DEFAULT NULL,
  `count_reviews` int(10) UNSIGNED DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room`
--

INSERT INTO `room` (`room_id`, `type_id`, `name`, `city`, `area`, `photo_url`, `count_of_guests`, `price`, `address`, `location_lat`, `location_long`, `description_short`, `description_long`, `parking`, `wifi`, `pet_friendly`, `avg_reviews`, `count_reviews`, `created_time`, `updated_time`) VALUES
(1, 1, 'Hilton Hotel', 'Athens', 'Zwgrafou', 'room-1.jpg', 1, 350, 'Vasilis Sofeias 38', '37.9767030', '23.7504170', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n\r\nVestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', 1, 1, 0, '3.6154000', 13, '2020-05-28 20:15:36', '2021-08-28 13:47:21'),
(2, 2, 'Megali Vretania Hotel', 'Athens', 'Syntagma', 'room-2.jpg', 2, 500, 'Vasilis Olgas, 115', '37.9765250', '23.7353970', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 0, '3.3333000', 3, '2020-05-28 20:15:36', '2021-08-12 15:26:17'),
(3, 3, 'Apollo Hotel', 'Athens', 'Kentro', 'room-3.jpg', 3, 420, 'Achilleos 10', '37.9853780', '23.7199320', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, '5.0000000', 1, '2020-05-28 20:15:36', '2021-08-13 13:50:26'),
(4, 2, 'Oscar Hotel', 'Athens', 'Kentro', 'room-4.jpg', 2, 250, 'Filadelfias 25', '37.9973410', '23.7219820', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 0, 1, 0, '3.8333000', 6, '2020-05-28 20:15:36', '2021-08-30 11:02:27'),
(5, 2, 'Anatolia Hotel', 'Thessaloniki', 'Kentro', 'room-5.jpg', 2, 400, 'Lagkada 13', '40.6477560', '22.9342730', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, NULL, 0, '2020-05-28 20:15:36', '2020-05-28 20:15:36'),
(6, 3, 'Nea Metropolis Hotel', 'Thessaloniki', 'Kentro', 'room-6.jpg', 3, 320, 'Siggrou 22', '40.6446290', '22.9409210', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 0, 1, 0, '2.6667000', 3, '2020-05-28 20:15:36', '2021-08-29 14:23:46'),
(7, 2, 'Airotel Galaxy Hotel', 'Kavala', 'Kentro', 'room-7.jpg', 2, 170, 'El. Venizelou 27', '40.9431210', '24.4100360', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, '4.2500000', 8, '2020-05-28 20:15:36', '2021-08-22 12:53:29'),
(8, 4, 'Egnatia City Hotel', 'Kavala', 'Kentro', 'room-8.jpg', 4, 280, '7is Merarchias 139', '40.9479970', '24.3874950', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.', 1, 1, 0, '4.0000000', 3, '2020-05-28 20:15:36', '2021-08-29 14:50:46'),
(9, 2, 'Villa Manos Hotel Santorini', 'Santorini', 'Xwra', 'room-9.jpg', 2, 300, 'Karterados', '36.4131770', '25.4478070', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.', 0, 1, 0, '4.6667000', 6, '2020-05-28 20:15:36', '2021-08-24 13:33:55'),
(10, 3, 'Volcano View Hotel Santorini', 'Santorini', 'Xwra', 'room-10.jpg', 3, 410, 'Fira', '36.4006410', '25.4377640', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 0, NULL, 0, '2020-05-28 20:15:36', '2020-05-28 20:15:36');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room_type`
--

CREATE TABLE `room_type` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room_type`
--

INSERT INTO `room_type` (`type_id`, `title`) VALUES
(1, 'Single Room'),
(2, 'Double Room'),
(3, 'Triple Room'),
(4, 'Fourfold Room');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `created_time`, `updated_time`) VALUES
(1, 'hotel_admin', 'hotel_admin@collegelink.gr', '', '2020-05-28 20:15:35', '2020-05-28 20:15:35'),
(10, 'John', 'john@doe.com', 'password', '2021-07-28 09:57:35', '2021-07-28 09:57:35'),
(12, 'Maria', 'maria@gmail.com', '$2y$10$beUft8ztDUkaxlDQrhhtrOOFEVgiMLvrBzGQrcfCjAkocOceI/Z.e', '2021-07-28 12:25:33', '2021-07-28 12:25:33'),
(14, 'Christina Stylianoy ', 'xristinastyl@gmail.com', '$2y$10$fNoMXEPw97Z.aNeuw5HVn.M/bEjQNUlETN1NWoY5q47uvHZkv/KHW', '2021-07-29 12:10:41', '2021-07-29 12:10:41'),
(15, 'Panos Papa', 'panos@example.com', '$2y$10$KGhxo9dtjXNtxGkWbU/WxuAsL.sh/aF0P343lHtKO3vVxgI4ZTLYC', '2021-07-29 12:15:58', '2021-07-29 12:15:58'),
(17, 'Giota Kex', 'giota@gmail.com', '$2y$10$RsfQONp4v/ka9ceuvtwiUen/EOHHR7tpiJV9ZCMLla4.d7RA3qyZS', '2021-07-29 12:30:25', '2021-07-29 12:30:25'),
(20, 'examplename', 'name@example.com', '$2y$10$qPLPJKFmcTpH.22iPVHaM.PDpsFSK6WdnbneB.nhyQlapQM327B/S', '2021-07-30 09:06:10', '2021-07-30 09:06:10'),
(21, 'Christina new ', 'christina@mail.com', '$2y$10$WFahGjoStgEFH6Evva9KYOlaneP7pVYFZNanrwxN2TYNnPa6PexPa', '2021-08-10 15:33:41', '2021-08-10 15:33:41'),
(22, 'maria new ', 'maria@example.com', '$2y$10$6YlyfsJzWLP.uX3fYHmhwODFMHhW14UNsweXzkx4vG0CUXRemqUbq', '2021-08-10 15:35:22', '2021-08-10 15:35:22'),
(26, 'dimitris ', 'dimitris@gmail.com', '$2y$10$jhUQD.myWVpbqN/PmlJsiubcXxoYJqdkCIeSs96wgPpE3w80wHKVq', '2021-08-10 16:04:36', '2021-08-10 16:04:36'),
(29, 'xristina new', 'christinanew@mail.com', '$2y$10$uF30l6rZyEm9q9j3.9ugM.1bOFRzDVxb.hwTuyLN9OGkPiQqvjjpi', '2021-08-10 16:08:26', '2021-08-10 16:08:26'),
(30, 'xristina stylianou', 'xristina_styl@hotmail.com', '$2y$10$4S73aqGmR.SBMfTmp3D/LOhc/a640YGgO0H9YPuvfXp/qNfkFCHIG', '2021-08-10 16:13:39', '2021-08-10 16:13:39'),
(32, 'Xristina Final', 'final@email.com', '$2y$10$3fgBc8tYFZUi8LC.BaFCwu6toscZa7.tbDb0MVvYdyT60Q42AT5Gm', '2021-08-11 16:20:48', '2021-08-11 16:20:48'),
(33, 'Christina Stylianoy ', 'xristinastylianou@email.com', '$2y$10$pzyGrhAblvK3ruOK5yKYbu3tjWxCfLn081SdAPeIFwF5/rnrV9XiS', '2021-08-13 12:01:39', '2021-08-13 12:01:39'),
(35, 'christina', 'christina@gmail.com', '$2y$10$pA9hXcB0RKIf/m0L2eKCw.QmRZew3ZT1q6QptYDEF7mdUf3S1B9zu', '2021-08-26 11:52:07', '2021-08-26 11:52:07'),
(36, 'New register ', 'register@email.com', '$2y$10$cFKBAQyhW1CliewwN6qeOOXVGcgJSti.saZwlXV32qSTrInj7mulm', '2021-08-29 14:29:11', '2021-08-29 14:29:11');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking__room_idx` (`room_id`),
  ADD KEY `fk_booking__user_idx` (`user_id`);

--
-- Ευρετήρια για πίνακα `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`user_id`,`room_id`),
  ADD KEY `fk_favorite__room_idx` (`room_id`);

--
-- Ευρετήρια για πίνακα `payment`
--
ALTER TABLE `payment`
  ADD KEY `fk_payment__booking` (`booking_id`);

--
-- Ευρετήρια για πίνακα `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review__room_idx` (`room_id`),
  ADD KEY `fk_review__user_idx` (`user_id`);

--
-- Ευρετήρια για πίνακα `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_room__room_type_idx` (`type_id`),
  ADD KEY `idx_city__price` (`city`,`price`);

--
-- Ευρετήρια για πίνακα `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Ευρετήρια για πίνακα `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT για πίνακα `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT για πίνακα `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `room_type`
--
ALTER TABLE `room_type`
  MODIFY `type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_favorite__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment__booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`) ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room__room_type` FOREIGN KEY (`type_id`) REFERENCES `room_type` (`type_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
