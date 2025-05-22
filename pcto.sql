-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 21, 2025 alle 22:10
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE `attivita` (
  `id` int(11) NOT NULL,
  `studente_id` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `ore` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `azienda_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `attivita`
--

INSERT INTO `attivita` (`id`, `studente_id`, `data`, `ore`, `note`, `azienda_id`) VALUES
(1, 1, '2025-03-15', 4, 'Progetto su app mobile', 1),
(2, 2, '2025-03-16', 6, 'Installazione pannelli solari', 2),
(3, 3, '2025-03-17', 5, 'Analisi dei dati sanitari', 3),
(4, 4, '2025-03-18', 3, 'Testing software gestionale', 1),
(5, 5, '2025-03-19', 4, 'Report tecnico su impianti', 2);


-- --------------------------------------------------------

--
-- Struttura della tabella `aziende`
--

CREATE TABLE `aziende` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `specializzazione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `aziende`
--

INSERT INTO `aziende` (`id`, `nome`, `specializzazione`) VALUES
(1, 'Tech Solutions S.r.l.', 'Sviluppo software'),
(2, 'Green Energy', 'Energie rinnovabili'),
(3, 'MediCare Italia', 'Servizi sanitari');

-- --------------------------------------------------------

--
-- Struttura della tabella `classi`
--

CREATE TABLE `classi` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `anno` year(4) NOT NULL,
  `coordinatore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `classi`
--

INSERT INTO `classi` (`id`, `nome`, `indirizzo`, `anno`, `coordinatore`) VALUES
(1, '5A', 'Informatica', '2025', 2),
(2, '5B', 'Elettronica', '2025', 3),
(3, '4A', 'informatica', '2024', 1),
(4, '3B', 'elettronica', '2023', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `prof`
--

CREATE TABLE `prof` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `materia` text NOT NULL,
  `utente` text NOT NULL,
  `psw` text NOT NULL DEFAULT 'scuola25',
  `global` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `prof`
--

INSERT INTO `prof` (`id`, `nome`, `cognome`, `materia`, `utente`, `psw`, `global`) VALUES
(1, 'Luigi', 'Bianchi', 'Matematica', 'lb', 'lb', 1),
(2, 'Anna', 'Verdi', 'Informatica', '', '', 0),
(3, 'Marco', 'Rossi', 'Fisica', '', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `studenti`
--

CREATE TABLE `studenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cognome` varchar(50) DEFAULT NULL,
  `classe_id` int(11) DEFAULT NULL,
  `utente` varchar(30) NOT NULL,
  `psw` varchar(30) NOT NULL DEFAULT 'scuola25'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `studenti`
--

INSERT INTO `studenti` (`id`, `nome`, `cognome`, `classe_id`, `utente`, `psw`) VALUES
(1, 'Giulia', 'Conti', 1, '', 'scuola25'),
(2, 'Luca', 'Neri', 2, '', 'scuola25'),
(3, 'Francesca', 'Moretti', 1, '', 'scuola25'),
(4, 'Andrea', 'Rizzo', 3, '', 'scuola25'),
(5, 'Chiara', 'Esposito', 2, '', 'scuola25'),
(6, 'mark', 'heimer', NULL, 'mh6', 'scuola25'),
(7, 'carl', 'svarz', 6, 'cs7', 'scuola25'),
(8, 'herr', 'voss', 6, 'hv8', 'scuola25'),
(9, 'carl', 'voss', 6, 'cv9', 'scuola25');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `aziende`
--
ALTER TABLE `aziende`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `classi`
--
ALTER TABLE `classi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attivita`
--
ALTER TABLE `attivita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `aziende`
--
ALTER TABLE `aziende`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `classi`
--
ALTER TABLE `classi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `prof`
--
ALTER TABLE `prof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
