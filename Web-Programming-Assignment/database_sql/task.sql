-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 26, 2023 lúc 11:05 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dashboard`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `task`
--

CREATE TABLE `task` (
  `description` varchar(200) NOT NULL,
  `deadline` datetime(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` enum('in progress','approved','done','need review') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `task`
--

INSERT INTO `task` (`description`, `deadline`, `name`, `status`) VALUES
('Đổ rác', '2002-02-02 00:00:00.000000', 'Đổ rác', 'in progress'),
('Thiết kế website', '2003-02-02 00:00:00.000000', 'Website UI', 'in progress'),
('Thiết kế backend', '2004-03-02 00:00:00.000000', 'Backend design', 'done'),
('Thiết kế poster cho khách', '2005-04-03 00:00:00.000000', 'Design Poster', 'done'),
('Làm đồ án', '2003-02-02 00:00:00.000000', 'Project', 'need review'),
('Doing homework', '2002-02-02 00:00:00.000000', 'Homework', 'approved');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
