-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2018 at 09:27 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `asset_data`
--

CREATE TABLE `asset_data` (
  `assetId` int(11) NOT NULL,
  `termsConditions` text NOT NULL,
  `usagePolicy` text NOT NULL,
  `copyright` text NOT NULL,
  `disclaimer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_data`
--

INSERT INTO `asset_data` (`assetId`, `termsConditions`, `usagePolicy`, `copyright`, `disclaimer`) VALUES
(1, 'Terms And Conditions Description', 'Usage Policy Description', 'Copyright Description', 'Disclaimer Description');

-- --------------------------------------------------------

--
-- Table structure for table `category_data`
--

CREATE TABLE `category_data` (
  `catId` int(11) NOT NULL,
  `catName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_data`
--

INSERT INTO `category_data` (`catId`, `catName`) VALUES
(1, 'Faculty'),
(2, 'Part-Time'),
(3, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `cur_data`
--

CREATE TABLE `cur_data` (
  `curId` int(11) NOT NULL,
  `curYear` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cur_data`
--

INSERT INTO `cur_data` (`curId`, `curYear`) VALUES
(1, '2018-2019'),
(2, '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `deptjunc_data`
--

CREATE TABLE `deptjunc_data` (
  `deptjuncId` int(11) NOT NULL,
  `deptId` int(11) NOT NULL,
  `programId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deptjunc_data`
--

INSERT INTO `deptjunc_data` (`deptjuncId`, `deptId`, `programId`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 4, 4),
(5, 3, 5),
(6, 4, 6),
(7, 6, 7),
(8, 5, 8);

-- --------------------------------------------------------

--
-- Table structure for table `dept_data`
--

CREATE TABLE `dept_data` (
  `deptId` int(11) NOT NULL,
  `deptTitle` varchar(64) NOT NULL,
  `deptStat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept_data`
--

INSERT INTO `dept_data` (`deptId`, `deptTitle`, `deptStat`) VALUES
(1, 'Information Communication Technology', 1),
(2, 'Hotel and Tourism Management', 1),
(3, 'Criminology', 1),
(4, 'Teacher Education', 1),
(5, 'Business Education', 1),
(6, 'College of Arts and Sciences', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_data`
--

CREATE TABLE `enrollment_data` (
  `enrollmentId` int(11) NOT NULL,
  `elementary` int(11) NOT NULL,
  `highSchool` int(11) NOT NULL,
  `college` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment_data`
--

INSERT INTO `enrollment_data` (`enrollmentId`, `elementary`, `highSchool`, `college`) VALUES
(1, 200, 600, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `events_data`
--

CREATE TABLE `events_data` (
  `eventId` int(11) NOT NULL,
  `eventDate` date NOT NULL,
  `eventTitle` varchar(128) NOT NULL,
  `eventWhere` varchar(128) NOT NULL,
  `eventDesc` text NOT NULL,
  `eventImage` varchar(128) NOT NULL,
  `eventPost` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_data`
--

INSERT INTO `events_data` (`eventId`, `eventDate`, `eventTitle`, `eventWhere`, `eventDesc`, `eventImage`, `eventPost`) VALUES
(6, '2017-11-30', 'Intramurals', 'DJEMFCST', 'This school event is necessarily to all school its called Intramurals that celebrate in different school once a year. ', '87878i7.jpg', '2018-11-09'),
(7, '2018-11-30', 'Ms Intramurals', 'DJEMFCST', 'This part of school event is called Ms.Intramurals will be held once a year.', 'dfsfsff.jpg', '2018-11-09'),
(8, '2018-09-20', 'ICT Days', 'Dinagat Islands', 'ICT days that held by the Department of ICT.', '20160715_070044.jpg', '2018-11-09'),
(9, '2018-11-02', 'Group Dance', 'Dinagat Islands', 'A Group Dance of school event are very interesting and enjoyable.Its very popular or common in different school.', 'imasdsefsees.jpg', '2018-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `facpos_data`
--

CREATE TABLE `facpos_data` (
  `posId` int(11) NOT NULL,
  `posName` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facpos_data`
--

INSERT INTO `facpos_data` (`posId`, `posName`) VALUES
(1, 'Program Head'),
(2, 'Dean'),
(3, 'Instructor');

-- --------------------------------------------------------

--
-- Table structure for table `facultyjunc_data`
--

CREATE TABLE `facultyjunc_data` (
  `facultyjuncId` int(11) NOT NULL,
  `facultyId` int(11) NOT NULL,
  `deptId` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `posId` int(11) NOT NULL,
  `qualId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facultyjunc_data`
--

INSERT INTO `facultyjunc_data` (`facultyjuncId`, `facultyId`, `deptId`, `catId`, `posId`, `qualId`) VALUES
(1, 1, 1, 1, 2, 1),
(2, 2, 1, 1, 3, 2),
(3, 3, 1, 1, 3, 3),
(4, 4, 1, 1, 3, 4),
(5, 5, 6, 1, 3, 5),
(6, 6, 5, 1, 2, 6),
(7, 7, 5, 1, 3, 7),
(8, 8, 5, 1, 3, 8),
(9, 9, 5, 1, 3, 9),
(10, 10, 5, 1, 3, 10),
(11, 11, 3, 1, 3, 11),
(12, 12, 3, 1, 2, 12),
(13, 13, 3, 1, 3, 13),
(14, 14, 4, 1, 3, 14),
(15, 15, 4, 1, 3, 15),
(16, 16, 2, 1, 2, 16),
(17, 17, 2, 1, 3, 17),
(18, 18, 2, 1, 3, 18),
(19, 19, 2, 1, 3, 19),
(20, 20, 4, 1, 3, 20),
(21, 21, 4, 1, 3, 21),
(22, 22, 4, 1, 3, 22),
(23, 23, 4, 1, 3, 23),
(24, 24, 4, 1, 3, 24),
(25, 25, 4, 1, 3, 25),
(26, 26, 4, 1, 3, 26),
(28, 28, 4, 1, 3, 28),
(29, 29, 4, 1, 3, 29),
(30, 30, 4, 1, 3, 30),
(31, 31, 5, 1, 3, 31),
(32, 32, 0, 2, 3, 32),
(33, 33, 4, 1, 3, 33),
(34, 34, 4, 1, 3, 34),
(35, 35, 4, 1, 3, 35),
(36, 36, 4, 1, 2, 36),
(37, 37, 6, 1, 2, 37),
(38, 38, 4, 1, 3, 38),
(39, 39, 4, 1, 3, 39),
(40, 40, 4, 1, 3, 40);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_data`
--

CREATE TABLE `faculty_data` (
  `facultyId` int(11) NOT NULL,
  `firstName` varchar(32) NOT NULL,
  `middleName` varchar(10) NOT NULL,
  `lastName` varchar(32) NOT NULL,
  `Image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_data`
--

INSERT INTO `faculty_data` (`facultyId`, `firstName`, `middleName`, `lastName`, `Image`) VALUES
(1, 'Jhesorley', 'Magana', 'Laid', 'LAID,Jhesorley.jpg'),
(2, 'Jerson', 'Ocon', 'Maneja', 'MANEJA,Jerson.jpg'),
(3, 'Robert Jhun', 'Villapaz', 'Lagang', 'LAGANG,Robert Jhun.jpg'),
(4, 'Aldrin', 'Clutario', 'Tasong', 'TASONG,Aldrin.jpg'),
(5, 'Christian', 'A', 'Felicilda', 'FELICILDA,Christian.jpg'),
(6, 'Rita', 'T', 'Arcala', '20937767_10212956424160519_1385325157_n.jpg'),
(7, 'Maryland', 'E', 'Busano', 'maryland.jpg'),
(8, 'Desiree Queen ', 'T', 'Arcala', 'Arcala,Desiree Queen T..jpg'),
(9, 'Rahker', 'C', 'Cortes', 'Rahker.jpg'),
(10, 'Robert', 'M', 'Urbuda', 'URBUDA,Robert M..jpg'),
(11, 'Donald', 'G', 'Lecciones', 'LECCIONES,Donald.jpg'),
(12, 'Joel Jr', 'L', 'Siarez', 'SIAREZ,Joel Jr. L..jpg'),
(13, 'Renrich', 'C', 'Taypa', 'TAYPA,Renrich.jpg'),
(14, 'Lolita', 'A', 'Dela Pena', 'DELA PENA,Lolita.jpg'),
(15, 'Nancy', 'P', 'Arubo', 'ARUBO,Nancy.jpg'),
(16, 'Hazel', 'R', 'Berte', 'BERTE,Hazel.jpg'),
(17, 'Jubie', 'P', 'Solina', '20937694_10212956422080467_1907459780_n.jpg'),
(18, 'Rex', 'T', 'Pasquil', 'PASQUIL,Rex.jpg'),
(19, 'Robin ', 'M', 'Dypiangco', 'robin.jpg'),
(20, 'Aiza', 'Q', 'Dayoc', 'DAYOC,Aiza.jpg'),
(21, 'Gladdes', 'O', 'Blangco', 'BLANCO,Gladdes.jpg'),
(22, 'Doncie', 'P', 'Paquibot', 'PAQUIBOT,Doncie.jpg'),
(23, 'Yolanda', 'C', 'Tasil', 'TASIL,Yolanda.jpg'),
(24, 'Jhenibabes', 'L', 'Eviota', 'EVIOTA,Jhenibabes.jpg'),
(25, 'Jenyvieve', 'O', 'Amanduron', 'AMANDORON,Jenyvieve.jpg'),
(26, 'Lovely', 'O', 'Blangco', 'BLANCO,Lovely.jpg'),
(28, 'Claire Ann', 'A', 'Antipeusto', 'ANTIPUESTO,Claire.jpg'),
(29, 'Janeth', 'M', 'Marzan', 'MARZAN,Janeth.jpg'),
(30, 'Ravelyen', 'C', 'Monato', 'MONATO,Ravelyen.jpg'),
(31, 'Rita', 'N', 'Ampatin', 'LOGO.jpg'),
(32, 'Danilo', 'C', 'Bulabos', 'FB_IMG_1538718842517.jpg'),
(33, 'Beatriz', 'C', 'Divinagracia', 'DIVINAGRACIA,Beatriz C..jpg'),
(34, 'Kevin Jhon', 'O', 'Durango', 'DURANGO,Kevin.jpg'),
(35, 'Kheam', 'L', 'Lulab', 'LULAB,Kheam.jpg'),
(36, 'Ann', 'O', 'Tibe', 'TIBE,Ann O..jpg'),
(37, 'Marichu', 'M', 'Esnardo', 'ESNARDO,Marichu.jpg'),
(38, 'Fidylou', 'D', 'Morala', 'MORALA,Fidylou.jpg'),
(39, 'Keevin', 'Cofino', 'Lindayao', 'LINDAYAO,Keevin.jpg'),
(40, 'Danilo', 'Cabesas', 'Bulabos', 'bulabos.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_data`
--

CREATE TABLE `gallery_data` (
  `galleryId` int(11) NOT NULL,
  `galleryName` varchar(64) NOT NULL,
  `galleryDesc` text NOT NULL,
  `galleryImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_data`
--

INSERT INTO `gallery_data` (`galleryId`, `galleryName`, `galleryDesc`, `galleryImage`) VALUES
(1, 'Awarding Night', 'overall champion  in Intramurals', 'DSC_1019.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `history_data`
--

CREATE TABLE `history_data` (
  `historyId` int(11) NOT NULL,
  `historyYear` varchar(32) NOT NULL,
  `historyDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_data`
--

INSERT INTO `history_data` (`historyId`, `historyYear`, `historyDesc`) VALUES
(1, '1980-1982', '       The birth of the first and the only existing Higher Educational Institution in the Province of Dinagat Islands was on the  year 1980. It  was founded by Dr. Glenda B. Ecleo through the desire of Hon. Ruben E. Ecleo, Sr., the Supreme President of Philippine Benevolent Missionaries Association, Inc., (P.B.M.A.) â€œto educate his peopleâ€. The pilot name of the institution was Marcos- Romualdez College (MRC).</The academic programs being offered were Liberal Arts,Bachelor of   Science in Commerce and Junior Secretarial.  In the same year, classes were temporarily conducted at Barangay Cultural Center for there was no school building yet, having one hundred thirty-eight (138) total enrollees. However, the name   Marcos-Romualdez  College failed   to   secure registration from the  Securities and Exchange Commission (SEC). Hence, Mr. Rudy O. Buray, brother of the School Founder, suggested Don Jose Ecleo   Memorial Educational Foundation to be the name of the institution.It was on the 30th of April, 1982 when Private Schools Area Supervisor II, MECS, Region X, Cagayan de Oro City Dr. Violeta B. Omega, conducted an ocular inspection to the institution. The name Don Jose Ecleo Memorial Educational Foundation (DJEMF) was officially registered to SEC and the school was permitted to operate. The first Commencement Exercises was on the 19th of March 1985; there were one hundred twenty-four (124) Liberal Arts and six (6) Electronics pioneering graduates.Bachelor of Science in Elementary Education (BSEEd), Bachelor of   Science in Secondary Education (BSSEd), Bachelor of Science in Commerce (BSC) were offered and recognized by the Commission on Higher Education by the year 1989 at the same time, the Department of Education, Culture and Sports (DECS) issued Recognition for the operation of Secondary  Education (High School) during the  administration of Mr. Jesus A. Jariol, a retired District Supervisor. Mrs. Lucila B. Borci, assumed her office as Officer â€“In-Charge of the foundation on June 1990 to 1992. Dr. Violeta B. Omega, a retired Public Schools Area Supervisor II of the DECS Region X, Cagayan de Oro City, assumed her office as School Director on June 1993.The name Don Jose Ecleo Memorial Foundation (DJEMF) was converted into Don Jose Ecleo Memorial Foundation College of Science and Technology (DJEMFCST) on June 8, 1994. The school offered Pre-school and Elementary Education, to complete the foundation of education and as a laboratory school for Teacher Education in the year 1999. On the same year, the school participated in the National Search for the Best Volunteerism Project, a project of President Joseph E. Estrada. The school was the Regional Winner and rank 8 in the National Level Competition.  Dr. Violeta B. Omega, School Director and Dr. Pacita T. Orbita, School  Administrator, went to Malacanang Palace to receive the  Â  trophy and the cash prize. The school was accredited as TESDA Testing Center on  Dinagat Area on the mid-year of 2002. On the same year, TESDA commended DJEMFCST for winning three major awards in the IT competition in Surigao City, during the TVET Month Provincial Skills Competition  sponsored by TESDA with Dr. Ann O. Tibe, the Technical Vocational Head. The school was accredited as TESDA Testing Center on  Dinagat Area on the mid-year of 2002. On the same year, TESDA commended DJEMFCST for winning three major awards in the IT competition in Surigao City, during the TVET Month Provincial Skills Competition  sponsored by TESDA with Dr. Ann O. Tibe,the Technical Vocational Head. Despite the catastrophe that struck the school, the  administration, faculty and staff stayed strong and united.Upon the instruction of Dr. Glenda B. Ecleo on May 2003, the School Director with the administrators were able to restart the school operation. The new school building was built in its new school site at Purok 5 Barangay Justiniana, San Jose, Surigao del Norte. The barangay was named in  honor of the beloved wife of Don Jose Edera Ecleo, the parent of Hon. Ruben Edera Ecleo, Sr., the P.B.M.A. Supreme President and Founder. The new gymnasium was utilized as temporary classrooms.'),
(2, '2003-2004', 'The institution offered the 6-Month Caregiver NC II course, under the TESDA programs, with Certificate of Registration WTR# 0315032061.'),
(3, '2004-2005', '           here were apparent improvements in terms of faculty and staff  upliftments, physical plant facilities, support and auxiliary services and   curriculum delivery. As a proof of its quality education services, the DJEMFCST garnered seven (7) gold medals, one (1) silver medal and three (3) bronze medals during the 2001 TVET Months Skills Competition in celebration of TESDAâ€™s 10th  anniversary. Moreover, the new Library Building and Guidance Office were inaugurated and came to function on the same academic year.June, 2005. The college was proud to offer Bachelor of Secondary Education (BSEd) major in Biology and General Science along with the investiture of the New Science Laboratory Building, the new building of the Department of the Student Affairs, and the classrooms for Elementary Classes.'),
(4, '2005-2006', '        To advance schoolâ€™s student services, various scholarship   programs were offered to poor but deserving students. Students graduated under the following scholarship grants, such as:TESDA-PESFA grantees in ITM TESDA-ADP grantees in Nursing Aide Congressional grantees in Baccalaureate Courses ESC Scholars in High School.'),
(5, '2006-2007', '       Tech Voc Department applied for UTPRAS the 3-year Hotel and Restaurant Management (HRM) program.  It was approved and offered on the same year.<br>May 2006 DJEMFCST Deans and office heads had its Lakbay-Aral at  Â  Cagayan de Oro and Camiguin Islands May 26, 2006 The National Certificate of TVET Program Registration was  issued for the One-Year in Food Beverage Service Attendant NC II; with COPR:<br><br> WTR # 0615032007.November 30, 2006.Â As per CHED mandate, the collegeâ€™s Bachelor of Science in Commerce (BSC) was converted into Bachelor of Science in Business  Administration (BSBA) with the following majors: Marketing Management<br>Financial Management <br>Operation Management<br>May 17, 2007.The National Certificate of TVET Program Registration was granted to DJEMFCST for the following Ladderized Education Programs (LEP):<br>PC Operation NC II ; <br><br> WTR # 0715032115<br>Computer Hardware Servicing NC II ; WTR #  0715032116 Computer Programming NC IV ; WTR # 0715032117<br>Housekeeping NC II ;WTR # Bartending NC II ; WTR # 071503214 June 7, 2007 Dr. Pacita T. Orbita assumed her office as an OIC-School  Director.February 6, 2008. The Bachelor of Science in Accounting Technology (BSAT) was permitted by CHED to operate for First Year Level.December 2, 2008. The National Certificate of TVET Program Registration was granted to DJEMFCST for the following programs:<br><br> Health Care Services NC II WTR # 0815032077 Household Services NC II WTR # 0815032075 Tourism Promotion Services NC II WTR # 0815032076 Tour Guiding Services NC II WTR # 0815032079 Front office Services NC II WRT # 0815032078 May, 2009 In this year, the Bachelor of Science in Hotel and Restaurant  Management (BSHRM), Bachelor of Science in Tourism Management (BSTM), Bachelor of Science in Computer Science (BSCS) and Bachelor of   Science in Information Technology (BSIT) programs submitted application requirements for permit to operate under the leadership of Dr. Pacita T.  Orbita, OIC-School Director.'),
(6, '2011-2012', '         The College offered and started its operation with the following programs:<br>Bachelor of Science in Criminology (BSCRIM), and<br>Bachelor of Science in Civil engineering (BSCE) DJEMFCST Faculty and staff bench marked to colleges and  universities in Cebu and Bohol on May 2011.October, 2013.The Campus Journalism for college was organized under the Publication Office and first circulates its first magazine issue with the Zephyrs as the Official Student Publication of the school with Loejun Y. Patual as Editor-in-Chief.'),
(7, '2014-2015', '        DJEMFCST was a recipient of the Department of Trade and Industry (DTI) Shared Service Facility (SSF) with nine hundred ninety-six thousand pesos (P 996,000.00) worth of facilities.The two million (P2 M) worth Speech Laboratory of the school was installed. DJEMFCST Faculty and staff had its Team Building/Wellness Program at Boracay on April 2015.Academic Year 2015-2016 DJEMFCST ROTC won as first placer during the Regional Tactical Inspection.'),
(8, '2016-2017', '        The two-storey, six classroom building for Senior High School was  constructed.<br>Pasalamat Festival was organized to give tribute to Don Jose on January 16, 2016. This festival is celebrated every five years.<br><br>DJEMFCST ROTC defended being the first placer during the  Regional Tactical Inspection.The Senior High School Program was implemented on June 2016 under the DepEd K-12 Curriculum with the following tracks:Academic:<br><br>Science Technology Engineering and Mathematics (STEM)<br>Humanities and Social Sciences (HUMSS)<br>Accounting Business and Management (ABM)<br>Technical Vocational and Livelihood (TVL)<br>Electrical Installation and Maintenance NCII<br>Computer System Servicing NCII<br>Computer Programming NCII<br>Bread and Pastry Production NCII, Food Beverages  Services NCII and Cookery NCII<br>Local Guiding Services NCII, Front Office Services NCII, Housekeeping NCII and Wellness Massage NCII.'),
(9, '2017-2018', '        The DJEMFCST Deans, Program coordinators and office heads embarked to its first international, ASEAN Tour at Beijing, China on   October 2017.</p><p>â€ƒâ€ƒOn January 30, 2018 the ESC Quality Assurance Team conducted ocular inspection to the Junior High School Department of DJEMFCST and awarded the re-certification status on April 2018. There were ninety seven (97) pioneering Senior High School graduates on March 29, 2018. DJEMFCST started the construction of the school covered court and school canteen on April 2018.On May 28, 2018 the Professional Regulation Commission (PRC) in cooperation with the Commission on Higher Education (CHED) conducted National Monitoring and Evaluation to the BS Criminology Department with an overall evaluation rating of 96.5%.'),
(10, '2018-2019', '       On June 4, 2018 the Civil Service Commission (CSC) assessed DJEMFCST as prospect testing center for Civil Service Exam- Paper and Pencil Test (Sub-Professional Level) for year 2019.');

-- --------------------------------------------------------

--
-- Table structure for table `imagetemp_data`
--

CREATE TABLE `imagetemp_data` (
  `tempId` int(11) NOT NULL,
  `tempImage` varchar(255) NOT NULL,
  `fromId` int(11) NOT NULL,
  `fromTable` varchar(64) NOT NULL,
  `fromName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagetemp_data`
--

INSERT INTO `imagetemp_data` (`tempId`, `tempImage`, `fromId`, `fromTable`, `fromName`) VALUES
(1, 'DSC_1019.JPG', 1, 'gallery_data', 'Awarding Night'),
(2, '87878i7.jpg', 6, 'events_data', 'Intramurals'),
(3, '20160715_070044.jpg', 8, 'events_data', 'ICT Days'),
(4, 'imasdsefsees.jpg', 9, 'events_data', 'Group Dance'),
(5, 'dfsfsff.jpg', 7, 'events_data', 'Ms Intramurals'),
(9, 'b.jpg', 1, 'news_data', 'Back To School'),
(10, 'imazdfsdfsges.jpg', 3, 'news_data', 'The Main Campus'),
(11, 'zczcz.jpg', 4, 'news_data', 'School News'),
(12, 'manila-news-philippine-flood.jpg', 7, 'news_data', 'Weather News'),
(13, 'imagdfsdfsfes.jpg', 2, 'news_data', 'Formal Occasion');

-- --------------------------------------------------------

--
-- Table structure for table `message_data`
--

CREATE TABLE `message_data` (
  `messageId` int(11) NOT NULL,
  `messageName` varchar(128) NOT NULL,
  `messagePos` varchar(64) NOT NULL,
  `messageDesc` text NOT NULL,
  `messageImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_data`
--

INSERT INTO `message_data` (`messageId`, `messageName`, `messagePos`, `messageDesc`, `messageImage`) VALUES
(1, 'Dr. Pacita T. Orbita', ' President', '<p></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>&nbsp;&nbsp;&nbsp; As </i><b><i>Don Josenians</i></b><i>, you are expected to abide the policies and procedures, espouse order and discipline and uphold DJEMFCSTâ€™s &nbsp;  vision and mission. While studying at DJEMFCST, you will encounter a variety of challenges that will open more doors of opportunities and self-discoveries. It will solely be your option to grab or to miss out on those chances for self-improvement.</i></p><p><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please read this Handbook in earnest and follow the guidelines to &nbsp;  direct you in your quest for knowledge in the most conductive manner and to comfort yourself in a way that is both fitting and admirable. With school heads, faculty  members and staff supporting you, DJEMFCST is ever ready to serve you.  We will help to facilitate your growth in every facet of your life. To make your stay prolific and momentous at DJEMFCST, we encourage you to excel in all your endeavors.</i></p><p></p>', 'ORBITA,Pacita.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `news_data`
--

CREATE TABLE `news_data` (
  `newsId` int(11) NOT NULL,
  `newsDate` date NOT NULL,
  `newsTitle` varchar(128) NOT NULL,
  `newsDesc` text NOT NULL,
  `newsImage` varchar(128) NOT NULL,
  `newsPost` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_data`
--

INSERT INTO `news_data` (`newsId`, `newsDate`, `newsTitle`, `newsDesc`, `newsImage`, `newsPost`) VALUES
(1, '2018-08-09', 'Back To School', 'A school is an institution designed to provide learning spaces and learning environments for the teaching of students (or "pupils") under the direction of teachers..\r\n<br>\r\n<br>\r\nWhat: "General Pahina"\r\n<br>\r\n<br>\r\nWhere: DJEMFCST\r\n<br>\r\n<br> \r\nWHEN: Monday 8:00 Am M \r\n<br>\r\n<br>\r\n  All Students must bring bolo, sack, walis, tambo..', 'b.jpg', '2018-11-09'),
(2, '2018-11-18', 'Formal Occasion', 'At this day happens the Final defense of 4th Year ICT department.', 'imagdfsdfsfes.jpg', '2018-11-09'),
(3, '2018-11-09', 'The Main Campus', 'The Campus of Don Jose Ecleo Memorial Foundation College of Science and Technology(DJEMFCST)  are under construction because there is a New Building  arise and a covered court in front of the stage for the student to have a proper and organize event and have a formal venue for occasion.    ', 'imazdfsdfsges.jpg', '2018-11-09'),
(4, '2018-11-09', 'School News', 'The Don Jose Ecleo Memorial Foundation college of Science and Technology (DJEMFCST) Post Headlines About All Requirements of student in  Clearance  must be Comply during Clearances..', 'zczcz.jpg', '2018-11-09'),
(5, '2018-11-20', 'Sport News', 'The Don Jose Ecleo Memorial Foundation College of Science and Technology (DJEMFCST) are Select an Athletics For PRESAA,The Different Sports to be Try out are:\r\n<br>\r\n<br>\r\n \r\nBasketball\r\n<br>\r\nVolleball \r\n<br>\r\nChess\r\n<br>\r\nSwimming\r\n<br>\r\nBadminton\r\n', 'indexasdaw.jpg', '2018-11-09'),
(6, '2018-11-24', 'School News', 'The Don Jose Ecleo Memorial Foundation College of Science and Technology (DJEMFCST), The students  are not Allowed to enter The Class without proper Uniform,School ID,\r\n', 'indzczdfzdfex.jpg', '2018-11-09'),
(7, '2018-11-09', 'Weather News', 'The Don Jose Are suspended the class Because There is a Super Typhoon Yolanda', 'manila-news-philippine-flood.jpg', '2018-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `programgallery_data`
--

CREATE TABLE `programgallery_data` (
  `galleryId` int(11) NOT NULL,
  `galleryName` varchar(64) NOT NULL,
  `galleryDesc` text NOT NULL,
  `galleryImage` varchar(255) NOT NULL,
  `galleryProgram` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programgallery_data`
--

INSERT INTO `programgallery_data` (`galleryId`, `galleryName`, `galleryDesc`, `galleryImage`, `galleryProgram`) VALUES
(1, 'BSHM Day''s', 'Bachelor of Science in Hospitality Management (BSHM) celebrate 8th foundation day.', 'BSHM.jpg', 'BSHM'),
(3, 'HMTOUR DAYS', '<b><i>War of chief''s during there HM congress.&nbsp;</i><i></i></b>', 'FB_IMG_15417569538423607.jpg', 'BSHM'),
(4, 'Criminology Night', '<p>Criminology night held @ Cuarinta Function Hall</p>', 'FB_IMG_15417585114320792.jpg', 'BSCrim'),
(5, 'Teachers Day Celebration', 'TEACHERS DAY', 'FB_IMG_15417581722907368.jpg', 'BEEd'),
(6, 'Teacher Day celebtation', '<p>TEACHER DAY</p>', 'FB_IMG_15417581974074026.jpg', 'BSEd'),
(7, '8TH BUSINESS DAYS', '<p>BSBA Concert for Walk for a Cause.</p>', 'FB_IMG_15408053166913852.jpg', 'BSBA'),
(8, 'CAS DAYS CELEBRATION', '<p>EPIC NIGHT Of CAS held @ Aurelio Gym wearing their Costume .</p>', 'FB_IMG_15417578214984001.jpg', 'AB'),
(9, 'ICT DAYS', '<br>7th ICT Days Celebration"Â The Group III "Team Yokai" walk in the High way under the sun with beautiful smile and everyone enjoy.however the other group was busy talking while walking..Â \r\n<br', '20160715_071646.jpg', 'BSIT'),
(10, 'ICT DAYS', '<p>7th ICT Days Celebration&nbsp;</p><p>After the parade was the Activities, the Group III Team Yokai was afraid of Ice basket Challenge because everyone he/she didn''t know after putting a one container of very cold water.&nbsp; &nbsp; &nbsp;</p>', '20160716_102620.jpg', 'BSIT'),
(11, 'Humanities  field trip', '<p>ICT students have a field trip to bababu lake in Humanities subject,everyone are excited to go there.Its hard to go to the lake because the road is so very rough and tiny,but instead of tiring it is very enjoyable and very interesting.</p>', 'A20150906_075520.jpg', 'BSIT'),
(12, 'ICT DAYS', '<p>9th ICT DAYS&nbsp;</p><p>This picture taken last August 15 while walking this group was so happy and excited of the other event .&nbsp;</p>', 'FB_IMG_15373051570248129.jpg', 'BSIT'),
(13, 'State of the Province Address 2018', '<p>State of the Province address 2018 Gov.Glenda B. Ecleo. Ed,D..The BSHM access the Snack while the Speaker Speech..</p>', 'FB_IMG_15409402671752443.jpg', 'BSHM'),
(14, 'HMTOUR DAYS', '8th HMTOUR DaysÂ The Big 3 of HMTOUR with other  2 contestant during there Activities..', 'FB_IMG_15417571645240074.jpg', 'BSHM'),
(15, 'Ms Chief & Mr Chief', 'This three contingent was the participating team of Don Jose are Believe there Self to get the Medals.', 'FB_IMG_15417568440151698.jpg', 'BSTM'),
(16, 'HMTOUR DAYS', '<p>During the 8th HMTOUR Days Dance Under the Sun&nbsp;</p>', 'FB_IMG_15417565744955824.jpg', 'BSTM'),
(17, 'HMTOUR DAYS', '<p>During 8th HMTOUR Days the judges take a picture with this group..everyone was happy..</p>', 'adc.jpg', 'BSTM'),
(18, 'HMTOUR DAYS', '<p>During the 8th HMTOUR Days This group fight for there salvation and also fight for gold</p>', 'weqa.jpg', 'BSTM'),
(21, 'Criminology Night', '<p>#six Handsome Instructor of Criminology take a picture during the event..&nbsp;&nbsp;</p>', 'FB_IMG_15417584736247319.jpg', 'BSCrim'),
(22, 'Criminology Night', '<p>#Criminology picture taking after the event @ cuarinta function hall.</p>', 'FB_IMG_15417584281129692.jpg', 'BSCrim'),
(23, 'Pre-Oral', '<p>#Criminology Pre-oral&nbsp;</p>', 'FB_IMG_15417580870702462.jpg', 'BSCrim'),
(24, 'Happy Together', '<p>Groufie because its Teacher`s Day</p>', 'FB_IMG_15417582519089339.jpg', 'BEEd'),
(25, 'CAS Days', 'Morning EventsÂ in School Campus', 'FB_IMG_15408057183935203.jpg', 'AB'),
(27, 'Ms. Intramural 2017  ', 'Ms. Chanrah Bohol from Education Department', 'Shanrah.jpg', 'BEEd'),
(28, 'Ms. Intramural 2017  ', 'Ms.Ella Ambat from Business Education Department', 'Ella.jpg', 'BSBA'),
(29, 'Ms. Intramural 2017  ', 'from College of Arts Department', 'CAS Dept.jpg', 'AB'),
(30, 'Intramurals Awarding Night', 'Business Education Department', 'BSba.jpg', 'BSBA'),
(31, 'Intramurals Awarding Night', 'Teacher Education Department', 'Educ.jpg', 'BEEd'),
(32, 'Intramurals Awarding Night', 'College of Arts Department', 'CAS.jpg', 'AB'),
(33, 'Intramurals Night Event', '<p>Business Education Department Standard Dance Competition</p>', 'BA.jpg', 'BSBA'),
(34, 'Intramurals Night Event', 'Teacher Education Department Standard Dance Competition', 'Ed.jpg', 'BSEd'),
(35, 'Ms. Intramural 2017  ', 'Ms.Chanrah Bohol for her Athletic CostumeÂ ', 'ghgggg.jpg', 'BSEd'),
(36, 'Intramurals Awarding Night', 'The ICT Basketball Men Champion AwardÂ ', 'basket.jpg', 'BSIT'),
(37, 'Intramurals Awarding Night', 'ICT Overall Champion', 'Champ.jpg', 'BSIT'),
(38, 'Intramurals Awarding Night', '<p>Information Technology Award</p>', 'clint.jpg', 'BSIT'),
(39, 'Intramurals Awarding Night', 'The ICT Volleyball Men Champion Award', 'Volley.jpg', 'BSIT'),
(40, 'Awarding Night', '<p>2nd placer in 2017 Teacher Education Department</p>', 'DSC_1102.JPG', 'BSEd');

-- --------------------------------------------------------

--
-- Table structure for table `program_data`
--

CREATE TABLE `program_data` (
  `programId` int(11) NOT NULL,
  `programTitle` varchar(64) NOT NULL,
  `programName` varchar(128) NOT NULL,
  `programDesc` text NOT NULL,
  `programImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_data`
--

INSERT INTO `program_data` (`programId`, `programTitle`, `programName`, `programDesc`, `programImage`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;The <b>BS Information Technology program </b>includes the study of the utilization  of both hardware and software technologies involving planning, installing, customizing, operating, managing and administering, and maintaining information technology infrastructure that provides computing solutions to address the needs of an organization. <br>The program prepares graduates to address the various needs  involving the selection, development, application, integration and management of computing technologies within an organization.<div><b><br></b></div><div><b>Program Outcomes</b><div><ol><li><b></b>Apply knowledge of computing fundamentals and conceptualization of solution models from defined problems and requirements.<b><br></b></li><li>Understand best practices and standards and their applications</li><li>Collect, analyze and evaluate complex problems and identify and define the computing requirements appropriate to its solutions.</li><li>Identify and analyze user needs and take them into account in the selection, creation and evaluation of computing systems to achieve appropriate and effective solutions.</li><li>Design effective solutions for complex computing technology and evaluate systems, components or process that meet specified user needs and requirements under various constraints.</li><li>Integrate IT-based solutions into the user environment effectively.</li><li>Select and apply appropriate techniques and resources using innovative methods and modern computing tools and skills to achieve effectiveness and efficiency.</li><li>Execute function effectively either as an individual or member of a group to obey or lead and motivate others to attain common goals.</li><li>Assist in creation of an effective IT project plan.</li><li>Communicate effectively and appropriately with the computing community and with the society as a whole and be able to comprehend, write and give effective reports, presentations and comprehensive instructions.</li><li>Analyze the local and global impact of computing information technology on individuals, organizations, and society.</li><li>Understand professional, ethical, legal, security and social issues and responsibilities in the utilization of information technology.</li><li>Recognize the need for self-directed learning and engage in independent work and improving performance, resulting for continuous professional development.</li></ol></div></div>', 'logo.png'),
(2, 'BSHM', 'Bachelor of Science in Hospitality Management', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This course is designed to give a clear and whole overview of Tourism and Hospitality as an ecosystem and goes beyond the usual closed concept of tourism.It introduces the concepts and terms that are common throughout the different sectors.It also intends to develop,update and maintain local knowledge as well as tourism industry knowledge.It shows the structure and scope of tourism as well as the impact of Tourism as an industry in relation to the world economy and society.It also illustrate the effects of the convergence of tourism with the other local industries and let the world of the Philippines.It also introduces the sustainable goals of tourism and discusses among others,how to develop protective environments for children in tourism destinations;to observe and perform risk mitigation activities;etc.The students will also learn to appreciate the key global organizations and the roles they play in influencing and monitoring tourism trends.&nbsp;<br></p><p><b>Program&nbsp;Outcomes</b></p><p><b>Common to all program:</b></p><ol><li>Articulate and discuss the latest developments in the specific field of practice</li><li>Effectively communicate orally and in writing using English,Filipino,Mother tongue Language, and an appropriate Foreign Language required by the industry</li><li>Work effectively and independently in multi-disciplinary and multi-cultural teams</li><li>Act in recognition of professional,social and ethical responsibility</li><li>Preserve and promote"Filipino historical and cultural heritage"(based on RA No.7722)</li></ol><p><b>Common to the Business&nbsp; and Management&nbsp;Discipline:</b></p><p></p><ol><li>Apply the basic concepts that underline each of the functional areas of business (marketing,finance,human resource management,production and operations management,information technology,and strategic management)and employ these concepts in various business situations<br></li><li>Select the proper decision making tools to critically,analytically and creatively solve problems and drive results</li><li>Apply Information and Communication Technology (ICT) skills as required by the business environment</li></ol><p><b>Common to Tourism and Hospitality Discipline:</b>&nbsp;<b></b></p><p></p><ol><li><b></b>Demonstrate knowledge on the tourism industry,local tourism products and services</li><li>Manage and market a service oriented business organization</li><li>Demonstrate administrative and managerial skills in a service oriented business organization</li><li>Perform and monitor financial transactions and reports</li><li>Perform human capital development functions of a tourism oriented organization</li><li>Utilize information technology application for tourism and hospitality&nbsp;<b></b><br></li><li>Utilize various communication channels proficiently in dealing with guest and colleagues</li></ol><p><b>Specific to Hospitality Program:</b><br></p><p></p><ol><li>Produce food product and services complying with the enterprise&nbsp;</li><li>Apply management skills in F&amp;B services for front office&nbsp;</li><li>Perform and provide full guest cycle services for front office&nbsp;</li><li>Perform and maintain various housekeeping services for guest and facility operations</li><li>Plan and implement a risk management program to provide a safe and secure workplace&nbsp;</li><li>Provide food and beverage service and manage the operation seamlessly based on industry standards</li></ol>', 'BSHM.png'),
(3, 'BSTM', 'Bachelor of Science in Tourism Management', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; This course is designed to give a clear and whole overview of Tourism and Hospitality as an ecosystem and goes beyond the usual closed concept of tourism.It introduces the concepts and terms that are common throughout the different sectors.It also intends to develop,update and maintain local knowledge as well as tourism industry knowledge.It shows the structure and scope of tourism as well as the impact of Tourism as an industry in relation to the world economy and society.It also illustrate the effects of the convergence of tourism with the other local industries and let the world of the Philippines.It also introduces the sustainable goals of tourism and discusses among others,how to develop protective environments for children in tourism destinations;to observe and perform risk mitigation activities;etc.The students will also learn to appreciate the key global organizations and the roles they play in influencing and monitoring tourism trends.&nbsp;</p><h3><b>Program Outcomes</b></h3><p><b>Common to all program:</b></p><ol><li>Articulate and discuss the latest developments in the specific field of practice</li><li>Effectively communicate orally and in writing using English,Filipino,Mother tongue Language, and an appropriate Foreign Language required by the industry</li><li>Work effectively and independently in multi-disciplinary and multi-cultural teams</li><li>Act in recognition of professional,social and ethical responsibility</li><li>Preserve and promote"Filipino historical and cultural heritage"(based on RA No.7722)</li></ol><p><b>Common to the Business  and Management Discipline:</b></p><p></p><ol><li>Apply the basic concepts that underline each of the functional areas of business (marketing,finance,human resource management,production and operations management,information technology,and strategic management)and employ these concepts in various business situations<br></li><li>Select the proper decision making tools to critically,analytically and creatively solve problems and drive results</li><li>Apply Information and Communication Technology (ICT) skills as required by the business environment</li></ol><p><b>Common to Tourism and Hospitality Discipline:</b>&nbsp;<b></b></p><p></p><ol><li><b></b>Demonstrate knowledge on the tourism industry,local tourism products and services</li><li>Manage and market a service oriented business organization</li><li>Demonstrate administrative and managerial skills in a service oriented business organization</li><li>Perform and monitor financial transactions and reports</li><li>Perform human capital development functions of a tourism oriented organization</li><li>Utilize information technology application for tourism and hospitality <b></b><br></li><li>Utilize various communication channels proficiently in dealing with guest and colleagues</li></ol><b>Specific to Tourism Management Program:</b><br><p></p><p></p><ol><li><b></b>Research,plan and conduct various tour guiding activities<br></li><li>Plan,implement and monitor tours and sales activities</li><li>Develop appropriate marketing programs and arrange the required travel services</li><li>Plan,organize,implement and evaluate MICE activities</li><li>Plan develop and evaluate tourism sites and attractions</li></ol><p></p>', 'BSTM.png'),
(4, 'BEEd', 'Bachelor of Science in Elementary Education', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; The <b>BEEd</b> is an undergraduate teacher education degree program designed to prepare individuals to teach in the elementary level.</p><p>â€ƒâ€ƒâ€ƒLecture:This course covers the fundamental aspects of biochemistry and the structure and dynamics of important cellular components. The structure, properties, functions and metabolism of carbohydrates, proteins, lipids and other important biochemical compounds are also discussed.<br></p><p>â€ƒâ€ƒâ€ƒLecture:This course involves the study of the principles and theories important to the practice of analytical chemistry. It involves a discussion of the techniques, methods and instrumentation involved in determining the amount of constituents in sample. Particular attention is given to stoichiometric problems.  &nbsp; Laboratory:The laboratory work covers calibration of instruments, volumetric, and gravimetric methods especially those analyses encountered in industries. Emphasis is place in correct laboratory procedures and techniques.<br><br></p><p><b>Program Outcomes &nbsp;</b> <br>By the time of graduation, the students of the program shall be able to:&nbsp;</p><p></p><br><b>The minimum standards for the Bachelor of Special Needs Education program are expressed in the following minimum set of learning outcomes:</b><div><b>Common to all programs in all types of schools. The graduates have the ability to:</b><ol><li>Articulate and discuss the latest developments in the specific field of practice. (PQF level 6 descriptor)</li><li>&nbsp;Effectively communicate in English and Filipino, both orally and in writing&nbsp;</li><li>. work effectively and collaboratively with a substantial degree of independence in multi-disciplinary and multi-cultural teams. (PQF level 6 descriptor)</li><li>act in recognition of professional, social , and ethical responsibility</li><li>preserve and promote "Filipino historical and cultural heritage"(based on RA 7722)</li></ol><p></p><p></p><p></p><b>Common to the discipline (Teacher Education)</b><br><p></p><p></p><ol><li>&nbsp;Articulate the rootlessness of education in philosophical, socio-cultural, historical, psychological, and political contexts<br></li><li>&nbsp; Demonstrate mastery of subject matter/discipline<br></li><li>&nbsp; Facilitate learning using a wide range of teaching methodologies and delivery modes appropriate to specific learners and their environments<br></li><li>Develop innovative curricula, instructional plans, teaching approaches, and resources for diverse learners<br></li><li>&nbsp;Apply skills in the development and utilization of ICT to promote quality, relevant, and sustainable educational practices<br></li><li>&nbsp; Demonstrate a variety of thinking skills in planning, monitoring, assessing, and reporting learning processes and outcomes.<br></li><li>&nbsp;Practice professional and ethical teaching standards sensitive to the local, national, and global realities<br></li></ol>&nbsp;<b>Pursue lifelong learning for personal and professional growth through varied experiential and field-based opportunities</b><br><p></p><p></p><ol><li>&nbsp;Specific to a sub-discipline and a major&nbsp;<br></li><li>&nbsp; Bachelor of Secondary Education Major in Sciences<br></li></ol>&nbsp;<b> The graduates have the ability to demonstrate knowledge, skills and dispositions under the following domains:</b><br><p></p><p></p><ol><li>&nbsp; Demonstrate deep understanding of scientific concepts and principles<br></li><li>&nbsp; Apply scientific inquiry in teaching and learning<br></li><li>&nbsp; Utilize effective science teaching and assessment methods<br></li></ol><p></p><p></p>&nbsp; <b>Common to graduates of a horizontal type of institution as defined in CMO 46, 2012</b><br><p></p><p></p><ol><li>&nbsp;Graduates of professional institutions demonstrate service orientation in their respective professions<br></li><li>&nbsp;Graduates of colleges are qualified for various types of employment and participate in development activities and public discourses, particularly in response to the needs of the communities they serve<br></li><li>&nbsp;Graduates of universities contribute to the generation of new knowledge by participating in various research and development projectionist<br></li></ol><p></p></div>', 'BEED.png'),
(5, 'BSCrim', 'Bachelor of Science in Criminology', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;The field of <b>Criminology</b> is the study of crime and the various agencies of justice as they operate and react to crime, criminals and victims. It is therefore the mission of the Criminology program to provide the community with professionally competent and morally upright graduates who can deliver efficient and effective services in crime prevention, crime detection and investigation, law enforcement, public safety, custody and rehabilitation of offenders, criminological research, among others.</p><p>Criminology Program envision to continually involved in producing graduates who have the knowledge, skills, attitude and values in addressing the problem of criminality in the country and the character and competence to meet the challenges of globalization in the field of criminology.</p><p></p><ol><li>Conduct Criminological research on crimes, crimes causation, victims, and other offenders to include deviant behavior.</li><li>Internalize the concepts of human rights and victim welfare.</li><li>Demonstrate competence and broad understanding n law enforcement administration, public safety and criminal justice.</li><li>Utilize crminalistics of forensic science in the investigation and detection of crime.</li><li>Apply the principle and jurisprudence of criminal law, evidence and criminal procedure.</li><li>Ensure offenders welfare and development for their re-integration to community.</li></ol><p></p>', 'BSCRIM.png'),
(6, 'BSEd', 'Bachelor of Secondary Education', '<p><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>&nbsp;The <b>BS</b><small></small><small></small><b>Ed</b> is an undergraduate teacher education degree program designed to prepare individuals to teach in the elementary level.<br></p><p>&nbsp;â€ƒâ€ƒâ€ƒLecture:This course covers the fundamental aspects of biochemistry and the structure and dynamics of important cellular components. The structure, properties, functions and metabolism of carbohydrates, proteins, lipids and other important biochemical compounds are also discussed.<br></p><p>â€ƒâ€ƒâ€ƒLecture:This course involves the study of the principles and theories important to the practice of analytical chemistry. It involves a discussion of the techniques, methods and instrumentation involved in determining the amount of constituents in sample. Particular attention is given to stoichiometric problems.  &nbsp; Laboratory:The laboratory work covers calibration of instruments, volumetric, and gravimetric methods especially those analyses encountered in industries. Emphasis is place in correct laboratory procedures and techniques.<b></b></p><p></p><p><b>Program Outcomes </b>&nbsp; <br>By the time of graduation, the students of the program shall be able to:&nbsp;<br></p><p></p><b>The minimum standards for the Bachelor of Special Needs Education program are expressed in the following minimum set of learning outcomes:</b><br><b>Common to all programs in all types of schools. The graduates have the ability to:</b><br><ol><li>&nbsp;articulate and discuss the latest developments in the specific field of practice. (PQF level 6 descriptor)</li><li>&nbsp;Effectively communicate in English and Filipino, both orally and in writing&nbsp;</li><li>&nbsp;work effectively and collaboratively with a substantial degree of independence in multi-disciplinary and multi-cultural teams. (PQF level 6 descriptor)</li><li>&nbsp;Act in recognition of professional, social , and ethical responsibility</li><li>&nbsp;Preserve and promote "Filipino historical and cultural heritage"(based on RA 7722)</li><li>&nbsp;Common to the discipline (Teacher Education)</li><li>&nbsp;Articulate the rootlessness of education in philosophical, socio-cultural, historical, psychological, and political contexts</li><li>&nbsp;Demonstrate mastery of subject matter/discipline</li><li>Facilitate learning using a wide range of teaching methodologies and delivery modes appropriate to specific learners and their environments</li><li>&nbsp;Develop innovative curricula, instructional plans, teaching approaches, and resources for diverse learners</li><li>Apply skills in the development and utilization of ICT to promote quality, relevant, and sustainable educational practices</li><li>Demonstrate a variety of thinking skills in planning, monitoring, assessing, and reporting learning processes and outcomes.</li><li>&nbsp;Practice professional and ethical teaching standards sensitive to the local, national, and global realities</li><li>&nbsp;Pursue lifelong learning for personal and professional growth through varied experiential and field-based opportunities</li></ol><b>The graduates have the ability to demonstrate knowledge, skills and dispositions under the following domains:</b><br><ol><li>&nbsp;Demonstrate deep understanding of scientific concepts and principles</li><li>&nbsp;Apply scientific inquiry in teaching and learning</li><li>Utilize effective science teaching and assessment methods</li></ol><b>Common to graduates of a horizontal type of institution as defined in CMO 46, 2012</b><br><ol><li>Graduates of professional institutions demonstrate service orientation in their respective professions<br></li><li>&nbsp;Graduates of colleges are qualified for various types of employment and participate in development activities and public discourses, particularly in response to the needs of the communities they serve<br></li><li>&nbsp;Graduates of universities contribute to the generation of new knowledge by participating in various research and development projects<br></li></ol>', 'BSED.png'),
(7, 'AB', 'Bachelor of Arts', '<p><b>Nature of the filed of study</b></p><p>â€ƒ&nbsp; &nbsp; &nbsp; &nbsp;Global communication in the twenty-first century is made possible by the use of&nbsp; the language understood by all. that language is english, the medium used in the pursuit of knowledge, the advancement of science and technology, and the development of bussiness and industry. it gives humankind access to the infinite resource of the&nbsp; internetand thus inables countries to work together to achieve their common goals. New information and research findings are efficently in this international lingua franca.</p><p>â€ƒâ€ƒâ€ƒas an official language in the philippines, english is used in government and law, education and media,business nad industry. as such,&nbsp; there is a demand for graduates who not only have adequate facility of english but can competently and effectively use the language in different context and for various purposes.</p><p>â€ƒâ€ƒâ€ƒThe courses in the program are designed to integrate theory and practice to prepare the student for effective communication in english in diverse context and situation.</p><p><b>Program Goals</b><br></p><ol><li>To provide a comprehensive knowledge of the English language-its origin,growth and development,structures and use.</li><li>To enhance the students competencies in the use of the English language in real world contexts.</li><li>To present appropriate strategies of language use through a heightened awareness of how English works in different situation in the Philippines and in Asia and rest of the world.</li></ol><p><b>Program Outcomes</b></p><p>â€ƒThe minimum standards of the AB in English language/AB in English language studies program are expressed in the following minimum set of the outcomes.</p><b>Common to all programs in all types of schools</b><br><ol><li>articulate and discuss the latest development in the specific field of practice.</li><li>Effectively communicate orally and in writing using both English and Filipino.</li><li>Work effectively and independently in multi-disciplinary and multi-cultural terms.</li><li>Preserve and promote"Filipino Historical and culture heritage"(based on RA 7722)<br></li></ol><b>Common to the discipline&nbsp;graduates to the humanities program are able to:</b><br><ol><li><b></b>Recognized the need for an demonstrate the ability for lifelong learning.</li><li>identify multi-perspective and interrelations among texts and contexts.</li><li>apply analytical and interpretive skills in the study of the texts</li><li>Discuss and/or create artistic form.</li><li>demonstrate research skills specific to the sub-disciplines in the humanities.</li><li>Use appropriate theorist and methodologies critically and creatively.</li><li>Appraise the role of humanistic education in the formation of the human being and society.</li></ol>', 'AB.png'),
(8, 'BSBA', 'Bachelor of Science in Business Administration', '<p><b>Program Outcomes &nbsp;</b> <br>By the time of graduation, the students of the program shall be able to:  <br></p><ol><li>&nbsp;Common to all programs in all types of schools&nbsp;<br></li></ol>&nbsp;<b> The graduates have the ability to:</b><br><ol><li>&nbsp; Articulate and discuss the latest developments in the specific field of practice.&nbsp;<br></li><li>&nbsp; Effectively communicate orally and in writing using both English and Filipino.<br></li><li>&nbsp; Work effectively and independently in multi-disciplinary and multi-cultural teams.<br></li><li>&nbsp; Act in recognition of professional, social, and ethical responsibility.<br></li><li>&nbsp; &nbsp;Preserve and promote "Filipino historical and cultural heritage".<br></li></ol><b>2 Common to the Business and Management discipline  </b><br><br><b>&nbsp; Graduate of a business or management degree should be able to:</b><b></b><br><ol><li>&nbsp;Perform the basic functions of management such as planning, organizing, staffing, directing and controlling.</li><li>&nbsp;Apply the basic concepts that underlie each of the functional areas of business (marketing, finance, human resources management, production and operations management, information technology, and strategic, management) and employ these concepts in various business situations.</li><li>&nbsp;Select the proper decision making tools to critically, analytically and creatively solve problems and drive results.</li><li>&nbsp;Express oneself clearly and communicate effectively with stakeholders both in oral and written forms.</li><li>&nbsp;Apply information and communication technology (ICT) skills as required by the business environment.</li><li>Work effectively with other stakeholders and manage conflict in the workplace.</li><li>Plan and implement business related activities.</li><li>&nbsp;Demonstrate corporate citizenship and social responsibility</li><li>&nbsp;Exercise high personal moral and ethical standards</li><li>&nbsp;Specific to the Business Administration program&nbsp;</li></ol><b>&nbsp;Graduate of a business or management degree should be able to:</b>&nbsp;&nbsp;<ol><li>&nbsp;Analyze the business environment for strategic direction&nbsp;</li><li>Prepare operational plans</li><li>&nbsp;Innovate business ideas based on emerging industry Manage a strategic business unit for economic sustainability</li><li>&nbsp;Conduct business research</li></ol><b>3 Specific to the Business Administration program  </b><br><br>&nbsp;<b> Graduate of a business or management degree should be able to:</b><br><ol><li>&nbsp;For professional institutions: demonstrate a service orientation in one''s profession<br></li><li>&nbsp;For colleges: to participate in various types of employment, development activities, and public discourses particularly in response to the needs of the communities one serves.</li><li>&nbsp;For universities: generate new knowledge using research and development projects.</li></ol><p></p>', 'BSBA.png');

-- --------------------------------------------------------

--
-- Table structure for table `qual_data`
--

CREATE TABLE `qual_data` (
  `qualId` int(11) NOT NULL,
  `qualDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qual_data`
--

INSERT INTO `qual_data` (`qualId`, `qualDesc`) VALUES
(1, 'Graduate in Bachelor of Science and Information Technology\r\n<br>\r\n<br> \r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. For you active involvement during the conduct of \r\n  Philippine start-up challenge mentorâ€™ boot camp.\r\n<br>\r\n2. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n3. Orientation of E-class Record and Grading System.\r\n<br>\r\n4. Orientation-Workshop on Speech Laboratory \r\n    Usage And Drill.\r\n<br>\r\n5. Capability Dev: Training Workshop On Tech start-up and tech. Packaging for Boot camp & Technopreneurship.\r\n<br>\r\n6. CBDRRM Training of Trainers.\r\n<br>\r\n7. 2016 Reg. Congress on Higher Ect. Research.\r\n<br>\r\n8. CSS NC II Training.\r\n<br>\r\n9. Training Methodology Level 1.\r\n<br>\r\n10. Community-Based Disaster Risk Reduction And \r\n     Management Training of Trainer.\r\n<br>\r\n11. Regional Congress on Higher Educational \r\n   Research.\r\n<br>\r\n12. Visual Graphic Design NC III.\r\n<br>\r\n13. Cyber Security and Internet Ethics.\r\n<br>\r\n14. Provincial Assessment Moderation.\r\n<br>\r\n15. Seminar on Occupational Health and Work place Safety.'),
(2, 'Graduate in Bachelor of Science and Information Technology\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n3. Training Workshop on Tech Startup and Technology \r\n    Packaging for Bootcamp and Technopreneurship.\r\n<br>\r\n4. Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n<br>\r\n5. For you active involvement during the conduct of Philippine start-up challenge mentorâ€™ boot camp.'),
(3, 'Graduate in Bachelor of Science and Information Technology.\r\n<br>\r\n<br>\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory Usage \r\n          And Drill.'),
(4, 'Graduate of Bachelor of Science Information Technology\r\n<br>\r\n<br>\r\n\r\n<b>Trainings/Seminars Attended:</b>\r\n<br>\r\n\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n\r\n2. Seminar-Workshop on Office Productivity Tools.\r\n<br>\r\n\r\n3. Orientation of E-class Record and Grading System.\r\n<br>\r\n\r\n4. Construction Safety And Health, Urban Planning and Disaster Awareness Program. \r\n<br>\r\n\r\n5. Computer System Servicing NC II\r\n(280 Hours).\r\n<br>\r\n\r\n6. Orientation-Worksop on Speech Laboratory Usage And Drill.\r\n'),
(5, '<p><b></b>Graduate of Bachelor of Arts&nbsp;</p><p><b>Training''s/Seminar Attended:</b><br><b></b></p><p></p><ol><li><b></b>Training-Workshop on Multidisciplinary Research<br></li><li>Orientation of E-class Record and Grading System</li><li>Orientation-Workshop on Speech Laboratory Usage and Drill</li><li>17-Day Faculty Training for the Teaching of the men Ge Core course</li><li>Seminar-Workshop on Office Productivity Tools&nbsp;</li></ol><p></p>'),
(6, '<p><b>Training''s/Seminars Attended:</b></p><p></p><ol><li><b></b>Training-Workshop on Multidisciplinary Research<br></li><li>Orientation of E-class Record and Grading Record&nbsp;</li><li>Orientation-Workshop on Speech Laboratory Usage and Drill</li><li>11th Caraga Business Educator &amp; Student Congress</li><li>rnrn10th Caraga Business Educator &amp; Student Congressrnrn<br></li><li>Workshop on Multidisciplinary</li><li>Master of Business Administration (MBA)</li></ol><p></p>'),
(7, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory \r\n      Usage And Drill.\r\n<br>\r\n4. 2016 Regional Congress on Higher Education\r\n    Research. \r\n<br>                   \r\n5. Seminar-Workshop on Syllabi Construction for \r\n   OBE.\r\n<br>\r\n6. Information Session on Doing Business in Free \r\n    Trade (DBFTA).\r\n<br>\r\n7. Seminar-Workshop on Research and Extension \r\n   Program.\r\n<br>\r\n8. Gender Sensitivity Training.'),
(8, 'Graduate in Bachelor of Science and Marketing  \r\nManagement\r\n<br>\r\n<br>\r\n\r\n<b> Training/Seminars Attend:</b>\r\n<br>\r\n1.Training-Workshop on Multidisciplinary Research\r\n<br>\r\n\r\n2.Orientation of E-class Record and Grading System.\r\n<br>\r\n\r\n3.Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n<br>\r\n\r\n4.Seminar and Workshop on Research\r\n<br>\r\n\r\n5.Provincial Assessment Moderation\r\n<br>\r\n\r\n6.Font Office Services NC II\r\n<br>\r\n\r\n7.Bookkeeping NC III\r\n\r\n\r\n'),
(9, 'Graduate of Bachelor in Business Administration \r\n<br>\r\n1.Orientation-Workshop on Speech Laboratory Usage & Drill. \r\n<br>\r\n2.Orientation of E-Class Record and Grading System'),
(10, 'Graduate of Bachelor of Science in Business Administration\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2 .Orientation of E-class Record and Grading\r\nSystem.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n<br>\r\n4. Community-Based disaster risk Reduction and month training of trainers.\r\n<br>\r\n5. BDTPâ€™s FD a license to operatern(ATO) processing writes hop .'),
(11, 'Graduate in Bachelor of Science And Criminology\r\n<br>\r\n<br>\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory Usage And Drill.'),
(12, 'Graduate in Bachelor in Science and Criminology\r\n<br>\r\n<br>\r\n\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n\r\n3. 6th Criminology Student Congress With a Theme â€œBuilding Together, Binding as Oneâ€ \r\n<br>\r\n\r\n4. Seminar-Workshop on Philippine Coast Guard Auxiliary Orientation. \r\n<br>\r\n\r\n5. Trainerâ€™s Training For Philippine Environmental Lawâ€™s.\r\n<br>\r\n\r\n6. Trainerâ€™s refresher Training on Trafficking in Persons and  Environmental Crimes.\r\n<br>\r\n\r\n7. 1st UNODC TA OC-IG.\r\n<br>\r\n\r\n8. Provincial Assessment Moderation.\r\n<br>\r\n\r\n9. Training Workshop on Moral Renewal for Graft and Corruption Free Philippines.'),
(13, 'Graduate of Bachelor of Science in Criminology\r\n<br>\r\n<br>\r\n\r\n<b>Trainings/Seminar Attended:</b>\r\n<br>\r\n\r\n\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n\r\n2. Orientation of E-class Record and Grading System.\r\n'),
(14, '<b>Training/Seminars Attended: </b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n<br>\r\n4. Housekeeping NC II.'),
(15, 'Graduate in Bachelor of Science and Elementary Education\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n1.Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2.Learning Capabilities on their 60 days on the job. \r\n    training as practice teacher.\r\n<br>\r\n3.Housekeeping NC II.'),
(16, 'Graduate in Bachelor of Science in Hotel and Restaurant Management,\r\n<br>\r\n<br>\r\n\r\n<b> Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1. Gender Sensitivity Training and Tourism Awareness \r\n     Seminar.\r\n<br>\r\n\r\n2. Caraga Regional Tourism Stakeholder Summit.\r\n<br>\r\n\r\n3. Seminar Workshop on Syllabi Construction of Outcome-Based Education (OBE).'),
(17, 'Graduate of Bachelor of Science in Hospitality Management\r\n<br>\r\n<br>\r\n\r\n<b>Trainings/Seminar Attended:</b>\r\n<br>\r\n\r\n1. 6th HRM & Tourism student summit\r\n <br>\r\n\r\n2. 7th HRM & Tourism student summit\r\n <br>\r\n\r\n3. 8th HRM & Tourism student summit\r\n<br>\r\n\r\n4. FBS Training Certificate\r\n<br>\r\n\r\n5. HK Training Certificate\r\n'),
(18, 'Graduate in Bachelor of Science And Tourism Management.\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Food and Beverages Service.\r\n<br>\r\n2.Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n<br>\r\n3. Training-Workshop on Multidisciplinary Research.'),
(19, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. P.E Festival Mngt. Seminar Workshop.\r\n<br>\r\n2. Seminar Workshop on Syllabi Construction Outcome-Based Education (OBR).\r\n<br>\r\n3. Seminar Workshop on â€œTravel Agency mngt, and Operation.'),
(20, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1.9th Annual Regional BIPTA Convention and Scientific Sessions\r\n<br>\r\n 2.Seminar on Occupational Health and Workplace Safety.\r\n<br>\r\n3. Seminar-Workshop on office productivity tools\r\n     9th Annual Regional BIOTA Convention and \r\n        Scientific Sessions.\r\n<br>\r\n\r\n4. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n\r\n5. Orientation of E-class Record and Grading System.\r\n<br>\r\n\r\n6. Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n'),
(21, 'Graduate in Bachelor of Science and Elementary Education.\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminar Attended:</b>\r\n<br>\r\n1.Training-Workshop on Multidisciplinary Research\r\n    Seminar on Occupational Health and Workplace \r\n      Safety.\r\n<br>\r\n2.Seminar-Workshop on office productivity tools.\r\n<br>\r\n3.Orientation-Workshop on Speech Laboratory Usage \r\n    And Drill.\r\n'),
(22, 'Graduate in bachelor of Science and Elementary Education.\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1. Seminar on Occupational Health and Workplace Safety.\r\n<br>\r\n2. Seminar-Workshop on office productivity tools.\r\n<br>\r\n3. Orientation of E-class Grading System For College  Dept.\r\n<br>\r\n4. Seminar-Know Elections Better, Super Friends (KEBS).\r\n<br>\r\n5. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n6. Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n'),
(23, 'Graduate of Bachelor of Science Secondary Education\r\n<br>\r\n<br>\r\n\r\n<b> Tranings/Seminar Attended:</b>\r\n<br>\r\n\r\n1. Orientation of E-class Record and Grading System.\r\n<br>\r\n\r\n2. Training-Workshop on Multidisciplinary Research\r\n Seminar on Occupational Health and Workplace Safety.\r\n<br>\r\n\r\n3. Seminar-Workshop on office productivity tools\r\n9th Annual Regional BIPTA Convention and Scientific Sessions.\r\n<br>\r\n\r\n4. Learning Resource Management & Development System (LRMDS) Orientation & Advocacy for Division Level.\r\n<br>\r\n\r\n5. Orientation-Worksop on Speech Laboratory Usage And Drill\r\n'),
(24, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory Usage And Drill.'),
(25, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading System.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n\r\n\r\n'),
(26, 'Graduate of Bachelor of Elementary Education \r\n<br>\r\n1. Food and Beverage Service.\r\n<br>\r\n2. 2015 San Jose  District-wide BSP Encampment.\r\n<br>\r\n3. Division Refresher Course in ALS Program & \r\n        Projects cum RPMs.\r\n\r\n'),
(28, 'Graduate of Surigao State College of Technology\r\n<br>\r\n1.LET\r\n<br>\r\n  2.Front Office Services NC IIrn3.Bartending NC II\r\n'),
(29, 'Graduate in Bachelor of Science and Secondary Education.\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1. AM / TM Training.\r\n<br>\r\n\r\n2. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n\r\n3. Orientation of E-class Record and Grading System.\r\n<br>\r\n\r\n4. Orientation-Workshop on Speech Laboratory Usage And Drill.'),
(30, 'Graduate in Bachelor of Science and Secondary Education.'),
(31, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1.Training-Workshop on Multidisciplinary.\r\n<br>\r\n2.Research.Orientation of E-class Record and Grading System.\r\n<br>\r\n3.Orientation-Workshop on Speech Laboratory Usage and Drill.\r\n<br>\r\n4.PPL Survival Training.'),
(32, 'Qualifications list'),
(33, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Orientation of E-class Record and Grading \r\n  System.\r\n<br>\r\n3. Orientation-Workshop on Speech Laboratory \r\n Usage And Drill.\r\n<br>\r\n4. Learning New Initiative Things Adaptability of Change in Librarian.\r\n<br>\r\n5. Seminar Workshop on Syllabi Construction For OBE.\r\n<br>\r\n6. Provincial Stakeholders Forum.\r\n<br>\r\n7. Longevity Award.\r\n<br>\r\n8. Beginning a Question Research Pedagogy.\r\n<br>\r\n9. Approaches to Counselling and Psychotherapy ways of Healing.\r\n<br>\r\n10. Group Process .\r\n<br>\r\n11. Psychological Report Designing Testing and Assessment.\r\n<br>\r\n12. Effective Counselling Techniques.\r\n<br>\r\n13. Crime Vehicle of Self Transformation Though \r\n       the Transmission of Spiritual Values.\r\n<br>\r\n14. Gender Sensitivity Training .\r\n<br>\r\n15. Person, Professional Spiritual Enhancement.'),
(34, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Seminar-Workshop on office productivity tools.\r\n<br>\r\n3.Seminar on Occupational Health and Workplace Safety.\r\n<br>\r\n4. Seminar Workshop on Personality development.\r\n<br>\r\n5. Literacy training Service (LTS)Component of the National Service Training Program(NSTP).\r\n<br>\r\n6. Symposium on Drug Prevention.\r\n<br>\r\n7. Festival Management Enhancement Workshop for Tourism Development.\r\n<br>\r\n8. Orientation-Seminar on Self-care and health lifestyle.\r\n<br>\r\n9. Orientation-Workshop on Speech Laboratory Usage And Drill.'),
(35, 'Graduate in Bachelor of Science And Elementary Education.\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br.\r\n2. Seminar on Occupational Health and Workplace Safety.\r\n<br>\r\n3. Seminar-Workshop on office productivity tools.\r\n<br>\r\n4. Orientation-Workshop on Speech Laboratory Usage And Drill.'),
(36, 'DJEMFCST - Practical Nursing\r\nCentral Mindanao University  (CMU)\r\nSurigao Education Center (SEC) - B.S. in Education\r\nB.S Nursing - St. Paul University-Surigao (SPUS)	\r\nMaster of Arts in Education Mngt.\r\nSt. Paul University-\r\nSurigao (SPUS) - Doctor of Philosophy In education Mngt. \r\nFar East Advent School of Theology international	Doctor in Public  Service.\r\n<br>\r\n<br>\r\n\r\n<b>Trainings/Seminar Attended:</b>\r\n<br>\r\n\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n\r\n2. Orientation of E-class Record and Grading System.\r\n\r\n'),
(37, '<b>Training/Seminars Attended:</b>\r\n<br>\r\n1.Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2.Orientation of E-class Record and Grading System.\r\n<br>\r\n3.Orientation-Workshop on Speech Laboratory Usage And Drill.\r\n<br>\r\n4.Re-Orientation for Senior High.\r\n<br>\r\n5.Training for Senior High.\r\n<br>\r\n6.Workshop on Outcome.'),
(38, 'Graduate in Bachelor of Science and Elementary Education.\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1. Training-Workshop on Multidisciplinary Research.\r\n<br>\r\n2. Re-Echo Seminar on 2016 in service training for \r\n     private high school teacher.\r\n<br>\r\n3. Food and Beverage Service NC II.\r\n<br>\r\n4. Training for Work Scholarship Prog. (TWSD).\r\n<br>\r\n5. 2016-in Service Training (INSET) for Junior High \r\n     School Teacher Private School.\r\n<br>\r\n6. 2015 San Jose District-Wide BSP Encampment.\r\n<br>\r\n7. Values Reformation & Spiritual  Enhancement.\r\n<br>\r\n8. HIV / AIDS, HEPA-B, HEPA-C, Syphilis\r\n Tuberculosis  Orientation Seminar.\r\n<br>\r\n9. Bartending NC II Training for Work Scholarship Prog. (TWSP).\r\n<br>\r\n10. Beginning a Question; Research Pedagogy \r\n<br>\r\n11. Prime Vehicle of self-Transformation Through the Transformation of Spiritual Values.\r\n<br>\r\n12. Approaches to Counselling  & Psychology therapy Ways of Healing.\r\n<br>\r\n13. Learning to health & Healing to  Learn Children w/ Behavior all needs\r\n<br>\r\n14. Psychological testing % Assessment Report Designing.\r\n\r\n<br>\r\n15. Group Process.\r\n'),
(39, 'Graduate in Bachelor of Science and Secondary Education.\r\n</p>\r\n</p>\r\n</p>\r\n<p><b>Training/Seminars Attended:</b></p><p>\r\n1. Training-Workshop on Multidisciplinary Research.</p><p>2. Orientation of E-class Record and Grading System.</p><p>3. Office Productivity Tools.</p><p>\r\n4. Reproductive Health and HIV Awareness.</p><p>\r\n5. Seminar Orientation on Disaster RiskÂ  Reduction Management and Preparedness.</p><p>6. Climate change & Disaster Risk Reduction Management.</p><p>7. Special Education (SPED)</p><p>\r\n8. Orientation-Workshop on Speech Laboratory Usage and Drill.</p><p>9. Science, Technology & Society.</p><p>10. 8th Annual Regional BIOTA.</p><p>Seminar on Values Formation and Human Behavior.Â </p>'),
(40, '<p><b>Training/Seminar Attended:</b></p><p><b></b>1. PHL.TVET Competency Assessment & Certifications Housekeeping NC II.</p><p>2. Provincial Assessment Moderation.</p><p>3. Travel Photography Workshop.</p><p>4. Local Tour Guiding Seminar.</p><p>5. Tourist Reception and Guiding Tech. Seminar Workshop.</p><p>6. 7th Seminar Workshop on "Tunay na Pyestang Pinoy ".</p>');

-- --------------------------------------------------------

--
-- Table structure for table `requirements_data`
--

CREATE TABLE `requirements_data` (
  `requirementsId` int(11) NOT NULL,
  `requirementsFresh` text NOT NULL,
  `requirementsOld` text NOT NULL,
  `requirementsTrans` text NOT NULL,
  `requirementsTcc` text NOT NULL,
  `freshEnProcess` text NOT NULL,
  `oldEnProcess` text NOT NULL,
  `tccEnProcess` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirements_data`
--

INSERT INTO `requirements_data` (`requirementsId`, `requirementsFresh`, `requirementsOld`, `requirementsTrans`, `requirementsTcc`, `freshEnProcess`, `oldEnProcess`, `tccEnProcess`) VALUES
(1, '<p></p><ol><li>Form 138 (Report Card);</li><li>PSA Birth Certificate;</li><li>Marriage Contract (If Married);</li><li>Good Moral Certificate</li><li>Student Handbook;</li><li>Bridging Course Grades (If Applicable);</li><li>Long Brown Envelope;</li></ol><p></p>', '<p></p><ol><li>Student ID;</li><li>Student Clearance;</li><li>Student Handbook;</li><li>PSA Birth Certificate;</li><li>Marriage Contract (If Married);</li><li>Class Card with grades;</li><li>Academic Evaluation Form (Completely filled-up);</li><li>Long folder with fastener.</li></ol><p></p>', '<p></p><ol><li>Form 138 (Report Card);</li><li>PSA Birth Certificate;</li><li>Marriage Contract (If Married);</li><li>Good Moral Certificate</li><li>Student Handbook;</li><li>Bridging Course Grades (If Applicable);</li><li>Long Brown Envelope;</li></ol><p></p>', '<p></p><ol><li>Transcript of Record with S.O;</li><li>PSA Birth Certificate;</li><li>Honorable Dismissal;</li><li>Long brown envelope;</li><li>2x2 ID Picture (4pcs);</li><li>Registration Fee (Php. 1000.00).</li></ol><p></p>', '<p></p><ol><li>Pay the non-refundable Registration fee at&nbsp; the Accounting Office (For non Scholar);</li><li>Proceed to the Guidance Office for College Entrance Examination;</li><li>Secure Enrollment Slip from the Academic Office (Present all requirements);</li><li>For Teacher Education &amp; Criminology, take the Admission Test for the program;</li><li>Proceed to the Department Dean for Interview &amp; Load Advising (Student with parent(s));</li><li>Proceed to the Academic Office for Verification of Subject Loads;</li><li>Proceed to the Accounting Office for payment of tuition &amp; other School Fees (for non Scholar) and billing Assessment for Scholar;</li><li>Proceed to the Registrar''s Office for enrollment Validation.</li></ol><p></p>', '<p></p><ol><li>Secure Enrollment Slip from the Academic Office(Present all requirements);</li><li>Proceed to the Department Dean for Interview &amp; Load Advising (Student with parents);</li><li>Proceed to the Academic Office for Verification of Subject Loads;</li><li>Proceed to the Accounting Office for registration and payment (for non-Scholar);</li><li>Proceed to the Registrar''s Office for enrollment Validation.</li></ol><p></p>', '<p></p><ol><li>Pay the non-refundable Registration feat the Accounting Office;</li><li>Proceed to the Guidance Office for College Entrance Examination;</li><li>Proceed to the TCC Program Focal for the Admission Test;</li><li>Secure Enrollment Slip and subject loading, and the validation at the TCC Office/Department of Academic Affairs (DAA) Office;</li><li>Proceed to the Accounting Office for payment and billing assessment of tuition fee-and other school fees.</li></ol><p></p>');

-- --------------------------------------------------------

--
-- Table structure for table `school_data`
--

CREATE TABLE `school_data` (
  `schoolId` int(11) NOT NULL,
  `mission` text NOT NULL,
  `vision` text NOT NULL,
  `history` text NOT NULL,
  `philosophy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_data`
--

INSERT INTO `school_data` (`schoolId`, `mission`, `vision`, `history`, `philosophy`) VALUES
(1, '<p><b>DJEMFCST</b> is committed and dedicated to:<br></p><ol><li>Foster a safe, secured and supportive academic environment that promotes diverse education;</li><li>Mold students the value of self-discipline, integrity, compassion for others and loyalty to Alma Mater;</li><li>Develop students with active and creative minds through discovery, intellectual simulation and research;</li><li>Practice professional career to uphold the value of learning,  leadership and service; and</li><li>Build strong, positive linkages with industries, communities and  other stakeholders for them to be actively involved in our studentsâ€™&nbsp;  learning.<br></li></ol><p><br></p><br>', '<p><b>DJEMFCST</b> envisions to be the leading frontier of learning and innovation in instruction,  research and extension to transform students into an  &nbsp;  empowered, holistically developed and locally-globally competitive graduates.<br><br></p><br>', 'a', '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The Don Jose Ecleo Memorial Foundation College of Science and Technology was founded on the belief that SUPREME BEING is the origin of all wisdom, goods and knowledge. The academe perceives and absolutely believes that education is a process used by man to serve the community, it is an expression and representation of manâ€™s free will and devotion to the Almighty God.<br>&nbsp; As an institution of higher learning, the school is dedicated to secure and provide a profound process that is in line with CHED, DepEd, and TESDA standards based on the current century and train nations most important human resources on educational advancement for  &nbsp; &nbsp; &nbsp; &nbsp; economic self-sufficiency.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; As a non-sectarian college, its quest is to offer equal service to all citizens closer to the vicinity or outside the islands regardless of  religious beliefs, political affiliations, races/ethnicity, historical and cultural practices.As a research institution, the Don Jose Ecleo Memorial Foundation College of Science and Technology assures to improve school   facilities, establish and gather data through survey, experiments, and innovations that help promote the best standards possible, encouraging good leadership and advancing knowledge about nature, man and its role to society.</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; As a vehicle for human development, the academe is  &nbsp; committed to provide accessible venue for transformation of man for  &nbsp; becoming â€œthe total man with virtueâ€, and integrate psychological, mental, physical,  &nbsp; socio-cultural, economic and spiritual well-being.<br>&nbsp; As a community, it aims to promote harmony and   understanding under the principles of Democracy.<br><br></p>');

-- --------------------------------------------------------

--
-- Table structure for table `sem_data`
--

CREATE TABLE `sem_data` (
  `semId` int(11) NOT NULL,
  `semName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sem_data`
--

INSERT INTO `sem_data` (`semId`, `semName`) VALUES
(1, '1'),
(2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `setting_data`
--

CREATE TABLE `setting_data` (
  `settingId` int(11) NOT NULL,
  `courseAY` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_data`
--

INSERT INTO `setting_data` (`settingId`, `courseAY`) VALUES
(1, '2018-2019');

-- --------------------------------------------------------

--
-- Table structure for table `staffqual_data`
--

CREATE TABLE `staffqual_data` (
  `qualId` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  `staffQual` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffqual_data`
--

INSERT INTO `staffqual_data` (`qualId`, `staffId`, `staffQual`) VALUES
(1, 1, 'Graduate of Bachelor of Science Information Technology\r\n<br>\r\n<br>\r\nGraduate of College of Arts & Sciences\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n\r\n1. Trainers Methodology Level 1.\r\n<br>\r\n2. Training-Workshop on Multidisciplinary Research.\r\n<b'),
(2, 2, 'Graduate of Bachelor of Science Elementary Education\r\n<br>\r\n<br>\r\n\r\n<b>Trainings/Seminars Attended:</b>\r\n<br>\r\n<br>\r\n\r\n1. Training-Workshop on Multidisciplinary Research\r\n<br>\r\n\r\n2. Orientation of E-class Record and Grading System\r\n<br>\r\n\r\n3. Orientation-'),
(3, 3, 'Graduate in Bachelor of Arts'),
(4, 4, 'Graduate in Bachelor of Science and Secondary Education \r\n\r\n'),
(5, 5, 'Graduate in Bachelor Of Science in Commerce\r\n<br>\r\n<br>\r\n\r\n<b>Training/Seminars Attended:</b>\r\n<br>\r\n<br>\r\n1.Trainers Methodology Certificate 1.\r\n<br>\r\n2.Trainers Methodology Certificate 1.\r\n<br>\r\n3. Commercial Cooking NC II.\r\n<br>\r\n4. Bar tending NC II.\r');

-- --------------------------------------------------------

--
-- Table structure for table `staff_data`
--

CREATE TABLE `staff_data` (
  `staffId` int(11) NOT NULL,
  `staffName` varchar(64) NOT NULL,
  `staffImage` varchar(255) NOT NULL,
  `staffCat` varchar(32) NOT NULL,
  `staffAssign` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_data`
--

INSERT INTO `staff_data` (`staffId`, `staffName`, `staffImage`, `staffCat`, `staffAssign`) VALUES
(1, 'Berlyn Tabamo Cabitana', 'CABITANA,Berlin T..jpg', 'Staff', 'Computer laboratory Incharge'),
(2, 'Guadalupe I. Babatid', 'BABATID,Guadalupe.jpg', 'Staff', 'Computer laboratory Incharge'),
(3, 'Alex R. Fernan', 'FERNAN,Alex R..jpg', 'Staff', 'Computer laboratory Incharge'),
(4, 'Analyn C. Sapid', 'SAPID,Analyn C..jpg', 'Staff', 'Computer laboratory Incharge'),
(5, 'Ethel A. Empinado', 'EMPINADO,Ethel A..jpg', 'Staff', 'Computer laboratory Incharge');

-- --------------------------------------------------------

--
-- Table structure for table `studentact_data`
--

CREATE TABLE `studentact_data` (
  `activityId` int(11) NOT NULL,
  `activityName` varchar(64) NOT NULL,
  `activityDesc` text NOT NULL,
  `activityImage` varchar(255) NOT NULL,
  `activityCat` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentact_data`
--

INSERT INTO `studentact_data` (`activityId`, `activityName`, `activityDesc`, `activityImage`, `activityCat`) VALUES
(21, 'DJEMFCST Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 2.jpg', 'Organizations'),
(22, 'club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 3.jpg', 'Organizations'),
(23, 'Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 4.jpg', 'Organizations'),
(24, 'Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 5.jpg', 'Organizations'),
(25, 'Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 6.jpg', 'Organizations'),
(26, 'Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 7.png', 'Organizations'),
(27, 'Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 8.jpg', 'Organizations'),
(28, 'Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 9.jpg', 'Organizations'),
(29, 'DJEMFCST Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'organization 1.jpg', 'Organizations'),
(30, 'Math Club', 'The names for these schools vary by country (discussed in the Regional section below) but generally include primary school for young children and secondary school for teenagers who have completed primary education. An institution where higher education is taught, is commonly called a university college or university (but these higher education institutions are usually not compulsory', 'org 10.jpg', 'Organizations'),
(32, 'Center For American And World Culture', '<p></p><p>We serve as an interdisciplinary focal point for the study of\r\nrace, class, gender, sexual orientation, ethnicity, nationality, religious\r\ndifference, and abilities both here and abroad, today, and in the past. Our courses,\r\nwhich range from classes that delve into the meanings of prejudice and\r\ndiscrimination to a class that prepares you for your international study abroad\r\nexperiences, and our rich selection of programming, provide many opportunities\r\nto explore and experience the world and prepare you for the challenges that\r\nawait you. Please join us on the exhilarating journey as we explore people, places, and\r\npersonal and global issues.<u> </u></p>\r\n<br><p></p>', 'art bj 1.png', 'Arts'),
(33, 'Community Engagement & Service', '<p></p><p>Community Connect is Miami Universityâ€™s new tool for the\r\npromotion, management, and tracking of volunteer opportunities in our region.\r\nWe believe this new tool will increase levels of community engagement in\r\nSouthwest Ohio and provide us with a more accurate picture of how we are\r\nimpacting our communities together as nonprofits and educational institutions.</p>\r\n\r\n\r\n\r\n\r\n\r\n<br><p></p>', 'bj we2.png', 'Arts'),
(34, 'Miami Tribe Relation', 'Miami University and the Miami Tribe of OklahomaÂ enjoy a trusted and respectful relationship that has developed over almost 40 years, and exists on many levels,\r\ninstitutional and official, academic, and interpersonal.\r\n', 'sdd3.png', 'Arts'),
(35, 'Women''s Center', '<p></p><p>Established in 1991, the\r\nWomen''s Center exists to support and empower women, educate the campus about\r\nwomen''s issues, and help the University achieve positive institutional change\r\nrelated to gender equity. We do this through resources and services, programs\r\nand events, opportunities for engagement and leadership, and welcoming space.</p>\r\n\r\n\r\n\r\n\r\n\r\n<br><p></p>', 'wqz5.jpg', 'Arts'),
(36, 'Diversity Affairs', '<p></p><p>Miami University''s Office of Diversity Affairs is responsible\r\nfor the development and implementation of programs, activities, and procedures\r\ndesigned to enhance the academic success, retention, and personal development\r\nof diverse student populations. ODA embodies a commitment to\r\ndiversity/multiculturalism as expressed through ability, age, ethnicity,\r\ngender, race, religion, sexual orientation, and socioeconomic differences<br></p>\r\n\r\n\r\n\r\n\r\n\r\n<br><p></p>', 'qwe4.jpg', 'Arts'),
(37, 'Global Initiatives', 'Global Initiatives is the\r\ncampus center supporting and encouraging the Miami University commitment to\r\ndynamic and comprehensive internationalization resulting in a diverse cultural\r\nand global learning experience for students.', 'qww6.jpg', 'Arts'),
(38, 'College of Creatives Arts', '<p></p><p>The College of Creative\r\nArts prepares students for global engagement as practitioners, educators,\r\ncreators, advocates and patrons of the arts. We foster the development of\r\nprofessional skills and intellectual growth necessary for the pursuit of\r\ncreative and scholarly inquiry by extending artistic traditions, while\r\nembracing a culture of innovation and change.<br></p>\r\n\r\n\r\n\r\n\r\n\r\n<br><p></p>', 'weqw7.jpg', 'Arts'),
(39, 'The Art Center', 'Miami University''s Art\r\nCenter offers students, faculty, staff and community members a variety of\r\nopportunities to engage in creative activities. The Art Center is located in\r\nPhillips Hall, 420 S. Oak Street in Oxford. It consists of a ceramics/pottery\r\nstudio, a digital photo lab, wood shop, and metals/jewelry/glass studio.', 'zdc8.png', 'Arts'),
(40, 'The Cage Gallery', 'The Alumni Hall Cage\r\nGallery showcases student and faculty work, highlights on and off campus\r\neducational experiences, and exhibits the work of prominent architects,\r\ndesigners, and scholars--often in conjunction with the departmental lecture\r\nseries.', 'dsac9.png', 'Arts'),
(41, 'Donaroo', 'Every\r\nspring, USFâ€™s Campus Activities Board brings up-and-coming musicians to campus\r\nfor exclusive concerts. Past shows have featured Macklemore & Ryan Lewis,\r\nA-Trak, Krewella, and Mike Posner.', 'zdsz10.jpg', 'Arts'),
(42, 'Basketball', 'Basketball is a team sport in which two teams of five players, opposing one another on a rectangular court, compete with the primary objective of shooting a basketball (approximately 9.4 inches (24 cm) in diameter) through the defender''s hoop (a basket 18 inches (46 cm) in diameter mounted 10 feet (3.048 m) high to a backboard at each end of the court) while preventing the opposing team from shooting through their own hoop. A field goal is worth two points, unless made from behind the three-point line, when it is worth three. After a foul, timed play stops and the player fouled or designated to shoot a technical foul is given one or more one-point free throws. The team with the most points at the end of the game wins, but if regulation play expires with the score tied, an additional period of play (overtime) is mandated.', 'lebron james 1 ath.jpg', 'Athletics'),
(43, 'Volleyball', 'the first two touches are used to set up for an attack, an attempt to direct\r\nthe ball back over the net in such a way that the serving team is unable to prevent\r\nit from being grounded in their court.\r\nA field goal is worth two points, unless made from behind the three-point line, when it is worth three. After a foul, timed play stops and the player fouled or designated to shoot a technical foul is given one or more one-point free throws. The team with the most points at the end of the game wins, but if regulation play expires with the score tied, an additional period of play (overtime) is mandated.', 'qawvolleyathle2.jpg', 'Athletics'),
(44, 'Tennis', 'Tennis is a racket sport that can be played individually against a single opponent (singles) or between two teams of two players each (doubles). Each player uses a tennis racket that is strung with cord to strike a hollow rubber ball covered with felt over or around a net and into the opponent''s court. The object of the game is to maneuver the ball in such a way that the opponent is not able to play a valid return. The player who is unable to return the ball will not gain a point, while the opposite player will.', 'weaathlet3.jpg', 'Athletics'),
(45, 'Badminton', 'Although it may be played with larger teams, the most common forms of the game are "singles" (with one player per side) and "doubles" (with two players per side). Badminton is often played as a casual outdoor activity in a yard or on a beach; formal games are played on a rectangular indoor court. Points are scored by striking the shuttlecock with the racquet and landing it within the opposing side''s half of the court.\r\n\r\nEach side may only strike the shuttlecock once before it passes over the net. Play ends once the shuttlecock has struck the floor or if a fault has been called by the umpire.\r\n\r\nThe shuttlecock is a feathered or (in informal matches) plastic projectile which flies differently from the balls used in many other sports. In particular, the feathers create much higher causing the shuttlecock to decelerate more rapidly. Shuttlecocks also have a high top speed compared to the balls in other racquet sports. The flight of the shuttlecock gives the sport its distinctive nature.', 'asdathle4.jpg', 'Athletics'),
(46, 'Football', 'Association football, more commonly known as football or soccer,[a] is a team sport played with a spherical ball between two teams of eleven players. It is played by 250 million players in over 200 countries and dependencies, making it the world''s most popular sport.[5][6][7][8] The game is played on a rectangular field called a pitch with a goal at each end. The object of the game is to score by moving the ball beyond the goal line into the opposing goal.', 'wdeathlet 6.jpg', 'Athletics'),
(47, 'Boxing', 'Boxing is a combat sport in which two people, usually wearing protective gloves, throw punches at each other for a predetermined amount of time in a boxing ring. Amateur boxing is both an Olympic and Commonwealth Games sport and is a common fixture in most international gamesâ€”it also has its own World Championships. Boxing is overseen by a referee over a series of one- to three-minute intervals called rounds. The result is decided when an opponent is deemed incapable to continue by a referee, is disqualified for breaking a rule, resigns by throwing in a towel. If a fight completes all of its allocated rounds, the victor is determined by judges'' scorecards at the end of the contest. In the event that both fighters gain equal scores from the judges, professional bouts are considered a draw. In Olympic boxing, because a winner must be declared, judges award the content to one fighter on technical criteria.', 'awedathlet5.jpg', 'Athletics'),
(48, 'Swimming', 'Swimming is an individual or team sport that requires the use of one''s arms and legs to move the body through water. The sport takes place in pools or open water (e.g., in a sea or lake). Competitive swimming is one of the most popular Olympic sports,[1] with varied distance events in butterfly, backstroke, breaststroke, freestyle, and individual medley. In addition to these individual events, four swimmers can take part in either a freestyle or medley relay. A medley relay consists of four swimmers who will each swim a different stroke. The order for a medley relay is: backstroke, breaststroke, butterfly, and freestyle. Swimming each stroke requires a set of specific techniques; in competition, there are distinct regulations concerning the acceptable form for each individual stroke.[2] There are also regulations on what types of swimsuits, caps, jewelry and injury tape that are allowed at competitions.[3] Although it is possible for competitive swimmers to incur several injuries from the sport, such as tendinitis in the shoulders or knees, there are also multiple health benefits associated with the sport.', 'wada8.jpg', 'Athletics'),
(49, 'Baseball', 'Baseball is a bat-and-ball game played between two opposing teams who take turns batting and fielding. The game proceeds when a player on the fielding team, called the pitcher, throws a ball which a player on the batting team tries to hit with a bat. The objectives of the offensive team (batting team) are to hit the ball into the field of play, and to run the basesâ€”having its runners advance counter-clockwise around four bases to score what are called "runs". The objective of the defensive team (fielding team) is to prevent batters from becoming runners, and to prevent runners'' advance around the bases.[2] A run is scored when a runner legally advances around the bases in order and touches home plate (the place where the player started as a batter). The team that scores the most runs by the end of the game is the winner.', 'awzsathlet8.jpg', 'Athletics'),
(50, 'Chess', 'Chess is a two-player strategy board game played on a chessboard, a checkered game board with 64 squares arranged in an 8Ã—8 grid.[1] The game is played by millions of people worldwide. Chess is believed to have originated in India sometime before the 7th century. The game was derived from the Indian game chaturanga, which is also the likely ancestor of the Eastern strategy games xiangqi, janggi, and shogi. Chess reached Europe by the 9th century, due to the Umayyad conquest of Hispania. The pieces assumed their current powers in Spain in the late 15th century; the rules were standardized in the 19th century.\r\n\r\nPlay does not involve hidden information. Each player begins with 16 pieces: one king, one queen, two rooks, two knights, two bishops, and eight pawns. Each of the six piece types moves differently, with the most powerful being the queen and the least powerful the pawn. The objective is to checkmate[note 1] the opponent''s king by placing it under an inescapable threat of capture. To this end, a player''s pieces are used to attack and capture the opponent''s pieces, while supporting each other. During the game, play typically involves making exchanges of one piece for an opponent''s similar piece, but also finding and engineering opportunities to trade one piece for two, or to get a better position. In addition to checkmate, a player wins the game if the opponent resigns, or (in a timed game) runs out of time. There are also several ways that a game can end in a draw.\r\n\r\n', 'wfdfathlet9.jpg', 'Athletics'),
(51, 'Gymnastics', 'Gymnastics is a sport that requires balance, strength, flexibility, agility, coordination and endurance. The movements involved in gymnastics contribute to the development of the arms, legs, shoulders, back, chest and abdominal muscle groups. Alertness, precision, daring, self-confidence and self-discipline are mental traits that can also be developed through gymnastics.[1] Gymnastics evolved from exercises used by the ancient Greeks that included skills for mounting and dismounting a horse, and from circus performance skills.\r\n\r\nMost forms of competitive gymnastics events are governed by the Federation Internationale de Gymnastique (FIG). Each country has its own national governing body (BIW) affiliated to FIG. Competitive artistic gymnastics is the best known of the gymnastic events. It typically involves the women''s events of vault, uneven bars, balance beam and floor exercise as well as the men''s events of floor exercise, pommel horse, still rings, vault, parallel bars and horizontal bar.', 'errfathlet10.jpg', 'Athletics');

-- --------------------------------------------------------

--
-- Table structure for table `subject_data`
--

CREATE TABLE `subject_data` (
  `subjectId` int(11) NOT NULL,
  `subjectCode` varchar(20) NOT NULL,
  `subjectDesc` varchar(128) NOT NULL,
  `subjectLab` int(5) NOT NULL,
  `subjectLec` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_data`
--

INSERT INTO `subject_data` (`subjectId`, `subjectCode`, `subjectDesc`, `subjectLab`, `subjectLec`) VALUES
(1, 'GEC101', 'Understanding the self', 0, 3),
(2, 'GEC102', 'Readings in the Philippine History', 0, 3),
(3, 'GEC104', 'Mathematics of the Modern World', 0, 3),
(4, 'IT101', 'Introduction to Computing', 1, 2),
(5, 'IT102', 'Computer Programming 1', 1, 2),
(6, 'FIL101', 'Komunikasyon sa Akademikong Filipino', 0, 3),
(7, 'NSTP1', 'National Service Training Program', 0, 3),
(8, 'PE1', 'Physical Fitness', 0, 2),
(9, 'GEC105', 'Purposive Communication', 0, 3),
(10, 'GEC107', 'Science, Technology and Society', 0, 3),
(11, 'IBC101', 'Grammar Review', 0, 3),
(12, 'IT111', 'Platform Technologies', 0, 3),
(13, 'IT112', 'Computer Programming 2', 1, 2),
(14, 'IT113', 'Discrete Mathematics', 0, 3),
(15, 'FIL102', 'Panitikan', 0, 3),
(16, 'NSTP2', 'National Service Training Program 2', 0, 3),
(17, 'PE2', 'Rhythmic Activities', 0, 2),
(18, 'LIT101', 'World Literature', 0, 3),
(19, 'GEC103', 'The Contemporary World', 0, 3),
(20, 'IT201', 'Data Structure and Algorithm', 1, 2),
(21, 'IT202', 'Quantitative Methods', 0, 3),
(22, 'IT203', 'Introduction to Human Computer Interaction 1', 0, 3),
(23, 'IT204', 'Object-Oriented Programming', 1, 2),
(24, 'IT205', 'Networking 1', 1, 2),
(25, 'PE3', 'Single/dual Sports', 0, 2),
(26, 'IT211', 'Information Management', 1, 2),
(27, 'GEC106', 'Art Appreciation', 0, 3),
(28, 'IT212', 'Event-Driven Programming', 1, 2),
(29, 'IT213', 'Networking 2', 1, 2),
(30, 'IT214', 'Integrative Programming and Technologies 1', 1, 2),
(31, 'IT215', 'Fundamentals of Database Systems', 1, 2),
(32, 'IT216', 'Human and Computer Interaction 2', 1, 2),
(33, 'GEC108', 'Ethics', 0, 3),
(34, 'PE4', 'Team Sports', 0, 2),
(35, 'IT301', 'Advance Database Systems', 1, 2),
(36, 'GEC-101', 'Understanding the Self', 0, 3),
(37, 'IT302', 'Social and Professional Issues', 0, 3),
(38, 'IT303', 'System Integration and Architecture 1', 0, 3),
(39, 'IT305', 'Web Systems and Technologies', 1, 2),
(40, 'GEC-102', 'Readings in the Philippine History', 0, 3),
(41, 'IT306', 'System Analysis and Design', 0, 3),
(42, 'GEC-103', 'Contemporary World', 0, 3),
(43, 'IT307', 'Integration Programming and Technologies 2', 1, 2),
(44, 'EL-100', 'Introduction to Linguistic', 0, 3),
(45, 'EL-101', 'Language,Culture,Society', 0, 3),
(46, 'IT311', 'Information Assurance and  Security 1', 0, 3),
(47, 'EL-102', 'Structure of English', 0, 3),
(48, 'FIL-101', 'Komunikasyon sa Akademikong Filipino', 0, 3),
(49, 'IT312', 'Multimedia Systems', 1, 2),
(50, 'IBC-101', 'Grammar Review', 1, 3),
(51, 'PE-1', 'Physical Fitness 1', 0, 3),
(52, 'IT313', 'Application Development and Emerging Technologies', 1, 2),
(53, 'NSTP-1', 'NSTP-1', 0, 3),
(54, 'IT314', 'Capstone Project 1', 0, 3),
(55, 'IBC102', 'English Computerized Learning Program', 1, 2),
(56, 'GEC-104', 'Mathematics in the Modern World', 0, 3),
(57, 'IT401', 'System Administration and Maintenance', 1, 2),
(58, 'IT402', 'Capstone Project 2', 0, 3),
(59, 'GEC-105', 'Purposive Communication', 0, 3),
(60, 'IT404', 'System Integration and Architecture 2', 0, 3),
(61, 'GEC109', 'Life and Works of Rizal', 0, 3),
(62, 'EL-103', 'Principles and Theories of Language Acquisition and Learning', 0, 3),
(63, 'IT411', 'Practicum', 0, 6),
(64, 'EL-104', 'Language Programs and Policies in Multilingual Societies', 0, 3),
(65, 'EL-105', 'Language Learning Materials Development', 0, 3),
(66, 'EDUC-101', 'The Child and Adolescent Learners and Learning Principles', 0, 3),
(67, 'FIL-102', 'Panitikan', 0, 3),
(68, 'IBC-102', 'English Computerize Learning Program', 1, 3),
(69, 'PE-2', 'Rhythmic Activities', 0, 3),
(70, 'NSTP-2', 'NSTP-2', 0, 3),
(71, 'GEC-106', 'Art Appreciation', 0, 3),
(72, 'GEC-107', 'Science Technology and Society', 0, 3),
(73, 'GEC-108', 'Ethics', 0, 3),
(74, 'GEC-109', 'Rizal', 0, 3),
(75, 'EL-106', 'Teaching and Assessment of Literature Studies', 0, 3),
(76, 'EL-107', 'Teaching and Assessment of the Macroskills', 0, 3),
(77, 'EL-108', 'Teaching and Assessment of Grammar', 0, 3),
(78, 'EL-109', 'Speech and Theater Arts', 0, 3),
(79, 'EDUC-102', 'The Teaching Profession', 0, 3),
(80, 'PE-3', 'Individual and Dual Sports', 0, 2),
(81, 'GEE-110', 'Mathematics,Science and Technology (Leaving in IT Era)', 0, 3),
(82, 'GEE-111', 'Social,Science and Philosophy(Gender in Society)', 0, 3),
(83, 'GEE-112', 'Arts and Humanities (Reading Visual Arts)', 0, 3),
(84, 'EL-110', 'Language Education Research', 0, 3),
(85, 'EL-111', 'Children and Adolescent Literature', 0, 3),
(86, 'EL-112', 'Methology and Folklore', 0, 3),
(87, 'EL-113', 'Survey of Philippine Literature in English', 0, 3),
(88, 'EDUC-103', 'The Teacher and the Community,School Culture and Organizational Leadership', 0, 3),
(89, 'PE-4', 'Team Sports/Games', 0, 2),
(90, 'EL-114', 'Survey of Afro-Asian Literature', 0, 3),
(91, 'EL-115', 'Survey of English and American Literature', 0, 3),
(92, 'EL-116', 'Contemporary,Popular and Emergent Literature', 0, 3),
(93, 'EL-117', 'Literary Criticism', 0, 3),
(94, 'EL-118', 'Technical Writing', 0, 3),
(95, 'EDUC-104', 'Foundation of Special and Inclusive Education', 0, 3),
(96, 'EDUC-105', 'Facilitating Learner-Centered Teaching', 0, 3),
(97, 'EDUC-106', 'Assessment in Learning 1', 0, 3),
(98, 'RS-1', 'Review Subject 1', 0, 1),
(99, 'EL-119', 'Campus Journalism', 0, 3),
(100, 'EDUC-108', 'Technology for Teaching and Learning 1', 0, 3),
(101, 'ELEC-101', 'Translation', 0, 3),
(102, 'ELEC-102', 'Remedial Instruction', 0, 3),
(103, 'EDUC-107', 'Assessment in Learning 2', 0, 3),
(104, 'TTL-2', 'Technology for Teaching and Learning 2 (Technology in Language Education)', 0, 3),
(105, 'EDUC-109', 'The Teachers and the School Curriculum', 0, 3),
(106, 'EDUC-110', 'Building and Enhancing New Literacies Across the Curriculum', 0, 3),
(107, 'RS-2', 'Review Subject 2', 0, 1),
(108, 'EDUC-111', 'Field Study 1', 0, 3),
(109, 'EDUC-112', 'Field Study 2', 0, 3),
(110, 'EDUC-113', 'Teaching Internship', 6, 0),
(111, 'GEC-101', 'Understanding the Self', 0, 3),
(112, 'GEC-107', 'Science Technology and Society', 0, 3),
(113, 'GEC-102', 'Readings in the Philippine History', 0, 3),
(114, 'GEC-108', 'Ethics', 0, 3),
(115, 'GEC-103', 'Contemporary World', 0, 3),
(116, 'GEC-109', 'Rizal', 0, 3),
(117, 'GEC-104', 'Mathematics in the Modern World', 0, 3),
(118, 'GEC-105', 'Purposive Communication', 0, 3),
(119, 'GEE-110', 'Mathematics,Science and Technology', 0, 3),
(120, 'GEC-106', 'Art Appreciation', 0, 3),
(121, 'GEE-111', 'Social Science and Philosophy(Gender in Society)', 0, 3),
(122, 'EDUC-101', 'The Child and Adolescent Learners and Learning Principles', 0, 3),
(123, 'GEE-112', 'Arts and Humanities(Reading Visual Arts)', 0, 3),
(124, 'FIL-101', 'Komunikasyon sa Akademikong Filipino', 0, 3),
(125, 'PE-1', 'Physical Fitness 1', 0, 2),
(126, 'EDUC-110', 'Building and Enhancing New Literacies Across the Curriculum', 0, 3),
(127, 'PE-2', 'Rhythmic Activities', 0, 2),
(128, 'NSTP-1', 'NSTP 1', 0, 3),
(129, 'NSTP-2', 'NSTP 2', 0, 3),
(130, 'EDUC-102', 'The Teaching Profession', 0, 3),
(131, 'EDUC-108', 'Technology for Teaching and Learning 1', 0, 3),
(132, 'EDUC-104', 'Foundations of Special and Inclusive Education', 0, 3),
(133, 'EDUC-105', 'Facilitating Learner-Centered Teaching', 0, 3),
(134, 'SCI-102', 'Teaching Science in Elementary Grades', 0, 3),
(135, 'MATH-102', 'Teaching Math in the Intermediate Grades', 0, 3),
(136, 'MTB-MLE', 'Content and Pedagogy for the Mother Tongue', 0, 3),
(137, 'SCI-101', 'Teaching Science in Elementary Grades ( Biology and Chemistry )', 0, 3),
(138, 'SSC-102', 'Teaching Social Studies in Elementary Grades', 0, 3),
(139, 'MATH-101', 'Teaching Math in the Primary Grades', 0, 3),
(140, 'TLE-101', 'Edukasyong Pantahan at Pangkabuhayan', 0, 3),
(141, 'IBC-102', 'English Computerize Learning Program', 1, 3),
(142, 'PE-4', 'Team Sports/Games', 0, 2),
(143, 'SSC-101', 'Teaching Social Studies in Elementary Grades', 0, 3),
(144, 'ENG-102', 'Elective:Teaching Multi-Grades Classes', 0, 3),
(145, 'FIL-201', 'Pagtuturo ng Filipino sa Elementarya (I)', 0, 3),
(146, 'EDUC-103', 'The Teacher and the Community,School Culture', 0, 3),
(147, 'EDUC-107', 'Assessment of Learning 2', 0, 3),
(148, 'VED', 'Good Manners and Right Conduct', 0, 3),
(149, 'IBC-101', 'English Grammar', 0, 3),
(150, 'PEH', 'Teaching PE and Health in the Elementary Grades', 0, 3),
(151, 'FIL-202', 'Pagtuturo ng Filipino sa Elemetarya', 0, 3),
(152, 'PE-3', 'Individual and Dual Sports', 0, 2),
(153, 'RES', 'Research in Education', 0, 3),
(154, 'TLE-102', 'Edukasyong Pantahanan at Pangkabuhayan', 0, 3),
(155, 'RS 2', 'Review Subject 2', 0, 1),
(156, 'EDUC-113', 'Teaching Internship', 6, 0),
(157, 'TEMPCODE', 'Teaching English in the Elementary Grades ( Language Arts )', 0, 3),
(158, 'EDUC-109', 'Teacher in the School Curriculum', 0, 3),
(159, 'TTL-2', 'Technology for Teaching and Learning in the Elementary', 0, 3),
(160, 'EDUC-106', 'Assessment of Learning 1', 0, 3),
(161, 'MUSIC', 'Teaching Music in the Elementary Grades', 0, 3),
(162, 'ENG-101', 'Teaching English in the Elementary Grades Through Literature', 0, 3),
(163, 'ARTS', 'Teaching Arts in Elementary Grades', 0, 3),
(164, 'RS-1', 'Review Subject 1', 0, 1),
(165, 'EDUC-111', 'Field Study 1', 0, 3),
(166, 'EDUC-112', 'Field Study 2', 0, 3),
(167, 'Gec101', 'Understanding the self', 0, 3),
(168, 'GEC102', 'Reading in the Philippine History', 0, 3),
(169, 'GEC103', 'The Contemporary World', 0, 3),
(170, 'GEC104', 'Mathematics of the modern world', 0, 3),
(171, 'GEE101', 'Mathematics,science and technology(leaving in the IT era)', 0, 3),
(172, 'Fil101', 'Kumunikasyon sa akademikong Filipino', 0, 3),
(173, 'IBC101', 'Readings and writings with grammar Review', 0, 3),
(174, 'Criminology 101', 'Introduction to criminology', 0, 3),
(175, 'NSTP1', 'National Service Training Program', 0, 3),
(176, 'PE1', 'foundamental of Martial Arts', 0, 2),
(177, 'GEC105', 'Purposive Communication', 0, 3),
(178, 'GEC106', 'Art Appreciation', 0, 3),
(179, 'GEC107', 'Science,Technology and Society', 0, 3),
(180, 'Fil102', 'Panitikan', 0, 3),
(181, 'CLJ101', 'Introduction to philippine criminal Justice System', 0, 3),
(182, 'LEA101', 'Law Enforcement Organization and administration', 0, 3),
(183, 'NSTP2', 'National Service Training Program', 0, 3),
(184, 'PE2', 'Arnis and Disaming Techniques', 0, 2),
(185, 'GEE102', 'Philippine Popular Culture', 0, 2),
(186, 'GEE103', 'Gender and Society', 0, 0),
(187, 'GEE109', 'Life and works of Rizal', 0, 0),
(188, 'CFML201', 'Character Formation,Nationalism and patriotism', 0, 3),
(189, 'CDI201', 'Foundamentals of criminal investigation and intelligence', 0, 3),
(190, 'Forensic201', 'Forensic Photography', 0, 3),
(191, 'LEA202', 'Comparative Models in policing', 0, 3),
(192, 'Criminology 202', 'Theories of crime causation', 0, 3),
(193, 'REV.1', 'Review class-1', 0, 1),
(194, 'PE3', 'First aid and water safety', 0, 2),
(195, 'CDI202', 'Specialized crime investigation 1 with legal medicine', 0, 3),
(196, 'CLJ202', 'Human Rights Education', 0, 3),
(197, 'Forensic202', 'Personal Identification Techniques', 0, 3),
(198, 'AdGE201', 'General Chemistry(Organic)', 0, 3),
(199, 'criminology203', 'Human Behavior and Victimology', 0, 3),
(200, 'criminology204', 'Proffesional Conduct and Ethical Standards', 0, 3),
(201, 'LEA203', 'Introduction to Industrial security concepts', 0, 3),
(202, 'PE4', 'marksmanship and combat shooting', 0, 3),
(203, 'Rev-2', 'Review class-2', 0, 3),
(204, 'CA302', 'Non-Institutional Correction', 0, 3),
(205, 'CFLM302', 'Character formation with leadership,descision making,management andadministration', 0, 3),
(206, 'CDI303', 'Specialized crime investigation 2', 0, 3),
(207, 'Forensic303', 'Forensic Chemistry and toxilogy', 0, 3),
(208, 'CDI304', 'Traffic management operation and accident investigation with driving', 0, 3),
(209, 'LEA304', 'Law enforcement operation and planning with crime mapping', 0, 3),
(210, 'CLLJ303', 'criminal law(book-1)', 0, 3),
(211, 'Criminology 305', 'juvvenile delinquency and juvvenile justice system', 0, 3),
(212, 'rev3', 'review class-3', 0, 3),
(213, 'IBC302', 'english computerized learning program', 0, 3),
(214, 'CLJ304', 'criminal law(book-2)', 0, 3),
(215, 'CA303', 'theraputics modalities', 0, 3),
(216, 'forensic304', 'question documentation Examinitation', 0, 3),
(217, 'Criminology 306', 'Dispute resolution and crises/incidents management', 0, 3),
(218, 'Forensic 305', 'lie detection techniques', 0, 3),
(219, 'CDI 305', 'Technical English 1(Technical report writing and presentation)', 0, 3),
(220, 'CDI 306', 'Fire protection and arson investigation', 0, 3),
(221, 'criminology 307', 'criminological research 1(Research methods with applied statistics)', 0, 3),
(222, 'REV.4', 'Review class', 0, 3),
(223, 'Criminology 408', 'Criminogical research 2(Thesis writing and presentation)', 0, 3),
(224, 'CLJ405', 'Criminals Evidence', 0, 0),
(225, 'forensic 406', 'Forensic Ballistics', 0, 0),
(226, 'CLJ 406', 'Criminal Procedure and court testimony', 0, 3),
(227, 'CDI407', 'Vice and drug Education and control', 0, 3),
(228, 'CDI 408', 'Technical English 2(legal forms)', 0, 3),
(229, 'CDI409', 'Introduction to cybercrime and environment laws and protection', 0, 3),
(230, 'STP', 'Student congress,tour and seminars', 0, 3),
(231, 'REV.5', 'Review class-5', 0, 3),
(232, 'Criminology practicu', 'Internship (on the Training)', 0, 3),
(233, 'GEC101', 'Understanding the Self', 0, 3),
(234, 'GEC102', 'Reading in the Phil.History', 0, 3),
(235, 'GEC103', 'Contemporary World', 0, 3),
(236, 'GEC104', 'Mathematics in the Modern World', 0, 3),
(237, 'ELS100', 'History of the English Language', 0, 3),
(238, 'FIL101', 'Komunikasyon sa Akademikong Filipino', 0, 3),
(239, 'PE1', 'Physical Fitness', 0, 2),
(240, 'NSTP1', 'National Service Training Program', 0, 3),
(241, 'GEC105', 'Purposive Communication', 0, 3),
(242, 'GEC106', 'Art Appreciation', 0, 3),
(243, 'GEC107', 'Science Technology and Society', 0, 3),
(244, 'ELS101', 'Introduction to the English Language', 0, 3),
(245, 'ELS102', 'Theories of Language and Language Acquisit', 0, 3),
(246, 'ELS132', 'Multilingualism and Multiculturalism', 0, 3),
(247, 'PE2', 'Rhythmic Activities', 0, 2),
(248, 'NSTP2', 'National Service Training Program', 0, 3),
(249, 'ELS104', 'English Phonology and Morphology', 0, 3),
(250, 'ELS105', 'English Syntax', 0, 3),
(251, 'ELS136', 'Foundations of Eng Lang. Tchng ', 0, 3),
(252, 'ELS136', 'English Computerized Learning Program', 0, 3),
(253, 'GEC108', 'Ethics', 0, 3),
(254, 'IBC101', 'English Computerized Learning Program', 0, 3),
(255, 'FIL102', 'Masining Na Pagpapahayag', 0, 3),
(256, 'PE3', 'Individuals/Dual/Sports Games', 0, 2),
(257, 'ELS106', 'Semantics of English', 0, 3),
(258, 'ELS109', 'Introduction to Language, Society and Cul.', 0, 3),
(259, 'FL201', 'Foreign Language 1', 0, 3),
(260, 'ELS110', 'Language of Literary Texts', 0, 3),
(261, 'PE4', 'Team Sports/Games', 0, 2),
(262, 'ELS133', 'ELT Approaches and Methods', 0, 3),
(263, 'ELS137', 'English Language Curriculum and Devt', 0, 3),
(264, 'ELS107', 'English Discourse', 0, 3),
(265, 'ELS108', 'Stylistics', 0, 3),
(266, 'ELS111', 'Language of Non-Literary Texts', 0, 3),
(267, 'FL202', 'Foreign Language 2', 0, 3),
(268, 'FIL103', 'Panitikan', 0, 3),
(269, 'ELS112', 'Computer-Mediated Comunication', 0, 3),
(270, 'FL202', 'Foreign Language 2', 0, 3),
(271, 'FIL103', 'Panitikan', 0, 3),
(272, 'ELS199', 'Language Research 1:Methodology', 0, 3),
(273, 'ELS142', 'Language and Journalism', 0, 3),
(274, 'ELS138', 'Technical Writing in the Professions', 0, 3),
(275, 'ELS148', 'Intercultural Communication', 0, 3),
(276, 'ELS143', 'Language and Advertising', 0, 3),
(277, 'FL303', 'Foreign Language 3', 0, 3),
(278, 'ELS200', 'Language Research 11: Thesis', 0, 3),
(279, 'ELS147', 'Organizational Communication', 0, 3),
(280, 'GEC101', 'Understanding the Self', 0, 3),
(281, 'CBR-101', 'Oral Communication', 0, 3),
(282, 'ELS149', 'Issues and Perspectives in Eng.Acc.Prof', 0, 3),
(283, 'CBR-101', 'Contemporary Philippine Arts from the Region', 0, 3),
(284, 'CBR-101', 'Introduction to Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 0, 3),
(285, 'CBR-101', 'Personal Development/Pansariling Kaunlaran', 0, 3),
(286, 'LIT101', 'Philippine Literature', 0, 3),
(287, 'CBR-105', 'General Mathematics', 0, 3),
(288, 'FIL 101', 'Komunikasyon sa akademikong Filipino', 0, 3),
(289, 'OME-101', 'Operation Research', 0, 3),
(290, 'NSTP1', 'National Service Training Program(CWTS)', 0, 3),
(291, 'FL404', 'Foreign Language 4', 0, 3),
(292, 'PE 1', 'Physical Fitness', 0, 3),
(293, 'CBR-107', 'Media and Information Literacy', 0, 3),
(294, 'CBR-111', 'Understanding Society Culture ', 0, 3),
(295, 'RIzal', 'Rizal''s Life and Works', 0, 3),
(296, 'CBR-112', 'Physical Science', 0, 3),
(297, 'CBR-113', 'Earth and Life Science', 0, 3),
(298, 'IBC 101', 'Reading and Writing with Grammar Review', 0, 3),
(299, 'FIL 102', 'Panitikan', 0, 3),
(300, 'OME-102', 'Entrepreneurial Management', 0, 3),
(301, 'NSTP-2', 'National Services Training Program', 0, 3),
(302, 'ELS149', 'Issues and Perspectives in Eng.Acc.Prof', 0, 3),
(303, 'PE2', 'Rhythmic Activities', 0, 3),
(304, 'SBR-101', 'Fundamentals of Accounting/Business and Management', 0, 3),
(305, 'SBR-104', 'Organization and Management', 0, 3),
(306, 'SBR-105', 'Business Marketing', 0, 3),
(307, 'GEC105', 'Purposive Communication', 0, 3),
(308, 'ELS150', 'Special Topics in Eng Acc  the Professions', 0, 3),
(309, 'GEC102', 'Readings in the Phil.History', 0, 3),
(310, 'GEC103', 'The Contemporary World', 0, 3),
(311, 'LIT102', 'World Literature', 0, 3),
(312, 'GEC104', 'Mathematics in the modern world', 0, 3),
(313, 'GEE102', 'Social Science ', 0, 3),
(314, 'BA101', 'Basic Microeconomics(Econ)', 0, 3),
(315, 'OMC-101', 'Inventory Management  and Control', 0, 3),
(316, 'OME-103', 'Balance Scorecard', 0, 3),
(317, 'OME-104', 'Financial Management', 0, 3),
(318, 'PE 3', 'Individual and Dual Sports', 0, 3),
(319, 'GEC107', 'Science,Technology ', 0, 3),
(320, 'GEC109', 'Rizal''s Life and Works', 0, 3),
(321, 'BA102', 'Business Law(Obligation ', 0, 3),
(322, 'BA103', 'Taxation (Income Taxation)', 0, 3),
(323, 'ABI', 'Internship', 0, 3),
(324, 'OMC-102', 'Logistic Management', 0, 3),
(325, 'OMC-103', 'Project Management', 0, 3),
(326, 'OME-105', 'Enterprise Resource Planning', 0, 3),
(327, 'OME-106', 'Marketing Management', 0, 3),
(328, 'PE 4', 'Team Sports Game', 0, 3),
(329, 'SBR-104', 'Business Finance', 0, 3),
(330, 'SBR-105', 'Applied Economics', 0, 3),
(331, 'GEC 108', 'Ethics', 0, 3),
(332, 'GEE 101', 'Mathematics, Science ', 0, 3),
(333, 'IBC102', 'English Computerized Learning Program', 0, 3),
(334, 'BME101', 'Strategic Management', 0, 3),
(335, 'BA104', 'Social Responsibility ', 0, 3),
(336, 'BA105', 'Human Resource Management', 0, 3),
(337, 'BA106', 'International Trade ', 0, 3),
(338, 'OMC-104', 'Facilities Management', 0, 3),
(339, 'OMC-105', 'Productivity Quality Tools', 0, 3),
(340, 'OME-107', 'Global International Trade', 0, 3),
(341, 'CBR-109', 'Statistics and Probability', 0, 3),
(342, 'GEC103', 'Arts ', 0, 3),
(343, 'BA107', 'Business Research', 0, 3),
(344, 'BME102', 'Operation Management (TQM)', 0, 3),
(345, 'OMC-106', 'Environmental Management System', 0, 3),
(346, 'OMC-107', 'Costing ', 0, 3),
(347, 'OME-108', 'Management Information System', 0, 3),
(348, 'GEC106', 'Art Appreciation', 0, 3),
(349, 'CBR-111', 'Understanding Society Culture and Politics', 0, 3),
(350, 'CBR-110', '21st Century Literature from the Philippines and the World', 0, 3),
(351, 'OMC-108', 'Special Topics in Operations Management', 0, 3),
(352, 'OME-109', 'Managerial Accounting', 0, 3),
(353, 'OME-110', 'Configuration Management', 0, 3),
(354, 'OME-111', 'Environmental Management', 0, 3),
(355, 'BA109', 'Thesis or Feasibility Study', 0, 3),
(356, 'MME-112', 'Personal Finance', 0, 3),
(357, 'OJT01', 'Practicum Integrated Learning', 0, 3),
(358, 'GEC-105', 'Purposive Communication', 0, 3),
(359, 'GEC-102', 'Readings in Philippine History', 0, 3),
(360, 'GEC 104', 'Mathematics in the Modern World', 0, 3),
(361, 'FIL 101', 'Komunikasyon sa Akademikong Filipino', 0, 3),
(362, 'THC 101', 'Macro Perspective of Tourism and Hospitality', 0, 3),
(363, 'THC 102', 'Risk Management and Applied to Safety,Security and Sanitation', 0, 3),
(364, 'GEE 110', 'Mathematics,Science and Technology (Living in the IT Era)', 0, 3),
(365, 'PE 101', 'Physical Fitness', 0, 2),
(366, 'NSTP 1', 'NSTP', 0, 3),
(367, 'IBC 101', 'Grammar Review', 0, 3),
(368, 'FIL 102', 'Panitikan', 0, 3),
(369, 'THC 103', 'Quality Service Management in Tourism and Hospitality', 0, 3),
(370, 'TCH 104', 'Philippine,Tourism,Geography and Culture', 0, 3),
(371, 'THC 105', 'Micro Perspective of Tourism Hospitality', 0, 3),
(372, 'HMC 101', 'Kitchen Essentials ', 1, 2),
(373, 'HMC 102', 'Fundamentals in Lodging Operation', 1, 2),
(374, 'HME 101', 'Food and Beverage Service with Lab', 1, 2),
(375, 'PE 102', 'Rhythmic Activities', 0, 2),
(376, 'NSTP 101', 'NSTP', 0, 3),
(377, 'GEC 101', 'Understanding the Self', 0, 3),
(378, 'IBC 102', 'English Computerized Learning Program (ECLP)', 1, 2),
(379, 'GEE 111', 'Social Science ', 0, 3),
(380, 'HMC 103', 'Applied Business Tools and Technologies (PMS) With Lab', 1, 2),
(381, 'HMC 104', 'Supply Chain Management in Hospitality Industry', 0, 3),
(382, 'HME 102', 'Gastronomy ', 1, 2),
(383, 'HME 103', 'Culinary Fundamentals', 1, 2),
(384, 'PE 103', 'Individual and Dual Sports', 0, 2),
(385, 'GEC 107', 'Science Technology ', 0, 3),
(386, 'GEC 106', 'Arts Appreciation', 0, 3),
(387, 'GEC 108', 'Ethics', 0, 3),
(388, 'HMC 105', 'Fundamentals in Food Service Operation', 0, 3),
(389, 'THC 106', 'Entrepreneurship in Tourism and Hospitality', 0, 3),
(390, 'HMC 106', 'Foreign Language 1', 1, 2),
(391, 'HME 104', 'Cost Control', 0, 3),
(392, 'PE 104', 'Team Sports/Games', 0, 2),
(393, 'GEC 103', 'The Contemporary World', 0, 3),
(394, 'HME 105', 'Front Office Operation', 1, 2),
(395, 'HME 106', 'Bread ', 2, 1),
(396, 'HMC 106', 'Ergonomic ', 0, 3),
(397, 'HMC 107', 'Foreign Language 2', 1, 2),
(398, 'HME 107', 'ASIAN Cuisine', 2, 1),
(399, 'THC 107', 'Professional Development ', 0, 3),
(400, 'THC 108', 'Tourism ', 0, 3),
(401, 'BME 102', 'Strategic Management in Tourism and Hospitality', 0, 3),
(402, 'THC 109', 'Legal Aspects in Tourism ', 0, 3),
(403, 'THC 110', 'Multicultural Diversity in Workplace for the Tourism Professional', 0, 3),
(404, 'HMC 108', 'Introduction to Meetings,Incentives Conferences and Events Managements (MICE)', 1, 2),
(405, 'BME 101', 'Opeartion Management in Tourism Hospitality Industry', 0, 3),
(406, 'HME 108', 'Bar ', 1, 2),
(407, 'HME 109', 'Intro to Transport Services', 0, 3),
(408, 'HMC 110', 'Research in Hospitality', 0, 3),
(409, 'HME 110', 'Specialty Cuisine', 2, 1),
(410, 'GEC 109', 'Life ', 0, 3),
(411, 'GEE 112', 'Arts ', 0, 3),
(412, 'HME 111', 'Oenology ( Making of wine ', 2, 1),
(413, 'HME 112', 'Catering Management', 2, 1),
(414, 'OJT 1', 'Practicum', 0, 0),
(415, 'GEC 105', 'Purposive Communication', 0, 3),
(416, 'GEC 102', 'Readings in Philippines History', 0, 3),
(417, 'GEC 104', 'Mathematics in the Modern World', 0, 3),
(418, 'THC 101', 'Macro-Perspective in Tourism ', 0, 3),
(419, 'THC 102', 'Risk Management as Applied to Safety,Security ', 0, 3),
(420, 'FIL 101', 'Komunikasyon sa Akademikong Filipino', 0, 3),
(421, 'GEE 101', 'Mathematics,Science ', 1, 2),
(422, 'NSTP 1', 'National Service Training Program', 0, 3),
(423, 'PE 1', 'Physical Fitness', 0, 2),
(424, 'IBC 101', 'Grammar Review', 0, 3),
(425, 'FIL 102', 'Panitikan', 0, 3),
(426, 'TME 101', 'Agri-Tourism', 0, 3),
(427, 'THC 103', 'Quality Service Management in Tourism ', 0, 3),
(428, 'THC 104', 'Philippine Tourism,Geography ', 0, 3),
(429, 'THC 105', 'Micro Perspective in Tourism Management', 0, 3),
(430, 'TMC 101', 'Tour & Travel Management', 0, 3),
(431, 'PE 2', 'Rhythmic Activities', 0, 2),
(432, 'NSTP 2', 'National Service Training Program', 0, 2),
(433, 'NSTP 2', 'National Service Training Program', 0, 2),
(434, 'GEC 101', 'Understanding the Self', 0, 3),
(435, 'GEE 111', 'Social Science ', 0, 3),
(436, 'TMC 102', 'Applied Bus. Tools ', 1, 2),
(437, 'HME 102', 'Gastronomy ( Food ', 1, 2),
(438, 'TME 102', 'Heritage Tourism', 0, 3),
(439, 'TMC 104', 'Sustainable Tourism', 0, 3),
(440, 'TMC 103', 'Global Tourism,Geography ', 0, 3),
(441, 'IBC 102', 'English Computerize Learning Program (ECLP)', 1, 2),
(442, 'PE 3', 'Individual ', 0, 2),
(443, 'GEC 107', 'Science Technology ', 0, 3),
(444, 'GEC 106', 'Arts Appreciation', 0, 3),
(445, 'GEC 108', 'Ethics', 0, 3),
(446, 'TMC 105', 'Tourism Policy Planning and Development', 0, 3),
(447, 'THC 106', 'Entrepreneurship in Tourism/Hospitality', 0, 3),
(448, 'TMC 107', 'Foreign Language 1', 1, 2),
(449, 'TME 103', 'Tour Guiding', 0, 3),
(450, 'PE 4', 'Team Sports/Games', 0, 2),
(451, 'GEC 103', 'The Contemporary World', 0, 3),
(452, 'TMC 108', 'Foreign Language 2', 1, 2),
(453, 'HME 105', 'Front Office Operations', 1, 2),
(454, 'HME 113', 'Housekeeping Opeartions', 0, 3),
(455, 'THC 107', 'Professional Development ', 0, 3),
(456, 'THC 108', 'Tourism ', 0, 3),
(457, 'TME 104', 'Cruise Tourism', 0, 3),
(458, 'TME 105', 'Tourism Product ', 0, 3),
(459, 'BME 101', 'Operations Management in TH Industry', 0, 3),
(460, 'BME 102', 'Strategic Management in TH Industry', 0, 3),
(461, 'THC 109', 'Legal Aspect in Tourism ', 0, 3),
(462, 'THC 109', 'Multicultural Diversity in Workplace for Tourism', 0, 3),
(463, 'THC 110', 'Introduction to MICE', 1, 2),
(464, 'TME 106', 'Travel Writing ', 1, 2),
(465, 'TMC 109', 'Transportation Management ( Covers air,land,sea )', 0, 3),
(466, 'TMC 110', 'Research in Tourism', 0, 3),
(467, 'HME 110', 'Specialty Cuisine', 1, 2),
(468, 'GEC 109', 'Life ', 0, 3),
(469, 'HME 112', 'Catering Management', 1, 2),
(470, 'GEE 112', 'Arts ', 0, 3),
(471, 'TME 107', 'Destination Management ', 0, 3),
(472, 'OJT 101', 'Practicum 1', 0, 0),
(473, 'IT322', 'COMMINGSOON', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjunc_data`
--

CREATE TABLE `subjunc_data` (
  `subjuncId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL,
  `curId` int(11) NOT NULL,
  `programId` int(11) NOT NULL,
  `yearId` int(11) NOT NULL,
  `semId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjunc_data`
--

INSERT INTO `subjunc_data` (`subjuncId`, `subjectId`, `curId`, `programId`, `yearId`, `semId`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1),
(3, 3, 1, 1, 1, 1),
(4, 4, 1, 1, 1, 1),
(5, 5, 1, 1, 1, 1),
(6, 6, 1, 1, 1, 1),
(7, 7, 1, 1, 1, 1),
(8, 8, 1, 1, 1, 1),
(9, 9, 1, 1, 1, 2),
(10, 10, 1, 1, 1, 2),
(11, 11, 1, 1, 1, 2),
(12, 12, 1, 1, 1, 2),
(13, 13, 1, 1, 1, 2),
(14, 14, 1, 1, 1, 2),
(15, 15, 1, 1, 1, 2),
(16, 16, 1, 1, 1, 2),
(17, 17, 1, 1, 1, 2),
(18, 18, 1, 1, 2, 1),
(19, 19, 1, 1, 2, 1),
(20, 20, 1, 1, 2, 1),
(21, 21, 1, 1, 2, 1),
(22, 22, 1, 1, 2, 1),
(23, 23, 1, 1, 2, 1),
(24, 24, 1, 1, 2, 2),
(25, 25, 1, 1, 2, 2),
(26, 26, 1, 1, 2, 2),
(27, 27, 1, 1, 2, 2),
(28, 28, 1, 1, 2, 2),
(29, 29, 1, 1, 2, 2),
(30, 30, 1, 1, 2, 2),
(31, 31, 1, 1, 2, 2),
(32, 32, 1, 1, 2, 2),
(33, 33, 1, 1, 2, 2),
(34, 34, 1, 1, 2, 1),
(35, 35, 1, 1, 3, 1),
(36, 36, 1, 6, 1, 1),
(37, 37, 1, 1, 3, 1),
(38, 38, 1, 1, 3, 1),
(39, 39, 1, 1, 3, 1),
(40, 40, 1, 6, 1, 1),
(41, 41, 1, 1, 3, 1),
(42, 42, 1, 6, 1, 1),
(43, 43, 1, 1, 3, 1),
(44, 44, 1, 6, 1, 1),
(45, 45, 1, 6, 1, 1),
(46, 46, 1, 1, 3, 2),
(47, 47, 1, 6, 1, 1),
(48, 48, 1, 6, 1, 1),
(49, 49, 1, 1, 3, 2),
(50, 50, 1, 6, 1, 1),
(51, 51, 1, 6, 1, 1),
(52, 52, 1, 1, 3, 2),
(53, 53, 1, 6, 1, 1),
(54, 54, 1, 1, 3, 2),
(55, 55, 1, 1, 3, 2),
(56, 56, 1, 6, 1, 2),
(57, 57, 1, 1, 4, 1),
(58, 58, 1, 1, 4, 1),
(59, 59, 1, 6, 1, 2),
(60, 60, 1, 1, 4, 1),
(61, 61, 1, 1, 4, 1),
(62, 62, 1, 6, 1, 2),
(63, 63, 1, 1, 4, 2),
(64, 64, 1, 6, 1, 2),
(65, 65, 1, 6, 1, 2),
(66, 66, 1, 6, 1, 2),
(67, 67, 1, 6, 1, 2),
(68, 68, 1, 6, 1, 2),
(69, 69, 1, 6, 1, 2),
(70, 70, 1, 6, 1, 2),
(71, 71, 1, 6, 2, 1),
(72, 72, 1, 6, 2, 1),
(73, 73, 1, 6, 2, 1),
(74, 74, 1, 6, 2, 1),
(75, 75, 1, 6, 2, 1),
(76, 76, 1, 6, 2, 1),
(77, 77, 1, 6, 2, 1),
(78, 78, 1, 6, 2, 1),
(79, 79, 1, 6, 2, 1),
(80, 80, 1, 6, 2, 1),
(81, 81, 1, 6, 2, 2),
(82, 82, 1, 6, 2, 2),
(83, 83, 1, 6, 2, 2),
(84, 84, 1, 6, 2, 2),
(85, 85, 1, 6, 2, 2),
(86, 86, 1, 6, 2, 2),
(87, 87, 1, 6, 2, 2),
(88, 88, 1, 6, 2, 2),
(89, 89, 1, 6, 2, 2),
(90, 90, 1, 6, 3, 1),
(91, 91, 1, 6, 3, 1),
(92, 92, 1, 6, 3, 1),
(93, 93, 1, 6, 3, 1),
(94, 94, 1, 6, 3, 1),
(95, 95, 1, 6, 3, 1),
(96, 96, 1, 6, 3, 1),
(97, 97, 1, 6, 3, 1),
(98, 98, 1, 6, 3, 1),
(99, 99, 1, 6, 3, 2),
(100, 100, 1, 6, 3, 2),
(101, 101, 1, 6, 3, 2),
(102, 102, 1, 6, 3, 2),
(103, 103, 1, 6, 3, 2),
(104, 104, 1, 6, 3, 2),
(105, 105, 1, 6, 3, 2),
(106, 106, 1, 6, 3, 2),
(107, 107, 1, 6, 3, 2),
(108, 108, 1, 6, 4, 1),
(109, 109, 1, 6, 4, 1),
(110, 110, 1, 6, 4, 2),
(111, 111, 1, 4, 1, 1),
(112, 112, 1, 4, 1, 2),
(113, 113, 1, 4, 1, 1),
(114, 114, 1, 4, 1, 2),
(115, 115, 1, 4, 1, 1),
(116, 116, 1, 4, 1, 2),
(117, 117, 1, 4, 1, 1),
(118, 118, 1, 4, 1, 1),
(119, 119, 1, 4, 1, 2),
(120, 120, 1, 4, 1, 1),
(121, 121, 1, 4, 1, 2),
(122, 122, 1, 4, 1, 1),
(123, 123, 1, 4, 1, 2),
(124, 124, 1, 4, 1, 1),
(125, 125, 1, 4, 1, 1),
(126, 126, 1, 4, 1, 2),
(127, 127, 1, 4, 1, 2),
(128, 128, 1, 4, 1, 1),
(129, 129, 1, 4, 1, 2),
(130, 130, 1, 4, 2, 2),
(131, 131, 1, 4, 2, 1),
(132, 132, 1, 4, 2, 2),
(133, 133, 1, 4, 2, 1),
(134, 134, 1, 4, 2, 2),
(135, 135, 1, 4, 2, 2),
(136, 136, 1, 4, 2, 2),
(137, 137, 1, 4, 2, 1),
(138, 138, 1, 4, 2, 2),
(139, 139, 1, 4, 2, 1),
(140, 140, 1, 4, 2, 2),
(141, 141, 1, 4, 2, 2),
(142, 142, 1, 4, 2, 2),
(143, 143, 1, 4, 2, 1),
(144, 144, 1, 4, 3, 2),
(145, 145, 1, 4, 2, 1),
(146, 146, 1, 4, 3, 2),
(147, 147, 1, 4, 3, 2),
(148, 148, 1, 4, 2, 1),
(149, 149, 1, 4, 2, 1),
(150, 150, 1, 4, 3, 2),
(151, 151, 1, 4, 3, 2),
(152, 152, 1, 4, 2, 1),
(153, 153, 1, 4, 3, 2),
(154, 154, 1, 4, 3, 2),
(155, 155, 1, 4, 3, 2),
(156, 156, 1, 4, 4, 2),
(157, 157, 1, 4, 3, 1),
(158, 158, 1, 4, 3, 1),
(159, 159, 1, 4, 3, 1),
(160, 160, 1, 4, 3, 1),
(161, 161, 1, 4, 3, 1),
(162, 162, 1, 4, 3, 1),
(163, 163, 1, 4, 3, 1),
(164, 164, 1, 4, 3, 1),
(165, 165, 1, 4, 4, 1),
(166, 166, 1, 4, 4, 1),
(167, 167, 1, 5, 1, 1),
(168, 168, 1, 5, 1, 1),
(169, 169, 1, 5, 1, 1),
(170, 170, 1, 5, 1, 1),
(171, 171, 1, 5, 1, 1),
(172, 172, 1, 5, 1, 1),
(173, 173, 1, 5, 1, 1),
(174, 174, 1, 5, 1, 1),
(175, 175, 1, 5, 1, 1),
(176, 176, 1, 5, 1, 1),
(177, 177, 1, 5, 1, 2),
(178, 178, 1, 5, 1, 2),
(179, 179, 1, 5, 1, 2),
(180, 180, 1, 5, 1, 2),
(181, 181, 1, 5, 1, 2),
(182, 182, 1, 5, 1, 2),
(183, 183, 1, 5, 1, 2),
(184, 184, 1, 5, 1, 2),
(185, 185, 1, 5, 2, 1),
(186, 186, 1, 5, 2, 1),
(187, 187, 1, 5, 2, 1),
(188, 188, 1, 5, 2, 1),
(189, 189, 1, 5, 2, 1),
(190, 190, 1, 5, 2, 1),
(191, 191, 1, 5, 2, 1),
(192, 192, 1, 5, 2, 1),
(193, 193, 1, 5, 2, 1),
(194, 194, 1, 5, 2, 1),
(195, 195, 1, 5, 2, 2),
(196, 196, 1, 5, 2, 2),
(197, 197, 1, 5, 2, 2),
(198, 198, 1, 5, 2, 2),
(199, 199, 1, 5, 2, 2),
(200, 200, 1, 5, 2, 2),
(201, 201, 1, 5, 2, 2),
(202, 202, 1, 5, 2, 2),
(203, 203, 1, 5, 2, 2),
(204, 204, 1, 5, 3, 1),
(205, 205, 1, 5, 3, 1),
(206, 206, 1, 5, 3, 1),
(207, 207, 1, 5, 3, 1),
(208, 208, 1, 5, 3, 1),
(209, 209, 1, 5, 3, 1),
(210, 210, 1, 5, 3, 1),
(211, 211, 1, 5, 3, 1),
(212, 212, 1, 5, 3, 1),
(213, 213, 1, 5, 3, 2),
(214, 214, 1, 5, 3, 2),
(215, 215, 1, 5, 3, 2),
(216, 216, 1, 5, 3, 2),
(217, 217, 1, 5, 3, 2),
(218, 218, 1, 5, 3, 2),
(219, 219, 1, 5, 3, 2),
(220, 220, 1, 5, 3, 2),
(221, 221, 1, 5, 3, 2),
(222, 222, 1, 5, 3, 2),
(223, 223, 1, 5, 4, 1),
(224, 224, 1, 5, 4, 1),
(225, 225, 1, 5, 4, 1),
(226, 226, 1, 5, 4, 1),
(227, 227, 1, 5, 4, 1),
(228, 228, 1, 5, 4, 1),
(229, 229, 1, 5, 4, 1),
(230, 230, 1, 5, 4, 1),
(231, 231, 1, 5, 4, 1),
(232, 232, 1, 5, 4, 2),
(233, 233, 1, 7, 1, 1),
(234, 234, 1, 7, 1, 1),
(235, 235, 1, 7, 1, 1),
(236, 236, 1, 7, 1, 1),
(237, 237, 1, 7, 1, 1),
(238, 238, 1, 7, 1, 1),
(239, 239, 1, 7, 1, 1),
(240, 240, 1, 7, 1, 1),
(241, 241, 1, 7, 1, 2),
(242, 242, 1, 7, 1, 2),
(243, 243, 1, 7, 1, 2),
(244, 244, 1, 7, 1, 2),
(245, 245, 1, 7, 1, 2),
(246, 246, 1, 7, 1, 2),
(247, 247, 1, 7, 1, 2),
(248, 248, 1, 7, 1, 2),
(249, 249, 1, 7, 2, 1),
(250, 250, 1, 7, 2, 1),
(251, 251, 1, 7, 2, 1),
(253, 253, 1, 7, 2, 1),
(254, 254, 1, 7, 2, 1),
(255, 255, 1, 7, 2, 1),
(256, 256, 1, 7, 2, 1),
(257, 257, 1, 7, 2, 2),
(258, 258, 1, 7, 2, 2),
(259, 259, 1, 7, 2, 2),
(260, 260, 1, 7, 2, 2),
(261, 261, 1, 7, 2, 2),
(262, 262, 1, 7, 2, 2),
(263, 263, 1, 7, 2, 2),
(264, 264, 1, 7, 3, 1),
(265, 265, 1, 7, 3, 1),
(266, 266, 1, 7, 3, 1),
(269, 269, 1, 7, 3, 1),
(270, 270, 1, 7, 3, 1),
(271, 271, 1, 7, 3, 1),
(272, 272, 1, 7, 3, 2),
(273, 273, 1, 7, 3, 2),
(274, 274, 1, 7, 3, 2),
(275, 275, 1, 7, 3, 2),
(276, 276, 1, 7, 3, 2),
(277, 277, 1, 7, 3, 2),
(278, 278, 1, 7, 4, 1),
(279, 279, 1, 7, 4, 1),
(280, 280, 1, 8, 1, 1),
(281, 281, 1, 8, 1, 1),
(282, 282, 1, 7, 4, 1),
(283, 283, 1, 8, 1, 1),
(284, 284, 1, 8, 1, 1),
(285, 285, 1, 8, 1, 1),
(286, 286, 1, 7, 4, 1),
(287, 287, 1, 8, 1, 1),
(288, 288, 1, 8, 1, 1),
(289, 289, 1, 8, 1, 1),
(290, 290, 1, 8, 1, 1),
(291, 291, 1, 7, 4, 1),
(292, 292, 1, 8, 1, 1),
(293, 293, 1, 8, 1, 2),
(294, 295, 1, 8, 1, 2),
(295, 295, 1, 7, 4, 1),
(296, 296, 1, 8, 1, 2),
(297, 297, 1, 8, 1, 2),
(298, 298, 1, 8, 1, 2),
(299, 299, 1, 8, 1, 2),
(300, 300, 1, 8, 1, 2),
(301, 301, 1, 8, 1, 2),
(302, 302, 1, 7, 4, 2),
(303, 303, 1, 8, 1, 2),
(304, 304, 1, 8, 2, 1),
(305, 305, 1, 8, 2, 1),
(306, 306, 1, 8, 2, 1),
(307, 307, 1, 8, 2, 1),
(308, 308, 1, 7, 4, 2),
(309, 309, 1, 8, 2, 1),
(310, 310, 1, 8, 2, 1),
(311, 311, 1, 7, 4, 2),
(312, 312, 1, 8, 2, 1),
(313, 313, 1, 8, 2, 1),
(314, 314, 1, 8, 2, 1),
(315, 315, 1, 8, 2, 1),
(316, 316, 1, 8, 2, 1),
(317, 317, 1, 8, 2, 1),
(318, 318, 1, 8, 2, 1),
(319, 319, 1, 8, 2, 2),
(320, 320, 1, 8, 2, 2),
(321, 321, 1, 8, 2, 2),
(322, 322, 1, 8, 2, 2),
(323, 323, 1, 7, 4, 2),
(324, 324, 1, 8, 2, 2),
(325, 325, 1, 8, 2, 2),
(326, 326, 1, 8, 2, 2),
(327, 327, 1, 8, 2, 2),
(328, 328, 1, 8, 2, 2),
(329, 329, 1, 8, 2, 2),
(330, 330, 1, 8, 2, 2),
(331, 331, 1, 8, 2, 2),
(332, 332, 1, 8, 3, 1),
(333, 333, 1, 8, 3, 1),
(334, 334, 1, 8, 3, 1),
(335, 335, 1, 8, 3, 1),
(336, 336, 1, 8, 3, 1),
(337, 337, 1, 8, 3, 1),
(338, 338, 1, 8, 3, 1),
(339, 339, 1, 8, 3, 1),
(340, 340, 1, 8, 3, 1),
(341, 341, 1, 8, 3, 2),
(342, 342, 1, 8, 3, 2),
(343, 343, 1, 8, 3, 2),
(344, 344, 1, 8, 3, 2),
(345, 345, 1, 8, 3, 2),
(346, 346, 1, 8, 3, 2),
(347, 347, 1, 8, 3, 2),
(348, 348, 1, 8, 3, 2),
(349, 349, 1, 8, 3, 2),
(350, 350, 1, 8, 3, 2),
(351, 351, 1, 8, 3, 2),
(352, 352, 1, 8, 4, 1),
(353, 353, 1, 8, 4, 1),
(354, 354, 1, 8, 4, 1),
(355, 355, 1, 8, 4, 1),
(356, 356, 1, 8, 4, 1),
(357, 357, 1, 8, 4, 2),
(358, 358, 1, 2, 1, 1),
(359, 359, 1, 2, 1, 1),
(360, 360, 1, 2, 1, 1),
(361, 361, 1, 2, 1, 1),
(362, 362, 1, 2, 1, 1),
(363, 363, 1, 2, 1, 1),
(364, 364, 1, 2, 1, 1),
(365, 365, 1, 2, 1, 1),
(366, 366, 1, 2, 1, 1),
(367, 367, 1, 2, 1, 2),
(368, 368, 1, 2, 1, 2),
(369, 369, 1, 2, 1, 2),
(370, 370, 1, 2, 1, 2),
(371, 371, 1, 2, 1, 2),
(372, 372, 1, 2, 1, 2),
(373, 373, 1, 2, 1, 2),
(374, 374, 1, 2, 1, 2),
(375, 375, 1, 2, 1, 2),
(376, 376, 1, 2, 1, 2),
(377, 377, 1, 2, 2, 1),
(378, 378, 1, 2, 2, 1),
(379, 379, 1, 2, 2, 1),
(380, 380, 1, 2, 2, 1),
(381, 381, 1, 2, 2, 1),
(382, 382, 1, 2, 2, 1),
(383, 383, 1, 2, 2, 1),
(384, 384, 1, 2, 2, 1),
(385, 385, 1, 2, 2, 2),
(386, 386, 1, 2, 2, 2),
(387, 387, 1, 2, 2, 2),
(388, 388, 1, 2, 2, 2),
(389, 389, 1, 2, 2, 2),
(390, 390, 1, 2, 2, 2),
(391, 391, 1, 2, 2, 2),
(392, 392, 1, 2, 2, 2),
(393, 393, 1, 2, 3, 1),
(394, 394, 1, 2, 3, 1),
(395, 395, 1, 2, 3, 1),
(396, 396, 1, 2, 3, 1),
(397, 397, 1, 2, 3, 1),
(398, 398, 1, 2, 3, 1),
(399, 399, 1, 2, 3, 1),
(400, 400, 1, 2, 3, 1),
(401, 401, 1, 2, 3, 2),
(402, 402, 1, 2, 3, 2),
(403, 403, 1, 2, 3, 2),
(404, 404, 1, 2, 3, 2),
(405, 405, 1, 2, 3, 2),
(406, 406, 1, 2, 3, 2),
(407, 407, 1, 2, 3, 2),
(408, 408, 1, 2, 3, 2),
(409, 409, 1, 2, 4, 1),
(410, 410, 1, 2, 4, 1),
(411, 411, 1, 2, 4, 1),
(412, 412, 1, 2, 4, 1),
(413, 413, 1, 2, 4, 1),
(414, 414, 1, 2, 4, 2),
(415, 415, 1, 3, 1, 1),
(416, 416, 1, 3, 1, 1),
(417, 417, 1, 3, 1, 1),
(418, 418, 1, 3, 1, 1),
(419, 419, 1, 3, 1, 1),
(420, 420, 1, 3, 1, 1),
(421, 421, 1, 3, 1, 1),
(422, 422, 1, 3, 1, 1),
(423, 423, 1, 3, 1, 1),
(424, 424, 1, 3, 1, 2),
(425, 425, 1, 3, 1, 2),
(426, 426, 1, 3, 1, 2),
(427, 427, 1, 3, 1, 2),
(428, 428, 1, 3, 1, 2),
(429, 429, 1, 3, 1, 2),
(430, 430, 1, 3, 1, 2),
(431, 431, 1, 3, 1, 2),
(432, 432, 1, 3, 1, 2),
(433, 433, 1, 3, 1, 2),
(434, 434, 1, 3, 2, 1),
(435, 435, 1, 3, 2, 1),
(436, 436, 1, 3, 2, 1),
(437, 437, 1, 3, 2, 1),
(438, 438, 1, 3, 2, 1),
(439, 439, 1, 3, 2, 1),
(440, 440, 1, 3, 2, 1),
(441, 441, 1, 3, 2, 1),
(442, 442, 1, 3, 2, 1),
(443, 443, 1, 3, 2, 2),
(444, 444, 1, 3, 2, 2),
(445, 445, 1, 3, 2, 2),
(446, 446, 1, 3, 2, 2),
(447, 447, 1, 3, 2, 2),
(448, 448, 1, 3, 2, 2),
(449, 449, 1, 3, 2, 2),
(450, 450, 1, 3, 2, 2),
(451, 451, 1, 3, 3, 1),
(452, 452, 1, 3, 3, 1),
(453, 453, 1, 3, 3, 1),
(454, 454, 1, 3, 3, 1),
(455, 455, 1, 3, 3, 1),
(456, 456, 1, 3, 3, 1),
(457, 457, 1, 3, 3, 1),
(458, 458, 1, 3, 3, 1),
(459, 459, 1, 3, 3, 2),
(460, 460, 1, 3, 3, 2),
(461, 461, 1, 3, 3, 2),
(462, 462, 1, 3, 3, 2),
(463, 463, 1, 3, 3, 2),
(464, 464, 1, 3, 3, 2),
(465, 465, 1, 3, 3, 2),
(466, 466, 1, 3, 3, 2),
(467, 467, 1, 3, 4, 1),
(468, 468, 1, 3, 4, 1),
(469, 469, 1, 3, 4, 1),
(470, 470, 1, 3, 4, 1),
(471, 471, 1, 3, 4, 1),
(472, 472, 1, 3, 4, 2),
(474, 473, 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `summary_data`
--

CREATE TABLE `summary_data` (
  `summaryId` int(11) NOT NULL,
  `facultySum` int(11) NOT NULL,
  `staffSum` int(11) NOT NULL,
  `partSum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summary_data`
--

INSERT INTO `summary_data` (`summaryId`, `facultySum`, `staffSum`, `partSum`) VALUES
(1, 38, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `userId` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `fullName` varchar(32) NOT NULL,
  `userImage` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`userId`, `userName`, `userPass`, `fullName`, `userImage`) VALUES
(1, 'admin', 'ceedf12f8fe3dc63d35b2567a59b93bd62ff729a', 'Junry Solloso', 'images (38).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `year_data`
--

CREATE TABLE `year_data` (
  `yearId` int(11) NOT NULL,
  `yearName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year_data`
--

INSERT INTO `year_data` (`yearId`, `yearName`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asset_data`
--
ALTER TABLE `asset_data`
  ADD PRIMARY KEY (`assetId`);

--
-- Indexes for table `category_data`
--
ALTER TABLE `category_data`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `cur_data`
--
ALTER TABLE `cur_data`
  ADD PRIMARY KEY (`curId`);

--
-- Indexes for table `deptjunc_data`
--
ALTER TABLE `deptjunc_data`
  ADD PRIMARY KEY (`deptjuncId`);

--
-- Indexes for table `dept_data`
--
ALTER TABLE `dept_data`
  ADD PRIMARY KEY (`deptId`);

--
-- Indexes for table `enrollment_data`
--
ALTER TABLE `enrollment_data`
  ADD PRIMARY KEY (`enrollmentId`);

--
-- Indexes for table `events_data`
--
ALTER TABLE `events_data`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `facpos_data`
--
ALTER TABLE `facpos_data`
  ADD PRIMARY KEY (`posId`);

--
-- Indexes for table `facultyjunc_data`
--
ALTER TABLE `facultyjunc_data`
  ADD PRIMARY KEY (`facultyjuncId`);

--
-- Indexes for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD PRIMARY KEY (`facultyId`);

--
-- Indexes for table `gallery_data`
--
ALTER TABLE `gallery_data`
  ADD PRIMARY KEY (`galleryId`);

--
-- Indexes for table `history_data`
--
ALTER TABLE `history_data`
  ADD PRIMARY KEY (`historyId`);

--
-- Indexes for table `imagetemp_data`
--
ALTER TABLE `imagetemp_data`
  ADD PRIMARY KEY (`tempId`);

--
-- Indexes for table `message_data`
--
ALTER TABLE `message_data`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `news_data`
--
ALTER TABLE `news_data`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `programgallery_data`
--
ALTER TABLE `programgallery_data`
  ADD PRIMARY KEY (`galleryId`);

--
-- Indexes for table `program_data`
--
ALTER TABLE `program_data`
  ADD PRIMARY KEY (`programId`);

--
-- Indexes for table `qual_data`
--
ALTER TABLE `qual_data`
  ADD PRIMARY KEY (`qualId`);

--
-- Indexes for table `requirements_data`
--
ALTER TABLE `requirements_data`
  ADD PRIMARY KEY (`requirementsId`);

--
-- Indexes for table `school_data`
--
ALTER TABLE `school_data`
  ADD PRIMARY KEY (`schoolId`);

--
-- Indexes for table `sem_data`
--
ALTER TABLE `sem_data`
  ADD PRIMARY KEY (`semId`);

--
-- Indexes for table `setting_data`
--
ALTER TABLE `setting_data`
  ADD PRIMARY KEY (`settingId`);

--
-- Indexes for table `staffqual_data`
--
ALTER TABLE `staffqual_data`
  ADD PRIMARY KEY (`qualId`);

--
-- Indexes for table `staff_data`
--
ALTER TABLE `staff_data`
  ADD PRIMARY KEY (`staffId`);

--
-- Indexes for table `studentact_data`
--
ALTER TABLE `studentact_data`
  ADD PRIMARY KEY (`activityId`);

--
-- Indexes for table `subject_data`
--
ALTER TABLE `subject_data`
  ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `subjunc_data`
--
ALTER TABLE `subjunc_data`
  ADD PRIMARY KEY (`subjuncId`);

--
-- Indexes for table `summary_data`
--
ALTER TABLE `summary_data`
  ADD PRIMARY KEY (`summaryId`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `year_data`
--
ALTER TABLE `year_data`
  ADD PRIMARY KEY (`yearId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asset_data`
--
ALTER TABLE `asset_data`
  MODIFY `assetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category_data`
--
ALTER TABLE `category_data`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cur_data`
--
ALTER TABLE `cur_data`
  MODIFY `curId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deptjunc_data`
--
ALTER TABLE `deptjunc_data`
  MODIFY `deptjuncId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `dept_data`
--
ALTER TABLE `dept_data`
  MODIFY `deptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `enrollment_data`
--
ALTER TABLE `enrollment_data`
  MODIFY `enrollmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events_data`
--
ALTER TABLE `events_data`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `facpos_data`
--
ALTER TABLE `facpos_data`
  MODIFY `posId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `facultyjunc_data`
--
ALTER TABLE `facultyjunc_data`
  MODIFY `facultyjuncId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `faculty_data`
--
ALTER TABLE `faculty_data`
  MODIFY `facultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `gallery_data`
--
ALTER TABLE `gallery_data`
  MODIFY `galleryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `history_data`
--
ALTER TABLE `history_data`
  MODIFY `historyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `imagetemp_data`
--
ALTER TABLE `imagetemp_data`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `message_data`
--
ALTER TABLE `message_data`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `news_data`
--
ALTER TABLE `news_data`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `programgallery_data`
--
ALTER TABLE `programgallery_data`
  MODIFY `galleryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `program_data`
--
ALTER TABLE `program_data`
  MODIFY `programId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `qual_data`
--
ALTER TABLE `qual_data`
  MODIFY `qualId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `requirements_data`
--
ALTER TABLE `requirements_data`
  MODIFY `requirementsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `school_data`
--
ALTER TABLE `school_data`
  MODIFY `schoolId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sem_data`
--
ALTER TABLE `sem_data`
  MODIFY `semId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `setting_data`
--
ALTER TABLE `setting_data`
  MODIFY `settingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `staffqual_data`
--
ALTER TABLE `staffqual_data`
  MODIFY `qualId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `staff_data`
--
ALTER TABLE `staff_data`
  MODIFY `staffId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `studentact_data`
--
ALTER TABLE `studentact_data`
  MODIFY `activityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `subject_data`
--
ALTER TABLE `subject_data`
  MODIFY `subjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;
--
-- AUTO_INCREMENT for table `subjunc_data`
--
ALTER TABLE `subjunc_data`
  MODIFY `subjuncId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;
--
-- AUTO_INCREMENT for table `summary_data`
--
ALTER TABLE `summary_data`
  MODIFY `summaryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `year_data`
--
ALTER TABLE `year_data`
  MODIFY `yearId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
