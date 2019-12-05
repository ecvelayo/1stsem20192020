-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2019 at 02:20 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilaw1`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `BookId` int(11) NOT NULL,
  `BookCategoryId` int(11) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `BookDescription` varchar(100) NOT NULL,
  `BookVideoFileName` varchar(255) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookId`, `BookCategoryId`, `BookName`, `BookDescription`, `BookVideoFileName`, `IsDeleted`) VALUES
(1, 1, '10 Commandments', 'The Ten Commandments appear twice in the Hebrew Bible: in the books of Exodus and Deuteronomy', 'upload/book/10_commandments_(online-video-cutter_com).mp4', 0),
(2, 1, 'Adam and Eve', 'Adam is told that he can eat freely of all the trees in the garden, except for a tree of the knowled', 'upload/book/adam_and_eve_(online-video-cutter_com).mp4', 0),
(3, 2, 'Bear and Two friends', 'Bear and Two friends', 'upload/book/Bear_And_Two_Friends_in_English_Story_English_Fairy_Tales_(online-video-cutter_com).mp4', 0),
(4, 2, 'Gingerbread Man', 'Gingerbread Man', 'upload/book/Gingerbread_Man_in_English_Story_English_Fairy_Tales_(online-video-cutter_com).mp4', 0),
(5, 3, 'Alamat ng Ampalaya', 'Alamat ng Ampalaya', 'upload/book/ALAMAT_NG_AMPALAYA_(TAGALOG_BOOK)_KIDS_READING_WITH_ENGLISH_TAGALOG_SUBTITLES_(online-video-cutter_com).mp4', 0),
(7, 4, '12 labours of hercules', '12 labours of hercules', 'upload/book/12_labours_of_hercules.mp4', 0),
(8, 4, 'Apollo and Cassandra', 'Apollo and Cassandra', 'upload/book/apollo_and_cassandra.mp4', 0),
(13, 3, 'Ang pangbihirang buhok', 'Ang pangbihirang buhok', 'upload/book/ANG_PAMBIHIRANG_BUHOK_NI_LOLA_(TAGALOG_BOOK)_KIDS_READING_WITH_ENGLISH_TAGALOG_SUBTITLES_(online-video-cutter_com).mp4', 0),
(64, 5, 'Global Warming', 'Global warming is the long-term rise in the average temperature of the Earth\'s climate system.', 'upload/book/Global_Warming_-_The_End_Game___The_Dr__Binocs_Show___Best_Learning_Videos_For_Kids___Peekaboo_Kidz_(online-video-cutter_com).mp4', 0),
(65, 5, 'Amazing Spider', 'The wall crawler, The web-slinger, The amazing, The spectacular! None other than your friendly neigh', 'upload/book/How_Amazing_Are_Spiders!_-_The_Dr__Binocs_Show___Best_Learning_Videos_For_Kids___Peekaboo_Kidz_(online-video-cutter_com).mp4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookcategory`
--

CREATE TABLE `bookcategory` (
  `BookCategoryId` int(11) NOT NULL,
  `BookCategoryName` varchar(100) NOT NULL,
  `BookCategoryPictureFileName` varchar(100) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookcategory`
--

INSERT INTO `bookcategory` (`BookCategoryId`, `BookCategoryName`, `BookCategoryPictureFileName`, `IsDeleted`) VALUES
(1, 'Biblical', 'upload/book_category/biblical.png', 0),
(2, 'Fairytale', 'upload/book_category/fairytale.png', 0),
(3, 'Folklore', 'upload/book_category/folklore.jpg', 0),
(4, 'Mythical', 'upload/book_category/mythical.jpg', 0),
(5, 'Scientifical', 'upload/book_category/scientifical.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `ExamId` int(11) NOT NULL,
  `BookId` int(11) NOT NULL,
  `Question` varchar(50) NOT NULL,
  `Option1` varchar(50) NOT NULL,
  `Option2` varchar(50) NOT NULL,
  `Option3` varchar(50) NOT NULL,
  `Option4` varchar(50) NOT NULL,
  `CorrectAnswer` varchar(50) NOT NULL,
  `IsFileExam` int(11) NOT NULL,
  `ExamFileName` varchar(100) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`ExamId`, `BookId`, `Question`, `Option1`, `Option2`, `Option3`, `Option4`, `CorrectAnswer`, `IsFileExam`, `ExamFileName`, `IsDeleted`) VALUES
(1, 1, 'What is the title of the story', '9 commandments', '10 commandments', '3 commandments', '1 commandments', '10 commandments', 0, '', 0),
(2, 1, 'What crime did moses make?', 'Escape Egypt', 'Kill someone', 'Steal gold', 'Punch a person', 'Escape Egypt', 0, '', 0),
(3, 1, 'What did moses see?', 'Sheep', 'a crazy person', 'a dog', 'Burning bush', 'Burning bush', 0, '', 0),
(4, 1, 'What is God\'s first punishment?', 'Great Flood', 'Earthquake', 'Land Slide', 'Fire', 'Great Flood', 0, '', 0),
(5, 1, 'What did moses stick turn?', 'Frog', 'Cat', 'Tiger', 'Snake', 'Snake', 0, '', 0),
(6, 1, 'Who are God\'s people?', 'Israelites', 'Americans', 'Palestines', 'Filipinos', 'Israelites', 0, '', 0),
(7, 1, 'What color did the Nile river turn?', 'Blue', 'Green', 'Black', 'Red', 'Red', 0, '', 0),
(8, 1, 'Who is talking to moses?', 'Jesus', 'Mary', 'Joseph', 'God', 'God', 0, '', 0),
(9, 1, 'what animal does moses have?', 'cow', 'Dog', 'Cat', 'Sheep', 'Sheep', 0, '', 0),
(10, 1, '-', 'Red water', 'Blue water', 'Greed water', 'White water', 'Blue water', 1, 'upload/exam_visual_audio/11.mp3', 0),
(11, 1, '-', 'Chicken', 'Beef', 'Cow', 'Snake', 'Snake', 1, 'upload/exam_visual_audio/12.mp3', 0),
(12, 1, '-', '1', '4', '10', '6', '10', 1, 'upload/exam_visual_audio/13.mp3', 0),
(13, 1, '-', 'Nile River', 'Amazon River', 'Mantuyong River', 'Flowing River', 'Nile River', 1, 'upload/exam_visual_audio/14.mp3', 0),
(14, 1, '-', 'Iran', 'Pakistan', 'India', 'Egypt', 'Egypt', 1, 'upload/exam_visual_audio/15.mp3', 0),
(15, 1, '-', 'Burning tree', 'Burning bush', 'Burning plant', 'Burning sheep', 'Burning bush', 1, 'upload/exam_visual_audio/16.mp3', 0),
(16, 1, '-', 'sand', 'water', 'sky', 'earth', 'water', 1, 'upload/exam_visual_audio/17.mp3', 0),
(17, 1, '-', 'Mount sinai', 'Mount apo', 'Mount everest', 'Mount Fuji', 'Mount Sinai', 1, 'upload/exam_visual_audio/18.mp3', 0),
(18, 1, '-', 'Israelites', 'egyptians', 'indians', 'Filipinos', 'Israelites', 1, 'upload/exam_visual_audio/19.mp3', 0),
(19, 1, '-', 'Mark', 'Moses', 'John', 'Peter', 'Moses', 1, 'upload/exam_visual_audio/20.mp3', 0),
(20, 1, '-', 'stone', 'staff', 'sword', 'spear', 'staff', 1, 'upload/exam_visual_audio/21.mp3', 0),
(21, 2, 'Who is the first man on earth?', 'Jesus', 'Adam', 'Jacob', 'Moses', 'Adam', 0, '', 0),
(22, 2, 'Who created adam and eve??', 'Mary', 'Joseph', 'Jesus', 'God', 'God', 0, '', 0),
(23, 2, 'Who is created First?', 'Eve', 'Adam', 'Abraham', 'Moses', 'Adam', 0, '', 0),
(24, 2, 'What is the name of God\'s Garden?', 'Garden of Eden', 'Garden of Sirao', 'Garden of eve', 'Garden of Heaven', 'Garden of Eden', 0, '', 0),
(25, 2, 'Who is the first woman on earth?', 'Mary', 'Ruth', 'Elizabeth', 'Eve', 'Eve', 0, '', 0),
(26, 2, 'What did they eat that made God angry?', 'Banana', 'Mango', 'Forbiden Fruit', 'Durian', 'Forbiden Fruit', 0, '', 0),
(27, 2, 'What is the color of the forbiden fruit?', 'Blue', 'Green', 'Black', 'Red', 'Red', 0, '', 0),
(28, 2, 'What animal tempted adam and eve?', 'Cat', 'Tiger', 'Mouse', 'Snake', 'Snake', 0, '', 0),
(29, 2, 'What did God do after adam and eve eat the fruit?', 'Banish from the land', 'Stayed in the garden', 'Disappeared', 'Kidnapped', 'Banish from the land', 0, '', 0),
(30, 2, '-', 'Sun', 'Water', 'Moon', 'Earth', 'Sun', 1, 'upload/exam_visual_audio/111.mp3', 0),
(31, 2, '-', 'earth', 'Moon', 'water', 'Sun', 'Moon', 1, 'upload/exam_visual_audio/121.mp3', 0),
(32, 2, '-', 'Fish', 'Pigs', 'Birds', 'Insects', 'Birds', 1, 'upload/exam_visual_audio/131.mp3', 0),
(33, 2, '-', 'Tiger', 'Lion', 'Snake', 'Lizard', 'Snake', 1, 'upload/exam_visual_audio/141.mp3', 0),
(34, 2, '-', 'Sea', 'Ocean', 'Water', 'Falls', 'Ocean', 1, 'upload/exam_visual_audio/151.mp3', 0),
(35, 2, '-', 'Pants', 'Flowers', 'Petals', 'Trees', 'Trees', 1, 'upload/exam_visual_audio/161.mp3', 0),
(36, 2, '-', 'sand', 'water', 'sky', 'earth', 'water', 1, 'upload/exam_visual_audio/171.mp3', 0),
(37, 2, '-', 'Adam & Eve', 'Jesus', 'Moses', 'Mary & Joseph', 'Adam & Eve', 1, 'upload/exam_visual_audio/181.mp3', 0),
(38, 2, '-', 'leaves', 'tshirt', 'pants', 'shorts', 'leaves', 1, 'upload/exam_visual_audio/191.mp3', 0),
(39, 2, '-', 'Green', 'Brown', 'White', 'Red', 'Green', 1, 'upload/exam_visual_audio/201.mp3', 0),
(40, 2, '-', 'Green', 'Blue', 'Orange', 'Yellow', 'Blue', 1, 'upload/exam_visual_audio/211.mp3', 0),
(41, 3, 'What are the names of the Two Friends?', 'Ron and John', 'Mike and Ryan', 'Josh and Sam', 'Andy and Lee', 'Ron and John', 0, '', 0),
(42, 3, 'Where did the Two Friends decided to do?', 'The mountain', 'The forest', 'The ocean', 'The malls', 'The forest', 0, '', 0),
(43, 3, 'What is the color of the snake?', 'Pink', 'Green', 'Orange', 'Yellow', 'Orange', 0, '', 0),
(44, 3, 'What is the color of the cheetah?', 'Brown', 'Red', 'Pink', 'Yellow', 'Yellow', 0, '', 0),
(45, 3, 'What is the color of the spider?', 'Brown', 'Pink', 'Orange', 'Yellow', 'Brown', 0, '', 0),
(46, 3, 'How many skulls did the saw while walking in the f', '3', '2', '1', '0', '3', 0, '', 0),
(47, 3, 'What is the color of the skulls?', 'Black', 'Orange', 'White', 'Green', 'White', 0, '', 0),
(48, 3, 'What is the color of the bear?', 'Black', 'Brown', 'Orange', 'Blue', 'Brown', 0, '', 0),
(49, 3, 'What is the title of the short story?', 'Jon and Josh', 'The fish', 'Bear and Two Friends', 'The Two Friends', 'Bear and Two Friends', 0, '', 0),
(50, 3, 'What is the color of the house of Ron and John?', 'Brown and Red', 'Pink and Blue', 'Gray and Pink', 'Black and Brown', 'Brown and Red', 0, '', 0),
(51, 3, '-', 'Green and Violet', 'Pink and Yellow', 'Black and White', 'Red and Orange', 'Green and Violet', 1, 'upload/exam_visual_audio/112.mp3', 0),
(52, 3, '-', 'Pink', 'Blue', 'Brown', 'Yellow', 'Brown', 1, 'upload/exam_visual_audio/122.mp3', 0),
(53, 3, '-', 'Teal and Red', 'Pink and Yellow', 'Brown and Black', 'White and Yellow', 'Teal and Red', 1, 'upload/exam_visual_audio/132.mp3', 0),
(54, 3, '-', 'Pink and Blue', 'Yellow and Red', 'Orange and Blue', 'Green and Brown', 'Green and Brown', 1, 'upload/exam_visual_audio/142.mp3', 0),
(55, 3, '-', '2', '3', '1', '0', '1', 1, 'upload/exam_visual_audio/152.mp3', 0),
(56, 3, '-', '1', '2', '3', '4', '1', 1, 'upload/exam_visual_audio/162.mp3', 0),
(57, 3, '-', '2', '4', '3', '1', '1', 1, 'upload/exam_visual_audio/172.mp3', 0),
(58, 3, '-', '5', '3', '1', '2', '1', 1, 'upload/exam_visual_audio/182.mp3', 0),
(59, 3, '-', 'White', 'Red', 'Black and White', 'Yellow', 'Red', 1, 'upload/exam_visual_audio/192.mp3', 0),
(60, 3, '-', 'Brown', 'White', 'Black and White', 'Orange', 'Brown', 1, 'upload/exam_visual_audio/202.mp3', 0),
(61, 4, ' What is the title of the short story?', 'Gingerbread Man', 'Breadtalk', 'The Man', 'Ginger Man', 'Gingerbread Man', 0, '', 0),
(62, 4, ' Who lived in a little old house?', 'Girl', 'Boy', 'Old woman and her husband', 'Parents', 'Old woman and her husband', 0, '', 0),
(63, 4, 'What is the color of the house?', 'Red and Black', 'Brown and Blue', 'Pink and Red', 'Green and Orange', 'Brown and Blue', 0, '', 0),
(64, 4, 'How many children did the couple have?', '0', '1', '2', '3', '0', 0, '', 0),
(65, 4, 'What did the old woman decided to make?', 'Garden', 'Dress', 'Gingerbread', 'Soup', 'Gingerbread', 0, '', 0),
(66, 4, ' Where did the old woman put the gingerbread?', 'In the room', 'In the oven', 'In the jungle', 'In the comfort room', 'In the oven', 0, '', 0),
(67, 4, ' What is the color of the gingerbread?', 'Brown', 'Pink', 'Black', 'Green', 'Brown', 0, '', 0),
(68, 4, ' What is the color of the gingerbread’s eyes?', 'Pink', 'Red', 'Blue', 'White', 'Blue', 0, '', 0),
(69, 4, 'What is the color of the cow?', 'Blue', 'Red', 'Orange', 'White', 'White', 0, '', 0),
(70, 4, 'What is the color of the pig?', 'Pink', 'Red', 'Orange', 'Green', 'Pink', 0, '', 0),
(71, 4, '-', 'Bake', 'Oven', 'Obin', 'Oben', 'Oven', 1, 'upload/exam_visual_audio/113.mp3', 0),
(72, 4, '-', 'Pig', 'Peeg', 'Pippa Pig', 'Piglet', 'Pig', 1, 'upload/exam_visual_audio/123.mp3', 0),
(73, 4, '-', 'Caw', 'Kaw', 'Cow', 'Law', 'Cow', 1, 'upload/exam_visual_audio/133.mp3', 0),
(74, 4, '-', 'Fat', 'Faat', 'Feet', 'Fit', 'Fat', 1, 'upload/exam_visual_audio/143.mp3', 0),
(75, 4, '-', 'Pat', 'Goat', 'Cow', 'Cat', 'Cat', 1, 'upload/exam_visual_audio/153.mp3', 0),
(76, 4, '-', 'Hen', 'Heen', 'Hin', 'Him', 'Hen', 1, 'upload/exam_visual_audio/164.mp3', 0),
(77, 4, '-', 'Fix', 'Pox', 'Fox', 'Feet', 'Fox', 1, 'upload/exam_visual_audio/173.mp3', 0),
(78, 4, '-', 'Orange', 'Pink', 'Yellow', 'Blue', 'Orange', 1, 'upload/exam_visual_audio/183.mp3', 0),
(79, 4, '-', 'Red', 'Pink', 'Orange', 'Blue', 'Blue', 1, 'upload/exam_visual_audio/193.mp3', 0),
(80, 4, '-', 'Black', 'Red', 'Yellow', 'Pink', 'Black', 1, 'upload/exam_visual_audio/203.mp3', 0),
(558, 5, 'Ano ang pangalan ng bayan kung saan naninirahan an', 'Sardinas', 'Sariwa', 'Saging', 'Sawa', 'Sariwa', 0, '', 0),
(559, 5, 'Ano ang pangalan ng bayan kung saan naninirahan an', 'ampalaya', 'kamatis', 'luya', 'singkamas', 'ampalaya', 0, '', 0),
(560, 5, 'Anong gulay ang may manipis na balat?', 'labanos', 'ampalaya', 'sibuyas ', 'patola', 'sibuyas', 0, '', 0),
(561, 5, 'Sinong gulay ang nagduda sa dayuhang gulay?', 'kamatis', 'talong', 'sitaw', 'upo', 'kamatis', 0, '', 0),
(562, 5, 'Ano na ang kulay ng ampalaya pagkatapos ng kwento?', 'madilim na luntian', 'dilaw', 'asul ', 'berde', 'madilim na luntian', 0, '', 0),
(563, 5, '-', 'sibuyas', 'luya', 'patola', 'kamatis', 'luya', 1, 'upload/exam_visual_audio/q1.mp3', 0),
(564, 5, '-', 'labanos', 'luya', 'kalabasa', 'mustasa', 'labanos', 1, 'upload/exam_visual_audio/q2.mp3', 0),
(565, 5, '-', 'mustasa', 'talong', 'sibuyas ', 'labanos', 'talong', 1, 'upload/exam_visual_audio/q3.mp3', 0),
(566, 5, '-', 'singkamas', 'patola', 'kalabasa', 'sibuyas', 'kalabasa', 1, 'upload/exam_visual_audio/q4.mp3', 0),
(567, 5, '-', 'kamatis', 'ampalaya', 'labanos', 'singkamas', 'singkamas', 1, 'upload/exam_visual_audio/q5.mp3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `examresult`
--

CREATE TABLE `examresult` (
  `ExamResultId` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `ExamId` int(11) NOT NULL,
  `BookId` int(11) NOT NULL,
  `TeacherId` int(11) NOT NULL,
  `SchoolYear` int(11) NOT NULL,
  `GradeLevel` int(11) NOT NULL,
  `TotalScore` int(11) NOT NULL,
  `PerfectScore` int(11) NOT NULL,
  `Date` varchar(50) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `GameId` int(11) NOT NULL,
  `GameCategoryId` int(11) NOT NULL,
  `GameName` varchar(50) NOT NULL,
  `GamePictureFileName` varchar(50) NOT NULL,
  `GameLink` varchar(255) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`GameId`, `GameCategoryId`, `GameName`, `GamePictureFileName`, `GameLink`, `IsDeleted`) VALUES
(1, 1, 'Maze', 'upload/game/maze.PNG', 'https://img-hws.y8.com/cloud/y8-flash-game/contents/item_versions/flash_games/9624/original/maze_game_game_play_8.swf?1521321143', 0),
(2, 2, 'Shapes', 'upload/game/shape.PNG', 'https://img-hws.y8.com/cloud/y8-flash-game/contents/item_versions/flash_games/17585/original/shape_drop.swf?1521354272', 0),
(3, 3, 'Spelling', 'upload/game/spelling.PNG', 'https://img-hws.y8.com/cloud/y8-flash-game/contents/item_versions/flash_games/60245/original/dora_swiper_s_spelling_book.swf?1521654219', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gamecategory`
--

CREATE TABLE `gamecategory` (
  `GameCategoryId` int(11) NOT NULL,
  `GameCategoryName` varchar(100) NOT NULL,
  `GameCategoryPictureFileName` varchar(100) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gamecategory`
--

INSERT INTO `gamecategory` (`GameCategoryId`, `GameCategoryName`, `GameCategoryPictureFileName`, `IsDeleted`) VALUES
(1, 'Maze', 'upload/game_category/maze.jpg', 0),
(2, 'Shapes', 'upload/game_category/5473ab7f8a76a_thumb900.jpg', 0),
(3, 'Spelling', 'upload/game_category/spell.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ReportId` int(11) NOT NULL,
  `BookId` int(11) NOT NULL,
  `TotalViews` int(11) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentlist`
--

CREATE TABLE `studentlist` (
  `StudentListId` int(11) NOT NULL,
  `UserAccountId` int(11) NOT NULL,
  `GradeLevel` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentlist`
--

INSERT INTO `studentlist` (`StudentListId`, `UserAccountId`, `GradeLevel`, `Status`, `IsDeleted`) VALUES
(1, 4, 1, 'Assigned', 0),
(2, 5, 1, 'UnAssigned', 0),
(3, 6, 1, 'UnAssigned', 0),
(4, 7, 1, 'UnAssigned', 0),
(5, 8, 1, 'UnAssigned', 0),
(6, 9, 1, 'UnAssigned', 0),
(7, 10, 1, 'UnAssigned', 0),
(8, 11, 1, 'UnAssigned', 0),
(9, 12, 1, 'Assigned', 0),
(10, 13, 1, 'Assigned', 0),
(11, 14, 1, 'UnAssigned', 0),
(12, 15, 1, 'UnAssigned', 0),
(13, 16, 1, 'UnAssigned', 0),
(14, 17, 1, 'UnAssigned', 0),
(15, 18, 1, 'UnAssigned', 0),
(16, 19, 1, 'UnAssigned', 0),
(17, 20, 1, 'UnAssigned', 0),
(18, 21, 1, 'UnAssigned', 0),
(19, 22, 1, 'UnAssigned', 0),
(20, 23, 1, 'UnAssigned', 0),
(21, 24, 1, 'UnAssigned', 0),
(22, 25, 1, 'UnAssigned', 0),
(23, 26, 1, 'UnAssigned', 0),
(24, 27, 1, 'UnAssigned', 0),
(25, 28, 1, 'UnAssigned', 0),
(26, 29, 1, 'UnAssigned', 0),
(27, 30, 1, 'UnAssigned', 0),
(28, 31, 1, 'UnAssigned', 0),
(29, 32, 1, 'UnAssigned', 0),
(30, 33, 1, 'UnAssigned', 0),
(31, 34, 1, 'UnAssigned', 0),
(32, 35, 1, 'Assigned', 0),
(33, 36, 1, 'UnAssigned', 0),
(34, 37, 1, 'UnAssigned', 0),
(35, 38, 1, 'UnAssigned', 0),
(36, 39, 1, 'UnAssigned', 0),
(37, 40, 1, 'UnAssigned', 0),
(38, 41, 1, 'UnAssigned', 0),
(39, 42, 1, 'UnAssigned', 0),
(40, 43, 1, 'UnAssigned', 0),
(41, 44, 1, 'UnAssigned', 0),
(42, 45, 1, 'UnAssigned', 0),
(43, 46, 1, 'UnAssigned', 0),
(44, 47, 1, 'UnAssigned', 0),
(45, 48, 1, 'UnAssigned', 0),
(46, 49, 1, 'UnAssigned', 0),
(47, 50, 1, 'Assigned', 0),
(48, 51, 1, 'UnAssigned', 0),
(49, 52, 1, 'UnAssigned', 0),
(50, 53, 1, 'UnAssigned', 0),
(51, 54, 1, 'UnAssigned', 0),
(52, 55, 1, 'UnAssigned', 0),
(53, 56, 1, 'Assigned', 0),
(54, 57, 1, 'UnAssigned', 0),
(55, 58, 1, 'UnAssigned', 0),
(56, 59, 1, 'Assigned', 0),
(57, 60, 1, 'Assigned', 0),
(58, 61, 1, 'UnAssigned', 0),
(59, 62, 1, 'UnAssigned', 0),
(60, 63, 1, 'UnAssigned', 0),
(61, 64, 1, 'UnAssigned', 0),
(62, 65, 1, 'UnAssigned', 0),
(63, 66, 1, 'UnAssigned', 0),
(64, 67, 1, 'UnAssigned', 0),
(65, 68, 1, 'UnAssigned', 0),
(66, 69, 1, 'UnAssigned', 0),
(67, 70, 1, 'UnAssigned', 0),
(68, 71, 1, 'UnAssigned', 0),
(69, 72, 1, 'UnAssigned', 0),
(70, 73, 1, 'UnAssigned', 0),
(71, 74, 1, 'UnAssigned', 0),
(72, 75, 1, 'UnAssigned', 0),
(73, 76, 1, 'UnAssigned', 0),
(74, 77, 1, 'UnAssigned', 0),
(75, 78, 1, 'UnAssigned', 0),
(76, 79, 1, 'UnAssigned', 0),
(77, 80, 1, 'UnAssigned', 0),
(78, 81, 1, 'UnAssigned', 0),
(79, 82, 1, 'UnAssigned', 0),
(80, 83, 1, 'Assigned', 0),
(81, 84, 1, 'Assigned', 0),
(82, 85, 1, 'Assigned', 0),
(83, 86, 1, 'UnAssigned', 0),
(84, 87, 1, 'UnAssigned', 0),
(85, 88, 1, 'UnAssigned', 0),
(86, 89, 1, 'UnAssigned', 0),
(87, 90, 1, 'UnAssigned', 0),
(88, 91, 1, 'UnAssigned', 0),
(89, 92, 1, 'UnAssigned', 0),
(90, 93, 1, 'UnAssigned', 0),
(91, 94, 1, 'UnAssigned', 0),
(92, 95, 1, 'UnAssigned', 0),
(93, 96, 1, 'UnAssigned', 0),
(94, 97, 1, 'UnAssigned', 0),
(95, 98, 1, 'UnAssigned', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacherclass`
--

CREATE TABLE `teacherclass` (
  `TeacherClassId` int(11) NOT NULL,
  `TeacherId` int(11) NOT NULL,
  `StudentListId` int(11) NOT NULL,
  `SchoolYear` int(11) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacherclass`
--

INSERT INTO `teacherclass` (`TeacherClassId`, `TeacherId`, `StudentListId`, `SchoolYear`, `IsDeleted`) VALUES
(1, 2, 80, 2019, 0),
(2, 2, 56, 2019, 0),
(3, 2, 9, 2019, 0),
(4, 2, 10, 2019, 0),
(5, 2, 1, 2019, 0),
(6, 2, 32, 2019, 0),
(7, 2, 57, 2019, 0),
(8, 2, 81, 2019, 0),
(9, 2, 82, 2019, 0),
(10, 2, 53, 2019, 0),
(11, 2, 47, 2019, 0);

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE `travel` (
  `TravelId` int(11) NOT NULL,
  `TravelCategoryId` int(11) NOT NULL,
  `TravelName` varchar(100) NOT NULL,
  `TravelDescription` varchar(255) NOT NULL,
  `TravelPictureFileName` varchar(100) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`TravelId`, `TravelCategoryId`, `TravelName`, `TravelDescription`, `TravelPictureFileName`, `IsDeleted`) VALUES
(1, 1, 'Carabao Mango', '', 'upload/travel/carabao_mango.jpg', 0),
(2, 1, 'Cebu City', '', 'upload/travel/cebu_city.jpg', 0),
(3, 1, 'Colon', '', 'upload/travel/colon.jpg', 0),
(4, 1, 'Simala Church', '', 'upload/travel/simala_church.jpg', 0),
(5, 1, 'Sinulog', '', 'upload/travel/sinulog.jpg', 0),
(6, 1, 'Whale Shark', '', 'upload/travel/whale_shark.jpg', 0),
(7, 2, 'Coron', '', 'upload/travel/Coron.jpg', 0),
(8, 2, 'El Nido', '', 'upload/travel/El_Nido.jpg', 0),
(9, 2, 'Honda Bay', '', 'upload/travel/Puerto_Princesa_Bay.jpg', 0),
(10, 2, 'Puerto Princesa', '', 'upload/travel/Puerto_Princesa.jpg', 0),
(11, 2, 'Kulambo Feast', '', 'upload/travel/The_Kulambo_Festival.jpg', 0),
(12, 2, 'Tubbatha Reef', '', 'upload/travel/Tubbataha_Reef_National_Park.jpg', 0),
(16, 3, 'La Trinidad Farm', '', 'upload/travel/La_Trinidad_Strawberry_Farm1.jpg', 0),
(17, 3, 'Baguio Cathedral', '', 'upload/travel/Baguio_Cathedral1.jpg', 0),
(18, 3, 'Baguio City', '', 'upload/travel/baguio_city1.jpg', 0),
(19, 3, 'Panagbenga Feast', '', 'upload/travel/Panagbenga_Festival.jpg', 0),
(20, 3, 'Strawberry', '', 'upload/travel/strawberry.jpg', 0),
(21, 3, 'Valley of Colors', '', 'upload/travel/The_Valley_of_Colors.jpg', 0),
(22, 4, 'Davao City', '', 'upload/travel/davao_city.jpg', 0),
(23, 4, 'Durian', '', 'upload/travel/durian.jpg', 0),
(24, 4, 'Kadayawan Feast', '', 'upload/travel/Kadayawan_Festival.jpg', 0),
(25, 4, 'Mt. Apo', '', 'upload/travel/mt.jpg', 0),
(26, 4, 'People\'s Park', '', 'upload/travel/peoples_park.jpg', 0),
(27, 4, 'Phil. Eagle', '', 'upload/travel/Philippine_Eagle.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `travelcategory`
--

CREATE TABLE `travelcategory` (
  `TravelCategoryId` int(11) NOT NULL,
  `TravelCategoryName` varchar(100) NOT NULL,
  `TravelCategoryPictureFileName` varchar(100) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travelcategory`
--

INSERT INTO `travelcategory` (`TravelCategoryId`, `TravelCategoryName`, `TravelCategoryPictureFileName`, `IsDeleted`) VALUES
(1, 'Cebu', 'upload/travel_category/cebu.jpg', 0),
(2, 'Palawan', 'upload/travel_category/palawan.jpg', 0),
(3, 'Baguio', 'upload/travel_category/baguio.jpg', 0),
(4, 'Davao', 'upload/travel_category/davao.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `UserAccountId` int(11) NOT NULL,
  `UserDetailId` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `UserRole` varchar(50) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`UserAccountId`, `UserDetailId`, `Username`, `Password`, `IsActive`, `UserRole`, `IsDeleted`) VALUES
(1, 1, 'admin', '0c909a141f1f2c0a1cb602b0b2d7d050', 1, 'Administrator', 0),
(2, 2, 'sam', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'Teacher', 0),
(3, 3, 'lloyd', '550e1bafe077ff0b0b67f4e32f29d751', 1, 'Teacher', 0),
(4, 4, '1ab1', '07afc5d985ed164e15b34e8a921e7422', 1, 'Student', 0),
(5, 5, '1ab2', '56c25a2429bf3c0a33e5b3710999a996', 1, 'Student', 0),
(6, 6, '1ab3', '40c53e49e0c37d0b93ac9ee9b549bd69', 1, 'Student', 0),
(7, 7, '1ab4', 'd05a84ca1109278f5f320f5765942dd6', 1, 'Student', 0),
(8, 8, '1ab5', '5bf1ad60381115a0a4d0b62cff144037', 1, 'Student', 0),
(9, 9, '1ab6', '62a002c2a8c37dfaffa1a57e0291430b', 1, 'Student', 0),
(10, 10, '1ab7', '908cdd6325244cae40e315a3f7fe883e', 1, 'Student', 0),
(11, 11, '1ab8', '772ef85e8a2fc1400eced5bfd2c51389', 1, 'Student', 0),
(12, 12, '1ag1', 'f75e49b4baa28a267319dd114b8e04ea', 1, 'Student', 0),
(13, 13, '1ag2', '3b44f723115993cd70021e2fe17faf46', 1, 'Student', 0),
(14, 14, '1ag3', 'cf2440c4b34c14706bb3b18f7e6c3ae7', 1, 'Student', 0),
(15, 15, '1ag4', '269d2d2bce232d09236d4a5510b52680', 1, 'Student', 0),
(16, 16, '1ag5', 'ff002dbb9aeb7d748cf2cdf7a7087338', 1, 'Student', 0),
(17, 17, '1ag6', 'b2b92b554707684c5c92c841e135fde6', 1, 'Student', 0),
(18, 18, '1ag7', 'e962a0b298547e5846ab0ebb613bc8a1', 1, 'Student', 0),
(19, 19, '1ag8', 'f2c239f622469e51cd5925afe67f4218', 1, 'Student', 0),
(20, 20, '1ag9', '98acc9ee3c446a1468b5a07afefcc975', 1, 'Student', 0),
(21, 21, '1ag10', '11522d5dab21ae2c511debe1def5b449', 1, 'Student', 0),
(22, 22, '1ag11', 'b2bfc272d10bb87d9f5e328fffb99e0e', 1, 'Student', 0),
(23, 23, '1ag12', '46957d4eecd5edd204be8368cda39a72', 1, 'Student', 0),
(24, 24, '1ag13', 'a1ef829eaa778a153dd703e8fc03e8fa', 1, 'Student', 0),
(25, 25, '1ag14', '901754c10ddc5f8fed51799ded069451', 1, 'Student', 0),
(26, 26, '1ag15', '77f51cb1781b8e53db443c1a3f2f9389', 1, 'Student', 0),
(27, 27, '1bb1', 'c3d12783e75bec68f05497f2f1d45ad7', 1, 'Student', 0),
(28, 28, '1bb2', 'ab9c3ca88a7c375b2eec966b1b7943d0', 1, 'Student', 0),
(29, 29, '1bb3', '0790978b72d57b00d0ff3f924dc19fc1', 1, 'Student', 0),
(30, 30, '1bb4', '877670e2438b8b98b64562180184f00f', 1, 'Student', 0),
(31, 31, '1bb5', '98f99de276944ef35bdd228649bff4bc', 1, 'Student', 0),
(32, 32, '1bb6', 'efaacdb4aadf8cbcccb521e2269c46a4', 1, 'Student', 0),
(33, 33, '1bb7', 'c3f7a120e99b47e54dbb022785bd8b28', 1, 'Student', 0),
(34, 34, '1bb8', '4f176265597321f72cee77522c0bb107', 1, 'Student', 0),
(35, 35, '1bg1', '7b39e9ed5659a0a1c7af29c28aa061d1', 1, 'Student', 0),
(36, 36, '1bg2', 'fd41faf93dbff6a347b38a3e76a8862e', 1, 'Student', 0),
(37, 37, '1bg3', 'db09e8e31ec38204ed7ca8e2537b0c74', 1, 'Student', 0),
(38, 38, '1bg4', 'c35584226019dcc2bbda28d8e0afeb1c', 1, 'Student', 0),
(39, 39, '1bg5', '6f3c5fa62005ab0ccc17b8ada8cd0fb9', 1, 'Student', 0),
(40, 40, '1bg6', 'd1849ff2d4c4aac557b011da4067f1d9', 1, 'Student', 0),
(41, 41, '1bg7', '6502af222972d7724aea19654d358c9e', 1, 'Student', 0),
(42, 42, '1bg8', 'f831279ff44ad9995250dc9b644ad146', 1, 'Student', 0),
(43, 43, '1bg9', '0865597281334d3e92866f684b7303b4', 1, 'Student', 0),
(44, 44, '1bg10', '068fc9cf0749ab0989ee438558225f5c', 1, 'Student', 0),
(45, 45, '1bg11', '0d7e07d62cc860317e635ce5cbca74ee', 1, 'Student', 0),
(46, 46, '1bg12', '9c91d029e22e8a2acd133446dc508e72', 1, 'Student', 0),
(47, 47, '1bg13', 'a03d61dfa14326c31f0904b8afb9b80f', 1, 'Student', 0),
(48, 48, '1bg14', '5d32a2e394d2e94fb1996d2777341029', 1, 'Student', 0),
(49, 49, '1bg15', 'cb555a43c400787fdfc44788ba8be051', 1, 'Student', 0),
(50, 50, '1bg16', '9ccdc8fa6044e6edb2ce3f03852cead5', 1, 'Student', 0),
(51, 51, '1cb1', 'cbb894be17d041af63f35e1215cfb484', 1, 'Student', 0),
(52, 52, '1cb2', 'e7b31f9d8e9d2a8e6b92d5bbe7605be9', 1, 'Student', 0),
(53, 53, '1cb3', 'a5130236e58411c6d5a18561ffafcc1e', 1, 'Student', 0),
(54, 54, '1cb4', 'f25550c2cd98022c896198b9172b0b5f', 1, 'Student', 0),
(55, 55, '1cb5', '7a019bf3423cddbd87efe43c17f8e610', 1, 'Student', 0),
(56, 56, '1cb6', '8fd2458e86be54b5d09ba98ec6884a28', 1, 'Student', 0),
(57, 57, '1cb7', '3a765b569e2220f24a6cb8d8b7b36164', 1, 'Student', 0),
(58, 58, '1cb8', '7e32c500c4610489eade15fa98864d1c', 1, 'Student', 0),
(59, 59, '1cg1', 'd80665c0b7e3a0d206c0fd569e93dc4d', 1, 'Student', 0),
(60, 60, '1cg2', '012a2155e1d2f1637330837091705c4b', 1, 'Student', 0),
(61, 61, '1cg3', '4b516a01d12fcf0378d890c83aa59897', 1, 'Student', 0),
(62, 62, '1cg4', '8ad51a474a4fa131ab0526e1eddf1101', 1, 'Student', 0),
(63, 63, '1cg5', 'e3ef140849036691938f39ff6bc902e3', 1, 'Student', 0),
(64, 64, '1cg6', 'd12fcad9fff063037d4254e6e5892937', 1, 'Student', 0),
(65, 65, '1cg7', '4cf8e03ccb412dde9e26f58ea62635c6', 1, 'Student', 0),
(66, 66, '1cg8', 'd87c37b488ec1b3b91d996545eb6afcd', 1, 'Student', 0),
(67, 67, '1cg9', 'f03519af91815ebbbef4a51e1e188828', 1, 'Student', 0),
(68, 68, '1cg10', '3b8d23c2f09c88229b5327c1f619fd99', 1, 'Student', 0),
(69, 69, '1cg11', '301088ffff480a1d23727f509d6ab0f1', 1, 'Student', 0),
(70, 70, '1cg12', '6e5165f3d49b6cf83163a954d185aa7d', 1, 'Student', 0),
(71, 71, '1cg13', '7b4be2720df2d0b4acfd718732f156f8', 1, 'Student', 0),
(72, 72, '1cg14', 'd8ee5182a7c58607a0cb136ceeabadcc', 1, 'Student', 0),
(73, 73, '1cg15', 'da00ff9a9ef49c7e74c2e14388c22725', 1, 'Student', 0),
(74, 74, '1cg16', '7ed0bdada1f6cf8e3d628bcbdbd9f4f0', 1, 'Student', 0),
(75, 75, '1db1', '771f1888fbb539961e8b73bad7436ec1', 1, 'Student', 0),
(76, 76, '1db2', '1a8b9c8ddb422b017a728d4ad5451992', 1, 'Student', 0),
(77, 77, '1db3', '85e8e4655ad7b80183170bbd2ac59175', 1, 'Student', 0),
(78, 78, '1db4', '4e5477e4ac2847af61b7b01e202eccc9', 1, 'Student', 0),
(79, 79, '1db5', '17045aaf3c1900f0c23a619505c04b50', 1, 'Student', 0),
(80, 80, '1db6', 'c0318f937e9d09b1f2bea4836c9c70c5', 1, 'Student', 0),
(81, 81, '1db7', '8d018c4fdd696f95ea0ab44b5eeb3ebb', 1, 'Student', 0),
(82, 82, '1db8', 'a37828e1d86c11ad8da81859d2097335', 1, 'Student', 0),
(83, 83, '1dg1', '622277371104792751ce16d11a5cad61', 1, 'Student', 0),
(84, 84, '1dg2', 'cfeecbc3147cac68b4c1969ffa5557ac', 1, 'Student', 0),
(85, 85, '1dg3', '004ad79f071dc98009f64d0fbf351250', 1, 'Student', 0),
(86, 86, '1dg4', '7382b2b5e8f1ed1c56e935859c6d01da', 1, 'Student', 0),
(87, 87, '1dg5', '8650b5826f53f7b87ac8af3c5980cc38', 1, 'Student', 0),
(88, 88, '1dg6', 'f4a1071f81204d1c946f72110832bd72', 1, 'Student', 0),
(89, 89, '1dg7', 'c776402d7834b610e8ea689556540818', 1, 'Student', 0),
(90, 90, '1dg8', '98d3042b2e4233f52adc9435f5e333bf', 1, 'Student', 0),
(91, 91, '1dg9', '2cfc37a7c5e7d82c4347d311b157d33c', 1, 'Student', 0),
(92, 92, '1dg10', 'fa14625f47f010d8f7dee0899d70e0c1', 1, 'Student', 0),
(93, 93, '1dg11', 'bd61fb3a43218780a0294a67058a7090', 1, 'Student', 0),
(94, 94, '1dg12', 'f2cea6dfe2d0675f6c9fe81b9e4757c4', 1, 'Student', 0),
(95, 95, '1dg13', '5985264eea1619986a5c968d0d1fde03', 1, 'Student', 0),
(96, 96, '1dg14', '6d7cb4fec0edfd9311707cb1191e75de', 1, 'Student', 0),
(97, 97, '1dg15', '18a6d411ff90b56cf4a712a4a1841754', 1, 'Student', 0),
(98, 98, '1dg16', 'dedaa26ffdf8fd47ec0734af439afece', 1, 'Student', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `UserDetailId` int(11) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Middleinitial` varchar(1) NOT NULL,
  `DateOfBirth` varchar(50) NOT NULL,
  `Age` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `IsDeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`UserDetailId`, `Lastname`, `Firstname`, `Middleinitial`, `DateOfBirth`, `Age`, `Gender`, `IsDeleted`) VALUES
(1, 'admin', 'admin', 'a', '', '', '', 0),
(2, 'prada', 'sam', 's', '', '', '', 0),
(3, 'ebarola', 'lloyd', 'l', '', '', '', 0),
(4, 'ANORE', 'Ciego Erl Prodenz', 'A', '', '', 'Male', 0),
(5, 'AVILA', 'Enrico Miguel', 'M', '', '', 'Male', 0),
(6, 'ESMA', 'Matthew Ian', 'G', '', '', 'Male', 0),
(7, 'KYAMKO', 'Pio Nathaniel', 'F', '', '', 'Male', 0),
(8, 'OFRIL', 'Jasper Leo', 'M', '', '', 'Male', 0),
(9, 'PELIÑA', 'Zayn Airol', 'G', '', '', 'Male', 0),
(10, 'REPUNTE', 'Zachary John', '-', '', '', 'Male', 0),
(11, 'TORRALBA', 'Sebastian Iñigo', 'Y', '', '', 'Male', 0),
(12, 'ALMOROTO', 'Sophia Elizabeth', 'L', '', '', 'Female', 0),
(13, 'ALOTA', 'Alevia Margaux', 'I', '', '', 'Female', 0),
(14, 'DACALOS', 'Romina Carmel Therese', 'J', '', '', 'Female', 0),
(15, 'ENCARNACION', 'Daena Denise Dominique', 'A', '', '', 'Female', 0),
(16, 'FRANCISCO', 'Anna Ysobella', 'I', '', '', 'Female', 0),
(17, 'GO', 'Emma Adrianne', 'S', '', '', 'Female', 0),
(18, 'GORON', 'Albie Gabrielle', 'B', '', '', 'Female', 0),
(19, 'SANCHEZ', 'Shiloh Andrei', 'A', '', '', 'Female', 0),
(20, 'SARDA', 'Janaea Brianna', 'B', '', '', 'Female', 0),
(21, 'SHIN', 'Se Gyeong', 'U', '', '', 'Female', 0),
(22, 'TURA', 'Michaella Sashenka', 'E', '', '', 'Female', 0),
(23, 'TELERON', 'Rei Azelia', 'L', '', '', 'Female', 0),
(24, 'VELOSO', 'Louise Laurence', '-', '', '', 'Female', 0),
(25, 'VILLACAMPA', 'Lheureen', '-', '', '', 'Female', 0),
(26, 'ZABATE', 'Dolly Estelle', 'B', '', '', 'Female', 0),
(27, 'ARMA', 'Armani Carlos Louis', 'J', '', '', 'Male', 0),
(28, 'BATUCAN', 'Samuel Adam', 'M', '', '', 'Male', 0),
(29, 'CORTEZ', 'Niko Mark', 'S', '', '', 'Male', 0),
(30, 'EVALES', 'Enrique Johan', 'L', '', '', 'Male', 0),
(31, 'GABRIEL', 'Francis Angelo', 'M', '', '', 'Male', 0),
(32, 'GUAREN', 'Gahom Paul Emmanuelle', '-', '', '', 'Male', 0),
(33, 'MAGALLANO', 'Athan John', '-', '', '', 'Male', 0),
(34, 'REMEDIO', 'Eikken Lyle', 'L', '', '', 'Male', 0),
(35, 'APOSTOL', 'Klairina Deen', 'H', '', '', 'Female', 0),
(36, 'BARBARONA', 'Arielle Perl', 'A', '', '', 'Female', 0),
(37, 'BOLIGAO', 'Sophia Addison ', 'R', '', '', 'Female', 0),
(38, 'CABILING', 'Francis Courtney May', 'T', '', '', 'Female', 0),
(39, 'CARDENAS', 'Carla Therese', 'B', '', '', 'Female', 0),
(40, 'DE GUZMAN', 'Amber Rose Brielle', 'D', '', '', 'Female', 0),
(41, 'GONZALES', 'Stefanie Marie', 'D', '', '', 'Female', 0),
(42, 'LIBRANDO', 'Rain Cristina Mari', 'C', '', '', 'Female', 0),
(43, 'MALALUAN', 'Seanna Lexie', 'M', '', '', 'Female', 0),
(44, 'MATEO', 'Miranda Renee', 'E', '', '', 'Female', 0),
(45, 'MOFAN', 'Phaleen Riley', 'I', '', '', 'Female', 0),
(46, 'MUMAR', 'Audrey Lexine', 'G', '', '', 'Female', 0),
(47, 'SAMAR', 'Niña Camille Louise', 'F', '', '', 'Female', 0),
(48, 'SON', 'Saffi Vanicka', 'D', '', '', 'Female', 0),
(49, 'VILLACASTIN', 'Juliana Martha', 'L', '', '', 'Female', 0),
(50, 'ZAREEN', 'Aliyah', 'U', '', '', 'Female', 0),
(51, 'BASIGA', 'Cahlil Nyle', 'M', '', '', 'Male', 0),
(52, 'CRUZ', 'Marc Danniel Ross', 'L', '', '', 'Male', 0),
(53, 'GARCIA', 'Kenji Matthieu', 'T', '', '', 'Male', 0),
(54, 'LASCUÑA', 'Zachary', 'H', '', '', 'Male', 0),
(55, 'MERACAP', 'Liam Matthew', 'C', '', '', 'Male', 0),
(56, 'PAÑARES', 'Lawrence Gabriel', 'G', '', '', 'Male', 0),
(57, 'SIA', 'Sancho Rafael', 'L', '', '', 'Male', 0),
(58, 'SUNGAHID', 'Kevin James', 'M', '', '', 'Male', 0),
(59, 'AGUILLON', 'Marcia Julyanna', '-', '', '', 'Female', 0),
(60, 'AQUINO', 'Adelina Marie', 'F', '', '', 'Female', 0),
(61, 'AYO', 'Bryce Edwardine', '-', '', '', 'Female', 0),
(62, 'CANSANCIO', 'Ma. Illoiza', 'C', '', '', 'Female', 0),
(63, 'CASTAÑOS', 'Jaeian Sofia', 'G', '', '', 'Female', 0),
(64, 'CRUZ', 'Klariz Daniella', 'R', '', '', 'Female', 0),
(65, 'CUEVAZ', 'Mary Margarette', 'U', '', '', 'Female', 0),
(66, 'DELGADO', 'Sofia Illeana', 'N', '', '', 'Female', 0),
(67, 'ESCUDERO', 'Eliza Denise', 'G', '', '', 'Female', 0),
(68, 'GIUFFRE', 'Xrystaline Julia', 'M', '', '', 'Female', 0),
(69, 'MAHINAY', 'Tameka Zuri', 'S', '', '', 'Female', 0),
(70, 'MAI', 'Sitti Sophia', 'M', '', '', 'Female', 0),
(71, 'NOLASCO', 'Chloe Carmel', 'S', '', '', 'Female', 0),
(72, 'QUISIMBING', 'Myra Ashley Nicole', 'R', '', '', 'Female', 0),
(73, 'ROMERO', 'Isabella Alessandra', 'A', '', '', 'Female', 0),
(74, 'SAMBILAD', 'Queneerich', 'D', '', '', 'Female', 0),
(75, 'CANTALEJO', 'Charlie', 'R', '', '', 'Male', 0),
(76, 'ESPAÑOLA', 'Dan Ceasar', 'S', '', '', 'Male', 0),
(77, 'GOMANDOY', 'Oved', 'C', '', '', 'Male', 0),
(78, 'LEOPARDAS', 'Sean Patrick', 'C', '', '', 'Male', 0),
(79, 'PANCHO', 'Brent Kean Raphael', 'E', '', '', 'Male', 0),
(80, 'RONATO', 'Czar Joaquin', 'P', '', '', 'Male', 0),
(81, 'TO ', 'Aleck Xian', 'L', '', '', 'Male', 0),
(82, 'VILLARUEL', 'Miguel', 'N', '', '', 'Male', 0),
(83, 'ADORA', 'Chelsey', 'D', '', '', 'Female', 0),
(84, 'ARANETA', 'Giorgina Ysabelle', 'C', '', '', 'Female', 0),
(85, 'ARCUENCO', 'Jielia Barachiel', 'A', '', '', 'Female', 0),
(86, 'BALDOMERO', 'Lysanndra', 'B', '', '', 'Female', 0),
(87, 'BIOLENA', 'Audris Mikhaela', 'T', '', '', 'Female', 0),
(88, 'CUPIN', 'Kendra Nadine', 'B', '', '', 'Female', 0),
(89, 'DE VERA', 'Adam Marchessa', '-', '', '', 'Female', 0),
(90, 'GO ', 'Samantha Alexys', 'B', '', '', 'Female', 0),
(91, 'KHO', 'Therecia Bree', 'C', '', '', 'Female', 0),
(92, 'MADRANGCA', 'Shylint ', 'L', '', '', 'Female', 0),
(93, 'ORAIS', 'Andrea Faye', 'G', '', '', 'Female', 0),
(94, 'PARK', 'Yuna', 'M', '', '', 'Female', 0),
(95, 'RENDON', 'Sophia Noelle', 'C', '', '', 'Female', 0),
(96, 'SAYRUDDIN', 'Kendra Chastine', 'C', '', '', 'Female', 0),
(97, 'VILLANUEVA', 'Kelly Margareth', 'Q', '', '', 'Female', 0),
(98, 'YONGOT', 'Rhozerel', 'A', '', '', 'Female', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookId`);

--
-- Indexes for table `bookcategory`
--
ALTER TABLE `bookcategory`
  ADD PRIMARY KEY (`BookCategoryId`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`ExamId`);

--
-- Indexes for table `examresult`
--
ALTER TABLE `examresult`
  ADD PRIMARY KEY (`ExamResultId`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`GameId`);

--
-- Indexes for table `gamecategory`
--
ALTER TABLE `gamecategory`
  ADD PRIMARY KEY (`GameCategoryId`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ReportId`);

--
-- Indexes for table `studentlist`
--
ALTER TABLE `studentlist`
  ADD PRIMARY KEY (`StudentListId`);

--
-- Indexes for table `teacherclass`
--
ALTER TABLE `teacherclass`
  ADD PRIMARY KEY (`TeacherClassId`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`TravelId`);

--
-- Indexes for table `travelcategory`
--
ALTER TABLE `travelcategory`
  ADD PRIMARY KEY (`TravelCategoryId`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`UserAccountId`);

--
-- Indexes for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD PRIMARY KEY (`UserDetailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `BookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `bookcategory`
--
ALTER TABLE `bookcategory`
  MODIFY `BookCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `ExamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=684;

--
-- AUTO_INCREMENT for table `examresult`
--
ALTER TABLE `examresult`
  MODIFY `ExamResultId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `GameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gamecategory`
--
ALTER TABLE `gamecategory`
  MODIFY `GameCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ReportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `studentlist`
--
ALTER TABLE `studentlist`
  MODIFY `StudentListId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `teacherclass`
--
ALTER TABLE `teacherclass`
  MODIFY `TeacherClassId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
  MODIFY `TravelId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `travelcategory`
--
ALTER TABLE `travelcategory`
  MODIFY `TravelCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `UserAccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `userdetail`
--
ALTER TABLE `userdetail`
  MODIFY `UserDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
