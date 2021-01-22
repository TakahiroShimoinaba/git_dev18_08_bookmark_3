-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `bookmark_kadai`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `bookname` varchar(64) NOT NULL,
  `url` text NOT NULL,
  `comment` text NOT NULL,
  `indate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `bookname`, `url`, `comment`, `indate`, `updated`) VALUES
(2, '  book1234', '  https://www.2222.com', 'comment1', '2021-01-22 10:13:07', '2021-01-22 10:13:07'),
(3, ' book2test２', ' https://www3.com', 'comment3', '2021-01-07 14:11:55', '2021-01-22 10:29:51'),
(4, 'book2test', 'https://www.4444.com', 'comment4', '2021-01-07 14:11:55', '2021-01-22 09:29:31'),
(5, 'あまぞんについて１', 'https://www555555.com', 'アマゾンについての話その１', '2021-01-07 15:06:35', '2021-01-22 09:29:31'),
(8, ' 書籍名書籍名書籍名書籍名', ' https://bookmarks', '１２３４５６７８９', '2021-01-15 14:20:30', '2021-01-22 09:29:31'),
(9, '更新などなど', '  wwwwww', '更新と登録', '2021-01-22 10:22:32', '2021-01-22 10:30:25'),
(10, '  更新登録 更新登録 更新登録', '  ええげげあｒ', 'ｓｄせげあげあげあ\r\n', '2021-01-22 10:24:31', '2021-01-22 10:26:06');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
