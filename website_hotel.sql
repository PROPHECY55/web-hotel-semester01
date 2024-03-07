-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Jan 2024 um 21:34
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `website_hotel`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `arrival_date` date NOT NULL,
  `departure_date` date NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `suite` varchar(50) NOT NULL,
  `breakfast` tinyint(1) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `pets` tinyint(1) NOT NULL,
  `current_price` decimal(10,2) NOT NULL,
  `booking_date` date NOT NULL,
  `username` varchar(20) NOT NULL,
  `booking_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `bookings`
--

INSERT INTO `bookings` (`booking_id`, `arrival_date`, `departure_date`, `adults`, `children`, `suite`, `breakfast`, `parking`, `pets`, `current_price`, `booking_date`, `username`, `booking_status`) VALUES
(358, '2024-01-26', '2024-01-28', 2, 3, 'Executive', 1, 0, 1, 570.00, '2024-01-15', 'admin', 'Neu');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `posts_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `selected_image` blob NOT NULL,
  `text_description` text NOT NULL,
  `username` varchar(20) NOT NULL,
  `upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`posts_id`, `title`, `selected_image`, `text_description`, `username`, `upload_date`) VALUES
(23, 'Neue Pool Eröffnung!', 0x7372632f75706c6f6164735f7468756d626e61696c732f74657374322e706e67, 'Mit glanzvoller Pracht und strahlendem Ambiente öffnet der brandneue Hotelpool seine Tore, um Gäste in eine Oase der Entspannung zu entführen. Das glitzernde Wasser lädt dazu ein, den Stress des Alltags hinter sich zu lassen und das luxuriöse Flair zu genießen. Umgeben von üppigem Grün und modernem Design bietet der Poolbereich eine einladende Atmosphäre. Die Eröffnung wird von einem festlichen Event begleitet, bei dem Gäste von erfrischenden Getränken und kulinarischen Köstlichkeiten verwöhnt werden. Mit einem atemberaubenden Blick auf die Umgebung wird dieser neue Hotelpool zu einem exklusiven Rückzugsort, der Entspannung und Eleganz perfekt vereint.', 'admin', '2024-01-15 21:29:32'),
(24, '20-Jähriges Jubiläum', 0x7372632f75706c6f6164735f7468756d626e61696c732f74657374312e706e67, 'Das Hotel \"I&L Continental\" feiert stolz das 20-jährige Jubiläum seines exquisiten Massagesalons. Ein Jahrzehnt umsorgt der Salon nun schon Gäste mit höchster Professionalität und einem Hauch von Luxus. Zum Jubiläum erwartet die Besucher ein Fest der Sinne, angefüllt mit exklusiven Massageangeboten, Entspannung pur und einem Hauch von festlicher Atmosphäre. Das erfahrene Team von Therapeuten, das seit den Anfängen des Salons treu seinen Dienst verrichtet, wird besonders geehrt. Gäste dürfen sich auf Sonderangebote, erlesene Wellnessbehandlungen und eine feierliche Stimmung freuen. Das 20-jährige Jubiläum des Massagesalons im \"I&L Continental\" verspricht, eine Reise in die Welt der Entspannung und des Wohlbefindens zu werden.', 'admin', '2024-01-15 21:32:06');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `salutation` varchar(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `acc_created` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`salutation`, `firstname`, `lastname`, `email`, `username`, `role`, `status`, `acc_created`, `password`, `user_id`) VALUES
('Mr', 'test', 'test', 'test@gmail.com', 'test', 'admin', 'active', '2023-11-16 23:06:21', '$2y$10$FsdvJYv7d1obNJ2ihTD/S.47CGUdT8RPURO3cgGy2CmXxWUhj.Jni', 2),
('Mrs', 'Lea', 'Fenz', 'leafenz@gmail.com', 'user', 'user', 'active', '2023-11-17 11:15:57', '$2y$10$ARNWKD/24HLsQHtbDTkFruzYOkusrs473XmRH7nUBoc5Od..xSr3W', 6),
('Mr', 'admin', 'admin', 'admin@admin.com', 'admin', 'admin', 'active', '2023-11-18 18:41:29', '$2y$10$wmVcDf2Jsah23FG7EQaO.uWskXsDeyWtchzdChkr59CC/aMWBet.q', 7);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`posts_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `posts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
