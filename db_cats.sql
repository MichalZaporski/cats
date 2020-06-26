-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 26 Cze 2020, 18:30
-- Wersja serwera: 5.5.60
-- Wersja PHP: 5.4.45-0+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `db_cats`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cares`
--

CREATE TABLE IF NOT EXISTS `cares` (
  `id_care` int(11) NOT NULL AUTO_INCREMENT,
  `user_give_id` int(11) NOT NULL,
  `user_take_id` int(11) DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `cat_name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `city` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id_care`),
  KEY `fk_foreign_cares_user1` (`user_give_id`),
  KEY `fk_foreign_cares_user2` (`user_take_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=13 ;


--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_mess` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `text` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id_mess`),
  KEY `fk_foreign_mess_user1` (`from_user_id`),
  KEY `fk_foreign_mess_user2` (`to_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=7 ;


--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `sec_name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `phone_num` varchar(11) COLLATE utf8_polish_ci NOT NULL,
  `type` char(1) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=11 ;


--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `cares`
--
ALTER TABLE `cares`
  ADD CONSTRAINT `fk_foreign_cares_user1` FOREIGN KEY (`user_give_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_foreign_cares_user2` FOREIGN KEY (`user_take_id`) REFERENCES `users` (`id_user`);

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_foreign_mess_user1` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_foreign_mess_user2` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
