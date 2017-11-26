-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 19 2017 г., 13:15
-- Версия сервера: 5.5.57
-- Версия PHP: 5.4.45-0+deb7u11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `psweb_ff`
--

-- --------------------------------------------------------

--
-- Структура таблицы `db_bonus_list`
--

CREATE TABLE IF NOT EXISTS `db_bonus_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sum` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `db_conabrul`
--

CREATE TABLE IF NOT EXISTS `db_conabrul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rules` text NOT NULL,
  `about` text NOT NULL,
  `contacts` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `db_conabrul`
--

INSERT INTO `db_conabrul` (`id`, `rules`, `about`, `contacts`) VALUES
(1, '<p>Правила проекта</p>', '<p>О проекте</p>', '<p>Контактные данные</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `db_config`
--

CREATE TABLE IF NOT EXISTS `db_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `amount_a_t` int(11) NOT NULL DEFAULT '0',
  `amount_b_t` int(11) NOT NULL DEFAULT '0',
  `amount_c_t` int(11) NOT NULL DEFAULT '0',
  `amount_d_t` int(11) NOT NULL DEFAULT '0',
  `amount_e_t` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `db_config`
--

INSERT INTO `db_config` (`id`, `admin`, `pass`, `min_pay`, `ser_per_wmr`, `ser_per_wmz`, `ser_per_wme`, `percent_swap`, `percent_sell`, `items_per_coin`, `a_in_h`, `b_in_h`, `c_in_h`, `d_in_h`, `e_in_h`, `amount_a_t`, `amount_b_t`, `amount_c_t`, `amount_d_t`, `amount_e_t`) VALUES
(1, 'admin', 'admin', 100, 100, 3300, 4200, 50, 50, 10, 1001, 2001, 3001, 4001, 5001, 1001, 2001, 3001, 4001, 5001);

-- --------------------------------------------------------

--
-- Структура таблицы `db_insert_money`
--

CREATE TABLE IF NOT EXISTS `db_insert_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `money` double NOT NULL DEFAULT '0',
  `serebro` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `db_lottery`
--

CREATE TABLE IF NOT EXISTS `db_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(10) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `db_lottery_winners`
--

CREATE TABLE IF NOT EXISTS `db_lottery_winners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_a` varchar(10) NOT NULL,
  `bil_a` int(11) NOT NULL DEFAULT '0',
  `user_b` varchar(10) NOT NULL,
  `bil_b` int(11) NOT NULL DEFAULT '0',
  `user_c` varchar(10) NOT NULL,
  `bil_c` int(11) NOT NULL DEFAULT '0',
  `bank` float NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `db_news`
--

CREATE TABLE IF NOT EXISTS `db_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `news` text NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `db_news`
--

INSERT INTO `db_news` (`id`, `title`, `news`, `date_add`) VALUES
(1, 'Тестовая новость', '<p style="text-align: center;"><span style="color: #ff0000; font-family: &quot;arial black&quot;, &quot;avant garde&quot;; font-size: medium;"><strong>Это тестовая новость</strong></span></p>', 1510832442),
(3, 'проба', '<p>проба</p>', 1510900013),
(4, 'проба1', '<p>проба1</p>', 1510919121),
(6, 'тест ', '<div style="text-align: center;"><b>тестовая</b></div>', 1511086117);

-- --------------------------------------------------------

--
-- Структура таблицы `db_payeer_insert`
--

CREATE TABLE IF NOT EXISTS `db_payeer_insert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `sum` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `db_payment`
--

CREATE TABLE IF NOT EXISTS `db_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `db_recovery`
--

CREATE TABLE IF NOT EXISTS `db_recovery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `db_recovery`
--

INSERT INTO `db_recovery` (`id`, `email`, `ip`, `date_add`, `date_del`) VALUES
(3, 'bax.edik@yandex.ru', 1509523661, 1510918999, 1510919899);

-- --------------------------------------------------------

--
-- Структура таблицы `db_regkey`
--

CREATE TABLE IF NOT EXISTS `db_regkey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referer_name` varchar(10) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `db_sell_items`
--

CREATE TABLE IF NOT EXISTS `db_sell_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a_s` int(11) NOT NULL DEFAULT '0',
  `b_s` int(11) NOT NULL DEFAULT '0',
  `c_s` int(11) NOT NULL DEFAULT '0',
  `d_s` int(11) NOT NULL DEFAULT '0',
  `e_s` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `all_sell` int(11) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `db_sell_items`
--

INSERT INTO `db_sell_items` (`id`, `user`, `user_id`, `a_s`, `b_s`, `c_s`, `d_s`, `e_s`, `amount`, `all_sell`, `date_add`, `date_del`) VALUES
(2, 'Admin', 1, 143409, 143338, 214971, 286604, 358237, 114655.9, 1146559, 1511084878, 1512380878);

-- --------------------------------------------------------

--
-- Структура таблицы `db_sender`
--

CREATE TABLE IF NOT EXISTS `db_sender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mess` text NOT NULL,
  `page` int(5) NOT NULL DEFAULT '0',
  `sended` int(7) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `db_sender`
--

INSERT INTO `db_sender` (`id`, `name`, `mess`, `page`, `sended`, `status`, `date_add`) VALUES
(1, 'Тестовая рассылка', 'Привет, {!USER!}!\r\nЭто тестовая рассылка', 0, 0, 0, 1510834066);

-- --------------------------------------------------------

--
-- Структура таблицы `db_stats`
--

CREATE TABLE IF NOT EXISTS `db_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `all_users` int(11) NOT NULL DEFAULT '0',
  `all_payments` double NOT NULL DEFAULT '0',
  `all_insert` double NOT NULL DEFAULT '0',
  `donations` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `db_stats`
--

INSERT INTO `db_stats` (`id`, `all_users`, `all_payments`, `all_insert`, `donations`) VALUES
(1, 8, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_stats_btree`
--

CREATE TABLE IF NOT EXISTS `db_stats_btree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(10) NOT NULL,
  `tree_name` varchar(10) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `db_stats_btree`
--

INSERT INTO `db_stats_btree` (`id`, `user_id`, `user`, `tree_name`, `amount`, `date_add`, `date_del`) VALUES
(1, 1, 'Admin', 'Лайм', 1001, 1510826203, 1512122203),
(2, 1, 'Admin', 'Лайм', 1001, 1510826278, 1512122278),
(3, 1, 'Admin', 'Вишня', 2001, 1510826290, 1512122290),
(4, 1, 'Admin', 'Апельсин', 5001, 1510826294, 1512122294),
(5, 1, 'Admin', 'Киви', 4001, 1510826298, 1512122298),
(6, 1, 'Admin', 'Клубника', 3001, 1510826300, 1512122300);

-- --------------------------------------------------------

--
-- Структура таблицы `db_swap_ser`
--

CREATE TABLE IF NOT EXISTS `db_swap_ser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `amount_b` double NOT NULL DEFAULT '0',
  `amount_p` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `db_swap_ser`
--

INSERT INTO `db_swap_ser` (`id`, `user_id`, `user`, `amount_b`, `amount_p`, `date_add`, `date_del`) VALUES
(3, 1, 'Admin', 1500, 1000, 1510898628, 1512194628);

-- --------------------------------------------------------

--
-- Структура таблицы `db_users_a`
--

CREATE TABLE IF NOT EXISTS `db_users_a` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `referer` varchar(10) NOT NULL,
  `referer_id` int(11) NOT NULL DEFAULT '0',
  `referals` int(11) NOT NULL DEFAULT '0',
  `date_reg` int(11) NOT NULL DEFAULT '0',
  `date_login` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `db_users_a`
--

INSERT INTO `db_users_a` (`id`, `user`, `email`, `pass`, `referer`, `referer_id`, `referals`, `date_reg`, `date_login`, `ip`, `banned`) VALUES
(1, 'Admin', 'admin@admin.ru', 'admin', 'Admin', 1, 6, 1367313062, 1511084291, 1509523661, 0),
(2, 'aleksey', 'leha.vodanov@mail.ru', 'aleksey', 'Admin', 1, 0, 1440868538, 1440868651, 1832711990, 0),
(3, 'baxedik', 'bax.edik@yandex.ru', '000000', 'Admin', 1, 0, 1510901125, 1510904750, 1509523661, 0),
(4, 'lexa2015', 'bax@yandex.ru', '000000', 'Admin', 1, 0, 1510901171, 0, 1509523661, 0),
(7, 'pligin', 'pligin103@gmail.com', 'a12344321', 'Admin', 1, 0, 1510915285, 0, 2956760126, 0),
(8, 'lexa', 'edik@yandex.ru', '000000', 'Admin', 1, 0, 1510919054, 0, 1509523661, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `db_users_b`
--

CREATE TABLE IF NOT EXISTS `db_users_b` (
  `id` int(11) NOT NULL,
  `user` varchar(10) NOT NULL,
  `money_b` double NOT NULL DEFAULT '0',
  `money_p` double NOT NULL DEFAULT '0',
  `a_t` int(11) NOT NULL DEFAULT '0',
  `b_t` int(11) NOT NULL DEFAULT '0',
  `c_t` int(11) NOT NULL DEFAULT '0',
  `d_t` int(11) NOT NULL DEFAULT '0',
  `e_t` int(11) NOT NULL DEFAULT '0',
  `a_b` int(11) NOT NULL DEFAULT '0',
  `b_b` int(11) NOT NULL DEFAULT '0',
  `c_b` int(11) NOT NULL DEFAULT '0',
  `d_b` int(11) NOT NULL DEFAULT '0',
  `e_b` int(11) NOT NULL DEFAULT '0',
  `all_time_a` int(11) NOT NULL DEFAULT '0',
  `all_time_b` int(11) NOT NULL DEFAULT '0',
  `all_time_c` int(11) NOT NULL DEFAULT '0',
  `all_time_d` int(11) NOT NULL DEFAULT '0',
  `all_time_e` int(11) NOT NULL DEFAULT '0',
  `last_sbor` int(11) NOT NULL DEFAULT '0',
  `from_referals` double NOT NULL DEFAULT '0',
  `to_referer` double NOT NULL DEFAULT '0',
  `payment_sum` double NOT NULL DEFAULT '0',
  `insert_sum` double NOT NULL DEFAULT '0',
  `kredit` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `db_users_b`
--

INSERT INTO `db_users_b` (`id`, `user`, `money_b`, `money_p`, `a_t`, `b_t`, `c_t`, `d_t`, `e_t`, `a_b`, `b_b`, `c_b`, `d_b`, `e_b`, `all_time_a`, `all_time_b`, `all_time_c`, `all_time_d`, `all_time_e`, `last_sbor`, `from_referals`, `to_referer`, `payment_sum`, `insert_sum`, `kredit`) VALUES
(1, 'Admin', 1045736.25, 1556289.25, 2, 1, 1, 1, 1, 0, 0, 0, 0, 0, 143850, 143779, 215632, 287485, 359339, 1511084875, 0, 0, 0, 0, 0),
(2, 'aleksey', 2000, 1000, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1440868538, 0, 0, 0, 0, 0),
(3, 'baxedik', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510901125, 0, 0, 0, 0, 0),
(4, 'lexa2015', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510901171, 0, 0, 0, 0, 0),
(8, 'lexa', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510919054, 0, 0, 0, 0, 0),
(7, 'pligin', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1510915285, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
