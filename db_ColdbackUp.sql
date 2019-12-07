-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-12-07 07:27
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
  `ReturnDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 테이블의 덤프 데이터 `borrow`
--

INSERT INTO `borrow` (`ID`, `ISBN`, `UserID`, `LoanDate`, `ReturnDate`) VALUES
('0a36d872d6', '12213154', 'startup', '2019-12-06 22:32:50', NULL),
('694bd3654a', '1558586383', 'startup', '2019-12-06 22:42:07', NULL),
('c321dc1a31', '12312312', 'startup', '2019-12-07 15:05:43', NULL);

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

--
-- 테이블의 덤프 데이터 `reservation`
--

INSERT INTO `reservation` (`ID`, `UserID`, `ISBN`, `ReservedDate`) VALUES
('abc7c75c45', 'startup', '12312312', '2019-12-06 22:41:06');

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
('startup', '1234', 'Gyu Bong Lee', 'jopemachine@naver.com', '010-5547-2540', 'í•™ë¶€ìƒ');

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
