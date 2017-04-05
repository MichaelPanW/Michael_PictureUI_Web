-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-04-05 20:27:11
-- 伺服器版本: 10.1.19-MariaDB
-- PHP 版本： 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `picture_control`
--

-- --------------------------------------------------------

--
-- 資料表結構 `config`
--

CREATE TABLE `config` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `programe_name` varchar(100) NOT NULL COMMENT '程式名稱',
  `company_name` varchar(200) NOT NULL COMMENT '公司名稱',
  `best_explorer` varchar(200) NOT NULL COMMENT '目前最適瀏覽器',
  `company_logo` varchar(200) NOT NULL COMMENT '公司LOGO',
  `logo_alt` varchar(200) NOT NULL COMMENT '公司logo說明',
  `logo_url` varchar(200) NOT NULL COMMENT '公司logo連結',
  `company_pic` varchar(200) NOT NULL COMMENT '公司型圖',
  `pic_alt` varchar(200) NOT NULL COMMENT 'pic說明',
  `pic_url` varchar(200) NOT NULL COMMENT 'pic連結',
  `photonic_logo` varchar(200) NOT NULL COMMENT 'photonic LOGO',
  `photonic_alt` varchar(200) NOT NULL COMMENT 'photoniclogo說明',
  `photonic_url` varchar(200) NOT NULL COMMENT 'photoniclogo連結',
  `photonic_link` text NOT NULL COMMENT '傳訊光網站連結',
  `contact_name` varchar(50) NOT NULL COMMENT '联系人',
  `telephone` varchar(50) NOT NULL COMMENT '电话',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `fax` varchar(50) NOT NULL COMMENT '传真',
  `mobile_telephone` varchar(50) NOT NULL COMMENT '手机',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `icp` varchar(20) NOT NULL COMMENT 'icp',
  `qq` varchar(50) NOT NULL COMMENT 'qq',
  `msn` varchar(100) NOT NULL COMMENT 'msn',
  `im` varchar(250) NOT NULL COMMENT '即时通讯工具',
  `web_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '网站状态',
  `status_description` text NOT NULL COMMENT '停止描述',
  `header_content` text NOT NULL COMMENT '头部内容',
  `footer_content` text NOT NULL COMMENT '脚部内容',
  `download_suffix` varchar(255) NOT NULL DEFAULT 'Winndows' COMMENT '下载类型',
  `global_thumb_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '缩略图开关',
  `global_attach_size` int(10) UNSIGNED NOT NULL DEFAULT '2048000' COMMENT '附件大小',
  `global_attach_suffix` varchar(200) NOT NULL COMMENT '允许附件类型',
  `product_thumb_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '产品缩略图开关',
  `product_thumb_size` varchar(50) NOT NULL COMMENT '产品缩略图高',
  `download_thumb_status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '下载缩略图开关',
  `download_thumb_size` varchar(50) NOT NULL COMMENT '下载缩略图高',
  `global_thumb_size` varchar(50) NOT NULL COMMENT '全局缩略图 尺寸',
  `seo_title` varchar(200) NOT NULL,
  `seo_keyword` varchar(240) NOT NULL,
  `seo_description` varchar(240) NOT NULL,
  `verify` tinyint(1) NOT NULL,
  `hascontact` tinyint(1) NOT NULL DEFAULT '0',
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `hasad` tinyint(1) NOT NULL DEFAULT '0',
  `hasnews` tinyint(1) NOT NULL DEFAULT '0',
  `newstitlelen` int(10) NOT NULL DEFAULT '0',
  `hasmarquee` tinyint(1) NOT NULL DEFAULT '0',
  `marqueecontent` text NOT NULL,
  `hasdownload` tinyint(1) NOT NULL DEFAULT '0',
  `downloadsize` int(10) NOT NULL DEFAULT '2048000',
  `haslink` tinyint(1) NOT NULL DEFAULT '0',
  `hasguestbook` tinyint(1) NOT NULL DEFAULT '0',
  `guestbooktitle` varchar(200) NOT NULL DEFAULT '問答區',
  `hasproject` tinyint(1) NOT NULL DEFAULT '0',
  `hasmobimg` tinyint(1) NOT NULL DEFAULT '0',
  `hasad2` tinyint(1) NOT NULL DEFAULT '0',
  `hasmarquee2` tinyint(4) NOT NULL DEFAULT '0',
  `hasmobimg2` tinyint(1) NOT NULL DEFAULT '0',
  `hasproduct` tinyint(1) NOT NULL DEFAULT '1',
  `hascart` tinyint(1) NOT NULL,
  `hascartstatus` tinyint(1) NOT NULL DEFAULT '1',
  `hasmovie` tinyint(1) NOT NULL,
  `hasarticle` tinyint(1) NOT NULL DEFAULT '1',
  `hasmanage` tinyint(1) NOT NULL DEFAULT '1',
  `hasvip` tinyint(1) NOT NULL DEFAULT '1',
  `multilan` tinyint(4) NOT NULL DEFAULT '0',
  `contacttitle` varchar(200) NOT NULL,
  `contactname` varchar(255) NOT NULL,
  `istopnum` int(10) NOT NULL DEFAULT '3',
  `recommendnum` int(10) NOT NULL DEFAULT '3',
  `wholefee` varchar(100) NOT NULL DEFAULT '-1',
  `wholefeenum` varchar(100) NOT NULL DEFAULT '300',
  `retailfee` varchar(100) NOT NULL DEFAULT '-1',
  `retailfeenum` varchar(100) NOT NULL DEFAULT '300',
  `salepricetype` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '提交时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 COMMENT='系统配置' DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- 資料表的匯出資料 `config`
