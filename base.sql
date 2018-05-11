-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Maio-2018 às 14:58
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruitfarm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_admins`
--

CREATE TABLE `db_admins` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(191) NOT NULL,
  `date_reg` int(11) NOT NULL DEFAULT '0',
  `date_login` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_admins`
--

INSERT INTO `db_admins` (`id`, `user`, `email`, `pass`, `date_reg`, `date_login`, `ip`) VALUES
  (1, 'Admin', 'admin@email.com', '3d109c9f18e20b3f295cc5f236a5ed74', 1367313062, 1525562978, 2130706433);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_bonus_list`
--

CREATE TABLE `db_bonus_list` (
  `id` int(11) NOT NULL,
  `user` varchar(10) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sum` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_conabrul`
--

CREATE TABLE `db_conabrul` (
  `id` int(11) NOT NULL,
  `rules` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacts` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `db_conabrul`
--

INSERT INTO `db_conabrul` (`id`, `rules`, `about`, `contacts`) VALUES
  (1, '&lt;div&gt;FF Script SM - an investment game project that provides services for earning and advertising.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;The player, the user, is the person who uses the services provided.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Account - a record containing information that the user reports about himself when registering and further changing.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;b&gt;GENERAL PROVISIONS&lt;/b&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Changes to the terms of the user agreement may be made without prior warning to users.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;If the user violates the terms of the user agreement, FF Script SM reserves the right to restrict access to certain functions or refuse to maintain the account with the loss of all data.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;b&gt;SECURITY&lt;/b&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;The user is solely responsible for the security (resilience to the selection) of his chosen password, and also independently ensures the confidentiality of his password.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Comply with the terms of the user agreement.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Do not register more than one account.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Provide truthful information about your personal data.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Do not use attempts to deceive FF Script SM and other users.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Do not attempt to crack FF Script SM and other user accounts.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Do not try to disrupt FF Script SM&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Report to the technical support service about any malfunctions or errors found.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Do not publish offensive messages to FF Script SM and other users.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&lt;b&gt;FF Script SM IS OBLIGED&lt;/b&gt;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Comply with the terms of the user agreement.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Do not disclose confidential information to users.&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Timely provide services and technical support to users.&lt;/div&gt;', '&lt;p style=&quot;text-align: left;&quot;&gt;&lt;span style=&quot;color: rgb(41, 43, 44); font-weight: 700; font-size: 1rem; display: inline !important;&quot;&gt;FF Script SM&lt;/span&gt;&lt;span style=&quot;color: rgb(41, 43, 44); font-weight: 700; font-size: 1rem; display: inline !important;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;font color=&quot;#292b2c&quot;&gt;is the best economic game with high payback.&lt;/font&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;font color=&quot;#292b2c&quot;&gt;After registration, you can refill your balance to start the game or play without attachments.&lt;/font&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;font color=&quot;#292b2c&quot;&gt;When replenishing the balance, you will be able to play games to test luck and machines that will generate revenue.&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;text-align: -webkit-center; display: inline !important;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: left;&quot;&gt;&lt;font color=&quot;#292b2c&quot;&gt;After the games, you can easily withdraw the won and earned money from the project.&lt;/font&gt;&lt;/p&gt;', '&lt;p&gt;You can contact us through the mail address &lt;a href=&quot;mailto:contact@sitename.com&quot; title=&quot;&quot; target=&quot;_blank&quot;&gt;contact@sitename.com&lt;/a&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_config`
--

CREATE TABLE `db_config` (
  `id` int(11) NOT NULL,
  `admin` varchar(10) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `min_pay` double NOT NULL DEFAULT '15',
  `ser_per_wmr` int(11) NOT NULL DEFAULT '1000',
  `ser_per_wmz` int(11) NOT NULL DEFAULT '3300',
  `ser_per_wme` int(11) NOT NULL DEFAULT '4200',
  `percent_swap` int(11) NOT NULL DEFAULT '0',
  `percent_sell` int(2) NOT NULL DEFAULT '10',
  `items_per_coin` int(11) NOT NULL DEFAULT '7',
  `a_in_h` int(11) NOT NULL DEFAULT '0',
  `b_in_h` int(11) NOT NULL DEFAULT '0',
  `c_in_h` int(11) NOT NULL DEFAULT '0',
  `d_in_h` int(11) NOT NULL DEFAULT '0',
  `e_in_h` int(11) NOT NULL DEFAULT '0',
  `f_in_h` int(11) NOT NULL DEFAULT '0',
  `amount_a_t` int(11) NOT NULL DEFAULT '0',
  `amount_b_t` int(11) NOT NULL DEFAULT '0',
  `amount_c_t` int(11) NOT NULL DEFAULT '0',
  `amount_d_t` int(11) NOT NULL DEFAULT '0',
  `amount_e_t` int(11) NOT NULL DEFAULT '0',
  `amount_f_t` int(11) NOT NULL DEFAULT '0',
  `default_lang` varchar(5) NOT NULL DEFAULT 'en'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_config`
--

INSERT INTO `db_config` (`id`, `admin`, `pass`, `min_pay`, `ser_per_wmr`, `ser_per_wmz`, `ser_per_wme`, `percent_swap`, `percent_sell`, `items_per_coin`, `a_in_h`, `b_in_h`, `c_in_h`, `d_in_h`, `e_in_h`, `f_in_h`, `amount_a_t`, `amount_b_t`, `amount_c_t`, `amount_d_t`, `amount_e_t`, `amount_f_t`, `default_lang`) VALUES
  (1, 'admin', 'admin', 100, 100, 3300, 4200, 50, 80, 100, 120, 240, 360, 480, 600, 1000, 10, 30, 50, 100, 500, 1000, 'en');

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_insert_money`
--

CREATE TABLE `db_insert_money` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `money` double NOT NULL DEFAULT '0',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_insert_money`
--

INSERT INTO `db_insert_money` (`id`, `user`, `user_id`, `money`, `serebro`, `date_add`, `date_del`) VALUES
  (1, 'knight', 5, 40, 40, 1512255050, 1513551050),
  (11, 'master', 20, 10, 10, 1512973547, 1514269547),
  (3, 'aleksandr', 1, 1, 1, 1512300151, 1513596151),
  (4, 'JAKUB54', 201, 50, 50, 1512377234, 1513673234),
  (5, 'Ratnik', 56, 10, 10, 1512501620, 1513797620),
  (6, 'Sgovor', 348, 1300, 1300, 1512548851, 1513844851),
  (7, 'vladcom201', 469, 10, 10, 1512636577, 1513932577),
  (8, 'aleksandr', 1, 1, 1, 1512646593, 1513942593),
  (9, 'migespa', 506, 15, 15, 1512972889, 1514268889),
  (10, 'aleksandr', 1, 1, 1, 1512973312, 1514269312),
  (12, 'migespa', 506, 10, 10, 1513026819, 1514322819),
  (13, 'Monitor97', 568, 40, 40, 1513282409, 1514578409),
  (14, 'Monitor97', 568, 220, 220, 1513364722, 1514660722),
  (15, 'migespa', 506, 20, 20, 1513470921, 1514766921),
  (16, 'Mustafa', 560, 1, 1, 1513743268, 1515039268),
  (17, 'Mustafa', 560, 6, 6, 1513754951, 1515050951),
  (18, 'montecrist', 424, 5.3, 5, 1525476280, 1516173570);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_news`
--

CREATE TABLE `db_news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `news` text NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_news`
--

INSERT INTO `db_news` (`id`, `title`, `news`, `date_add`) VALUES
  (1, 'Test News 1', '<p style=\"text-align: center;\"><font color=\"#ff0000\"><b>Test News 1</b></font><br></p>', 1510832442),
  (3, 'Test News 3', '<p>Test News 3</p>', 1510900013),
  (4, 'Test News 5', '<p>Test news 5</p>', 1510919121),
  (6, 'Test News 6', '<div style=\"text-align: center;\"><b>Test news 6</b></div>', 1511086117);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_payeer_insert`
--

CREATE TABLE `db_payeer_insert` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `sum` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_payeer_insert`
--

INSERT INTO `db_payeer_insert` (`id`, `user_id`, `user`, `sum`, `date_add`, `status`, `description`) VALUES
  (1, 5, 'knight', 40, 1512255002, 1, ''),
  (2, 1, 'aleksandr', 1, 1512295463, 0, ''),
  (3, 1, 'aleksandr', 0.1, 1512295518, 0, ''),
  (4, 1, 'aleksandr', 1, 1512296782, 0, ''),
  (5, 1, 'aleksandr', 1, 1512296782, 0, ''),
  (6, 1, 'aleksandr', 1, 1512296820, 0, ''),
  (7, 1, 'aleksandr', 1, 1512296820, 0, ''),
  (8, 1, 'aleksandr', 1, 1512297019, 0, ''),
  (9, 1, 'aleksandr', 1, 1512297083, 0, ''),
  (10, 1, 'aleksandr', 1, 1512297100, 0, ''),
  (11, 1, 'aleksandr', 1, 1512297100, 0, ''),
  (12, 1, 'aleksandr', 1, 1512297142, 0, ''),
  (13, 1, 'aleksandr', 1, 1512297158, 0, ''),
  (14, 1, 'aleksandr', 1, 1512297158, 0, ''),
  (15, 1, 'aleksandr', 1, 1512297235, 0, ''),
  (16, 1, 'aleksandr', 1, 1512297449, 0, ''),
  (17, 1, 'aleksandr', 1, 1512297468, 0, ''),
  (18, 1, 'aleksandr', 1, 1512297506, 0, ''),
  (19, 1, 'aleksandr', 1, 1512297540, 0, ''),
  (20, 1, 'aleksandr', 1, 1512299169, 0, ''),
  (21, 1, 'aleksandr', 1, 1512299181, 0, ''),
  (22, 1, 'aleksandr', 0, 1512299332, 0, ''),
  (23, 1, 'aleksandr', 0, 1512299488, 0, ''),
  (24, 1, 'aleksandr', 0, 1512299529, 0, ''),
  (25, 1, 'aleksandr', 0, 1512299588, 0, ''),
  (26, 1, 'aleksandr', 0, 1512299995, 0, ''),
  (27, 1, 'aleksandr', 1, 1512300108, 1, ''),
  (28, 74, 'valera612', 50, 1512305638, 0, ''),
  (29, 201, 'JAKUB54', 50, 1512377128, 0, ''),
  (30, 201, 'JAKUB54', 50, 1512377219, 1, ''),
  (31, 1, 'aleksandr', 1, 1512379783, 0, ''),
  (32, 1, 'aleksandr', 1, 1512384695, 0, ''),
  (33, 1, 'aleksandr', 1, 1512384773, 0, ''),
  (34, 1, 'aleksandr', 1, 1512421307, 0, ''),
  (35, 108, 'Dodg', 3.5, 1512424162, 0, ''),
  (36, 108, 'Dodg', 10, 1512424459, 0, ''),
  (37, 1, 'aleksandr', 10, 1512471058, 0, ''),
  (38, 332, 'Monkey', 0, 1512477572, 0, ''),
  (39, 56, 'Ratnik', 10, 1512501589, 1, ''),
  (40, 1, 'aleksandr', 1, 1512533832, 0, ''),
  (41, 348, 'Sgovor', 1300, 1512548757, 1, ''),
  (42, 1, 'aleksandr', 1, 1512581349, 0, ''),
  (43, 1, 'aleksandr', 1, 1512581370, 0, ''),
  (44, 273, 'akkashop', 1, 1512585097, 0, ''),
  (45, 469, 'vladcom201', 10, 1512636496, 1, ''),
  (46, 1, 'aleksandr', 1, 1512646578, 1, ''),
  (47, 334, 'foad60412', 1, 1512740768, 0, ''),
  (48, 506, 'migespa', 15, 1512972859, 1, ''),
  (49, 1, 'aleksandr', 1, 1512973299, 1, ''),
  (50, 20, 'master', 10, 1512973533, 1, ''),
  (51, 511, 'nicolaich7', 100, 1513022957, 0, ''),
  (52, 506, 'migespa', 10, 1513026750, 1, ''),
  (53, 568, 'Monitor97', 40, 1513282388, 1, ''),
  (54, 568, 'Monitor97', 223, 1513364688, 0, ''),
  (55, 568, 'Monitor97', 220, 1513364705, 1, ''),
  (56, 617, 'Bsuz', 100, 1513375084, 0, ''),
  (57, 617, 'Bsuz', 100, 1513375112, 0, ''),
  (58, 506, 'migespa', 20, 1513470900, 1, ''),
  (59, 663, 'misey', 15, 1513510333, 0, ''),
  (60, 380, 'JD005', 3, 1513557659, 0, ''),
  (61, 455, 'JEnnER', 7000, 1513735223, 0, ''),
  (62, 560, 'Mustafa', 1, 1513743245, 1, ''),
  (63, 560, 'Mustafa', 6, 1513754938, 1, ''),
  (64, 602, 'yelis', 1, 1513979880, 0, ''),
  (65, 602, 'yelis', 0, 1513980053, 0, ''),
  (66, 334, 'foad60412', 10, 1514482218, 0, ''),
  (67, 424, 'montecrist', 5.3, 1514877523, 1, ''),
  (68, 356, 'noom', 5.69, 1515651209, 0, ''),
  (69, 42, 'sereja38', 1, 1515831216, 0, ''),
  (70, 1, 'Admin', 1, 1525983197, 0, 'Payeer'),
  (71, 1, 'Admin', 1, 1525983207, 0, 'Payeer');

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_payment`
--

CREATE TABLE `db_payment` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purse` varchar(20) NOT NULL,
  `sum` double NOT NULL DEFAULT '0',
  `comission` double NOT NULL DEFAULT '0',
  `valuta` varchar(3) NOT NULL DEFAULT 'RUB',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `pay_sys` varchar(100) NOT NULL DEFAULT '0',
  `pay_sys_id` int(11) NOT NULL DEFAULT '0',
  `response` int(1) NOT NULL DEFAULT '0',
  `payment_id` int(11) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_payment`
--

INSERT INTO `db_payment` (`id`, `user`, `user_id`, `purse`, `sum`, `comission`, `valuta`, `serebro`, `status`, `pay_sys`, `pay_sys_id`, `response`, `payment_id`, `date_add`, `date_del`) VALUES
  (1, 'admin', 1, 'P1736392', 0.5, 0, 'RUB', 50, 3, '0', 0, 0, 1448724, 1525476280, 0),
  (2, 'testuser1', 1, 'P1234567', 0.5, 0, 'RUB', 30, 3, '0', 0, 0, 1448724, 1525476280, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_recovery`
--

CREATE TABLE `db_recovery` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `hash` varchar(191) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_regkey`
--

CREATE TABLE `db_regkey` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referer_name` varchar(10) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_sell_items`
--

CREATE TABLE `db_sell_items` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a_s` int(11) NOT NULL DEFAULT '0',
  `b_s` int(11) NOT NULL DEFAULT '0',
  `c_s` int(11) NOT NULL DEFAULT '0',
  `d_s` int(11) NOT NULL DEFAULT '0',
  `e_s` int(11) NOT NULL DEFAULT '0',
  `f_s` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `all_sell` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_sell_items`
--

INSERT INTO `db_sell_items` (`id`, `user`, `user_id`, `a_s`, `b_s`, `c_s`, `d_s`, `e_s`, `f_s`, `amount`, `all_sell`, `date_add`, `date_del`) VALUES
  (2, 'Admin', 1, 143409, 143338, 214971, 286604, 358237, 0, 114655.9, 1146559, 1511084878, 1512380878),
  (3, 'Admin', 1, 8237090, 8232975, 12347405, 16461835, 20913021, 0, 661923.26, 66192326, 1525915381, 1527211381);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_sender`
--

CREATE TABLE `db_sender` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mess` text NOT NULL,
  `page` int(5) NOT NULL DEFAULT '0',
  `sended` int(7) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_sender`
--

INSERT INTO `db_sender` (`id`, `name`, `mess`, `page`, `sended`, `status`, `date_add`) VALUES
  (1, 'Тестовая рассылка', 'Привет, {!USER!}!\r\nЭто тестовая рассылка', 0, 0, 0, 1510834066);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_stats`
--

CREATE TABLE `db_stats` (
  `id` int(11) NOT NULL,
  `all_users` int(11) NOT NULL DEFAULT '0',
  `all_payments` double NOT NULL DEFAULT '0',
  `all_insert` double NOT NULL DEFAULT '0',
  `donations` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_stats`
--

INSERT INTO `db_stats` (`id`, `all_users`, `all_payments`, `all_insert`, `donations`) VALUES
  (1, 9, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_stats_btree`
--

CREATE TABLE `db_stats_btree` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(10) NOT NULL,
  `tree_name` varchar(10) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_stats_btree`
--

INSERT INTO `db_stats_btree` (`id`, `user_id`, `user`, `tree_name`, `amount`, `date_add`, `date_del`) VALUES
  (1, 1, 'Admin', 'Level 1', 1001, 1510826203, 1512122203),
  (2, 1, 'Admin', 'Level 1', 1001, 1510826278, 1512122278),
  (3, 1, 'Admin', 'Level 2', 2001, 1510826290, 1512122290),
  (4, 1, 'Admin', 'Level 5', 5001, 1510826294, 1512122294),
  (5, 1, 'Admin', 'Level 4', 4001, 1510826298, 1512122298),
  (6, 1, 'Admin', 'Level 3', 3001, 1510826300, 1512122300),
  (7, 1, 'Admin', 'Level 5', 500, 1525654415, 1526950415);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_swap_ser`
--

CREATE TABLE `db_swap_ser` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `amount_b` double NOT NULL DEFAULT '0',
  `amount_p` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_swap_ser`
--

INSERT INTO `db_swap_ser` (`id`, `user_id`, `user`, `amount_b`, `amount_p`, `date_add`, `date_del`) VALUES
  (3, 1, 'Admin', 1500, 1000, 1510898628, 1512194628);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_users_a`
--

CREATE TABLE `db_users_a` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(191) NOT NULL,
  `referer` varchar(10) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referals` int(11) NOT NULL DEFAULT '0',
  `date_reg` int(11) NOT NULL DEFAULT '0',
  `date_login` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_users_a`
--

INSERT INTO `db_users_a` (`id`, `user`, `email`, `pass`, `referer`, `referer_id`, `referals`, `date_reg`, `date_login`, `ip`, `banned`) VALUES
  (1, 'Admin', 'rubens.dragonforce@gmail.com', '3d109c9f18e20b3f295cc5f236a5ed74', 'Admin', 1, 6, 1367313062, 1525652371, 2130706433, 0),
  (2, 'aleksey', 'testuser1@email.com', '3d109c9f18e20b3f295cc5f236a5ed74', 'Admin', 1, 0, 1440868538, 1440868651, 1832711990, 0),
  (3, 'baxedik', 'testuser2@email.com', '3d109c9f18e20b3f295cc5f236a5ed74', 'Admin', 1, 0, 1510901125, 1510904750, 1509523661, 0),
  (4, 'lexa2015', 'testuser3@email.com', '3d109c9f18e20b3f295cc5f236a5ed74', 'Admin', 1, 0, 1510901171, 0, 1509523661, 0),
  (7, 'pligin', 'testuser4@email.com', '3d109c9f18e20b3f295cc5f236a5ed74', 'Admin', 1, 0, 1510915285, 0, 2956760126, 0),
  (8, 'lexa', 'testuser5@email.com', '3d109c9f18e20b3f295cc5f236a5ed74', 'Admin', 1, 0, 1510919054, 0, 1509523661, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `db_users_b`
--

CREATE TABLE `db_users_b` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `money_b` double NOT NULL DEFAULT '0',
  `money_p` double NOT NULL DEFAULT '0',
  `a_t` int(11) NOT NULL DEFAULT '0',
  `b_t` int(11) NOT NULL DEFAULT '0',
  `c_t` int(11) NOT NULL DEFAULT '0',
  `d_t` int(11) NOT NULL DEFAULT '0',
  `e_t` int(11) NOT NULL DEFAULT '0',
  `f_t` int(11) DEFAULT '0',
  `a_b` int(11) NOT NULL DEFAULT '0',
  `b_b` int(11) NOT NULL DEFAULT '0',
  `c_b` int(11) NOT NULL DEFAULT '0',
  `d_b` int(11) NOT NULL DEFAULT '0',
  `e_b` int(11) NOT NULL DEFAULT '0',
  `f_b` int(11) NOT NULL DEFAULT '0',
  `all_time_a` int(11) NOT NULL DEFAULT '0',
  `all_time_b` int(11) NOT NULL DEFAULT '0',
  `all_time_c` int(11) NOT NULL DEFAULT '0',
  `all_time_d` int(11) NOT NULL DEFAULT '0',
  `all_time_e` int(11) NOT NULL DEFAULT '0',
  `all_time_f` int(11) NOT NULL DEFAULT '0',
  `last_sbor` int(11) NOT NULL DEFAULT '0',
  `from_referals` double NOT NULL DEFAULT '0',
  `to_referer` double NOT NULL DEFAULT '0',
  `payment_sum` double NOT NULL DEFAULT '0',
  `insert_sum` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `db_users_b`
--

INSERT INTO `db_users_b` (`id`, `user`, `money_b`, `money_p`, `a_t`, `b_t`, `c_t`, `d_t`, `e_t`, `f_t`, `a_b`, `b_b`, `c_b`, `d_b`, `e_b`, `f_b`, `all_time_a`, `all_time_b`, `all_time_c`, `all_time_d`, `all_time_e`, `all_time_f`, `last_sbor`, `from_referals`, `to_referer`, `payment_sum`, `insert_sum`, `kredit`) VALUES
  (1, 'Admin', 1177705.902, 2085827.858, 2, 1, 1, 1, 2, 0, 0, 0, 0, 0, 0, 0, 8380940, 8376754, 12563037, 16749320, 21272360, 0, 1525896824, 0, 0, 0.5, 1.1, 0),
  (2, 'aleksey', 2000, 1000, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1440868538, 0, 0, 0, 0, 0),
  (3, 'baxedik', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510901125, 0, 0, 0, 0, 0),
  (4, 'lexa2015', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510901171, 0, 0, 0, 0, 0),
  (8, 'lexa', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510919054, 0, 0, 0, 0, 0),
  (7, 'pligin', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510915285, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_admins`
--
ALTER TABLE `db_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `db_bonus_list`
--
ALTER TABLE `db_bonus_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_conabrul`
--
ALTER TABLE `db_conabrul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_config`
--
ALTER TABLE `db_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_insert_money`
--
ALTER TABLE `db_insert_money`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_news`
--
ALTER TABLE `db_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_payeer_insert`
--
ALTER TABLE `db_payeer_insert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_payment`
--
ALTER TABLE `db_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_recovery`
--
ALTER TABLE `db_recovery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `db_regkey`
--
ALTER TABLE `db_regkey`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `db_sell_items`
--
ALTER TABLE `db_sell_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_sender`
--
ALTER TABLE `db_sender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_stats`
--
ALTER TABLE `db_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_stats_btree`
--
ALTER TABLE `db_stats_btree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_swap_ser`
--
ALTER TABLE `db_swap_ser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `db_users_a`
--
ALTER TABLE `db_users_a`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `db_users_b`
--
ALTER TABLE `db_users_b`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_admins`
--
ALTER TABLE `db_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `db_bonus_list`
--
ALTER TABLE `db_bonus_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `db_conabrul`
--
ALTER TABLE `db_conabrul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_config`
--
ALTER TABLE `db_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_insert_money`
--
ALTER TABLE `db_insert_money`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `db_news`
--
ALTER TABLE `db_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `db_payeer_insert`
--
ALTER TABLE `db_payeer_insert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `db_payment`
--
ALTER TABLE `db_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `db_recovery`
--
ALTER TABLE `db_recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `db_regkey`
--
ALTER TABLE `db_regkey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `db_sell_items`
--
ALTER TABLE `db_sell_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_sender`
--
ALTER TABLE `db_sender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_stats`
--
ALTER TABLE `db_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `db_stats_btree`
--
ALTER TABLE `db_stats_btree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `db_swap_ser`
--
ALTER TABLE `db_swap_ser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `db_users_a`
--
ALTER TABLE `db_users_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
