-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-12-09 11:56
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
  `Name` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `PublishedHouse` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `Author` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `ReturnRequest` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `book`
--

INSERT INTO `book` (`ISBN`, `Name`, `PublishedHouse`, `Author`, `ReturnRequest`) VALUES
('12213154', 'bdfbf', 'wdqw', 'fwef', 0),
('12312312', 'feswffef', 'fefwefewf', 'wefwefe', 0),
('1558586383', 'efwef', 'fwefew', 'fwef', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `borrow`
--

CREATE TABLE `borrow` (
  `ID` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `ISBN` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `UserID` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `LoanDate` datetime NOT NULL DEFAULT current_timestamp(),
  `ReturnDate` datetime DEFAULT NULL,
  `ReturnDueDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `borrow`
--

INSERT INTO `borrow` (`ID`, `ISBN`, `UserID`, `LoanDate`, `ReturnDate`, `ReturnDueDate`) VALUES
('d86713d497', '12312312', 'startup', '2019-12-09 12:29:55', '2019-12-09 19:51:33', '2019-12-19 12:29:55');

-- --------------------------------------------------------

--
-- 테이블 구조 `reservation`
--

CREATE TABLE `reservation` (
  `ID` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `UserID` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `ISBN` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `ReservedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `ID` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `PW` varchar(40) CHARACTER SET utf8mb4 NOT NULL,
  `Name` varchar(40) CHARACTER SET utf8mb4 DEFAULT NULL,
  `Email` varchar(40) CHARACTER SET utf8mb4 DEFAULT NULL,
  `Telephone` varchar(40) CHARACTER SET utf8mb4 DEFAULT NULL,
  `Position` varchar(10) CHARACTER SET utf8mb4 NOT NULL DEFAULT '학부생'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`ID`, `PW`, `Name`, `Email`, `Telephone`, `Position`) VALUES
('manager', '1234', '매니저', NULL, NULL, '관리자'),
('sdfds', '1234', 'Gyu Bong Lee', 'jopemachine@naver.com', '010-5547-2540', 'êµì§ì›'),
('startup', '1234', 'ì´ê·œë´‰', 'jopemachine@naver.com', '010-5547-2540', 'í•™ë¶€ìƒ');

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
