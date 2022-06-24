-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.6.7-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- project_test 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `project_test` /*!40100 DEFAULT CHARACTER SET utf8mb3 */;
USE `project_test`;

-- 테이블 project_test.galley_t 구조 내보내기
CREATE TABLE IF NOT EXISTS `galley_t` (
  `g_num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_num` int(10) unsigned NOT NULL,
  `g_nm` varchar(30) NOT NULL,
  `g_intro` varchar(1000) DEFAULT NULL,
  `g_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`g_num`),
  KEY `l_num` (`l_num`),
  CONSTRAINT `galley_t_ibfk_1` FOREIGN KEY (`l_num`) REFERENCES `local_t` (`l_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 project_test.local_t 구조 내보내기
CREATE TABLE IF NOT EXISTS `local_t` (
  `l_num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_nm` varchar(5) NOT NULL,
  PRIMARY KEY (`l_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 project_test.picture_t 구조 내보내기
CREATE TABLE IF NOT EXISTS `picture_t` (
  `p_num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_num` int(10) unsigned NOT NULL,
  `p_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`p_num`),
  KEY `s_num` (`s_num`),
  CONSTRAINT `picture_t_ibfk_1` FOREIGN KEY (`s_num`) REFERENCES `show_t` (`s_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 project_test.review_t 구조 내보내기
CREATE TABLE IF NOT EXISTS `review_t` (
  `rv_num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_num` int(10) unsigned NOT NULL,
  `rv_ctnt` varchar(1000) DEFAULT NULL,
  `rv_score` int(10) NOT NULL,
  `rv_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`rv_num`),
  KEY `s_num` (`s_num`),
  CONSTRAINT `review_t_ibfk_1` FOREIGN KEY (`s_num`) REFERENCES `show_t` (`s_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 project_test.show_t 구조 내보내기
CREATE TABLE IF NOT EXISTS `show_t` (
  `s_num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_num` int(10) unsigned NOT NULL,
  `s_nm` varchar(100) NOT NULL,
  `s_s_date` date DEFAULT NULL,
  `s_e_date` date DEFAULT NULL,
  `s_ctnt_img` varchar(100) DEFAULT NULL,
  `s_ctnt_text` varchar(1000) DEFAULT NULL,
  `s_post` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`s_num`),
  KEY `g_num` (`g_num`),
  CONSTRAINT `show_t_ibfk_1` FOREIGN KEY (`g_num`) REFERENCES `galley_t` (`g_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 project_test.user_t 구조 내보내기
CREATE TABLE IF NOT EXISTS `user_t` (
  `u_num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_nick` varchar(15) NOT NULL,
  `u_pw` varchar(15) NOT NULL,
  `u_mail` varchar(50) NOT NULL,
  `u_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`u_num`),
  UNIQUE KEY `u_nick` (`u_nick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 내보낼 데이터가 선택되어 있지 않습니다.

-- 테이블 project_test.visit_t 구조 내보내기
CREATE TABLE IF NOT EXISTS `visit_t` (
  `redate` date DEFAULT NULL,
  `cnt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- 내보낼 데이터가 선택되어 있지 않습니다.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
