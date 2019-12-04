-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-12-04 15:12
-- 서버 버전: 10.3.16-MariaDB
-- PHP 버전: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `db_hw`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `book`
--

CREATE TABLE `book` (
  `ISBN` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `Book` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `PublishedHouse` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `Author` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `ReturnRequest` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 테이블 구조 `borrow`
--

CREATE TABLE `borrow` (
  `ID` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `ISBN` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `Name` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `UserID` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `LoanDate` date NOT NULL,
  `ReturnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 테이블 구조 `reservation`
--

CREATE TABLE `reservation` (
  `ID` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `UserID` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `ISBN` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `ReservedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `ID` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `PW` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `Name` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `Email` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `Telophone` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `Position` varchar(10) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- 테이블의 인덱스 `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`ID`);

--
-- 테이블의 인덱스 `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`ID`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
