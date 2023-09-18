SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Struktura tabulky `pos_entity`
--

DROP TABLE IF EXISTS `pos_entity`;
CREATE TABLE IF NOT EXISTS `pos_entity` (
  `pos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Pos ID',
  `name` varchar(255) NOT NULL DEFAULT '''''' COMMENT 'Name',
  `address` varchar(255) NOT NULL DEFAULT '''''' COMMENT 'Address',
  `is_available` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Availbility',
  PRIMARY KEY (`pos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='POS Table';

--
-- Vypisuji data pro tabulku `pos_entity`
--

INSERT INTO `pos_entity` (`pos_id`, `name`, `address`, `is_available`) VALUES
(1, 'In Sodales Elit Institution', '8327 Cursuserr Rd.', 1),
(2, 'Ipsum Curabitur Consequat PC', '739-7880 Elementum Rd.', 1),
(3, 'Et Commodo Institute', '248 Aliquam Ave', 0),
(4, 'Ipsum Dolor Sit Consulting', '221-3275 Lectus Rd.', 0),
(5, 'Fermentum Risus At Company', '9109 Sed Rd.', 1),
(6, 'Pretium Et Rutrum Ltd', '283-5504 Et, Ave', 0),
(7, 'Augue Porttitor Industries', 'Ap #142-4143 Vivamus Av.', 1),
(8, 'Cursus PC', '2108 Praesent St.', 0),
(9, 'Tellus Inc.', 'P.O. Box 785, 3935 Enim, Street', 0),
(10, 'Nunc Associates', '3988 Tellus Street', 0),
(11, 'Arcu Nunc Mauris PC', 'P.O. Box 745, 8541 Risus. Rd.', 1),
(12, 'Integer Tincidunt LLC', '621-9133 Pellentesque St.', 0),
(13, 'Penatibus Industries', '9236 Enim. Avenue', 0),
(14, 'Sit Amet Ante Associates', 'Ap #738-4457 Phasellus Rd.', 0),
(15, 'Pulvinar Arcu Consulting', '5203 Magna Street', 1),
(16, 'Imperdiet Consulting', 'P.O. Box 801, 6936 Turpis Avenue', 0),
(17, 'In Industries', '7104 Sociosqu Ave', 1),
(18, 'Odio Etiam Ligula Corporation', '2259 Tempus, Street', 1),
(19, 'Blandit At Limited', 'P.O. Box 446, 8283 Commodo Road', 0),
(20, 'In Industries', 'Ap #660-8222 Erat. Rd.', 0),
(21, 'Porttitor Scelerisque Company', 'P.O. Box 488, 8327 Lorem. Avenue', 1),
(22, 'Elit Pede Malesuada Corporation', '582-718 Euismod Av.', 0),
(23, 'Vitae Velit Corporation', '926-3041 Vestibulum Rd.', 0),
(24, 'Sit Amet Limited', 'P.O. Box 845, 5554 Sem Rd.', 1),
(25, 'Turpis Vitae Foundation', '4371 Pede, St.', 0),
(26, 'Magna Sed Eu LLC', '5485 Donec Rd.', 0),
(27, 'Montes Nascetur Ridiculus Corporation', '2922 Nec St.', 1),
(28, 'Magna PC', 'Ap #476-7961 Facilisis Rd.', 0),
(29, 'Maecenas Mi PC', 'P.O. Box 279, 5902 Lectus. St.', 0),
(30, 'Ipsum Incorporated', 'Ap #236-4475 Quam Ave', 1),
(31, 'Laoreet Ipsum Corporation', 'P.O. Box 737, 8912 Faucibus Street', 0),
(32, 'Consequat Institute', '381-3368 Metus. St.', 1),
(33, 'Dui Nec Associates', '658-5811 Cras St.', 0),
(34, 'Cursus LLP', 'P.O. Box 673, 8823 Lacus. Ave', 0),
(35, 'At Sem Corp.', '9710 Fusce Rd.', 1),
(36, 'Amet Consectetuer Foundation', '4630 Donec St.', 0),
(37, 'Eu Company', 'P.O. Box 409, 3077 Convallis Avenue', 0),
(38, 'Pellentesque Habitant Inc.', '8148 Dictum Avenue', 0),
(39, 'Ut LLP', '9354 Augue, Avenue', 1),
(40, 'In Tincidunt Congue PC', 'Ap #250-8369 Parturient Ave', 0),
(41, 'Erat Volutpat Associates', 'Ap #842-390 Curabitur Street', 0),
(42, 'Nunc Id PC', '569 Tempor Road', 1),
(43, 'Lorem Ut Aliquam Institute', '7393 Id Ave', 1),
(44, 'Mauris Blandit Mattis PC', 'P.O. Box 595, 2927 Ut Road', 1),
(45, 'Ipsum Primis In Corporation', '454-793 Id Rd.', 0),
(46, 'Cras Limited', '512-943 Suspendisse Av.', 0),
(47, 'Mi Aliquam Gravida Institute', 'P.O. Box 294, 5365 Velit. Street', 1),
(48, 'Justo Industries', 'P.O. Box 234, 7025 Curabitur St.', 1),
(49, 'Hendrerit Consectetuer LLC', '101-7765 Natoque Road', 1),
(50, 'Sapien Nunc PC', 'Ap #140-887 Suspendisse St.', 0),
(51, 'Mauris Associates', '970-3396 Erat Street', 1),
(52, 'Posuere At Institute', 'Ap #909-322 Donec Avenue', 1),
(53, 'Et Lacinia LLP', '526-8797 Sapien. St.', 0),
(54, 'Neque Morbi Company', 'P.O. Box 231, 9861 Sit Ave', 1),
(55, 'Mauris Eu Elit Consulting', '352-6499 Mauris St.', 1),
(56, 'Ut Corp.', '152-1852 Urna St.', 0),
(57, 'Purus Maecenas LLP', '807-2802 Bibendum. Street', 0),
(58, 'Donec Incorporated', '620-1015 Eget, Avenue', 0),
(59, 'Odio Consulting', '801-4780 Lectus St.', 0),
(60, 'Sociis Natoque Foundation', '4667 Pede. Rd.', 0),
(61, 'Felis LLP', '915-9203 Dui. Street', 0),
(62, 'Sagittis Semper Nam Corporation', 'P.O. Box 232, 2276 Sem St.', 0),
(63, 'Et Netus Corporation', 'P.O. Box 659, 6717 Vitae Rd.', 1),
(64, 'Tellus Corp.', 'P.O. Box 551, 5408 Odio. Rd.', 0),
(65, 'Ultricies Ornare Elit Corporation', 'P.O. Box 409, 2751 Lacinia Road', 0),
(66, 'Diam Pellentesque Incorporated', 'Ap #414-8028 Ornare Street', 0),
(67, 'Mollis Integer Limited', 'P.O. Box 459, 9429 Nec, Av.', 1),
(68, 'Velit In Aliquet Foundation', '124-5281 Phasellus St.', 1),
(69, 'Nisl Maecenas Associates', '2053 Vulputate Street', 1),
(70, 'In LLC', 'Ap #756-387 Magna Rd.', 1),
(71, 'Sem Semper Inc.', 'Ap #530-4690 Nunc Rd.', 0),
(72, 'Mollis Integer Foundation', 'Ap #232-5805 Feugiat. Rd.', 0),
(73, 'Vulputate Limited', 'Ap #107-4291 Nisi. Av.', 0),
(74, 'Euismod Enim Etiam Institute', 'P.O. Box 124, 5207 Tempus Street', 0),
(75, 'Fermentum Metus Aenean Company', '506-739 Vel Rd.', 1),
(76, 'Sed Malesuada Corp.', '895-6574 Mauris Avenue', 0),
(77, 'Tristique Incorporated', '929-9322 Consequat Avenue', 0),
(78, 'Adipiscing Lacus Ut Associates', 'Ap #144-9801 Magna Avenue', 0),
(79, 'Tempor Diam Dictum Ltd', '560-4751 Integer Rd.', 0),
(80, 'Mattis LLC', 'Ap #924-7807 Dapibus Road', 1),
(81, 'A Limited', '404-3370 Arcu. Road', 1),
(82, 'Sed Incorporated', 'Ap #444-5310 Nunc Av.', 1),
(83, 'Eu LLC', 'Ap #445-3137 Dui. Av.', 1),
(84, 'Eu Ligula Aenean Industries', '9154 Dignissim Av.', 0),
(85, 'Mauris A Nunc Inc.', '8569 Semper. Av.', 1),
(86, 'Posuere Associates', '764-7216 Sed St.', 0),
(87, 'Lacinia Limited', '5598 Dis Rd.', 1),
(88, 'Nullam Associates', 'P.O. Box 726, 5290 Placerat Avenue', 0),
(89, 'Ac Mattis LLP', '209-3375 Auctor St.', 1),
(90, 'Mauris Magna Incorporated', 'P.O. Box 466, 4177 Odio. Rd.', 1),
(91, 'Vitae Mauris Sit Associates', '292-6927 Lorem St.', 1),
(92, 'Quis Arcu Vel Limited', 'P.O. Box 292, 9780 At, St.', 0),
(93, 'Ac Tellus Suspendisse LLP', '557-4158 Litora Av.', 0),
(94, 'Vel Mauris Integer LLP', '789-1388 In Av.', 1),
(95, 'Arcu Industries', 'Ap #126-6973 Ac St.', 1),
(96, 'Morbi Quis Urna Incorporated', 'Ap #995-7732 Nunc Road', 1),
(97, 'Gravida Inc.', '914-8997 Risus. Rd.', 0),
(98, 'Mauris Vestibulum Neque LLP', '4492 At St.', 1),
(99, 'A Corp.', 'Ap #158-1211 A St.', 1),
(100, 'Egestas Fusce Aliquet Inc.', '638-4747 Habitant St.', 1),
(101, 'In Sodales Elite Institute', '8327 Cursuss Rd.', 1),
(102, 'Alexej Mrštík', 'Bellušova 1816/31', 1),
(104, 'Testing Name', 'Testing Addres', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
