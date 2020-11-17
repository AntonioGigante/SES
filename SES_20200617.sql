-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 17-06-2020 a les 03:31:37
-- Versió del servidor: 10.3.22-MariaDB-0+deb10u1
-- Versió de PHP: 7.0.33-25+0~20200225.32+debian9~1.gbpa11893

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `SES`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `campeonatos`
--

CREATE TABLE `campeonatos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `juego` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `miembros` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `competicionesapuntadas` int(11) NOT NULL,
  `competicionesganadas` int(11) NOT NULL,
  `partidos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `participaciones`
--

CREATE TABLE `participaciones` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `campeonato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `pruebas`
--

CREATE TABLE `pruebas` (
  `id` int(11) NOT NULL,
  `campeonato` int(11) DEFAULT NULL,
  `prueba` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `victorias` int(11) DEFAULT NULL,
  `competicionesapuntado` int(11) DEFAULT NULL,
  `competicionesganadas` int(11) DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Bolcant dades de la taula `users`
--

INSERT INTO `users` (`id`, `email`, `victorias`, `competicionesapuntado`, `competicionesganadas`, `roles`, `password`, `username`) VALUES
(21, 'rutherford.jodie@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$5Ui0S2LnPtOl6h7o3vrGfujGu8EtYtwqHSHKOJ5RFwzYE/1udrjpa', 'rutherford.jodie'),
(22, 'runolfsson.nettie@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$dqwDa.wDZ2nKnG8cXtsC1eKQEdyfdkXmi7sD3qFLdMff9K1n15w.W', 'runolfsson.nettie'),
(23, 'flemke@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$84/tB7euEyos79DA5Tja0u32O2NsQbz2FJjQvw00paQIynT7IAVSG', 'flemke'),
(24, 'sammy33@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$.PAO0/ocElTwM16PPyIGAeckkKu7J/tIbrJqoH3i4KtjUB1gKs/yS', 'sammy33'),
(25, 'malinda.mraz@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$G5.0SoblikXbnwMBGEltceRU6epT7rAC9IWj9eiA/SdaAx1s8Tek6', 'malinda.mraz'),
(26, 'jarret27@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$aXahOMXrKpXWObK5oghz3eVuyn4KKbKmTXffhSdiOZ4I/H9yeIefS', 'jarret27'),
(27, 'bbahringer@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$lySn371PUvpnVoRkiW57.OBSQ5fCev4CzBM8kLCy9DtCBYAVnjzzi', 'bbahringer'),
(28, 'isom80@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$ujXEXSmd2QdImLYjOghz6uTkN74O4STnButibs.L3A0uJ8iiJHYrG', 'isom80'),
(29, 'jmorissette@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$XyLEp00nMGeGykCZlKB49euL/8XUZ8TXoG109cmo5YHe76Rf2.4ba', 'jmorissette'),
(30, 'kcorkery@ses.test', 0, 0, 0, '[\"ROLE_USER\"]', '$2y$13$ubTA46U./PLH0xMOyaLjd.GVdhV6ci0TbVjD.Kt4MiMVn/LihSnaC', 'kcorkery');

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `campeonatos`
--
ALTER TABLE `campeonatos`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Index de la taula `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index de la taula `participaciones`
--
ALTER TABLE `participaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B769E4738D93D649` (`user`),
  ADD KEY `IDX_B769E473722DB8CA` (`campeonato`);

--
-- Index de la taula `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F49DAE3F722DB8CA` (`campeonato`);

--
-- Index de la taula `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `campeonatos`
--
ALTER TABLE `campeonatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la taula `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la taula `participaciones`
--
ALTER TABLE `participaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la taula `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la taula `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `participaciones`
--
ALTER TABLE `participaciones`
  ADD CONSTRAINT `FK_B769E473722DB8CA` FOREIGN KEY (`campeonato`) REFERENCES `campeonatos` (`id`),
  ADD CONSTRAINT `FK_B769E4738D93D649` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Restriccions per la taula `pruebas`
--
ALTER TABLE `pruebas`
  ADD CONSTRAINT `FK_F49DAE3F722DB8CA` FOREIGN KEY (`campeonato`) REFERENCES `campeonatos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
