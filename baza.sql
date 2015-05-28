-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 28 Maj 2015, 21:48
-- Wersja serwera: 5.1.65rel14.0-log
-- Wersja PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `pawel33317_newf`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `folder`
--

CREATE TABLE IF NOT EXISTS `folder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` text,
  `rodzajhasla` int(11) DEFAULT NULL,
  `haslo` varchar(256) DEFAULT NULL,
  `idwlasciciela` int(11) DEFAULT NULL,
  `opis` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=53 ;

--
-- Zrzut danych tabeli `folder`
--

INSERT INTO `folder` (`id`, `link`, `rodzajhasla`, `haslo`, `idwlasciciela`, `opis`) VALUES
(1, '', NULL, '', NULL, 'Katalog glowny serwera'),
(2, 'progcpp', NULL, NULL, NULL, NULL),
(3, 'pawel33317', NULL, 'fe80ef80e324d1499dc3137074792025', NULL, NULL),
(7, 'mobilne', NULL, '9aa6e5f2256c17d2d430b100032b997c', NULL, NULL),
(6, 'db2', NULL, 'f026039304a184900ee0f0743effcb7f', NULL, NULL),
(8, 'modelowanie', NULL, 'f026039304a184900ee0f0743effcb7f', NULL, NULL),
(26, 'projekt', NULL, NULL, NULL, NULL),
(9, 'pawel33317/progcpp', NULL, NULL, NULL, NULL),
(10, 'pawel33317/progcpp/mapa tab asoc', NULL, NULL, NULL, NULL),
(11, 'rozproszone', NULL, '74b87337454200d4d33f80c4663dc5e5', NULL, NULL),
(33, 'modelowanie/lab4', NULL, NULL, NULL, NULL),
(13, 'mobilne//', NULL, NULL, NULL, NULL),
(14, 'mobilne////', NULL, NULL, NULL, NULL),
(15, 'mobilne///./', NULL, NULL, NULL, NULL),
(16, 'mobilne///./././././', NULL, NULL, NULL, NULL),
(17, 'mobilne///././././././', NULL, NULL, NULL, NULL),
(18, 'mobilne///./././././.', NULL, NULL, NULL, NULL),
(19, 'mobilne///././././.', NULL, NULL, NULL, NULL),
(20, 'mobilne///./././.', NULL, NULL, NULL, NULL),
(21, 'mobilne///././.', NULL, NULL, NULL, NULL),
(22, 'mobilne///.', NULL, NULL, NULL, NULL),
(23, 'mobilne/', NULL, NULL, NULL, NULL),
(32, 'db2/inne', NULL, NULL, NULL, NULL),
(46, 'lingwistyka/zdjeciawykresow', NULL, NULL, NULL, NULL),
(45, 'db2/test', NULL, NULL, NULL, NULL),
(30, 'modelowanie/lab12', NULL, NULL, NULL, NULL),
(31, 'modelowanie/lab3', NULL, NULL, NULL, NULL),
(34, 'pawel33317/projekty', NULL, NULL, NULL, NULL),
(35, 'statystyka', NULL, '9498be38392818237fb99d0320e85610', NULL, NULL),
(36, 'rozproszone/zad2', NULL, NULL, NULL, NULL),
(37, 'proj', NULL, NULL, NULL, NULL),
(38, 'rozproszone/28.04 sampleDB', NULL, NULL, NULL, NULL),
(41, 'db2/pdf', NULL, NULL, NULL, NULL),
(40, 'lingwistyka', NULL, 'c544f3166cd2e09b301f945a1562269f', NULL, NULL),
(42, 'lingwistyka/zad1', NULL, NULL, NULL, NULL),
(43, 'projekt/proj', NULL, NULL, NULL, NULL),
(44, 'statystyka/old', NULL, NULL, NULL, NULL),
(47, 'modelowanie/oldKowalski', NULL, NULL, NULL, NULL),
(48, 'db2/old', NULL, NULL, NULL, NULL),
(49, 'db2/old/inne', NULL, NULL, NULL, NULL),
(50, 'db2/old/test', NULL, NULL, NULL, NULL),
(51, 'lingwistyka/zall', NULL, NULL, NULL, NULL),
(52, 'sas', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nowe`
--

CREATE TABLE IF NOT EXISTS `nowe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` text,
  `idwlasciciela` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(256) NOT NULL,
  `haslo` varchar(256) NOT NULL,
  `ranga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `haslo`, `ranga`) VALUES
(1, 'pawel33317', 'fe80ef80e324d1499dc3137074792025', 10),
(2, 'zzzz', '02c425157ecd32f259548b33402ff6d3', 0),
(3, 'db2', 'ea95a7d80f83fc61f9f153f2638ea853', 0),
(4, 'mobilne', 'fa4598ee7fbca4052d257610f511fcdf', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