--

INSERT INTO `config` (`id`, `programe_name`, `company_name`, `best_explorer`, `company_logo`, `logo_alt`, `logo_url`, `company_pic`, `pic_alt`, `pic_url`, `photonic_logo`, `photonic_alt`, `photonic_url`, `photonic_link`, `contact_name`, `telephone`, `email`, `fax`, `mobile_telephone`, `address`, `icp`, `qq`, `msn`, `im`, `web_status`, `status_description`, `header_content`, `footer_content`, `download_suffix`, `global_thumb_status`, `global_attach_size`, `global_attach_suffix`, `product_thumb_status`, `product_thumb_size`, `download_thumb_status`, `download_thumb_size`, `global_thumb_size`, `seo_title`, `seo_keyword`, `seo_description`, `verify`, `hascontact`, `online`, `hasad`, `hasnews`, `newstitlelen`, `hasmarquee`, `marqueecontent`, `hasdownload`, `downloadsize`, `haslink`, `hasguestbook`, `guestbooktitle`, `hasproject`, `hasmobimg`, `hasad2`, `hasmarquee2`, `hasmobimg2`, `hasproduct`, `hascart`, `hascartstatus`, `hasmovie`, `hasarticle`, `hasmanage`, `hasvip`, `multilan`, `contacttitle`, `contactname`, `istopnum`, `recommendnum`, `wholefee`, `wholefeenum`, `retailfee`, `retailfeenum`, `salepricetype`, `create_time`, `update_time`) VALUES
(1, '萬用商業版總管理', '萬用後台', '您的瀏覽器必須支援 Cookie 安全機制，並且建議使用IE 8.0或Firefox/3.6.16之版本及 1024 x 768 或以上的解析度瀏覽。', 'Config/201601/logo.png', 'company logo', 'http://localhost/photonic_cms/', 'Config/201606/logo.png', 'company picture', 'http://localhost/photonic_cms/', 'Images/logo.png', 'photonic logo', 'http://www.photonic.com.tw', '<LI><A href="http://www.photonic.com.tw">www.photonic.com.tw</A></LI>', 'photonic', '', 'planner@photonic.com.tw', '', '', '', '', '', '', '', 1, '', '', '', 'Winndows', 1, 20480000, '', 0, '', 0, '', '', '', '', '', 0, 2, 0, 1, 2, 20, 0, 'dgaasfd', 1, 2048000, 1, 0, '留言板', 1, 1, 1, 0, 1, 3, 1, 1, 1, 1, 1, 1, 1, '回函表', '萬用後台', 6, 6, '1000', '2424', '', '400', 3, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL COMMENT '代號',
  `parent` int(11) NOT NULL COMMENT '母節點',
  `path` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '圖片路徑',
  `path_htumb` varchar(300) COLLATE utf8_unicode_ci NOT NULL COMMENT '縮圖',
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '名子',
  `user_id` int(11) NOT NULL COMMENT '擁有者',
  `create_time` int(11) UNSIGNED NOT NULL COMMENT '建立時間',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '類別0:資料夾 1:檔案 ',
  `extension` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '檔案類型',
  `size` int(30) NOT NULL DEFAULT '0' COMMENT '檔案大小'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `file`
--

INSERT INTO `file` (`id`, `parent`, `path`, `path_htumb`, `name`, `user_id`, `create_time`, `type`, `extension`, `size`) VALUES
(1, 0, '', '', '根目錄', 0, 0, 0, '', 0),
(22, 22, './Uploads/Files/5/test/57d25d8b8fabe1473404299.jpg', './Uploads/Files/5/test/57d25d8b8fabe1473404299_s.jpg', 'messageImage_1472805770171', 5, 1473404299, 1, 'jpg', 0),
(75, 22, './Uploads/Files/5/測試/1473406830.jpg', './Uploads/Files/5/57d26764ab1051473406820_s.jpg', 'Koala', 5, 1473406830, 1, 'jpg', 0),
(76, 22, './Uploads/Files/5/測試/1473406830.jpg', './Uploads/Files/5/57d26764a99951473406820_s.jpg', 'Desert', 5, 1473406830, 1, 'jpg', 0),
(77, 22, './Uploads/Files/5/測試/1473406953.jpg', './Uploads/Files/5/57d26764ab1051473406820_s.jpg', 'Koala', 5, 1473406953, 1, 'jpg', 0),
(78, 22, './Uploads/Files/5/測試/1473406954.jpg', './Uploads/Files/5/57d26764acc5e1473406820_s.jpg', 'Lighthouse', 5, 1473406954, 1, 'jpg', 0),
(79, 22, './Uploads/Files/5/測試/1473407143.jpg', './Uploads/Files/5/57d26856f05d71473407062_s.jpg', '2015051548919021', 5, 1473407143, 1, 'jpg', 0),
(89, 22, './Uploads/Files/5/測試/57d2896eaba721473415534.jpg', './Uploads/Files/5/測試/57d2896eaba721473415534_s.jpg', '9269794168_3ac58fc15c_b', 5, 1473415534, 1, 'jpg', 253359),
(103, 112, './Uploads/Files/5/衝浪/大圖/b7d1410cf81d084d2080613bda60e1d51473473514.jpg', './Uploads/Files/5/衝浪/57d36b7baf94d1473473403_s.jpg', 'shutterstock_316178285', 5, 1473473514, 1, 'jpg', 10037271),
(129, 1, './Uploads/Files/5/58e536373070d.png', './Uploads/Files/5/58e536373070d.png', 'logo', 5, 1491416631, 1, 'png', 37271),
(130, 1, './Uploads/Files/5/58e536eecacee.PNG', './Uploads/Files/5/58e536eecacee.PNG', 'IMG_0231', 5, 1491416814, 1, 'PNG', 1588584);

-- --------------------------------------------------------

--
-- 資料表結構 `vip`
--

CREATE TABLE `vip` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '流水號(唯一)',
  `create_time` int(11) NOT NULL COMMENT '建立時間',
  `update_time` int(11) NOT NULL COMMENT '更新時間',
  `account` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳號(唯一)',
  `passwords` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密碼',
  `real_pw` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '密碼',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '真實姓名',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性別',
  `birthday` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '生日',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '電話',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '信箱',
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '小名',
  `fb_count` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '綁定帳號',
  `fb_pw` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '綁定密碼',
  `address` text COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `get_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT '收件地址',
  `level` int(1) NOT NULL DEFAULT '1' COMMENT '會員等級',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '會員狀態',
  `fav_point` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '累積點數',
  `pay_point` int(11) NOT NULL DEFAULT '0' COMMENT '已消費點數',
  `total_point` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '總累積儲存點數',
  `pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '會員照片',
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手機',
  `buf_cart` text COLLATE utf8_unicode_ci COMMENT '購物車暫存',
  `ruleck` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '確認規定',
  `loginnum` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登入次數',
  `desire` text COLLATE utf8_unicode_ci NOT NULL COMMENT '慾望清單'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `vip`
--

INSERT INTO `vip` (`id`, `create_time`, `update_time`, `account`, `passwords`, `real_pw`, `name`, `sex`, `birthday`, `phone`, `email`, `nickname`, `fb_count`, `fb_pw`, `address`, `get_address`, `level`, `status`, `fav_point`, `pay_point`, `total_point`, `pic`, `mobile`, `buf_cart`, `ruleck`, `loginnum`, `desire`) VALUES
(2, 1467250850, 1467712212, 'php@photonic.com.tw', '8ab4b7d22b56c2f8a437d60dca8d5faf', 'zxcvzxcv', 'tester', 1, '1467129600', '02-123457', 'php@photonic.com.tw', '', '', '', '3#48#林森北路5巷12-1號', '臺北市中山區林森北路5巷12-1號', 1, 1, 1600, 500, '2100', NULL, '0912345678', NULL, 0, 0, 'Product:77#Product:82#Product:86'),
(3, 1467777955, 0, 'kate1p41p4@photonic.com.tw', '8ab4b7d22b56c2f8a437d60dca8d5faf', 'zxcvzxcv', '1p41p4', 1, '1467734400', '02-123457', 'kate1p41p4@photonic.com.tw', '', '', '', '臺北市48林森北路5巷12-1號', '', 1, 1, 0, 0, '0', NULL, '0912345678', NULL, 0, 0, ''),
(5, 1467250850, 1467250850, 'root', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 'michael', 1, '', '', '', '', '', '', '', '', 1, 1, 0, 0, '0', NULL, NULL, NULL, 0, 0, ''),
(6, 0, 0, 'anson', '81dc9bdb52d04dc20036dbd8313ed055', '1234', 'anson', 1, '', '', '', '', '', '', '', '', 1, 1, 0, 0, '0', NULL, NULL, NULL, 0, 0, '');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `vip`
--
ALTER TABLE `vip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`account`,`nickname`,`fb_count`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `config`
--
ALTER TABLE `config`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用資料表 AUTO_INCREMENT `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '代號', AUTO_INCREMENT=131;
--
-- 使用資料表 AUTO_INCREMENT `vip`
--
ALTER TABLE `vip`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '流水號(唯一)', AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
