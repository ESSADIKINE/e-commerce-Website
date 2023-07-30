-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2023 at 11:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `mot_de_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `mot_de_pass`) VALUES
(2, 'anass', '9a6b59da46371d86eb75259c956aee4b580c0119');

-- --------------------------------------------------------

--
-- Table structure for table `liste`
--

CREATE TABLE `liste` (
  `id` int(100) NOT NULL,
  `id_utilisateur` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liste`
--

INSERT INTO `liste` (`id`, `id_utilisateur`, `pid`, `nom`, `prix`, `image`) VALUES
(5, 1, 15, 'YAMAHA CASQUE', 1650, '2918437-2.webp'),
(9, 1, 4, 'LENOVO PC CEL N4020', 3199, '2945068-_1_.webp');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `id_utilisateur` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `némuro` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `id_utilisateur`, `nom`, `email`, `némuro`, `message`) VALUES
(3, 1, 'essadikine', 'an4ss.essadikine@gmail.com', '0666666666', 'J&#39;ai acheté un téléphone portable sur ce site et j&#39;en suis très satisfait'),
(4, 1, 'anass', 'essadikine.fst@uhp.ac.ma', '0656789787', 'J&#39;ai acheté un ordinateur portable sur ce site et j&#39;ai été très satisfait de mon achat');

-- --------------------------------------------------------

--
-- Table structure for table `ordres`
--

