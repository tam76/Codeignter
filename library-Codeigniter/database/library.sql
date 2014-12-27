-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2014 at 05:16 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `link` varchar(120) NOT NULL,
  `group` varchar(50) NOT NULL,
  `time_create` varchar(50) NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `link`, `group`, `time_create`, `user_create`, `status`) VALUES
(4, 'banner4', 'banner4_1419648673.jpg', 'slide-main', '11-11-2014 10:59', '2', 1),
(5, 'banner1', 'banner1_1419648629.jpg', 'slide-main', '11-11-2014 16:20', '2', 1),
(7, 'banner2', 'banner2_1415697808.jpg', 'slide-main', '11-11-2014 16:23', '2', 1),
(8, 'left1', 'left1_1419647632.jpg', 'left-ad', '27-12-2014 09:33', '2', 1),
(9, 'right', 'right_1419647664.jpg', 'right-ad', '27-12-2014 09:34', '2', 1),
(10, 'banner3', 'banner3_1419648654.jpg', 'slide-main', '27-12-2014 09:35', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `bookid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_title` varchar(255) NOT NULL,
  `book_url` varchar(255) NOT NULL,
  `cost` int(11) DEFAULT '0',
  `book_img` varchar(255) NOT NULL,
  `author` varchar(150) DEFAULT NULL,
  `publisher` varchar(150) DEFAULT NULL,
  `book_date` int(10) unsigned DEFAULT NULL,
  `book_tag` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `book_public` char(1) NOT NULL,
  `cateid` int(10) unsigned NOT NULL,
  `userid_create` int(10) unsigned NOT NULL,
  `userid_modify` int(10) unsigned DEFAULT NULL,
  `total_rate` int(10) unsigned DEFAULT '0',
  `views_rate` int(10) unsigned DEFAULT '0',
  `viewing` int(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`bookid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `book_title`, `book_url`, `cost`, `book_img`, `author`, `publisher`, `book_date`, `book_tag`, `description`, `book_public`, `cateid`, `userid_create`, `userid_modify`, `total_rate`, `views_rate`, `viewing`) VALUES
(1, 'Advanced Java Networking', 'advanced-java-networking_1419538915.swf', 0, 'advanced-java-networking_1419538915.jpg', '', '', 2009, '["Java"]', '<p>By now you&#39;ve seen all the hype, read all the books, and discovered all the wonders of&nbsp;<br />\r\nJava. But most of us still use C++ or C to create our hard-core applications, saving&nbsp;<br />\r\nJava for our Web pages or leaving it to HTML jocks to fiddle with. Doing so denies&nbsp;<br />\r\nus the opportunity to use a programming language that makes interfacing with a&nbsp;<br />\r\ncomputer infinitely easier, with less frustration and faster results.&nbsp;<br />\r\nJava is much more than &quot;Dancing Dukes&quot; or a programming language for Web pages.&nbsp;<br />\r\nIt is a strong alternative to the masochistic programming of the past, in which&nbsp;<br />\r\ncountless months were spent debugging compared to the mere days it took to code the&nbsp;<br />\r\ninitial concept. Java allows us to spend more time in the conceptual phase of software&nbsp;<br />\r\ndesign, thinking up new and creative ways to bring the vast knowledge of the Internet&nbsp;<br />\r\nand its many users to our desktop.&nbsp;<br />\r\nToday, our information, and its steady flow, is garnered from the Internet and the&nbsp;<br />\r\nmillions of fellow computer users around the world. Up until now, you&#39;ve no doubt&nbsp;<br />\r\ndesigned programs to interface with that knowledge using C or C++. Java will change&nbsp;<br />\r\nall of that. In addition to its ability to create adorable and functional user interfaces&nbsp;<br />\r\nquickly and easily is Java&#39;s ability to easily connect to the Internet. Java is, after&nbsp;<br />\r\nall,the Internet Language.&nbsp;</p>\r\n', 'Y', 1, 2, NULL, 41, 3, 0),
(2, 'Căn bản PHP', 'can-ban-php_1419539177.swf', 0, 'can-ban-php_1419539177.jpg', 'WWW.HUUKHANG.COM', 'COMPUTER LEARNING CENTER ', 2010, '["Php"]', '<p>kh&ocirc;ng c&oacute; m&ocirc; tả</p>\r\n', 'Y', 1, 2, NULL, 31, 2, 0),
(3, 'Facebook Application Development for Dummies', 'facebook-application-development-for-dummies_1419539536.swf', 2, 'facebook-application-development-for-dummies_1419539536.jpg', 'Jesse Stay', 'Wiley Publishing, Inc.', 2011, '["API"]', '<p>Learn to:<br />\r\n&bull; Install the Facebook toolkit&nbsp;and use the Graph API<br />\r\n&bull; Use Facebook Markup Language&nbsp;and Facebook Query Language<br />\r\n&bull; Create applications for marketing&nbsp;and making money<br />\r\n&bull; Boost your brand with a Facebook page</p>\r\n', 'Y', 1, 2, NULL, 20, 1, 1),
(4, 'Bí mật trị vì vương quốc đến quản lý công ty', 'bi-mat-tri-vi-vuong-quoc-den-quan-ly-cong-ty_1419540179.swf', 1, 'bi-mat-tri-vi-vuong-quoc-den-quan-ly-cong-ty_1419540179.jpg', 'Seldon Bowles', 'NXB Tổng hợp TP.HCM', 2009, '["Qu\\u1ea3n l\\u00fd"]', '<p>Phi&ecirc;n bản ebook n&agrave;y được thực hiện theo bản quyền xuất bản v&agrave; ph&aacute;t h&agrave;nh ấn bản<br />\r\ntiếng Việt của c&ocirc;ng ty First News - Tr&iacute; Việt với sự t&agrave;i trợ độc quyền của c&ocirc;ng ty TNHH<br />\r\nSamsung Electronics Việt Nam. T&aacute;c phẩm n&agrave;y kh&ocirc;ng được chuyển dạng sang bất kỳ<br />\r\nh&igrave;nh thức n&agrave;o hay sử dụng cho bất kỳ mục đ&iacute;ch thương mại n&agrave;o</p>\r\n', 'Y', 5, 2, NULL, 62, 4, 0),
(5, 'Câu chuyện nhà quản lý cà rốt và nghệ thuật khen thưởng', 'cau-chuyen-nha-quan-ly-ca-rot-va-nghe-thuat-khen-thuong_1419540611.swf', 1, 'cau-chuyen-nha-quan-ly-ca-rot-va-nghe-thuat-khen-thuong_1419540611.jpg', 'Adrian Gostick & Chester Elton', 'NXB Trẻ', 2009, '["Qu\\u1ea3n l\\u00fd"]', '<p>Phi&ecirc;n bản ebook n&agrave;y được thực hiện theo bản quyền xuất bản v&agrave; ph&aacute;t h&agrave;nh ấn bản<br />\r\ntiếng Việt của c&ocirc;ng ty First News - Tr&iacute; Việt với sự t&agrave;i trợ độc quyền của c&ocirc;ng ty<br />\r\nTNHH Samsung Electronics Việt Nam. T&aacute;c phẩm n&agrave;y kh&ocirc;ng được chuyển dạng<br />\r\nsang bất kỳ h&igrave;nh thức n&agrave;o hay sử dụng cho bất kỳ mục đ&iacute;ch thương mại n&agrave;o.</p>\r\n', 'Y', 5, 2, NULL, 52, 3, 0),
(6, 'Lĩnh vực chứng khoán', 'linh-vuc-chung-khoan_1419540916.swf', 0, 'linh-vuc-chung-khoan_1419540916.jpg', '', 'NXB Kim Đồng', 2013, '["Ch\\u1ee9ng kho\\u00e1n"]', '<p>Kh&ocirc;ng c&oacute; m&ocirc; tả</p>\r\n', 'Y', 5, 2, NULL, 40, 2, 0),
(7, 'Giáo trình Photoshop CS8', 'giao-trinh-photoshop-cs8_1419541193.swf', 0, 'giao-trinh-photoshop-cs8_1419541193.jpg', 'Lưu Hoàng Lý', '', 2010, '["\\u0110\\u1ed3 H\\u1ecda"]', '<p>Kh&ocirc;ng c&oacute; m&ocirc; tả</p>\r\n', 'Y', 1, 2, NULL, 0, 0, 1),
(8, 'Tự học SQL', 'tu-hoc-sql_1419541318.swf', 0, 'tu-hoc-sql_1419541318.jpg', '', '', 2010, '["Database"]', '<p>Welcome to SQL tutorial</p>\r\n', 'Y', 1, 2, NULL, 18, 1, 0),
(9, 'Nghệ thuật săn việc 2.0', 'nghe-thuat-san-viec-2-0_1419541521.swf', 2, 'nghe-thuat-san-viec-2-0_1419541521.jpg', 'Jay Conrad Levinson & David E. Perry', 'John Wiley & Sons', 2010, '["Vi\\u1ec7c l\\u00e0m"]', '<p>Bạn c&oacute; biết v&igrave; sao Jay Conrad Levinson v&agrave; David E.&nbsp;<br />\r\nPerry d&ugrave;ng từ du k&iacute;ch trong tất cả tựa s&aacute;ch v&agrave; trong c&aacute;c&nbsp;<br />\r\nbuổi tr&ograve; chuyện của họ kh&ocirc;ng? Đ&oacute; l&agrave; v&igrave; người du k&iacute;ch biết&nbsp;<br />\r\ntheo đuổi những mục ti&ecirc;u th&ocirc;ng thường theo những c&aacute;ch&nbsp;<br />\r\nkh&aacute;c thường. C&aacute;c du k&iacute;ch, cũng như độc giả th&agrave;nh c&ocirc;ng&nbsp;<br />\r\ncủa tạp ch&iacute; SUCCESS, lu&ocirc;n c&oacute; c&aacute;ch nh&igrave;n thực tế hơn so với&nbsp;<br />\r\nnhững người c&oacute; khuynh hướng thực hiện ước mơ bằng&nbsp;<br />\r\nc&aacute;ch l&agrave;m theo hướng dẫn trong s&aacute;ch vở.</p>\r\n', 'Y', 3, 2, NULL, 73, 4, 1),
(10, 'Phỏng vấn không hề đáng sợ', 'phong-van-khong-he-dang-so_1419541667.swf', 2, 'phong-van-khong-he-dang-so_1419541667.jpg', 'Marky Stein', 'fearless interviewing', 2010, '["Vi\\u1ec7c l\\u00e0m","Ph\\u1ecfng v\\u1ea5n"]', '<p>T&igrave;m đc vic l&agrave;m nh s t tin<br />\r\n- L&agrave;m ngạc nhi&ecirc;n người phỏng vấn ngay 20 gi&acirc;y&nbsp;đầu ti&ecirc;n<br />\r\n- Trả lời những c&acirc;u hỏi kh&oacute; một c&aacute;ch dễ d&agrave;ng<br />\r\n- Y&ecirc;u cầu mức lương cao hơn b&igrave;nh thường 20%</p>\r\n', 'Y', 3, 2, NULL, 53, 3, 0),
(11, 'Thủ thuật SEO', 'thu-thuat-seo_1419541849.swf', 0, 'thu-thuat-seo_1419541849.jpg', 'Tỉnh Trần ', '', 2012, '["SEO"]', '<p>Tối ưu h&oacute;a c&ocirc;ng cụ t&igrave;m kiếm (SEO) l&agrave; một trong những c&ocirc;ng việc kh&oacute; nhưng&nbsp;<br />\r\nm&agrave;u mỡ v&agrave; mang lại lợi nhuận to lớn cho c&aacute;c c&ocirc;ng ty v&agrave; doanh nghiệp cũng&nbsp;<br />\r\nnhư c&aacute;c c&aacute; nh&acirc;n đang kinh doanh tr&ecirc;n internet.&nbsp;<br />\r\nBất cứ ai muốn kiếm tiền tr&ecirc;n mạng, kinh doanh tr&ecirc;n internet hay muốn tạo thu&nbsp;<br />\r\nnhập tr&ecirc;n internet đều cần c&oacute; những kiến thức &amp; kinh nghiệm về SEO để tăng&nbsp;<br />\r\nlượng truy cập cũng như tăng lượng kh&aacute;ch h&agrave;ng tiềm năng cho m&igrave;nh.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Y', 1, 2, NULL, 33, 2, 1),
(12, 'Sự thật về 100 thất bại thương hiệu', 'su-that-ve-100-that-bai-thuong-hieu_1419542013.swf', 3, 'su-that-ve-100-that-bai-thuong-hieu_1419542013.jpg', 'Matt Haig', 'NXB Tổng hợp TP.HCM', 2012, '["Kinh doanh"]', '<p>Phi&ecirc;n bản ebook n&agrave;y được thực hiện theo bản quyền xuất bản v&agrave; ph&aacute;t h&agrave;nh ấn bản<br />\r\ntiếng Việt của c&ocirc;ng ty First News - Tr&iacute; Việt với sự t&agrave;i trợ độc quyền của c&ocirc;ng ty<br />\r\nTNHH Samsung Electronics Việt Nam. T&aacute;c phẩm n&agrave;y kh&ocirc;ng được chuyển dạng<br />\r\nsang bất kỳ h&igrave;nh thức n&agrave;o hay sử dụng cho bất kỳ mục đ&iacute;ch thương mại n&agrave;o</p>\r\n', 'Y', 5, 2, NULL, 13, 1, 0),
(14, 'Tôi tài giỏi, bạn cũng thế', 'toi-tai-gioi--ban-cung-the_1419542341.swf', 2, 'toi-tai-gioi--ban-cung-the_1419542341.jpg', 'Adam Khoo', 'NXB Phụ Nữ', 2012, '["Ph\\u00e1t tri\\u1ec3n b\\u1ea3n th\\u00e2n"]', '<p>Trước hết, xin được ch&uacute;c mừng bạn v&igrave; bạn đang sở hữu trong tay phi&ecirc;n bản ebook ho&agrave;n&nbsp;<br />\r\nto&agrave;n miễn ph&iacute; v&agrave; nhất l&agrave; ho&agrave;n to&agrave;n hợp ph&aacute;p (c&oacute; bản quyền) của s&aacute;ch &ldquo;T&ocirc;i T&agrave;i Giỏi,&nbsp;<br />\r\nBạn Cũng Thế!&rdquo;, được cung cấp ch&iacute;nh thức bởi hai t&aacute;c giả chuyển ngữ Trần Đăng Khoa v&agrave;&nbsp;<br />\r\nU&ocirc;ng Xu&acirc;n Vy.&nbsp;</p>\r\n', 'Y', 3, 2, NULL, 78, 4, 1),
(15, 'Đánh cắp ý tưởng', 'danh-cap-y-tuong_1419542664.swf', 4, 'danh-cap-y-tuong_1419542664.jpg', 'Steve Cone', 'NXB Trẻ', 2011, '["Qu\\u1ea3n l\\u00fd","Kinh doanh"]', '<p>Phi&ecirc;n bản ebook n&agrave;y được thực hiện theo bản quyền xuất bản v&agrave; ph&aacute;t h&agrave;nh ấn bản<br />\r\ntiếng Việt của c&ocirc;ng ty First News - Tr&iacute; Việt với sự t&agrave;i trợ độc quyền của c&ocirc;ng ty<br />\r\nTNHH Samsung Electronics Việt Nam. T&aacute;c phẩm n&agrave;y kh&ocirc;ng được chuyển dạng<br />\r\nsang bất kỳ h&igrave;nh thức n&agrave;o hay sử dụng cho bất kỳ mục đ&iacute;ch thương mại n&agrave;o</p>\r\n', 'Y', 5, 2, NULL, 58, 3, 0),
(16, 'Using Javascript', 'using-javascript_1419543261.swf', 0, 'using-javascript_1419543261.jpg', '', '', 2009, '', '<p>Kh&ocirc;ng c&oacute; m&ocirc; tả</p>\r\n', 'Y', 1, 2, NULL, 38, 2, 0),
(17, 'Advanced PHP Programming', 'advanced-php-programming_1419543478.swf', 3, 'advanced-php-programming_1419543478.jpg', 'George Schlossnagle', 'Sams Publishing', 0, '["Php"]', '<p>A practical guide to developing large-scale&nbsp;<br />\r\nWeb sites and applications with PHP 5</p>\r\n', 'Y', 1, 2, NULL, 18, 1, 0),
(18, 'AJAX and PHP  Building Responsive Web Applications ', 'ajax-and-php--building-responsive-web-applications-_1419544313.swf', 4, 'ajax-and-php--building-responsive-web-applications-_1419544313.jpg', 'Cristian Darie, Bogdan Brinzarea, Filip Cherecheş-Toşa, Mihai Bucica', 'Packt Publishing', 2012, '["Php"]', '<p>Enhance the user experience of your PHP website&nbsp;<br />\r\nusing AJAX with this practical tutorial featuring detailed&nbsp;<br />\r\ncase studies&nbsp;</p>\r\n', 'Y', 1, 2, NULL, 0, 0, 0),
(19, 'Beginning HTML5 and  CSS3', 'beginning-html5-and--css3_1419545300.swf', 3, 'beginning-html5-and--css3_1419545300.jpg', 'Richard Clark, Oli Studholme,  Christopher Murphy and Divya Manian ', '', 2008, '["web development"]', '<p>Who is this book for?&nbsp;<br />\r\nBeginning HTML5 and CSS3: The Web Evolved is aimed at anybody with a basic knowledge of HTML and CSS. If&nbsp;you have just recently dipped your toes into the world of HTML or CSS, or if you&rsquo;ve been developing sites for years,&nbsp;there will be something in this book for you. However, you will get the most out of this book if you&rsquo;ve had a play with&nbsp;HTML5 and CSS3 but don&rsquo;t yet fully understand all it has to offer. This book is packed full of practical, real-world &nbsp;advice and examples to help you master modern web standards.</p>\r\n', 'Y', 1, 2, NULL, 76, 5, 0),
(20, 'Beginning jQuery', 'beginning-jquery_1419545559.swf', 4, 'beginning-jquery_1419545559.jpg', 'Jack Franklin', '', 2008, '["web development"]', '<p>For your convenience Apress has placed some of the front&nbsp;<br />\r\nmatter material after the index. Please use the Bookmarks&nbsp;<br />\r\nand Contents at a Glance links to access them.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Y', 1, 2, NULL, 67, 4, 0),
(21, 'Beginning PHP and MySQL E-Commerce', 'beginning-php-and-mysql-e-commerce_1419545701.swf', 3, 'beginning-php-and-mysql-e-commerce_1419545701.jpg', 'Cristian Darie and Emilian Balanescu', 'Apress', 2008, '["Php","Database","web development"]', '<p>This practical PHP and MySQL tutorial will&nbsp;teach you how to successfully design and build&nbsp;<br />\r\nfully featured e-commerce web sites.</p>\r\n', 'Y', 1, 2, NULL, 43, 3, 0),
(22, 'Beginning PHP  and PostgreSQL 8 From Novice to Professional', 'beginning-php--and-postgresql-8-from-novice-to-professional_1419546194.swf', 3, 'beginning-php--and-postgresql-8-from-novice-to-professional_1419546194.jpg', 'W. Jason Gilmore and Robert H. Treat', 'Apress', 2008, '["Php","Database","web development"]', '<p>These are exciting times for the open source movement, and perhaps no two projects better&nbsp;<br />\r\nrepresent this development paradigm&rsquo;s incredible level of progress than the PHP scripting&nbsp;<br />\r\nlanguage and PostgreSQL database server.</p>\r\n', 'Y', 1, 2, NULL, 34, 2, 0),
(23, 'Beginning Smartphone  Web Development', 'beginning-smartphone--web-development_1419552799.swf', 4, 'beginning-smartphone--web-development_1419552799.jpg', 'Gail Rahn Frederick  with Rajesh Lal', 'Apress', 2010, '["web development","Mobile"]', '<p>Building JavaScript, CSS, HTML and Ajax-based&nbsp;Applications for iPhone, Android, Palm Pre, BlackBerry,&nbsp;Windows Mobile, and Nokia S60</p>\r\n', 'Y', 1, 2, NULL, 10, 1, 0),
(24, 'CakePHP Application  Development', 'cakephp-application--development_1419553564.swf', 2, 'cakephp-application--development_1419553564.jpg', 'Ahsanul Bari, Anupom Syam', 'Packt Publishing', 2008, '["Php","web development"]', '<p>Step-by-step introduction to rapid web&nbsp;development using the open-source MVC&nbsp;CakePHP framework</p>\r\n', 'Y', 1, 2, NULL, 0, 0, 0),
(25, 'CMS Design Using PHP and  jQuery', 'cms-design-using-php-and--jquery_1419553683.swf', 3, 'cms-design-using-php-and--jquery_1419553683.jpg', 'Kae Verens', 'Packt Publishing', 2010, '["web development"]', '<p>Build and improve your in-house PHP CMS by&nbsp;enhancing it with jQuery</p>\r\n', 'Y', 1, 2, NULL, 0, 0, 0),
(26, 'CodeIgniter 1.7 Professional  Development', 'codeigniter-1-7-professional--development_1419553893.swf', 2, 'codeigniter-1-7-professional--development_1419553893.jpg', 'Adam Griffiths', 'Packt Publishing', 2010, '["Php","web development"]', '<p>Become a CodeIgniter expert with professional tools,&nbsp;techniques, and extended libraries</p>\r\n', 'Y', 1, 2, 2, 20, 1, 1),
(27, 'Expert MySQL Second Edition', 'expert-mysql-second-edition_1419555224.swf', 2, 'expert-mysql-second-edition_1419555224.jpg', 'Charles Bell', 'Apress', 2012, '["Database"]', '<p>MySQL has been identified as the world&rsquo;s most popular open-source database and the fastest-growing database&nbsp;system in the industry. This book presents some of the topics of advanced database systems, examines the&nbsp;architecture of MySQL, and provides an expert&rsquo;s workbook for examining, integrating, and modifying the MySQL&nbsp;source code for use in enterprise environments. The book provides insight into how to modify the MySQL system to&nbsp;<br />\r\nmeet the unique needs of system integrators and educators alike.</p>\r\n', 'Y', 1, 2, NULL, 0, 0, 0),
(28, 'HTML5 and CSS3  Responsive Web  Design Cookbook', 'html5-and-css3--responsive-web--design-cookbook_1419555471.swf', 4, 'html5-and-css3--responsive-web--design-cookbook_1419555471.jpg', 'Benjamin LaGrone', 'Packt Publishing', 2013, '["web development","Mobile"]', '<p>Learn the secrets of developing responsive websites&nbsp;capable of interfacing with today&#39;s mobile Internet devices</p>\r\n', 'Y', 1, 2, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cateid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_title` varchar(150) NOT NULL,
  `tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cateid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cateid`, `cate_title`, `tag`) VALUES
(1, 'Công Nghệ Thông Tin', '["Php","Asp","Java","API","Đồ Họa","Database","SEO","web development","Mobile"]'),
(2, 'Truyện cười', NULL),
(3, 'Kĩ năng mềm', '["Việc làm","Phỏng vấn","Phát triển bản thân"]'),
(4, 'Pháp luật', NULL),
(5, 'Kinh Doanh', '["Quản lý","Chứng khoán","Kinh doanh"]'),
(7, 'truyện ngắn', '["Hồi kí","Nhật kí","Kí Sự","Phóng sự"]');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `setting` text NOT NULL,
  `default` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `setting`, `default`) VALUES
