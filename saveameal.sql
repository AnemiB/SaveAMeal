-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 12:39 PM
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
-- Database: `saveameal`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_body` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `meal_id`, `user_id`, `comment_body`) VALUES
(18, 13, 5, 'This tastes really good with a chicken sauce'),
(19, 15, 5, 'It works well with any sauce too!'),
(20, 15, 6, 'It is quite good'),
(21, 14, 6, 'Mine was good after 3 minutes, think it depends on the stove'),
(22, 16, 7, 'So yummy! Highly recommend'),
(23, 15, 7, 'I just bought it!'),
(24, 13, 7, 'The sauce can be too much '),
(25, 14, 7, 'So yummy!!!'),
(26, 17, 7, 'So creamy! <3'),
(27, 18, 8, 'The peas can be boiled longer'),
(28, 15, 8, 'Good'),
(29, 15, 8, 'Update: I made it, it needed salt'),
(30, 13, 8, 'Yumm'),
(31, 17, 8, 'It was good'),
(32, 16, 8, 'I love chili <3'),
(33, 20, 4, 'Affordable and delicious'),
(34, 19, 4, 'I love this!! '),
(35, 19, 6, 'The cheese is the best part over all'),
(36, 20, 6, 'Yum yum'),
(37, 20, 7, 'Just add sauce too, then it is really good'),
(38, 18, 7, 'You can add to taste @Mike Wazooski !'),
(39, 14, 3, 'I loved this!'),
(40, 19, 3, 'Most definitely going to buy this again'),
(41, 13, 3, 'So good!'),
(42, 13, 3, '<3'),
(43, 16, 3, 'Same! @Xanti Tinda'),
(44, 17, 3, 'Yummmm');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `comment_id`, `status`, `created_at`) VALUES
(52, 5, 18, 1, '2024-10-31 10:07:47'),
(53, 6, 19, 1, '2024-10-31 10:15:00'),
(54, 7, 22, 1, '2024-10-31 10:27:41'),
(55, 7, 19, 1, '2024-10-31 10:28:09'),
(57, 7, 23, 1, '2024-10-31 10:28:17'),
(58, 7, 18, 1, '2024-10-31 10:28:42'),
(59, 7, 25, 1, '2024-10-31 10:28:58'),
(60, 7, 26, 1, '2024-10-31 10:29:15'),
(61, 8, 19, 1, '2024-10-31 10:30:35'),
(62, 8, 28, 1, '2024-10-31 10:30:43'),
(64, 8, 30, 1, '2024-10-31 10:31:14'),
(65, 8, 25, 1, '2024-10-31 10:31:23'),
(66, 8, 21, 1, '2024-10-31 10:31:27'),
(67, 8, 26, 1, '2024-10-31 10:31:34'),
(68, 8, 31, 1, '2024-10-31 10:31:45'),
(69, 4, 33, 1, '2024-10-31 10:37:37'),
(70, 6, 34, 1, '2024-10-31 10:38:33'),
(71, 6, 33, 1, '2024-10-31 10:38:42'),
(72, 7, 37, 1, '2024-10-31 10:39:36'),
(73, 7, 38, 1, '2024-10-31 10:40:04'),
(74, 7, 34, 1, '2024-10-31 10:40:14'),
(75, 3, 21, 1, '2024-10-31 10:48:07'),
(76, 3, 25, 1, '2024-10-31 10:48:08'),
(77, 3, 39, 1, '2024-10-31 10:48:09'),
(79, 3, 40, 1, '2024-10-31 10:48:35'),
(81, 3, 41, 1, '2024-10-31 10:48:54'),
(82, 3, 24, 1, '2024-10-31 10:48:56'),
(83, 3, 18, 1, '2024-10-31 10:48:56'),
(84, 3, 22, 1, '2024-10-31 10:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meal_name` varchar(100) NOT NULL,
  `ingredients` text NOT NULL,
  `calories` int(11) NOT NULL,
  `prep_time` int(11) NOT NULL,
  `instructions` text NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `meal_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`meal_id`, `user_id`, `meal_name`, `ingredients`, `calories`, `prep_time`, `instructions`, `cost`, `meal_image`, `created_at`, `status`) VALUES
(13, 4, 'Chicken and Veggie Stir-Fry', 'Chicken breast, bell peppers, broccoli, carrots, soy sauce, garlic, ginger, olive oil', 350, 15, '1. Slice chicken and veggies.\r\n2. Heat oil in a pan, add garlic and ginger, then add chicken.\r\n3. Stir-fry until chicken is cooked, add veggies, and cook until tender-crisp.\r\n4. Add soy sauce to taste. \r\n5. Serve hot!', 85.00, '../uploads/krystal-ng-DoppEKJjIbc-unsplash.jpg', '2024-10-31 09:56:16', 'active'),
(14, 4, 'Lentil and Spinach Curry', 'Lentils, spinach, onion, garlic, curry powder, coconut milk, canned tomatoes, olive oil', 400, 10, '1. Sauté onion and garlic in oil, add curry powder.\r\n2. Add lentils and canned tomatoes, cook until lentils soften.\r\n3. Add spinach and coconut milk, simmer for 5 minutes. Serve with rice or bread.', 65.00, '../uploads/daniela-RELOvb0rrCE-unsplash.jpg', '2024-10-31 10:02:24', 'active'),
(15, 5, 'Vegetable Pasta Bake', 'Pasta, mixed vegetables, bell peppers, zucchini, carrots, tomato sauce, cheese, garlic, Italian herbs', 450, 20, '1. Boil pasta until al dente, set aside.\r\n2. Sauté veggies with garlic, add tomato sauce and herbs.\r\n3. Mix pasta with veggies, pour into baking dish, sprinkle cheese, and bake at 180°C for 15 minutes.', 90.00, '../uploads/elena-leya--KgQ-bDTreA-unsplash.jpg', '2024-10-31 10:07:07', 'active'),
(16, 6, 'Beef and Bean Chili', 'Minced beef, kidney beans, onion, garlic, canned tomatoes, chili powder, cumin, olive oil', 500, 35, '1. Brown beef in a pot with oil, add onions and garlic.\r\n2. Add tomatoes, beans, and spices, then simmer for 20 minutes.\r\n3. Serve with rice or bread.', 110.00, '../uploads/leanna-myers-omP-kDbTc8w-unsplash.jpg', '2024-10-31 10:18:19', 'active'),
(17, 6, 'Creamy Mushroom Risotto', 'Arborio rice, mushrooms, onion, garlic, vegetable broth, Parmesan cheese, olive oil', 457, 25, '1. Sauté onion, garlic, and mushrooms in oil until soft.\r\n2. Add rice, cook for 1 minute, then slowly add broth until rice is creamy.\r\n3. Stir in Parmesan cheese before serving.', 95.00, '../uploads/marika-sartori-KTLFhRO1Sds-unsplash.jpg', '2024-10-31 10:22:23', 'active'),
(18, 7, 'Sweet Potato and Chickpea Salad', 'Sweet potatoes, chickpeas, spinach, olive oil, lemon, cumin, salt, pepper', 350, 15, '1. Roast sweet potatoes with olive oil and cumin at 180°C until tender.\r\n2. Mix with chickpeas, spinach, and lemon juice. Season to taste.', 70.00, '../uploads/deryn-macey-B-DrrO3tSbo-unsplash.jpg', '2024-10-31 10:25:32', 'active'),
(19, 8, 'Eggplant Parmesan', 'Eggplant, breadcrumbs, Parmesan cheese, tomato sauce, mozzarella cheese, Italian seasoning', 560, 40, '1. Slice eggplant, coat in breadcrumbs, and bake until golden.\r\n2. Layer eggplant, tomato sauce, and cheese in a baking dish, sprinkle seasoning.\r\n3. Bake at 180°C for 20 minutes until cheese is bubbly.', 100.00, '../uploads/sunorwind-vNmf3cbb14g-unsplash.jpg', '2024-10-31 10:34:03', 'active'),
(20, 8, 'Chicken Caesar Wrap', 'Tortilla wraps, grilled chicken breast, lettuce, Caesar dressing, Parmesan cheese, croutons', 1500, 1, '1. Slice grilled chicken and toss with lettuce, dressing, and Parmesan.\r\n2. Place mixture in a tortilla, add croutons, and wrap tightly. Serve chilled or warm.\r\n', 45.00, '../uploads/alexander-mils-SNLfVYmL8os-unsplash.jpg', '2024-10-31 10:36:21', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `created_at`, `role`) VALUES
(1, 'admin@gmail.com', 'adminmain', '$2y$10$FCJyS4aUIYIeclrTMuGhe.t/WO1AaYC8qicGZygpgPdKA3Ub3.Io6', '2024-10-02 12:58:50', 'admin'),
(2, 'emm@gmail.com', 'emm', '$2y$10$onds9jv/7vP8PEtCQewrYeDZHug/f6l8Ppz05fztL2kyfYgDQCL0O', '2024-10-02 13:11:35', 'user'),
(3, 'anemi@gmail.com', 'Anemi', '$2y$10$vamzscveujyTcbdV/6r0POozdLPdHIRsa1a48doAeUxf1W/xY22Am', '2024-10-23 12:42:12', 'user'),
(4, 'vanessaque@gmail.com', 'Vanessa Que', '$2y$10$FyKI0LO8Hxw8Yhu7XTtlM.qgyjyjUIL2lOCdJxZZhzn3rm48ZRFIO', '2024-10-31 09:44:53', 'user'),
(5, 'willie@gmail.com', 'Willimina Reese', '$2y$10$A9HdAbyXwbGOIJ1woMohb.6aUJkXTHGAwXjPIV105ylqL1KP2.yu2', '2024-10-31 09:45:28', 'user'),
(6, 'sherryly@gmail.com', 'Sherral Berral', '$2y$10$8l2M4HCL4d2M3v/GZgjXc.yyypIg7B.9EijLTSM34pHzhQ75S2VqO', '2024-10-31 09:46:24', 'user'),
(7, 'xanti@gamil.com', 'Xanti Tinda', '$2y$10$H9aK3utd.kIWs4prD1zWLuHdwGjHuabhHtB.Kw9g2QVlxXlFJUgvG', '2024-10-31 09:46:56', 'user'),
(8, 'mikess@gamil.com', 'Mike Wazooski', '$2y$10$xpWjEn9iugKEKVIy5XnZtetLCqz5OroK6BvwyoxsQEvTD88CnnPjG', '2024-10-31 09:47:27', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`meal_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
