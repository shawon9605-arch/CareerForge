-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2026 at 07:26 PM
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
-- Database: `careerforge`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `student_id`, `title`, `type`, `event_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Final Exam', 'Exam', '2026-05-30', 'My Do Or Die Situation', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `match_percentage` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `company`, `category`, `description`, `location`, `match_percentage`, `created_at`, `updated_at`) VALUES
(1, 'Frontend Developer', 'Tech Solutions Ltd', 'Frontend', 'Build modern UI using HTML, CSS, JavaScript and React.', 'Dhaka, Bangladesh', '85%', NULL, NULL),
(2, 'Backend Laravel Developer', 'CareerForge AI', 'Backend', 'Develop scalable APIs and Laravel backend systems.', 'Remote', '92%', NULL, NULL),
(3, 'UI/UX Designer', 'Creative Studio', 'Design', 'Design modern and interactive application interfaces.', 'Dhaka', '78%', NULL, NULL),
(4, 'Cybersecurity Analyst', 'SecureNet', 'Cybersecurity', 'Monitor vulnerabilities and improve system security.', 'Remote', '88%', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_22_055923_create_events_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_answer` varchar(10) DEFAULT NULL,
  `explanation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `explanation`) VALUES
(1, 1, 'What is Python?', 'A snake', 'A programming language', 'A database', 'An operating system', 'b', 'Python is a programming language.'),
(2, 1, 'Which symbol is used for comments in Python?', '//', '#', '/*', '--', 'b', '# is used for comments in Python.'),
(3, 1, 'Which data type stores multiple values?', 'Integer', 'Float', 'List', 'Boolean', 'c', 'List stores multiple values.'),
(4, 2, 'Which language is used for styling web pages?', 'HTML', 'CSS', 'Python', 'PHP', 'b', 'CSS is used for styling web pages.'),
(5, 2, 'Which tag is used for JavaScript?', '<style>', '<js>', '<script>', '<javascript>', 'c', '<script> is used to include JavaScript.'),
(6, 3, 'Which language is commonly used for backend development?', 'PHP', 'CSS', 'HTML', 'Photoshop', 'a', 'PHP is widely used for backend development.'),
(7, 3, 'What does API stand for?', 'Application Programming Interface', 'Advanced Program Internet', 'Application Process Integration', 'Applied Program Interface', 'a', 'API means Application Programming Interface.'),
(8, 4, 'Which command retrieves data?', 'INSERT', 'DELETE', 'SELECT', 'UPDATE', 'c', 'SELECT retrieves data from database.'),
(9, 4, 'Which database is commonly used with PHP?', 'MySQL', 'Mongo Paint', 'Excel', 'PowerPoint', 'a', 'MySQL is commonly used with PHP.'),
(10, 5, 'What is phishing?', 'A hacking attack', 'A design tool', 'A database', 'A framework', 'a', 'Phishing is a cyber attack.'),
(11, 5, 'Which protocol is secure?', 'HTTP', 'FTP', 'HTTPS', 'TELNET', 'c', 'HTTPS is secure.'),
(12, 6, 'React is mainly used for?', 'Database', 'Frontend UI', 'Networking', 'Cybersecurity', 'b', 'React is used for frontend UI.'),
(13, 6, 'Which hook manages state?', 'useFetch', 'useData', 'useState', 'useLoop', 'c', 'useState manages state in React.');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `difficulty` varchar(50) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `category`, `difficulty`, `duration`, `description`) VALUES
(1, 'Python Fundamentals', 'Python', 'Beginner', 10, 'Basic Python quiz for beginners'),
(2, 'Frontend Development Quiz', 'Frontend', 'Intermediate', 15, 'HTML, CSS, JavaScript and UI quiz'),
(3, 'Backend Development Quiz', 'Backend', 'Intermediate', 15, 'PHP, APIs and server-side development quiz'),
(4, 'Database Management Quiz', 'Database', 'Beginner', 10, 'MySQL and database fundamentals quiz'),
(5, 'Cybersecurity Basics Quiz', 'Cybersecurity', 'Advanced', 20, 'Security, vulnerabilities and networking quiz'),
(6, 'React Development Quiz', 'React', 'Intermediate', 15, 'React.js fundamentals and component quiz');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `correct_answers` int(11) DEFAULT NULL,
  `wrong_answers` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `student_id`, `quiz_id`, `score`, `correct_answers`, `wrong_answers`, `created_at`) VALUES
(1, 1, 1, 20, 2, 1, '2026-05-21 10:10:30'),
(2, 1, 6, 0, 0, 2, '2026-05-21 10:25:28'),
(3, 1, 6, 20, 2, 0, '2026-05-21 10:25:47'),
(4, 1, 5, 10, 1, 1, '2026-05-21 10:34:50'),
(5, 1, 5, 20, 2, 0, '2026-05-21 10:35:01'),
(6, 1, 5, 20, 2, 0, '2026-05-21 14:58:49'),
(7, 1, 5, 10, 1, 1, '2026-05-21 14:58:59'),
(8, 1, 1, 20, 2, 1, '2026-05-22 13:50:43'),
(9, 1, 2, 20, 2, 0, '2026-05-22 16:17:48'),
(10, 1, 1, 30, 3, 0, '2026-05-22 16:20:52'),
(11, 1, 1, 20, 2, 1, '2026-05-22 16:21:03'),
(12, 1, 1, 20, 2, 1, '2026-05-22 17:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('37aQWVCrDaojt6RssTn1ZxUAeJplGW1rJHGe86wO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVNsSGlZc09wTnJRVGo1V2ROUjVLbGQwU21idk9pVnhjdjEzZ1RUNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qb2JzIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1779375715),
('lBcPqcxDAcrNV9smz0UNLTKWjRmTtlnXrJfo71gp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGVsWUc4SGJTTndFN2d4aU51RzJVVTg4QnJRQVRIWm81bnRvTHFtRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779381841),
('oN7zJVrSppOxDjxV9UdoDdT12z07O1ErgS3Dd01x', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2J5UmpoVUt3Ym54VE1nN0dnYlZiclExYXV0WXBLckVqRG1lZlhRUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jdi9kb3dubG9hZCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779365504);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `gpa` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `education` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `projects` longtext DEFAULT NULL,
  `cv_template` varchar(50) DEFAULT 'modern',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `image`, `skills`, `interests`, `gpa`, `created_at`, `education`, `experience`, `projects`, `cv_template`, `updated_at`) VALUES
(1, 'Imran iqbal', 'shawon9605@gmail.com', '202cb962ac59075b964b07152d234b70', 'uploads/profile_images/1779427273_668591946_2540728029657231_1588436217645627797_n.jpg', 'MySQL,PHP', 'C,C#,Java', 3.6, '2026-05-03 04:31:52', 'MSc in CSE', 'UIU Faculty', 'CareerForge for making Career easy to go and we will make future better', 'modern', NULL),
(2, 'Imran iqbal', 'miqbal223138@bscse.uiu.ac.bd', '81dc9bdb52d04dc20036dbd8313ed055', 'uploads/profile_images/1779428001_Screenshot 2026-04-28 155230.png', 'PHP,MySQL,JavaScript', 'Python', 3.45, '2026-05-21 23:09:09', 'BSc In Computer Science', 'Nasa Scientist', '[{\"title\":\"careerforge\",\"desc\":\"this is job readiness system\",\"link\":\"http://github.com//careerforge\",\"rating\":0,\"views\":0}]', 'modern', '2026-05-21 23:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
