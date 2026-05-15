-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 15, 2026 alle 02:49
-- Versione del server: 10.11.14-MariaDB-0ubuntu0.24.04.1
-- Versione PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DataBaseJungleon`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `MessaggiUtenti`
--

CREATE TABLE `MessaggiUtenti` (
  `ID` int(15) NOT NULL,
  `Utenti-Mandante` varchar(150) NOT NULL,
  `Utenti-Ricevente` varchar(150) NOT NULL,
  `tipo` varchar(250) NOT NULL DEFAULT 'messaggio',
  `dataInvio` datetime NOT NULL DEFAULT current_timestamp(),
  `testo` text NOT NULL,
  `visualizzato` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Mostri`
--

CREATE TABLE `Mostri` (
  `ID` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `livello` int(11) NOT NULL,
  `Utenti` varchar(150) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `esperienzaData` int(11) NOT NULL,
  `oroDato` int(11) NOT NULL,
  `vita` int(11) NOT NULL,
  `resistenza` int(11) NOT NULL,
  `velocità` int(11) NOT NULL,
  `forza` int(11) NOT NULL,
  `pubblico` tinyint(1) NOT NULL DEFAULT 0,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Mostri`
--

INSERT INTO `Mostri` (`ID`, `nome`, `livello`, `Utenti`, `descrizione`, `esperienzaData`, `oroDato`, `vita`, `resistenza`, `velocità`, `forza`, `pubblico`, `dataCreazione`) VALUES
(1, 'Scheletro Base', 1, NULL, 'Scheletro Base, lo capibile dalle piccole ossa che ha', 10, 0, 15, 1, 5, 5, 1, '2026-05-15 00:42:53'),
(2, 'Goblin Prova', 2, NULL, 'Mostro di test', 12, 5, 20, 3, 4, 6, 1, '2026-05-15 00:56:59'),
(3, 'Orco Boss', 5, 'testcopilot4', 'Test con collegamenti', 40, 25, 80, 10, 6, 14, 1, '2026-05-15 01:48:53'),
(4, 'WErion', 2, 'utente_phpmyadmin', 'boh, qualcosa', 10, 0, 100, 20, 10, 10, 1, '2026-05-15 01:56:24'),
(5, 'Ciao', 2, 'utente_phpmyadmin', '', 0, 0, 1, 0, 0, 0, 0, '2026-05-15 01:57:22'),
(6, 'Goblin Token', 2, 'testcopilot4', 'Token ok', 12, 5, 20, 3, 4, 6, 1, '2026-05-15 02:03:02'),
(7, 'Ciao2', 3, 'utente_phpmyadmin', '', 1, 1, 1, 1, 1, 1, 0, '2026-05-15 02:06:01'),
(8, 'Privato ok', 1, 'testcopilot4', 'x', 1, 0, 1, 0, 0, 0, 0, '2026-05-15 02:30:27');

-- --------------------------------------------------------

--
-- Struttura della tabella `Privilegi`
--

CREATE TABLE `Privilegi` (
  `nome` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Privilegi`
--

INSERT INTO `Privilegi` (`nome`, `tipo`, `descrizione`, `dataCreazione`) VALUES
('Accettazione lamentele', 'Moderazione utenza', 'Permette di visionare i messaggi di lamentele degli utenti', '2026-05-15 02:48:50'),
('Crea Mostri', 'Creazione', 'permette di creare dei mostri', '2026-05-15 01:02:50'),
('Crea Oggetti', 'Creazione', 'permette di creare degli oggetti', '2026-05-15 02:50:00'),
('Pubblicazione', 'Condivisione', 'permette di pubblicare le proprie creazioni (sia che siano oggetti, che dungeon, che stanze, ecc..)', '2026-05-15 01:04:02');

-- --------------------------------------------------------

--
-- Struttura della tabella `Privilegi_Ruoli`
--

CREATE TABLE `Privilegi_Ruoli` (
  `Privilegi` varchar(250) NOT NULL,
  `Ruoli` varchar(250) NOT NULL,
  `dataAssegnazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Privilegi_Ruoli`
--

INSERT INTO `Privilegi_Ruoli` (`Privilegi`, `Ruoli`, `dataAssegnazione`) VALUES
('Accettazione lamentele', 'Moderatore', '2026-05-15 02:49:03'),
('Crea Mostri', 'UtenteBase', '2026-05-15 01:04:47'),
('Crea Oggetti', 'UtenteBase', '2026-05-15 02:50:05'),
('Pubblicazione', 'UtenteBase', '2026-05-15 01:04:52');

-- --------------------------------------------------------

--
-- Struttura della tabella `RestrizioniPrivilegiUtenti`
--

CREATE TABLE `RestrizioniPrivilegiUtenti` (
  `ID` int(15) NOT NULL,
  `Utenti_Mandante` varchar(150) DEFAULT NULL,
  `Utenti_Ricevente` varchar(150) NOT NULL,
  `Privilegi` varchar(250) NOT NULL,
  `dataAssegnazione` datetime NOT NULL DEFAULT current_timestamp(),
  `dataFine` datetime DEFAULT NULL,
  `motivazione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `RestrizioniPrivilegiUtenti`
--

INSERT INTO `RestrizioniPrivilegiUtenti` (`ID`, `Utenti_Mandante`, `Utenti_Ricevente`, `Privilegi`, `dataAssegnazione`, `dataFine`, `motivazione`) VALUES
(1, NULL, 'utente_phpmyadmin', 'Pubblicazione', '2026-05-15 02:12:24', NULL, 'ha pubblicato un mostro non rispettoso verso un altro utente');

-- --------------------------------------------------------

--
-- Struttura della tabella `Ruoli`
--

CREATE TABLE `Ruoli` (
  `nome` varchar(250) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Ruoli`
--

INSERT INTO `Ruoli` (`nome`, `descrizione`, `dataCreazione`) VALUES
('Moderatore', 'Chi ha questo ruolo può e deve collaborare alla moderazione della piattaforma', '2026-05-15 02:36:10'),
('UtenteBase', NULL, '2026-05-14 23:38:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `Ruoli_Utenti`
--

CREATE TABLE `Ruoli_Utenti` (
  `ID` int(15) NOT NULL,
  `Utenti` varchar(150) NOT NULL,
  `Ruoli` varchar(250) NOT NULL,
  `dataAssegnazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Ruoli_Utenti`
--

INSERT INTO `Ruoli_Utenti` (`ID`, `Utenti`, `Ruoli`, `dataAssegnazione`) VALUES
(3, 'testcopilot3', 'UtenteBase', '2026-05-14 23:39:45'),
(4, 'testcopilot4', 'UtenteBase', '2026-05-14 23:41:01'),
(5, 'utente_phpmyadmin', 'UtenteBase', '2026-05-15 01:54:37'),
(6, 'FireFabry', 'UtenteBase', '2026-05-15 02:36:36'),
(7, 'FireFabry', 'Moderatore', '2026-05-15 02:37:52');

-- --------------------------------------------------------

--
-- Struttura della tabella `TemplateOggetti`
--

CREATE TABLE `TemplateOggetti` (
  `ID` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `livello` int(11) NOT NULL,
  `Utenti` varchar(150) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `storia` text DEFAULT NULL,
  `valore` int(11) NOT NULL,
  `rarità` varchar(250) NOT NULL,
  `pubblico` tinyint(1) NOT NULL DEFAULT 0,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `TemplateOggetti`
--

INSERT INTO `TemplateOggetti` (`ID`, `nome`, `livello`, `Utenti`, `descrizione`, `storia`, `valore`, `rarità`, `pubblico`, `dataCreazione`) VALUES
(1, 'Arco lungo scheletrico', 1, NULL, 'Arco lungo scheletrico', 'Arco lungo scheletrico di uno scheletro (o almeno avrebbe dovuto esserlo)', 2, '1', 1, '2026-05-15 00:40:26');

-- --------------------------------------------------------

--
-- Struttura della tabella `TemplateOggettiMostri`
--

CREATE TABLE `TemplateOggettiMostri` (
  `Mostri` int(11) NOT NULL,
  `TemplateOggetti` int(11) NOT NULL,
  `numero` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `TemplateOggettiMostri`
--

INSERT INTO `TemplateOggettiMostri` (`Mostri`, `TemplateOggetti`, `numero`) VALUES
(1, 1, 1),
(3, 1, 1),
(4, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `TemplateOggettiTipiMostri`
--

CREATE TABLE `TemplateOggettiTipiMostri` (
  `TipiMostri` varchar(250) NOT NULL,
  `TemplateOggetti` int(11) NOT NULL,
  `numero` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiArmature`
--

CREATE TABLE `TipiArmature` (
  `nome` varchar(250) NOT NULL,
  `resistenza` int(11) NOT NULL,
  `velocita` int(11) NOT NULL,
  `furtivita` int(11) NOT NULL,
  `usuraMax` tinyint(1) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiArmatureTemplateOggetti`
--

CREATE TABLE `TipiArmatureTemplateOggetti` (
  `TipiArmature` varchar(250) NOT NULL,
  `TemplateOggetti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiArmi`
--

CREATE TABLE `TipiArmi` (
  `nome` varchar(250) NOT NULL,
  `danno` int(11) NOT NULL,
  `velocita` int(11) NOT NULL,
  `furtivita` int(11) NOT NULL,
  `usuraMax` int(11) DEFAULT NULL,
  `aDueMani` tinyint(1) NOT NULL DEFAULT 0,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `TipiArmi`
--

INSERT INTO `TipiArmi` (`nome`, `danno`, `velocita`, `furtivita`, `usuraMax`, `aDueMani`, `dataCreazione`) VALUES
('Archi Lunghi', 20, 10, 10, 100, 0, '2026-05-15 00:34:30');

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiArmiTemplateOggetti`
--

CREATE TABLE `TipiArmiTemplateOggetti` (
  `TipiArmi` varchar(250) NOT NULL,
  `TemplateOggetti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiMostri`
--

CREATE TABLE `TipiMostri` (
  `nome` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `TipiMostri`
--

INSERT INTO `TipiMostri` (`nome`) VALUES
('Non-Morti');

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiMostriMostri`
--

CREATE TABLE `TipiMostriMostri` (
  `Mostri` int(11) NOT NULL,
  `TipiMostri` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `TipiMostriMostri`
--

INSERT INTO `TipiMostriMostri` (`Mostri`, `TipiMostri`) VALUES
(3, 'Non-Morti'),
(4, 'Non-Morti'),
(6, 'Non-Morti');

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiPozioni`
--

CREATE TABLE `TipiPozioni` (
  `nome` varchar(250) NOT NULL,
  `usuraMax` int(11) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiPozioniTemplateOggetti`
--

CREATE TABLE `TipiPozioniTemplateOggetti` (
  `TipiPozioni` varchar(250) NOT NULL,
  `TemplateOggetti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiReliquie`
--

CREATE TABLE `TipiReliquie` (
  `nome` varchar(250) NOT NULL,
  `usuraMax` int(11) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `TipiReliquieTemplateReliquieOggetti`
--

CREATE TABLE `TipiReliquieTemplateReliquieOggetti` (
  `TipiReliquie` varchar(250) NOT NULL,
  `TemplateOggetti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Tokens`
--

CREATE TABLE `Tokens` (
  `ID` int(15) NOT NULL,
  `Utenti` varchar(150) NOT NULL,
  `token` varchar(500) NOT NULL,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `username` varchar(150) NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `password` char(96) NOT NULL,
  `dataCreazione` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`username`, `email`, `nome`, `password`, `dataCreazione`) VALUES
('Fabry', NULL, NULL, '3', '2026-05-14 22:59:22'),
('FireFabry', NULL, 'Fabrizio', '906a01f116149730d21eba029bbaa4573be4b35b8371e8258c32f526bc6614ab045d25cc6fee213e69c9f779c672985e', '2026-05-15 02:36:36'),
('testcopilot2', NULL, 'Test Copilot', '364b7077dda0dc1e6f7ea0cd11199863c32898a91d0b1fa1b5fdb7a8c728af4eb55de700bf97dfe6fbed1af288e71964', '2026-05-14 23:37:26'),
('testcopilot3', NULL, 'Test Copilot', '778cf54cebc1c26f667bd42f75e3a8a91ed925eb4a9f0e6994244e96ba076d161ca573dea73b5caa15e15132cd362425', '2026-05-14 23:39:45'),
('testcopilot4', NULL, 'Test Copilot', '5571c8a3fee63b0a766ce2796acf75eef08d663234778296f0ab9658924b73da57868612af0054e62ce53f441a153a47', '2026-05-14 23:41:01'),
('utente_phpmyadmin', NULL, 'FireStone17', 'b6d95d4628136fc28ca23d4fa6661fef05a36ba50b4b1d9dd394a2c9eac5cc287ce5524be68442fc49f188e7c020c871', '2026-05-14 23:37:15');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `MessaggiUtenti`
--
ALTER TABLE `MessaggiUtenti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `MessaggiUtenti_Mandante-Utenti` (`Utenti-Mandante`),
  ADD KEY `MessaggiUtenti_Ricevente-Utenti` (`Utenti-Ricevente`);

--
-- Indici per le tabelle `Mostri`
--
ALTER TABLE `Mostri`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Mostri-Utenti` (`Utenti`);

--
-- Indici per le tabelle `Privilegi`
--
ALTER TABLE `Privilegi`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `Privilegi_Ruoli`
--
ALTER TABLE `Privilegi_Ruoli`
  ADD PRIMARY KEY (`Privilegi`,`Ruoli`),
  ADD KEY `Privilegi_Ruoli-Ruoli` (`Ruoli`);

--
-- Indici per le tabelle `RestrizioniPrivilegiUtenti`
--
ALTER TABLE `RestrizioniPrivilegiUtenti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RestrizioniPrivilegiUtenti_Mandante-Utenti` (`Utenti_Mandante`),
  ADD KEY `RestrizioniPrivilegiUtenti_Ricevente-Utenti` (`Utenti_Ricevente`),
  ADD KEY `RestrizioniPrivilegiUtenti-Privilegi` (`Privilegi`);

--
-- Indici per le tabelle `Ruoli`
--
ALTER TABLE `Ruoli`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `Ruoli_Utenti`
--
ALTER TABLE `Ruoli_Utenti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Ruoli_Utenti-Ruoli` (`Ruoli`),
  ADD KEY `Ruoli_Utenti-Utenti` (`Utenti`);

--
-- Indici per le tabelle `TemplateOggetti`
--
ALTER TABLE `TemplateOggetti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TemplateOggetti-Utenti` (`Utenti`);

--
-- Indici per le tabelle `TemplateOggettiMostri`
--
ALTER TABLE `TemplateOggettiMostri`
  ADD PRIMARY KEY (`Mostri`,`TemplateOggetti`),
  ADD KEY `TemplateOggettiMostri-TemplateOggetti` (`TemplateOggetti`);

--
-- Indici per le tabelle `TemplateOggettiTipiMostri`
--
ALTER TABLE `TemplateOggettiTipiMostri`
  ADD PRIMARY KEY (`TipiMostri`,`TemplateOggetti`),
  ADD KEY `TemplateOggettiTipiMostri-TemplateOggetti` (`TemplateOggetti`);

--
-- Indici per le tabelle `TipiArmature`
--
ALTER TABLE `TipiArmature`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `TipiArmatureTemplateOggetti`
--
ALTER TABLE `TipiArmatureTemplateOggetti`
  ADD PRIMARY KEY (`TipiArmature`,`TemplateOggetti`),
  ADD KEY `TipiArmatureTemplateOggetti-TemplateOggetti` (`TemplateOggetti`);

--
-- Indici per le tabelle `TipiArmi`
--
ALTER TABLE `TipiArmi`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `TipiArmiTemplateOggetti`
--
ALTER TABLE `TipiArmiTemplateOggetti`
  ADD PRIMARY KEY (`TipiArmi`,`TemplateOggetti`),
  ADD KEY `TipiArmiTemplateOggetti-TemplateOggetti` (`TemplateOggetti`);

--
-- Indici per le tabelle `TipiMostri`
--
ALTER TABLE `TipiMostri`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `TipiMostriMostri`
--
ALTER TABLE `TipiMostriMostri`
  ADD PRIMARY KEY (`Mostri`,`TipiMostri`),
  ADD KEY `TipiMostriMostri-TipiMostri` (`TipiMostri`);

--
-- Indici per le tabelle `TipiPozioni`
--
ALTER TABLE `TipiPozioni`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `TipiPozioniTemplateOggetti`
--
ALTER TABLE `TipiPozioniTemplateOggetti`
  ADD PRIMARY KEY (`TipiPozioni`,`TemplateOggetti`),
  ADD KEY `TipiPozioniTemplateOggetti-TemplateOggetti` (`TemplateOggetti`);

--
-- Indici per le tabelle `TipiReliquie`
--
ALTER TABLE `TipiReliquie`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `TipiReliquieTemplateReliquieOggetti`
--
ALTER TABLE `TipiReliquieTemplateReliquieOggetti`
  ADD KEY `TipiReliquieTemplateReliquieOggetti-TipiReliquie` (`TipiReliquie`),
  ADD KEY `TipiReliquieTemplateReliquieOggetti-TemplateOggetti` (`TemplateOggetti`);

--
-- Indici per le tabelle `Tokens`
--
ALTER TABLE `Tokens`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `MessaggiUtenti`
--
ALTER TABLE `MessaggiUtenti`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `Mostri`
--
ALTER TABLE `Mostri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `RestrizioniPrivilegiUtenti`
--
ALTER TABLE `RestrizioniPrivilegiUtenti`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `Ruoli_Utenti`
--
ALTER TABLE `Ruoli_Utenti`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `TemplateOggetti`
--
ALTER TABLE `TemplateOggetti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `Tokens`
--
ALTER TABLE `Tokens`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `MessaggiUtenti`
--
ALTER TABLE `MessaggiUtenti`
  ADD CONSTRAINT `MessaggiUtenti_Mandante-Utenti` FOREIGN KEY (`Utenti-Mandante`) REFERENCES `Utenti` (`username`),
  ADD CONSTRAINT `MessaggiUtenti_Ricevente-Utenti` FOREIGN KEY (`Utenti-Ricevente`) REFERENCES `Utenti` (`username`);

--
-- Limiti per la tabella `Mostri`
--
ALTER TABLE `Mostri`
  ADD CONSTRAINT `Mostri-Utenti` FOREIGN KEY (`Utenti`) REFERENCES `Utenti` (`username`);

--
-- Limiti per la tabella `Privilegi_Ruoli`
--
ALTER TABLE `Privilegi_Ruoli`
  ADD CONSTRAINT `Privilegi_Ruoli-Privilegi` FOREIGN KEY (`Privilegi`) REFERENCES `Privilegi` (`nome`),
  ADD CONSTRAINT `Privilegi_Ruoli-Ruoli` FOREIGN KEY (`Ruoli`) REFERENCES `Ruoli` (`nome`);

--
-- Limiti per la tabella `RestrizioniPrivilegiUtenti`
--
ALTER TABLE `RestrizioniPrivilegiUtenti`
  ADD CONSTRAINT `RestrizioniPrivilegiUtenti-Privilegi` FOREIGN KEY (`Privilegi`) REFERENCES `Privilegi` (`nome`),
  ADD CONSTRAINT `RestrizioniPrivilegiUtenti_Mandante-Utenti` FOREIGN KEY (`Utenti_Mandante`) REFERENCES `Utenti` (`username`),
  ADD CONSTRAINT `RestrizioniPrivilegiUtenti_Ricevente-Utenti` FOREIGN KEY (`Utenti_Ricevente`) REFERENCES `Utenti` (`username`);

--
-- Limiti per la tabella `Ruoli_Utenti`
--
ALTER TABLE `Ruoli_Utenti`
  ADD CONSTRAINT `Ruoli_Utenti-Ruoli` FOREIGN KEY (`Ruoli`) REFERENCES `Ruoli` (`nome`),
  ADD CONSTRAINT `Ruoli_Utenti-Utenti` FOREIGN KEY (`Utenti`) REFERENCES `Utenti` (`username`);

--
-- Limiti per la tabella `TemplateOggetti`
--
ALTER TABLE `TemplateOggetti`
  ADD CONSTRAINT `TemplateOggetti-Utenti` FOREIGN KEY (`Utenti`) REFERENCES `Utenti` (`username`);

--
-- Limiti per la tabella `TemplateOggettiMostri`
--
ALTER TABLE `TemplateOggettiMostri`
  ADD CONSTRAINT `TemplateOggettiMostri-Mostri` FOREIGN KEY (`Mostri`) REFERENCES `Mostri` (`ID`),
  ADD CONSTRAINT `TemplateOggettiMostri-TemplateOggetti` FOREIGN KEY (`TemplateOggetti`) REFERENCES `TemplateOggetti` (`ID`);

--
-- Limiti per la tabella `TemplateOggettiTipiMostri`
--
ALTER TABLE `TemplateOggettiTipiMostri`
  ADD CONSTRAINT `TemplateOggettiTipiMostri-TemplateOggetti` FOREIGN KEY (`TemplateOggetti`) REFERENCES `TemplateOggetti` (`ID`),
  ADD CONSTRAINT `TemplateOggettiTipiMostri-TipiMostri` FOREIGN KEY (`TipiMostri`) REFERENCES `TipiMostri` (`nome`);

--
-- Limiti per la tabella `TipiArmatureTemplateOggetti`
--
ALTER TABLE `TipiArmatureTemplateOggetti`
  ADD CONSTRAINT `TipiArmatureTemplateOggetti-TemplateOggetti` FOREIGN KEY (`TemplateOggetti`) REFERENCES `TemplateOggetti` (`ID`),
  ADD CONSTRAINT `TipiArmatureTemplateOggetti-TipiArmature` FOREIGN KEY (`TipiArmature`) REFERENCES `TipiArmature` (`nome`);

--
-- Limiti per la tabella `TipiArmiTemplateOggetti`
--
ALTER TABLE `TipiArmiTemplateOggetti`
  ADD CONSTRAINT `TipiArmiTemplateOggetti-TemplateOggetti` FOREIGN KEY (`TemplateOggetti`) REFERENCES `TemplateOggetti` (`ID`),
  ADD CONSTRAINT `TipiArmiTemplateOggetti-TipiArmi` FOREIGN KEY (`TipiArmi`) REFERENCES `TipiArmi` (`nome`);

--
-- Limiti per la tabella `TipiMostriMostri`
--
ALTER TABLE `TipiMostriMostri`
  ADD CONSTRAINT `TipiMostriMostri-Mostri` FOREIGN KEY (`Mostri`) REFERENCES `Mostri` (`ID`),
  ADD CONSTRAINT `TipiMostriMostri-TipiMostri` FOREIGN KEY (`TipiMostri`) REFERENCES `TipiMostri` (`nome`);

--
-- Limiti per la tabella `TipiPozioniTemplateOggetti`
--
ALTER TABLE `TipiPozioniTemplateOggetti`
  ADD CONSTRAINT `TipiPozioniTemplateOggetti-TemplateOggetti` FOREIGN KEY (`TemplateOggetti`) REFERENCES `TemplateOggetti` (`ID`),
  ADD CONSTRAINT `TipiPozioniTemplateOggetti-TipiPozioni` FOREIGN KEY (`TipiPozioni`) REFERENCES `TipiPozioni` (`nome`);

--
-- Limiti per la tabella `TipiReliquieTemplateReliquieOggetti`
--
ALTER TABLE `TipiReliquieTemplateReliquieOggetti`
  ADD CONSTRAINT `TipiReliquieTemplateReliquieOggetti-TemplateOggetti` FOREIGN KEY (`TemplateOggetti`) REFERENCES `TemplateOggetti` (`ID`),
  ADD CONSTRAINT `TipiReliquieTemplateReliquieOggetti-TipiReliquie` FOREIGN KEY (`TipiReliquie`) REFERENCES `TipiReliquie` (`nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
