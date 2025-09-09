-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2025 at 02:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Design'),
(2, 'Marketing'),
(3, 'Programming'),
(4, 'General');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `post_id`, `created_at`) VALUES
(1, 'Artikel yang sangat bermanfaat, terima kasih!', 2, 1, '2025-09-07 12:48:11'),
(2, 'Saya setuju, UI/UX itu penting sekali.', 3, 1, '2025-09-07 12:48:11'),
(3, 'Insight tentang marketing tahun depan sangat membantu.', 1, 2, '2025-09-07 12:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `user_id`, `category_id`, `created_at`) VALUES
(1, 'Belajar UI/UX Design', 'UI/UX design adalah salah satu aspek terpenting dalam pengembangan aplikasi. Desain yang baik membuat pengguna nyaman, sedangkan desain buruk bisa membuat mereka cepat pergi.\n\nTips dasar: gunakan konsistensi warna, tipografi, dan tata letak agar aplikasi terlihat profesional.', 1, 1, '2025-09-07 12:48:11'),
(2, 'Strategi Digital Marketing 2025', 'Tahun 2025 membawa banyak tren baru dalam digital marketing. AI dan personalisasi konten menjadi senjata utama brand besar.\n\nSelain itu, strategi omnichannel yang menghubungkan media sosial, email, dan website akan semakin penting untuk membangun loyalitas pelanggan.', 2, 2, '2025-09-07 12:48:11'),
(3, 'Mengoptimalkan SEO di Tahun 2025', 'Search Engine Optimization (SEO) di tahun 2025 bukan hanya soal menempatkan kata kunci pada artikel. Kini, Google semakin menekankan pada pengalaman pengguna seperti kecepatan loading, mobile friendly, serta kualitas konten yang benar-benar menjawab kebutuhan audiens. Hal ini membuat marketer dituntut untuk lebih kreatif dalam menyusun strategi konten yang relevan sekaligus bermanfaat.\r\n\r\nSelain itu, integrasi SEO dengan platform lain seperti media sosial dan video juga menjadi semakin penting. Konten yang terdistribusi dengan baik di berbagai channel akan lebih mudah mendapatkan otoritas di mata mesin pencari. Dengan demikian, SEO sekarang tidak bisa lagi berdiri sendiri, melainkan harus menjadi bagian dari strategi digital marketing yang lebih luas.', 5, 2, '2025-09-08 04:26:14'),
(4, 'Peran AI dalam Strategi Digital Marketing', 'Artificial Intelligence (AI) semakin sering dimanfaatkan dalam dunia marketing modern. Dengan analisis data yang cepat, AI dapat membantu marketer memahami perilaku konsumen secara lebih mendalam. Misalnya, sistem rekomendasi produk di e-commerce yang membuat pengalaman belanja jadi lebih personal dan meningkatkan peluang konversi.\r\n\r\nSelain itu, AI juga membantu dalam automasi kampanye iklan. Dengan algoritma machine learning, platform iklan dapat menargetkan audiens yang paling relevan, mengoptimalkan budget, dan meningkatkan ROI. Marketer yang mampu mengombinasikan kreativitas dengan teknologi AI akan memiliki keunggulan kompetitif yang signifikan dalam persaingan bisnis digital.', 5, 2, '2025-09-08 04:26:40'),
(5, 'Tren UI/UX Design di Era Digital 2025', 'Tahun 2025 membawa perubahan besar dalam dunia UI/UX design. Fokus utama kini bukan hanya pada estetika, tetapi juga pada user experience yang lebih inklusif. Desainer dituntut untuk memperhatikan aksesibilitas agar aplikasi maupun website dapat digunakan oleh semua orang, termasuk mereka yang memiliki keterbatasan fisik.\r\n\r\nSelain itu, integrasi teknologi baru seperti augmented reality dan voice interface semakin populer. Desainer perlu memikirkan bagaimana interaksi pengguna dapat berjalan mulus melalui berbagai media, baik layar, suara, maupun perangkat wearable. Hal ini menantang kreativitas desainer untuk menghadirkan pengalaman digital yang lebih imersif dan adaptif.', 5, 1, '2025-09-08 04:27:19'),
(6, 'Pentingnya Literasi Digital di Kehidupan Sehari-Hari', 'Literasi digital saat ini bukan lagi sekadar keterampilan tambahan, melainkan sebuah kebutuhan. Dengan maraknya penggunaan internet, setiap orang perlu memahami cara mencari, memilah, dan menggunakan informasi secara bijak. Tanpa literasi digital yang baik, seseorang mudah terjebak dalam misinformasi dan hoaks yang beredar cepat di dunia maya.\r\n\r\nSelain itu, literasi digital juga berkaitan dengan keamanan. Masyarakat perlu tahu bagaimana melindungi data pribadi, menghindari penipuan online, serta menjaga privasi di media sosial. Kemampuan ini akan membantu menciptakan ekosistem digital yang lebih sehat dan aman untuk semua pengguna.', 5, 4, '2025-09-08 04:27:54'),
(7, 'Pentingnya Clean Code dalam Pengembangan Software', 'Clean code adalah salah satu prinsip terpenting yang harus dipegang oleh setiap programmer. Dengan menulis kode yang rapi, terstruktur, dan mudah dibaca, tim pengembang bisa lebih mudah melakukan kolaborasi serta mengurangi potensi bug di kemudian hari. Prinsip clean code juga membuat proses debugging dan pemeliharaan sistem menjadi lebih efisien.\r\n\r\nSelain itu, clean code bukan hanya soal gaya penulisan, tetapi juga mencakup praktik best practices seperti penggunaan nama variabel yang jelas, pemisahan fungsi yang sesuai, dan dokumentasi yang baik. Seorang programmer yang terbiasa menulis clean code akan lebih mudah berkembang dan beradaptasi dengan proyek skala besar.', 5, 3, '2025-09-08 04:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'alice', 'alice@mail.com', '$2y$10$b00oYmEXNwucA1bRl/EGUujtOXLXtiAEL7WJy2BAyOHWNRSLJvVj2', '2025-09-07 12:48:11'),
(2, 'bob', 'bob@mail.com', '$2y$10$b00oYmEXNwucA1bRl/EGUujtOXLXtiAEL7WJy2BAyOHWNRSLJvVj2', '2025-09-07 12:48:11'),
(3, 'charlie', 'charlie@mail.com', '$2y$10$b00oYmEXNwucA1bRl/EGUujtOXLXtiAEL7WJy2BAyOHWNRSLJvVj2', '2025-09-07 12:48:11'),
(4, 'david', 'david@mail.com', '$2y$10$b00oYmEXNwucA1bRl/EGUujtOXLXtiAEL7WJy2BAyOHWNRSLJvVj2', '2025-09-07 12:48:11'),
(5, 'admin', 'admin@mail.com', '$2y$10$b00oYmEXNwucA1bRl/EGUujtOXLXtiAEL7WJy2BAyOHWNRSLJvVj2', '2025-09-07 13:17:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