CREATE TABLE `ordres` (
  `id` int(100) NOT NULL,
  `id_utilisateur` int(100) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `némuro` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_produit` varchar(1000) NOT NULL,
  `total_prix` int(100) NOT NULL,
  `date_commande` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordres`
--

INSERT INTO `ordres` (`id`, `id_utilisateur`, `nom`, `némuro`, `email`, `method`, `address`, `total_produit`, `total_prix`, `date_commande`, `payment_status`) VALUES
(14, 1, 'essadikine anass', '0666666666', 'an4ss.essadikine@gmail.com', 'Carte de crédit', 'Numéro appartement . 12, rue 6, ville Casablanca, region casablanca-settat, Maroc - 20190', 'HP 280S8EA (3399 x 1) - ', 3399, '2023-01-10', 'complété'),
(15, 1, 'essadikine anass', '0666666666', 'an4ss.essadikine@gmail.com', 'Carte de crédit', 'Numéro appartement . 12, rue 6, ville Casablanca, region casablanca-settat, Maroc - 20190', 'SAMSUNG ZFOLD4  (16999 x 1) - ', 16999, '2023-01-10', 'complété'),
(16, 1, 'essadikine anass', '0666666666', 'an4ss.essadikine@gmail.com', 'Carte de crédit', 'Numéro appartement . 12, rue 6, ville Casablanca, region casablanca-settat, Maroc - 20190', 'SAMSUNG OLED (15999 x 1) - ', 15999, '2023-01-10', 'en attendant'),
(19, 1, 'essadikine anass', '0666666666', 'an4ss.essadikine@gmail.com', 'Carte de crédit', 'Numéro appartement . 12, rue 6, ville Casablanca, region casablanca-settat, Maroc - 20190', 'HP LAPTOP 15-DW3027NK (7299 x 2) - ', 14598, '2023-01-10', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id` int(100) NOT NULL,
  `id_utilisateur` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` int(10) NOT NULL,
  `quantité` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id`, `id_utilisateur`, `pid`, `nom`, `prix`, `quantité`, `image`) VALUES
(29, 1, 3, 'HP 280S8EA', 3399, 1, 'hp_pc_portable_15-dw1000nk.webp');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `prix` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `details`, `prix`, `image_01`, `image_02`, `image_03`) VALUES
(2, 'HP LAPTOP 15-DW3027NK', '(PROCESSEUR  :   INTEL® COREI5-1135G7)\r\n(FREQUENCE   :  JUSQUÀ 4,2 GHZ)\r\n(TAILLE D&#39;ÉCRAN  :  15,6Š)\r\n(MÉMOIRE VIVE (RAM)  :  8 Géga)\r\n(CAPACITE DISQUE DUR HDD  :  1000 Géga)\r\n(CARTE GRAPHIQUE  :  NVIDIA GEFORCE MX350)\r\n(SYSTÈME D&#39;EXPLOITATION  :  WINDOWS 10)', 7299, '455x8ea_2__1.webp', '455x7ea-pic-2.webp', '455x7ea-pic-3.webp'),
(3, 'HP 280S8EA', '(PROCESSEUR  :   CELERON N4020 DUAL CORE)\r\n(FREQUENCE   :  2.8 GHZ)\r\n(TAILLE D&#39;ÉCRAN  :  15,6Š)\r\n(MÉMOIRE VIVE (RAM)  :  4 Géga)\r\n(CAPACITE DISQUE DUR HDD  :  1000 Géga)\r\n(CARTE GRAPHIQUE  :  INTEL UHD GRAPHICS)\r\n(SYSTÈME D&#39;EXPLOITATION  :  WINDOWS 10)', 3399, 'hp_pc_portable_15-dw1000nk.webp', 'cf755e4d346ac5c47cb331a968ca5dfc.webp', '674a1b09f2476fba63a5adc87be207da.webp'),
(4, 'LENOVO PC CEL N4020', '(PROCESSEUR : CELERON N4020) (FREQUENCE : N4020 ) (TAILLE D&#39;ÉCRAN : 15.6&#34; HD) (MÉMOIRE VIVE (RAM) : 4 Géga) (CAPACITE DISQUE DUR HDD : 1000 Géga) (CARTE GRAPHIQUE :  INTEL UHD GRAPHICS 600) (SYSTÈME D&#39;EXPLOITATION : WINDOWS 10)', 3199, '2945068-_1_.webp', '2945068-_4_.webp', '2945068-_5_.webp'),
(5, 'ASUS E203', '(PROCESSEUR : INTEL CELERON) (FREQUENCE : 2.8 GHZ) (TAILLE D&#39;ÉCRAN : 11.6 HD) (MÉMOIRE VIVE (RAM) : 4 Géga) (CAPACITE DISQUE DUR HDD : 128 Géga)  (SYSTÈME D&#39;EXPLOITATION : WINDOWS 10)', 3599, 'e203---v1-.webp', 'e202-v3-.webp', 'e203---v0-.webp'),
(6, 'HONOR X8', '(MARQUE  :  HONOR)\r\n(TAILLE D&#39;ECRAN  :  6.7&#34;)\r\n(MÉMOIRE RAM  :  6 GO)\r\n(MÉMOIRE DE STOCKAGE  :  128)\r\n(SYSTÈME D&#39;EXPLOITATION  :  ANDROID)\r\n(RESEAU  :  3G / 4G / LTE)\r\n(APPAREIL PHOTO :  64 MP / 5MP / 2MP / 2MP / 16 MP)\r\n(RESOLUTION DE L&#39;ECRAN  :  1080 X 2388 PIXELS)\r\n(TYPE DE BATTERIE  :  \r\n4000)', 2669, '2965600.webp', '2965600_2.webp', '2965600_3.webp'),
(7, 'XIAOMI REDMI NOTE 11 PRO', '(MARQUE : HONOR) (TAILLE D&#39;ECRAN : 6.7&#34;) (MÉMOIRE RAM : 6 GO) (MÉMOIRE DE STOCKAGE : 128) (SYSTÈME D&#39;EXPLOITATION : ANDROID) (RESEAU : 3G / 4G / LTE) (APPAREIL PHOTO : 64 MP / 5MP / 2MP / 2MP / 16 MP) (RESOLUTION DE L&#39;ECRAN : 1080 X 2388 PIXELS) (TYPE DE BATTERIE : 4000)', 3599, '2948758-_2_-.webp', '2948758-_3_.webp', '2948758-_2_.webp'),
(8, 'SAMSUNG ZFOLD4 ', '(MARQUE : HONOR) (TAILLE D&#39;ECRAN : 6.7&#34;) (MÉMOIRE RAM : 6 GO) (MÉMOIRE DE STOCKAGE : 128) (SYSTÈME D&#39;EXPLOITATION : ANDROID) (RESEAU : 3G / 4G / LTE) (APPAREIL PHOTO : 64 MP / 5MP / 2MP / 2MP / 16 MP) (RESOLUTION DE L&#39;ECRAN : 1080 X 2388 PIXELS) (TYPE DE BATTERIE : 4000)', 16999, 'sm-f936_zfold4_openback115_beige_220602.webp', 'sm-f936_zfold4_openback_beige_220602.webp', 'sm-f936_zfold4_openfront_beige_220602.webp'),
(10, 'SAMSUNG A73 BLANC', '(MARQUE : HONOR) (TAILLE D&#39;ECRAN : 6.7&#34;) (MÉMOIRE RAM : 6 GO) (MÉMOIRE DE STOCKAGE : 128) (SYSTÈME D&#39;EXPLOITATION : ANDROID) (RESEAU : 3G / 4G / LTE) (APPAREIL PHOTO : 64 MP / 5MP / 2MP / 2MP / 16 MP) (RESOLUTION DE L&#39;ECRAN : 1080 X 2388 PIXELS) (TYPE DE BATTERIE : 4000)', 5499, '2948342.webp', '2948342_3.webp', '2948342_2.webp'),
(12, 'SAMSUNG ACTIVE2', '(MARQUE  :  SAMSUNG)  (REFERENCE FOURNISSEUR  :  WATCH ACTIVE2 SM-R820NZS 44MM)', 2490, '2490174.webp', '2490174_2.webp', '2490174_3.webp'),
(13, 'HUAWEI GT3 42MM', '(MARQUE  :  HUAWEI)\r\n(REFERENCE FOURNISSEUR \r\n :  WTCH GT3 42MM ACTIVE)', 2399, '2943925-.webp', '2943925-.webp', '2943925-.webp'),
(14, 'HUAWEI WATCH FIT', '(MARQUE  :  HUAWEI)\r\n(REFERENCE FOURNISSEUR \r\n :  WATCH FIT ELEGANT FROSTY WHITE)', 1299, '2840299-2.webp', '2840299.webp', '2840299-3.webp'),
(15, 'YAMAHA CASQUE', '(MARQUE  :  YAMAHA)\r\n(REFERENCE FOURNISSEUR \r\n :  CASQUE BT -YHE500A BLEU) \r\n (TYPE  :  CASQUE BALADEUR SANS FIL)', 1650, '2918437-2.webp', '2918437-1.webp', '2918437-1.webp'),
(16, 'YAMAHA CASQUE ', '(MARQUE  :  YAMAHA)\r\n(REFERENCE FOURNISSEUR \r\n :  CASQUE BT YHE500A BLANC)\r\n(TYPE  :  CASQUE BALADEUR SANS FIL)', 1650, '2918439-2.webp', '2918439-3.webp', '2918439.webp'),
(17, 'SAMSUNG ECOUTEURS', '(MARQUE  :  SAMSUNG)\r\n(REFERENCE FOURNISSEUR \r\n :  ECOUTEURS GALAXY BUDS2 SM-R177NZTAM)\r\n(COMPATIBILITE  :  UNIVERSEL)\r\n(CONNECTIQUE  :  BLUETOOTH V5.2)', 1499, '2954138-1.webp', '2954138-1.webp', '2954138-2.webp'),
(18, 'HUAWEI ECOUTEURS', '(MARQUE  :  HUAWEI)\r\n(REFERENCE FOURNISSEUR \r\n :  ECOUTEURS BT FREEBUDS4 CERAMIC WHT)\r\n(COMPATIBILITE  :  UNIVERSEL)\r\n(CONNECTIQUE  :  BLUETOOTH)', 1599, '2871899-.webp', '2871899-.webp', '2871899-2-.webp'),
(19, 'HAIER LED H65K660UG', '(MARQUE  :  HAIER)\r\n(REFERENCE FOURNISSEUR  : \r\n LED H65K660UG PLUS)\r\n(TAILLE D&#39;ÉCRAN  :  65)\r\n(TYPE D&#39;ECRAN  :  FLAT)\r\n(SMART TV  :  OUI)', 7499, 'haier-smart-plus-_1_-_1__4.webp', 'haier-smart-plus-_1_-_1__4.webp', 'haier-smart-plus-_1_-_1__4.webp'),
(20, 'SAMSUNG OLED', '(MARQUE  :  SAMSUNG)\r\n(REFERENCE FOURNISSEUR  : \r\n OLED QD QE55S95BATXTK 4K)\r\n(TAILLE D&#39;ÉCRAN  :  55)\r\n(TYPE D&#39;ECRAN  :  FLAT)\r\n(SMART TV  :  OUI)', 15999, 'n-africa-oled-s95b-qe55s95batxtk-533702150.webp', 'n-africa-oled-s95b-qe55s95batxtk-533702125.webp', 'n-africa-oled-s95b-qe55s95batxtk-533702127.webp'),
(21, 'HP SOURIS GAMER', 'DATE DE DISPONIBILITÉ\r\n   MARQUE\r\nHP\r\nREFERENCE FOURNISSEUR\r\nSOURIS GAMER 2VP02AA OMEN REACTOR\r\nCOMPATIBLE    PC', 999, '2455870.webp', '2455870_2.webp', '2455870_3.webp'),
(22, 'HP CLAVIER PAVILLON', 'MARQUE\r\nHP\r\nREFERENCE FOURNISSEUR\r\nCLAVIER PAVILLON 3VN40AA\r\nSANS FIL\r\nNON\r\nCONNECTIQUE\r\nUSB 2.0\r\nSYSTÈME D&#39;EXPLOITATION\r\nWINDOWS', 799, '2455868.webp', '2455868_3.webp', '2455868_2.webp'),
(23, 'FUNWAY STAND PC', 'MARQUE\r\nFUNWAY\r\nREFERENCE FOURNISSEUR\r\nSTAND PC ALUM +VENTIL F006 NOIR\r\nTAILLE PC SUPPORTEE\r\nJUSQU&#39;À 17&#34;\r\nVENTILATION\r\nOUI', 249, 'support-ventil.webp', 'support-ventil.webp', 'support-ventil.webp');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(100) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `email`, `mot_de_pass`) VALUES
(1, 'essadikine anas', 'an4ss.essadikine@gmail.com', '9a6b59da46371d86eb75259c956aee4b580c0119');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordres`
--
ALTER TABLE `ordres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `liste`
--
ALTER TABLE `liste`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordres`
--
ALTER TABLE `ordres`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