(1, 'general', '{"time_zone":"UP5","language":"vi","style_time":"%d-%m-%Y %H:%i"}', '{"time_zone":"UP5","language":"vi","style_time":"%d-%m-%Y %H:%i"}'),
(2, 'upload_avata', '{"upload_path":"images\\/avata\\/","allowed_types":"gif|jpg|png","max_size":"1000","max_width":"1600","max_height":"1600","image_library":"gd2","quality":"100","width":"200","height":"200","new_image":"images\\/avata\\/thumb\\/","image_library_thumb":"gd2","width_thumb":"25","height_thumb":"25"}', '{"upload_path":"images\\/avata\\/","allowed_types":"gif|jpg|png","max_size":"1000","max_width":"1600","max_height":"1600","image_library":"gd2","quality":"100","width":"200","height":"200","new_image":"images\\/avata\\/thumb\\/","image_library_thumb":"gd2","width_thumb":"25","height_thumb":"25"}'),
(3, 'upload_book', '{"upload_path":"file\\/","allowed_types":"pdf","max_size":"51200"}', '{"upload_path":"file\\/","allowed_types":"pdf","max_size":"51200"}'),
(4, 'upload_img', '{"upload_path":"images\\/book\\/","allowed_types":"gif|jpg|png","max_size":"1000","max_width":"1400","max_height":"2000","image_library":"gd2","quality":"100","width":"230","height":"320"}', '{"upload_path":"images\\/book\\/","allowed_types":"gif|jpg|png","max_size":"1000","max_width":"1400","max_height":"2000","image_library":"gd2","quality":"100","width":"230","height":"320"}'),
(5, 'pagination', '{"home_limit":"6","book_limit":"6","hot_limit":"6","user":"10","cate":"10","book":"10"}', '{"home_limit":"10","book_limit":"10","hot_limit":"10","user":"10","cate":"10","book":"10"}'),
(6, 'banner', '{"upload_path":"images\\/banner\\/","allowed_types":"gif|jpg|png","slide":{"width":"1000","height":"400"},"left-ad":{"width":"300"},"right-ad":{"width":"300"},"block-1":{"height":"300"},"block-2":{"height":"300"}}', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avata` varchar(50) NOT NULL,
  `level` int(1) unsigned DEFAULT '3',
  `info` text NOT NULL,
  `bookcase` text NOT NULL,
  `property` int(11) DEFAULT '0',
  `register_date` varchar(50) NOT NULL,
  `register_ip` varchar(20) NOT NULL,
  `visited_date` varchar(50) NOT NULL,
  `visited_ip` varchar(20) NOT NULL,
  `active_code` varchar(32) NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '2',
  `history` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `avata`, `level`, `info`, `bookcase`, `property`, `register_date`, `register_ip`, `visited_date`, `visited_ip`, `active_code`, `status`, `history`) VALUES
(1, 'default', '7c6c8144ac7bceaf038bec3be5ec5c27', '', 'default.jpg', 3, '', '', 5, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(2, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 1, '', '[{"id":"51","date":1518309205},{"id":"52","date":1518309205},{"id":"50","date":1518309205},{"id":"36","date":1419886817}]', 28, '0000-00-00', '', '27-12-2014 11:01', '::1', '', 1, '[{"date":"06-11-2014 01:01","ip":"::1","money":"4"},{"date":"06-11-2014 00:00","ip":"::1","money":"2"},{"date":"06-11-2014 00:00","ip":"::1","money":"3"},{"date":"05-11-2014 23:43","ip":"::1","money":"1"}]'),
(3, 'tam123', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 1, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(4, 'admin1', '827ccb0eea8a706c4c34a16891f84e7b', 'tam.pro76@gmail.com', 'default.jpg', 1, '{"name":"Nguyễn Duy Tâm","gt":"1","birthday":"07\\/06\\/1991","address":"123 dsfsd fd","number":"0838661788","phone":"3143123412413","id":"43124124124"}', '', 0, '26-12-2014 02:41', '::1', '', '', '', 1, ''),
(6, 'kenny', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 2, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(7, '1ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(8, '3ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '{"name":"Nguyu1ec5n Duy Tu00e2m","birthday":"07/06/1991","email":"tam.pro76@gmail.com","phone":"01228121763","id":"024418622"}', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(10, '2ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(11, '4ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '{"name":"Nguyễn Duy Tâm"}', '[{"id":"51","date":1508309205},{"id":"52","date":1508309205},{"id":"50","date":1508309205},{"id":"54","date":1415467843}]', 11, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(12, '5ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(13, '6ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(14, '7ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 1, ''),
(15, '8ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 2, ''),
(16, '9ngoisao', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 3, '', '', 0, '0000-00-00', '', '0000-00-00', '', '', 2, ''),
(17, '1check', '827ccb0eea8a706c4c34a16891f84e7b', '', 'default.jpg', 1, '{"name":"Nguyễn Duy Tâm","gt":"1","birthday":"17/08/2014","email":"tam.pro76@gmail.com"}', '', 0, '0000-00-00', '', '0000-00-00', '', '', 2, ''),
(18, 'cccccc', 'b0baee9d279d34fa1dfd71aadb908c3f', 'tam.pro@gmail.com', 'default.jpg', 1, '{"name":"","gt":"0","birthday":"","address":"","number":"","phone":"","id":""}', '', 0, '0000-00-00', '::1', '0000-00-00', '', '', 2, ''),
(19, 'default', '827ccb0eea8a706c4c34a16891f84e7b', 'tam.pro@gmail.com', 'default.jpg', 2, '{"name":"Nguyễn Duy Tâm","gt":"1","birthday":"16\\/08\\/1991","address":"12345 dsfsd ","number":"0838661788","phone":"3143123412413","id":"2131321312"}', 'null', 0, '21-10-2014 17:20', '::1', '08-11-2014 07:56', '::1', '', 1, ''),
(20, 'demden', 'b0baee9d279d34fa1dfd71aadb908c3f', 'tam.pro@gmail.com', 'demden.jpg', 3, '{"name":"Nguyễn Duy Tâm","gt":"1","birthday":"12\\/09\\/2014","address":"171 dadas","number":"0838661788","phone":"3143123412413","id":"2131321312"}', '[{"id":"14","date":1420823951},{"id":"9","date":1420823951},{"id":"26","date":1420823951},{"id":"3","date":1420823951},{"id":"11","date":1420823951},{"id":"7","date":1420823951}]', 2, '02-11-2014 22:17', '::1', '27-12-2014 00:59', '::1', '', 1, 'null');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
