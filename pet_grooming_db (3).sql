-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2026 at 05:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_grooming_db`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getDailyCount` (`staff` INT, `d` DATE, `vtype` VARCHAR(15)) RETURNS INT(11)  BEGIN
    DECLARE cnt INT;
    SELECT COUNT(*) INTO cnt 
    FROM tbl_appointment 
    WHERE staff_id = staff 
      AND appointment_date = d 
      AND visit_type = vtype
      AND cancelled = 0;
    RETURN cnt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'VARSHA THOMAS', 'varshathomas2003@gmail.com', 'heyy', '2026-01-31 09:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_notification`
--

CREATE TABLE `tbl_admin_notification` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `related_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Unread','Read') DEFAULT 'Unread',
  `ref_id` int(11) DEFAULT NULL,
  `ref_type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin_notification`
--

INSERT INTO `tbl_admin_notification` (`id`, `message`, `related_id`, `type`, `created_at`, `status`, `ref_id`, `ref_type`) VALUES
(1, 'Vet requested leave from 2026-02-21 to 2026-02-22', NULL, 'leave', '2026-02-20 15:18:18', 'Unread', NULL, NULL),
(2, 'Vet requested leave from 2026-03-16 to 2026-03-19', NULL, 'leave', '2026-02-20 16:55:25', 'Unread', NULL, NULL),
(3, 'Appointment Started', NULL, NULL, '2026-02-21 13:47:38', 'Unread', 41, 'appointment'),
(4, 'Appointment Completed', NULL, NULL, '2026-02-21 13:47:41', 'Unread', 41, 'appointment'),
(5, 'Appointment Started', NULL, NULL, '2026-02-21 13:47:43', 'Unread', 13, 'appointment'),
(6, 'Appointment Completed', NULL, NULL, '2026-02-21 13:47:51', 'Unread', 13, 'appointment'),
(7, 'Vet requested leave from 2026-02-27 to 2026-02-28', NULL, 'leave', '2026-02-21 14:57:36', 'Unread', NULL, NULL),
(8, 'Vet requested leave from 2026-02-27 to 2026-02-28', NULL, 'leave', '2026-02-21 15:12:32', 'Read', NULL, NULL),
(9, 'Vet requested leave from 2026-02-23 to 2026-02-25', NULL, 'leave', '2026-02-21 17:18:24', 'Read', NULL, NULL),
(10, 'Appointment Started', NULL, NULL, '2026-02-21 17:27:46', 'Unread', 41, 'appointment'),
(11, 'Appointment Completed', NULL, NULL, '2026-02-21 17:27:50', 'Unread', 41, 'appointment'),
(12, 'Health Report Submitted', NULL, NULL, '2026-02-21 17:30:43', 'Unread', 3, 'report'),
(13, 'Vet requested leave from 2026-03-10 to 2026-03-11', NULL, 'leave', '2026-02-21 18:58:43', 'Unread', NULL, NULL),
(14, 'Appointment Completed', NULL, NULL, '2026-02-21 19:01:16', 'Unread', 39, 'appointment'),
(15, 'Appointment Started', NULL, NULL, '2026-02-22 12:24:10', 'Read', 39, 'appointment'),
(16, 'Appointment Completed', NULL, NULL, '2026-02-22 12:24:17', 'Read', 39, 'appointment'),
(17, 'Groomer requested leave', NULL, NULL, '2026-02-22 15:43:16', 'Unread', NULL, NULL),
(18, 'Appointment Started', NULL, NULL, '2026-02-24 04:04:52', 'Unread', 16, 'appointment'),
(19, 'Appointment Completed', NULL, NULL, '2026-02-24 04:05:00', 'Unread', 16, 'appointment'),
(20, 'Health Report Submitted', NULL, NULL, '2026-02-24 04:07:05', 'Unread', 5, 'report'),
(21, 'Health Report Submitted', NULL, NULL, '2026-02-24 04:09:35', 'Read', 4, 'report'),
(22, 'Appointment status updated to Completed', NULL, NULL, '2026-02-24 04:11:32', 'Read', NULL, NULL),
(23, 'Appointment Started', NULL, NULL, '2026-02-24 05:08:57', 'Read', 44, 'appointment'),
(24, 'Appointment Completed', NULL, NULL, '2026-02-24 05:11:54', 'Read', 44, 'appointment'),
(25, 'Appointment Started', NULL, NULL, '2026-02-24 17:46:31', 'Read', 47, 'appointment'),
(26, 'Appointment Completed', NULL, NULL, '2026-02-24 17:48:10', 'Unread', 47, 'appointment'),
(27, 'Leave request submitted', NULL, NULL, '2026-02-24 20:11:26', 'Unread', NULL, NULL),
(28, 'Vet updated availability', NULL, NULL, '2026-02-24 20:24:01', 'Unread', NULL, NULL),
(29, 'Groomer updated availability', NULL, NULL, '2026-02-24 20:31:36', 'Unread', NULL, NULL),
(30, 'Groomer updated availability', NULL, NULL, '2026-02-25 02:16:43', 'Unread', NULL, NULL),
(31, 'Vet updated availability', NULL, NULL, '2026-02-25 02:18:03', 'Read', NULL, NULL),
(32, 'Appointment Completed', NULL, NULL, '2026-02-26 19:00:48', 'Unread', 41, 'appointment'),
(33, 'Appointment Completed', NULL, NULL, '2026-02-26 19:00:55', 'Unread', 41, 'appointment'),
(34, 'Vaccination expired for Tiger (Rabies)', NULL, NULL, '2026-03-01 12:12:54', 'Read', NULL, NULL),
(35, 'Vaccination expired for Shadow (DHPP)', NULL, NULL, '2026-03-01 12:12:54', 'Read', NULL, NULL),
(36, 'Vaccination expired for Lucy (Rabies)', NULL, NULL, '2026-03-01 12:12:54', 'Read', NULL, NULL),
(37, 'Vaccination expired for Buddy (Distemper)', NULL, NULL, '2026-03-01 12:12:54', 'Read', NULL, NULL),
(38, 'Vaccination expired for Zoro (Parvo)', NULL, NULL, '2026-03-01 12:12:54', 'Read', NULL, NULL),
(39, 'Vaccination expired for Choco (Booster)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(40, 'Vaccination expired for Scooby (Rabies)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(41, 'Vaccination expired for Bolt (DHPP)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(42, 'Vaccination expired for Daisy (Rabies)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(43, 'Vaccination expired for Iliza (Parvo)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(44, 'Vaccination expired for Bella (Rabies)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(45, 'Vaccination expired for ABC (Distemper)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(46, 'Vaccination expired for Oscar (Rabies)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(47, 'Vaccination expired for Molly (Booster)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(48, 'Vaccination expired for Pinky (Rabies)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(49, 'Vaccination expired for Neko (Booster)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(50, 'Vaccination expired for Cameli (FVRCP)', NULL, NULL, '2026-03-01 12:12:54', 'Unread', NULL, NULL),
(51, 'Cleaning task approved and marked Completed', NULL, 'cleaning', '2026-03-01 14:16:41', 'Unread', 1, 'task'),
(52, 'Vaccination expired for Ruby (FVRCP)', NULL, NULL, '2026-03-02 03:58:46', 'Unread', NULL, NULL),
(53, 'Medical Case Started', NULL, NULL, '2026-03-03 15:44:55', 'Unread', 40, 'appointment'),
(54, 'Appointment Completed', NULL, NULL, '2026-03-03 15:45:02', 'Unread', 40, 'appointment'),
(55, 'Medical Case Started', NULL, NULL, '2026-03-03 16:49:06', 'Unread', 47, 'appointment'),
(56, 'Appointment Completed & Case Closed', NULL, NULL, '2026-03-03 16:49:12', 'Unread', 47, 'appointment'),
(57, 'Appointment Completed & Case Closed', NULL, NULL, '2026-03-04 04:13:40', 'Unread', 44, 'appointment'),
(58, 'Medical Case Started', NULL, NULL, '2026-03-04 05:33:26', 'Unread', 44, 'appointment'),
(61, 'Vaccination expired for Lilly (FVRCP)', NULL, NULL, '2026-03-06 03:49:26', 'Read', NULL, NULL),
(62, 'Appointment status updated to Completed', NULL, NULL, '2026-03-06 07:39:57', 'Read', NULL, NULL),
(63, 'Appointment status updated to In Progress', NULL, NULL, '2026-03-07 04:20:36', 'Unread', NULL, NULL),
(64, 'Health Report Submitted', NULL, NULL, '2026-03-07 08:48:08', 'Unread', 41, 'report');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alert_queue`
--

CREATE TABLE `tbl_alert_queue` (
  `alert_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `alert_type` varchar(255) DEFAULT NULL,
  `alert_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_alert_queue`
--

INSERT INTO `tbl_alert_queue` (`alert_id`, `user_id`, `pet_id`, `alert_type`, `alert_date`, `status`) VALUES
(1, 1, NULL, 'Service Completed - Payment Pending', '2026-02-14', 'pending'),
(2, 13, NULL, 'Appointment Approved', '2026-02-14', 'pending'),
(3, 13, NULL, 'Service Completed - Payment Pending', '2026-02-14', 'pending'),
(4, 18, NULL, 'Service Completed - Payment Pending', '2026-02-15', 'pending'),
(5, 12, NULL, 'Appointment Approved', '2026-02-16', 'pending'),
(6, 12, NULL, 'Service Completed - Payment Pending', '2026-02-16', 'pending'),
(7, 18, NULL, 'Service Completed - Payment Pending', '2026-02-16', 'pending'),
(8, 12, NULL, 'Appointment Approved', '2026-02-16', 'pending'),
(9, 4, NULL, 'Appointment Approved', '2026-02-24', 'pending'),
(10, 15, NULL, 'Service Completed - Payment Pending', '2026-03-04', 'pending'),
(11, 1, NULL, 'Service Completed - Payment Pending', '2026-03-04', 'pending'),
(12, 1, NULL, 'Appointment Approved', '2026-03-06', 'pending'),
(13, 18, NULL, 'Your appointment on 2026-03-24 at 12:00 - 01:00 has been approved.\r\nAssigned Staff: Anu', '2026-03-06', 'pending'),
(14, 43, NULL, 'Your appointment on 2026-03-18 at 10:00 - 11:00 has been approved.\r\nAssigned Staff: Meera', '2026-03-06', 'pending'),
(15, 8, NULL, 'Your appointment on 2026-03-12 at 10:00 - 11:00 has been approved.\r\nAssigned Staff: Meera', '2026-03-06', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','In Progress','Completed','Cancelled','Rejected') NOT NULL DEFAULT 'Pending',
  `visit_type` varchar(15) DEFAULT 'NORMAL',
  `cancelled` tinyint(4) DEFAULT 0,
  `time_slot` varchar(20) DEFAULT NULL,
  `booking_type` varchar(20) DEFAULT 'normal',
  `slot_locked` tinyint(4) DEFAULT 1,
  `emergency` tinyint(4) DEFAULT 0,
  `capacity` int(11) DEFAULT 8,
  `current_count` int(11) DEFAULT 0,
  `payment_status` enum('Pending','Paid') DEFAULT 'Pending',
  `service_id` int(11) DEFAULT NULL,
  `vaccine_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_appointment`
--

INSERT INTO `tbl_appointment` (`appointment_id`, `user_id`, `pet_id`, `staff_id`, `appointment_date`, `status`, `visit_type`, `cancelled`, `time_slot`, `booking_type`, `slot_locked`, `emergency`, `capacity`, `current_count`, `payment_status`, `service_id`, `vaccine_name`) VALUES
(1, 1, 1, 2, '2026-01-10', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(2, 2, 2, 2, '2026-01-10', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(3, 3, 3, 5, '2026-01-10', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 2, NULL),
(4, 4, 4, 2, '2026-01-10', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 5, NULL),
(5, 5, 5, 2, '2026-01-10', 'Cancelled', 'NORMAL', 1, NULL, 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(6, 6, 6, 2, '2026-01-10', 'Completed', 'EMERGENCY', 0, NULL, 'normal', 1, 0, 8, 0, 'Pending', 5, NULL),
(7, 7, 7, 2, '2026-01-10', 'Completed', 'EMERGENCY', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 4, NULL),
(8, 8, 8, 2, '2026-01-11', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 4, NULL),
(9, 9, 9, 2, '2026-01-11', 'Rejected', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Pending', 5, NULL),
(10, 10, 10, 2, '2026-01-11', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 4, NULL),
(11, 11, 11, 2, '2026-01-11', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Pending', 5, NULL),
(12, 12, 12, 2, '2026-01-11', 'Cancelled', 'NORMAL', 1, NULL, 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(13, 13, 13, 2, '2026-01-11', 'Completed', 'EMERGENCY', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 5, NULL),
(14, 14, 14, 2, '2026-01-12', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 5, NULL),
(15, 15, 15, 6, '2026-01-12', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Pending', 2, NULL),
(16, 1, 5, 2, '2026-01-11', 'Completed', 'NORMAL', 0, '09:00 - 10:00', 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(17, 1, 1, 6, '2026-01-11', 'Completed', 'NORMAL', 0, '09:00 - 10:00', 'normal', 1, 0, 8, 0, 'Paid', 1, NULL),
(18, 1, 3, 5, '2026-01-11', 'Completed', 'NORMAL', 0, '09:00 - 10:00', 'normal', 1, 0, 8, 0, 'Pending', 2, NULL),
(19, 1, 9, 2, '2026-01-11', 'Completed', 'NORMAL', 0, '09:00 - 10:00', 'normal', 1, 0, 8, 0, 'Paid', 4, NULL),
(20, 1, 14, 2, '2026-01-11', 'Rejected', 'NORMAL', 0, '09:00 - 10:00', 'normal', 1, 0, 8, 0, 'Pending', 5, NULL),
(22, 1, 15, 2, '2026-01-10', 'Completed', 'NORMAL', 0, '09:00 - 10:00', 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(27, 18, 20, 4, '2026-02-09', 'Completed', 'NORMAL', 0, '10:00 - 11:00', 'normal', 1, 0, 8, 0, 'Paid', 2, NULL),
(28, 18, 24, 6, '2026-02-13', 'Completed', 'NORMAL', 0, '11:00 - 12:00', 'normal', 1, 0, 8, 0, 'Paid', 1, NULL),
(29, 18, 25, 5, '2026-02-11', 'Completed', 'NORMAL', 0, '12:00 - 01:00', 'normal', 1, 0, 8, 0, 'Paid', 2, NULL),
(39, 1, 1, 4, '2026-02-22', 'Completed', 'NORMAL', 0, '09:00 - 10:00', 'normal', 1, 0, 8, 0, 'Pending', 3, NULL),
(40, 2, 2, 2, '2026-02-21', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(41, 3, 3, 2, '2026-02-20', 'Completed', 'EMERGENCY', 0, NULL, 'normal', 1, 1, 8, 0, 'Paid', 5, NULL),
(42, 4, 4, 2, '2026-02-19', 'Completed', 'NORMAL', 0, NULL, 'normal', 1, 0, 8, 0, 'Paid', 4, NULL),
(44, 4, 4, 2, '2026-02-27', 'Completed', 'NORMAL', 0, '11:00 - 12:00', 'normal', 1, 0, 8, 0, 'Paid', 4, NULL),
(45, 4, 4, 2, '2026-02-26', 'Rejected', 'NORMAL', 0, '10:00 - 11:00', 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(46, 1, 1, 4, '2026-02-09', 'Rejected', 'NORMAL', 0, '10:00 - 11:00', 'normal', 1, 0, 8, 0, 'Pending', 3, NULL),
(47, 7, 7, 2, '2026-02-27', 'Completed', 'NORMAL', 0, '11:00 - 12:00', 'normal', 1, 0, 8, 0, 'Pending', 4, NULL),
(48, 8, 8, 6, '2026-03-12', 'Approved', 'NORMAL', 0, '10:00 - 11:00', 'normal', 1, 0, 8, 0, 'Pending', 1, NULL),
(49, 4, 4, NULL, '2026-03-04', 'Cancelled', 'NORMAL', 1, '11:00 - 12:00', 'normal', 1, 0, 8, 0, 'Pending', 4, 'Booster'),
(53, 18, 24, 4, '2026-03-24', 'In Progress', 'NORMAL', 0, '12:00 - 01:00', 'normal', 1, 0, 8, 0, 'Pending', 2, ''),
(54, 1, 1, 2, '2026-03-19', 'Approved', 'NORMAL', 0, '04:00 - 05:00', 'normal', 1, 0, 8, 0, 'Pending', 4, 'Booster'),
(55, 43, 33, 6, '2026-03-18', 'Cancelled', 'NORMAL', 1, '10:00 - 11:00', 'normal', 1, 0, 8, 0, 'Pending', 4, 'FVRCP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audit_log`
--

CREATE TABLE `tbl_audit_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `entity` varchar(50) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_availability`
--

CREATE TABLE `tbl_availability` (
  `availability_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_availability`
--

INSERT INTO `tbl_availability` (`availability_id`, `staff_id`, `available_date`, `start_time`, `end_time`, `created_at`) VALUES
(1, 6, '2026-02-26', '09:00:00', '15:00:00', '2026-02-25 02:01:36'),
(2, 6, '2026-03-01', '08:46:00', '11:50:00', '2026-02-25 07:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `bill_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `bill_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_bill`
--

INSERT INTO `tbl_bill` (`bill_id`, `appointment_id`, `amount`, `bill_date`) VALUES
(1, 1, 1200.00, '2026-01-10'),
(2, 2, 800.00, '2026-01-10'),
(3, 3, 900.00, '2026-01-10'),
(4, 4, 1000.00, '2026-01-10'),
(5, 6, 1500.00, '2026-01-10'),
(6, 7, 2000.00, '2026-01-10'),
(7, 8, 900.00, '2026-01-11'),
(8, 9, 700.00, '2026-01-11'),
(9, 10, 800.00, '2026-01-11'),
(10, 11, 900.00, '2026-01-11'),
(11, 13, 1800.00, '2026-01-11'),
(12, 14, 1000.00, '2026-01-12'),
(13, 15, 700.00, '2026-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cleaner_kpi`
--

CREATE TABLE `tbl_cleaner_kpi` (
  `kpi_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `kpi_month` int(11) NOT NULL,
  `kpi_year` int(11) NOT NULL,
  `tasks_completed` int(11) DEFAULT 0,
  `avg_inspection_score` float DEFAULT 0,
  `punctuality_percentage` float DEFAULT 0,
  `overdue_tasks` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cleaner_performance`
--

CREATE TABLE `tbl_cleaner_performance` (
  `performance_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `completion_rate` decimal(5,2) DEFAULT NULL,
  `badge` enum('Bronze','Silver','Gold') DEFAULT 'Bronze'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cleaning_log`
--

CREATE TABLE `tbl_cleaning_log` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `cleaned_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cleaning_task`
--

CREATE TABLE `tbl_cleaning_task` (
  `task_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `task_area` varchar(100) DEFAULT NULL,
  `task_date` date NOT NULL,
  `status` enum('Pending','In Progress','Completion Requested','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `zone_id` int(11) DEFAULT NULL,
  `inspection_score` int(11) DEFAULT NULL,
  `inspection_note` text DEFAULT NULL,
  `reminder_sent` tinyint(4) DEFAULT 0,
  `priority` enum('Low','Medium','High') DEFAULT 'Medium',
  `is_overdue` tinyint(1) DEFAULT 0,
  `completion_requested` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_cleaning_task`
--

INSERT INTO `tbl_cleaning_task` (`task_id`, `staff_id`, `task_title`, `task_area`, `task_date`, `status`, `created_at`, `zone_id`, `inspection_score`, `inspection_note`, `reminder_sent`, `priority`, `is_overdue`, `completion_requested`) VALUES
(1, 1, 'Floor Mopping â€“ Ward A', 'Ward A', '2026-02-27', 'Completed', '2026-02-26 12:39:47', NULL, NULL, NULL, 0, 'High', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cleaning_zone`
--

CREATE TABLE `tbl_cleaning_zone` (
  `zone_id` int(11) NOT NULL,
  `zone_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clinical_observation`
--

CREATE TABLE `tbl_clinical_observation` (
  `observation_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `temperature` varchar(20) DEFAULT NULL,
  `weight` varchar(20) DEFAULT NULL,
  `heart_rate` varchar(20) DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `user_id`, `staff_id`, `appointment_id`, `message`, `rating`) VALUES
(1, 1, 2, 1, 'Excellent care', 5),
(2, 2, 6, 15, 'Fast service', 4),
(3, 3, 5, 3, 'Very clean clinic', 5),
(4, 4, 2, 2, 'Good staff', 4),
(5, 6, 2, 4, 'Saved my pet’s life', 5),
(6, 7, 2, 5, 'Immediate emergency help', 5),
(7, 8, 2, 6, 'Friendly doctors', 5),
(8, 9, 4, 39, 'Quick grooming', 4),
(9, 10, 5, 18, 'Nice experience', 4),
(10, 11, 6, 17, 'Professional treatment', 5),
(11, 13, 2, 7, 'Emergency handled well', 5),
(12, 14, 5, 29, 'Affordable service', 4),
(13, 15, 4, 27, 'Will recommend', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groomer`
--

CREATE TABLE `tbl_groomer` (
  `groomer_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `max_slots_per_day` int(11) DEFAULT 5,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `user_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_groomer`
--

INSERT INTO `tbl_groomer` (`groomer_id`, `name`, `max_slots_per_day`, `status`, `user_id`, `staff_id`) VALUES
(1, 'Anu', 5, 'Active', 28, 4),
(2, 'Rahul', 4, 'Active', 29, 5),
(3, 'Meera', 6, 'Active', 30, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grooming_checklist`
--

CREATE TABLE `tbl_grooming_checklist` (
  `checklist_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `bath` tinyint(4) DEFAULT 0,
  `nail_trim` tinyint(4) DEFAULT 0,
  `ear_cleaning` tinyint(4) DEFAULT 0,
  `haircut` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grooming_note`
--

CREATE TABLE `tbl_grooming_note` (
  `grooming_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `pet_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `groomer_name` varchar(100) DEFAULT NULL,
  `service` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `special_observation` text DEFAULT NULL,
  `before_image` varchar(255) DEFAULT NULL,
  `after_image` varchar(255) DEFAULT NULL,
  `grooming_date` date DEFAULT curdate(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grooming_record`
--

CREATE TABLE `tbl_grooming_record` (
  `grooming_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `groom_date` date NOT NULL,
  `services` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `special_observation` text DEFAULT NULL,
  `before_image` varchar(255) DEFAULT NULL,
  `after_image` varchar(255) DEFAULT NULL,
  `groomer_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Scheduled','Completed') DEFAULT 'Scheduled',
  `time_slot` varchar(20) DEFAULT NULL,
  `groomer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_grooming_record`
--

INSERT INTO `tbl_grooming_record` (`grooming_id`, `pet_id`, `appointment_id`, `staff_id`, `groom_date`, `services`, `notes`, `special_observation`, `before_image`, `after_image`, `groomer_name`, `created_at`, `status`, `time_slot`, `groomer_id`) VALUES
(1, 7, 1, NULL, '2026-02-10', '', NULL, NULL, NULL, NULL, '', '2026-02-07 17:29:03', 'Completed', '10:00 â€“ 11:00', 2),
(2, 7, 7, NULL, '2026-02-12', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-09 03:44:38', 'Completed', '10:00 â€“ 11:00', 2),
(3, 15, 22, NULL, '2026-02-20', NULL, NULL, NULL, NULL, NULL, 'Anu', '2026-02-09 03:45:00', 'Scheduled', '02:00 â€“ 03:00', 1),
(4, 5, 16, NULL, '2026-02-27', NULL, NULL, NULL, NULL, NULL, 'Anu', '2026-02-09 07:28:17', 'Scheduled', '10:00 â€“ 11:00', 1),
(5, 1, 17, NULL, '2026-02-12', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-09 08:05:00', 'Scheduled', '02:00 â€“ 03:00', 2),
(6, 6, 6, NULL, '2026-02-20', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 13:51:53', 'Scheduled', '02:00 â€“ 03:00', 3),
(7, 2, 2, NULL, '2026-02-18', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 13:52:07', 'Scheduled', '03:00 â€“ 04:00', 3),
(8, 25, 29, NULL, '2026-02-17', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 13:52:22', 'Scheduled', '02:00 â€“ 03:00', 3),
(9, 1, 1, NULL, '2026-01-10', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 13:53:11', 'Scheduled', '11:00 â€“ 12:00', 3),
(10, 24, 28, NULL, '2026-02-13', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 13:53:29', 'Scheduled', '10:00 â€“ 11:00', 3),
(11, 5, 16, NULL, '2026-01-11', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-12 13:55:05', 'Scheduled', '10:00 â€“ 11:00', 2),
(12, 3, 18, NULL, '2026-02-11', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-12 13:55:21', 'Scheduled', '11:00 â€“ 12:00', 2),
(13, 9, 19, NULL, '2026-02-13', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-12 13:58:46', 'Scheduled', '10:00 â€“ 11:00', 2),
(14, 14, 20, NULL, '2026-02-13', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-12 13:59:00', 'Scheduled', '11:00 â€“ 12:00', 2),
(15, 15, 15, NULL, '2026-02-13', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-12 13:59:11', 'Scheduled', '03:00 â€“ 04:00', 2),
(16, 20, 27, NULL, '2026-02-13', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-12 13:59:27', 'Scheduled', '09:00 â€“ 10:00', 2),
(17, 20, 27, NULL, '2026-02-09', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 14:42:06', 'Scheduled', '10:00 â€“ 11:00', 3),
(18, 2, 2, NULL, '2026-02-10', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 14:42:33', 'Scheduled', '10:00 â€“ 11:00', 3),
(19, 6, 6, NULL, '2026-02-17', NULL, NULL, NULL, NULL, NULL, 'Rahul', '2026-02-12 14:42:53', 'Scheduled', '02:00 â€“ 03:00', 2),
(20, 7, 7, NULL, '2026-02-18', NULL, NULL, NULL, NULL, NULL, 'Meera', '2026-02-12 14:43:03', 'Scheduled', '11:00 â€“ 12:00', 3),
(21, 15, 22, NULL, '2026-02-25', NULL, NULL, NULL, NULL, NULL, 'Anu', '2026-02-12 14:43:13', 'Scheduled', '10:00 â€“ 11:00', 1),
(22, 13, 13, NULL, '2026-02-15', NULL, NULL, NULL, NULL, NULL, 'Anu', '2026-02-12 14:43:26', 'Scheduled', '11:00 â€“ 12:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_health_note`
--

CREATE TABLE `tbl_health_note` (
  `note_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `note_date` date DEFAULT curdate(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_health_note`
--

INSERT INTO `tbl_health_note` (`note_id`, `pet_id`, `user_id`, `note`, `note_date`, `created_at`) VALUES
(1, 10, 22, 'Vet: Dr.Anjali | ', '2026-02-08', '2026-02-08 09:48:15'),
(2, 9, 22, 'Vet: Dr.Anjali | ', '2026-02-12', '2026-02-12 14:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_health_record`
--

CREATE TABLE `tbl_health_record` (
  `record_id` int(11) NOT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `vet_name` varchar(100) DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `next_vaccination` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_health_record`
--

INSERT INTO `tbl_health_record` (`record_id`, `pet_id`, `description`, `vet_name`, `visit_date`, `next_vaccination`, `created_at`, `vet_id`) VALUES
(1, 1, 'Vaccinated', NULL, '2026-01-10', NULL, '2026-02-08 02:33:49', NULL),
(2, 2, 'Skin infection', NULL, '2026-01-10', NULL, '2026-02-08 02:33:49', NULL),
(3, 3, 'Deworming', NULL, '2026-01-10', NULL, '2026-02-08 02:33:49', NULL),
(4, 4, 'General checkup', NULL, '2026-01-10', NULL, '2026-02-08 02:33:49', NULL),
(5, 6, 'Emergency surgery', NULL, '2026-01-10', NULL, '2026-02-08 02:33:49', NULL),
(6, 7, 'Accident treatment', NULL, '2026-01-10', NULL, '2026-02-08 02:33:49', NULL),
(7, 8, 'Vaccination', NULL, '2026-01-11', NULL, '2026-02-08 02:33:49', NULL),
(8, 9, 'Dental cleaning', NULL, '2026-01-11', NULL, '2026-02-08 02:33:49', NULL),
(9, 10, 'Skin treatment', NULL, '2026-01-11', NULL, '2026-02-08 02:33:49', NULL),
(10, 11, 'Eye infection', NULL, '2026-01-11', NULL, '2026-02-08 02:33:49', NULL),
(11, 13, 'Emergency burn care', NULL, '2026-01-11', NULL, '2026-02-08 02:33:49', NULL),
(12, 14, 'Deworming', NULL, '2026-01-12', NULL, '2026-02-08 02:33:49', NULL),
(13, 15, 'Regular checkup', NULL, '2026-01-12', NULL, '2026-02-08 02:33:49', NULL),
(14, 10, 'Vaccinated', NULL, '2026-02-12', '2026-02-19', '2026-02-08 09:48:15', NULL),
(15, 9, 'Grooming completed', NULL, '2026-02-13', '2026-03-13', '2026-02-12 14:00:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave`
--

CREATE TABLE `tbl_leave` (
  `leave_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medical_case`
--

CREATE TABLE `tbl_medical_case` (
  `case_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `vet_id` int(11) NOT NULL,
  `chief_complaint` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment_plan` text DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `status` enum('Open','Closed') DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `subjective` text DEFAULT NULL,
  `objective` text DEFAULT NULL,
  `assessment` text DEFAULT NULL,
  `plan` text DEFAULT NULL,
  `severity` enum('Stable','Serious','Critical') DEFAULT 'Stable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_medical_case`
--

INSERT INTO `tbl_medical_case` (`case_id`, `pet_id`, `appointment_id`, `vet_id`, `chief_complaint`, `diagnosis`, `treatment_plan`, `follow_up_date`, `status`, `created_at`, `subjective`, `objective`, `assessment`, `plan`, `severity`) VALUES
(1, 2, 40, 2, 'Initial Consultation', NULL, NULL, NULL, 'Open', '2026-03-03 15:44:55', NULL, NULL, NULL, NULL, 'Stable'),
(2, 7, 47, 2, 'Initial Consultation', NULL, NULL, NULL, 'Closed', '2026-03-03 16:49:06', NULL, NULL, NULL, NULL, 'Stable'),
(3, 4, 44, 2, 'Initial Consultation', NULL, NULL, NULL, 'Closed', '2026-03-04 05:33:26', NULL, NULL, NULL, NULL, 'Stable');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Unread','Read') DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`message_id`, `user_id`, `title`, `message`, `created_at`, `status`) VALUES
(1, 18, 'Appointment Approved', 'Your appointment on 2026-03-24 at 12:00 - 01:00 has been approved.\r\nAssigned Staff: Meera', '2026-03-06 14:58:48', 'Read'),
(2, 18, 'Appointment Approved', 'Your appointment on 2026-03-24 at 12:00 - 01:00 has been approved.\r\nAssigned Staff: Anu', '2026-03-06 15:02:36', 'Read'),
(3, 43, 'Appointment Approved', 'Your appointment on 2026-03-18 at 10:00 - 11:00 has been approved.\r\nAssigned Staff: Meera', '2026-03-06 15:02:45', 'Read'),
(4, 8, 'Appointment Approved', 'Your appointment on 2026-03-12 at 10:00 - 11:00 has been approved.\r\nAssigned Staff: Meera', '2026-03-06 15:02:51', 'Unread'),
(5, 43, 'Appointment Cancelled', 'Your appointment on 2026-03-18 was cancelled successfully.', '2026-03-07 02:21:45', 'Read');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `message` text NOT NULL,
  `type` enum('info','warning','success','alert') DEFAULT 'info',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Unread','Read') DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`notification_id`, `user_id`, `staff_id`, `title`, `message`, `type`, `is_read`, `created_at`, `status`) VALUES
(1, 30, 6, NULL, 'Your leave request from 2026-04-13 to 2026-04-14 has been Approved.', 'info', 0, '2026-03-01 14:57:10', 'Read');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_mode` enum('Cash','Online','Card') DEFAULT 'Cash',
  `bill_id` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT 'Pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `refund_status` tinyint(4) DEFAULT 0,
  `refund_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `appointment_id`, `user_id`, `amount`, `payment_mode`, `bill_id`, `payment_status`, `transaction_id`, `payment_date`, `refund_status`, `refund_date`) VALUES
(1, 0, 0, 0.00, 'Cash', 1, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(2, 0, 0, 0.00, 'Cash', 2, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(3, 0, 0, 0.00, 'Cash', 3, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(4, 0, 0, 0.00, 'Cash', 4, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(5, 0, 0, 0.00, 'Cash', 5, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(6, 0, 0, 0.00, 'Cash', 6, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(7, 0, 0, 0.00, 'Cash', 7, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(8, 0, 0, 0.00, 'Cash', 8, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(9, 0, 0, 0.00, 'Cash', 9, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(10, 0, 0, 0.00, 'Cash', 10, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(11, 0, 0, 0.00, 'Cash', 11, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(12, 0, 0, 0.00, 'Cash', 12, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(13, 0, 0, 0.00, 'Cash', 13, 'Paid', NULL, '2026-02-08 17:12:10', 0, NULL),
(14, 1, 1, 799.00, 'Cash', NULL, 'Refunded', 'TESTTXN123', '2026-02-08 19:34:31', 1, '2026-02-08 20:25:05'),
(16, 2, 2, 799.00, 'Cash', 2, 'Paid', 'CASH001', '2026-02-08 22:16:07', 0, NULL),
(17, 4, 4, 1299.00, 'Online', 4, 'Paid', 'UPI40910', '2026-02-15 21:28:26', 0, NULL),
(18, 7, 7, 999.00, 'Cash', 7, 'Paid', '', '2026-02-24 23:19:15', 0, NULL),
(19, 9, 9, 799.00, 'Cash', 9, 'Refunded', 'REFUND123', '2026-02-08 22:18:40', 1, '2026-02-08 22:18:40'),
(20, 11, 10, 499.00, 'Cash', 10, 'Paid', 'CASH002', '2026-02-01 00:00:00', 0, NULL),
(21, 13, 11, 1599.00, 'Cash', 11, 'Paid', '', '2026-02-15 08:02:45', 0, NULL),
(22, 14, 12, 899.00, 'Online', 12, 'Paid', 'UPI20696', '2026-02-15 09:11:11', 0, NULL),
(23, 15, 13, 699.00, 'Cash', 13, 'Paid', 'CASH003', '2026-02-04 00:00:00', 0, NULL),
(24, 5, 3, 799.00, 'Cash', NULL, 'Paid', 'TESTTXN001', '2026-02-09 19:30:40', 0, NULL),
(25, 6, 3, 1299.00, 'Online', NULL, 'Paid', 'UPI123456', '2026-02-09 19:30:40', 0, NULL),
(26, 7, 4, 499.00, 'Cash', NULL, 'Paid', '', '2026-02-24 23:19:15', 0, NULL),
(27, 5, 3, 799.00, 'Cash', NULL, 'Paid', 'TESTTXN001', '2026-02-09 23:18:45', 0, NULL),
(28, 6, 3, 1299.00, 'Online', NULL, 'Paid', 'UPI123456', '2026-02-09 23:18:45', 0, NULL),
(29, 7, 4, 499.00, 'Cash', NULL, 'Paid', '', '2026-02-24 23:19:15', 0, NULL),
(30, 17, 1, 500.00, 'Online', NULL, 'Paid', 'UPI13837', '2026-02-15 07:27:04', 0, NULL),
(31, 30, 13, 500.00, 'Online', NULL, 'Paid', 'UPI11092', '2026-02-15 07:55:43', 0, NULL),
(32, 29, 18, 500.00, 'Cash', NULL, 'Paid', '', '2026-02-15 21:44:37', 0, NULL),
(33, 31, 12, 500.00, 'Online', NULL, 'Pending', NULL, '2026-02-16 12:58:35', 0, NULL),
(34, 28, 18, 500.00, 'Cash', NULL, 'Paid', '', '2026-02-18 12:54:58', 0, NULL),
(35, 19, 1, 500.00, 'Online', NULL, 'Paid', 'UPI92909', '2026-03-07 08:18:36', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pet`
--

CREATE TABLE `tbl_pet` (
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_name` varchar(100) DEFAULT NULL,
  `species` varchar(50) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `vaccination_status` varchar(50) DEFAULT NULL,
  `last_vaccinated` date DEFAULT NULL,
  `next_vaccination_date` date DEFAULT NULL,
  `health_condition` text DEFAULT NULL,
  `microchip_id` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `neutered` enum('Yes','No') DEFAULT 'No',
  `image` varchar(255) DEFAULT NULL,
  `last_grooming` date DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `approved` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `weight` decimal(5,2) DEFAULT NULL,
  `height_cm` decimal(5,2) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `emergency_contact` varchar(20) DEFAULT NULL,
  `insurance_details` text DEFAULT NULL,
  `bmi` decimal(10,2) DEFAULT NULL,
  `health_flag` varchar(50) DEFAULT NULL,
  `chronic_condition` varchar(255) DEFAULT NULL,
  `allergy` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pet`
--

INSERT INTO `tbl_pet` (`pet_id`, `user_id`, `pet_name`, `species`, `breed`, `age`, `dob`, `vaccination_status`, `last_vaccinated`, `next_vaccination_date`, `health_condition`, `microchip_id`, `gender`, `neutered`, `image`, `last_grooming`, `status`, `approved`, `created_at`, `weight`, `height_cm`, `blood_group`, `color`, `allergies`, `emergency_contact`, `insurance_details`, `bmi`, `health_flag`, `chronic_condition`, `allergy`) VALUES
(1, 1, 'Tiger', 'Dog', 'German Shepherd', 3, '2023-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-1-2026', 'Male', 'No', 'pet1.jpg', '2026-02-01', 'Approved', 1, '2026-01-11 21:26:17', 34.00, 60.00, 'DEA 1.1', 'Black & Brown', 'None', '9876500001', 'Insured - PetSecure', 94.44, NULL, NULL, NULL),
(2, 2, 'Ruby', 'Cat', 'Persian', 2, '2024-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-2-2026', 'Female', 'No', 'pet2.jpg', '2026-02-05', 'Approved', 1, '2026-01-11 21:26:17', 4.00, 25.00, 'A', 'White', 'Dust', '9876500002', 'Not Insured', 64.00, NULL, NULL, NULL),
(3, 3, 'Shadow', 'Dog', 'Golden Retriever', 4, '2022-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-3-2026', 'Male', 'No', 'pet3.jpg', '2026-01-25', 'Approved', 1, '2026-01-11 21:26:17', 28.00, 58.00, 'DEA 1.1', 'Golden', 'Chicken', '9876500003', 'Insured - PawProtect', 83.23, NULL, NULL, NULL),
(4, 4, 'Lucy', 'Dog', 'Samoyed', 1, '2025-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-4-2026', 'Female', 'No', 'pet4.jpg', '2026-02-10', 'Approved', 1, '2026-01-11 21:26:17', 22.00, 55.00, 'DEA 1.1', 'Cream', 'None', '9876500004', 'Insured - PetCare Plus', 72.73, NULL, NULL, NULL),
(5, 5, 'Oscar', 'Cat', 'Maine Coon', 3, '2023-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-5-2026', 'Male', 'No', 'pet5.jpg', '2026-02-15', 'Approved', 1, '2026-01-11 21:26:17', 7.00, 30.00, 'A', 'Gray', 'Milk', '9876500005', 'Not Insured', 77.78, NULL, NULL, NULL),
(6, 6, 'Buddy', 'Dog', 'Golden Retriever', 5, '2021-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-6-2026', 'Male', 'No', 'pet6.jpg', '2026-01-20', 'Approved', 1, '2026-01-11 21:26:17', 30.00, 58.00, 'DEA 1.1', 'Golden', 'None', '9876500006', 'Insured - PetSecure', 89.18, NULL, NULL, NULL),
(7, 7, 'Molly', 'Cat', 'Ragdoll', 2, '2024-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-7-2026', 'Female', 'No', 'pet7.jpg', '2026-02-12', 'Approved', 1, '2026-01-11 21:26:17', 5.00, 28.00, 'A', 'White & Gray', 'Fish', '9876500007', 'Not Insured', 63.78, NULL, NULL, NULL),
(8, 8, 'Zoro', 'Dog', 'Labrador Retriever', 3, '2023-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-8-2026', 'Male', 'No', 'pet8.jpg', '2026-02-08', 'Approved', 1, '2026-01-11 21:26:17', 26.00, 57.00, 'DEA 1.1', 'Brown', 'None', '9876500008', 'Insured - PawProtect', 80.02, NULL, NULL, NULL),
(9, 9, 'Choco', 'Dog', 'Golden Retriever', 1, '2025-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-9-2026', 'Male', 'No', 'pet9.jpg', '2026-02-03', 'Approved', 1, '2026-01-11 21:26:17', 18.00, 58.00, 'DEA 1.1', 'Golden', 'Pollen', '9876500009', 'Not Insured', 53.51, NULL, NULL, NULL),
(10, 10, 'Lilly', 'Cat', 'Persian', 4, '2022-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-10-2026', 'Female', 'No', 'pet10.jpg', '2026-02-11', 'Approved', 1, '2026-01-11 21:26:17', 4.00, 25.00, 'A', 'White', 'None', '9876500010', 'Insured - PetCare Plus', 64.00, NULL, NULL, NULL),
(11, 11, 'Scooby', 'Dog', 'Golden Retriever', 6, '2020-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-11-2026', 'Male', 'No', 'pet11.jpg', '2026-01-30', 'Approved', 1, '2026-01-11 21:26:17', 29.00, 58.00, 'DEA 1.1', 'Brown', 'None', '9876500011', 'Not Insured', 86.21, NULL, NULL, NULL),
(12, 12, 'Pinky', 'Cat', 'Persian', 2, '2024-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-12-2026', 'Female', 'No', 'pet12.jpg', '2026-02-14', 'Approved', 1, '2026-01-11 21:26:17', 3.00, 25.00, 'A', 'Orange', 'Grain', '9876500012', 'Insured - PawProtect', 48.00, NULL, NULL, NULL),
(13, 13, 'Bolt', 'Dog', 'Poodle', 3, '2023-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-13-2026', 'Male', 'No', 'pet13.jpg', '2026-02-06', 'Approved', 1, '2026-01-11 21:26:17', 9.00, 45.00, 'DEA 1.1', 'Black', 'None', '9876500013', 'Not Insured', 44.44, NULL, NULL, NULL),
(14, 14, 'Daisy', 'Dog', 'Yorkshire Terrier', 1, '2025-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-14-2026', 'Female', 'No', 'pet14.jpg', '2026-02-18', 'Approved', 1, '2026-01-11 21:26:17', 3.00, 22.00, 'DEA 1.1', 'Brown', 'Egg', '9876500014', 'Insured - PetSecure', 61.98, NULL, NULL, NULL),
(15, 15, 'Neko', 'Cat', 'British Shorthair', 2, '2024-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-15-2026', 'Male', 'No', 'pet15.jpg', '2026-02-04', 'Approved', 1, '2026-01-11 21:26:17', 6.00, 26.00, 'A', 'White', 'None', '9876500015', 'Not Insured', 88.76, NULL, NULL, NULL),
(20, 18, 'Iliza', 'Dog', 'Samoyed', 3, '2023-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-20-2026', 'Female', 'No', 'pet4.jpg', NULL, 'Approved', 1, '2026-02-02 20:46:40', 20.00, 55.00, 'DEA 1.1', 'Brown', 'None', '9876543210', 'Not Insured', 66.12, NULL, NULL, NULL),
(24, 18, 'Bella', 'Dog', 'Golden Retriever', 3, '2023-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-24-2026', 'Female', 'No', 'pet11.jpg', NULL, 'Approved', 1, '2026-02-03 23:08:42', 24.00, 58.00, 'DEA 1.1', 'Brown', 'None', '9876543210', 'Not Insured', 71.34, NULL, NULL, NULL),
(25, 18, 'Cameli', 'Cat', 'Ragdoll', 3, '2023-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-25-2026', 'Female', 'No', 'pet_698233df42d08.jpg', NULL, 'Approved', 1, '2026-02-03 23:13:59', 5.00, 28.00, 'A', 'Brown', 'None', '9876543210', 'Not Insured', 63.78, NULL, NULL, NULL),
(29, 12, 'ABC', 'Dog', 'German Shepherd', 2, '2024-02-21', 'Up to Date', NULL, NULL, 'Healthy', 'MC-29-2026', 'Male', 'No', 'pet_6992ab0b4c4f2.jpg', NULL, 'Approved', 1, '2026-02-16 10:58:43', 32.00, 60.00, 'DEA 1.1', 'Brown', 'None', '9876543210', 'Not Insured', 88.89, NULL, NULL, NULL),
(33, 43, 'Luna', 'Cat', 'Persian', 2, '2024-05-12', 'Vaccinated', NULL, NULL, 'Healthy', 'MC-5147-2026', 'Female', 'No', 'pet_69aa56d2afa301.66534389.jpg', NULL, 'Approved', 1, '2026-03-06 09:53:46', 4.00, 25.00, '', 'Cream', '', '', '', 64.00, 'Obese', NULL, NULL);

--
-- Triggers `tbl_pet`
--
DELIMITER $$
CREATE TRIGGER `trg_calculate_bmi` BEFORE UPDATE ON `tbl_pet` FOR EACH ROW BEGIN
    SET NEW.bmi = ROUND(NEW.weight / POWER(NEW.height_cm/100,2),2);

    SET NEW.health_flag =
    CASE
        WHEN NEW.bmi < 15 THEN 'Underweight'
        WHEN NEW.bmi BETWEEN 15 AND 30 THEN 'Normal'
        WHEN NEW.bmi BETWEEN 30 AND 40 THEN 'Overweight'
        ELSE 'Obese'
    END;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pet_note`
--

CREATE TABLE `tbl_pet_note` (
  `note_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_pet_note`
--

INSERT INTO `tbl_pet_note` (`note_id`, `pet_id`, `user_id`, `note`, `created_at`) VALUES
(1, 20, 18, 'Scratching ears a lot.', '2026-02-05 16:57:43'),
(2, 20, 18, 'Scratching ears a lot.', '2026-02-05 17:42:31'),
(3, 20, 18, 'Vomiting yesterday', '2026-02-05 18:23:39'),
(4, 29, 12, 'Limping', '2026-02-21 11:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription`
--

CREATE TABLE `tbl_prescription` (
  `prescription_id` int(11) NOT NULL,
  `case_id` int(11) NOT NULL,
  `medicine_name` varchar(150) DEFAULT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` enum('Medical','Grooming') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`service_id`, `service_name`, `price`, `category`) VALUES
(1, 'Bath', 300.00, 'Grooming'),
(2, 'Hair Cut', 500.00, 'Grooming'),
(3, 'Nail Trim', 200.00, 'Grooming'),
(4, 'Vaccination', 800.00, 'Medical'),
(5, 'Health Checkup', 600.00, 'Medical');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `staff_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `daily_limit` int(11) DEFAULT 8,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`staff_id`, `name`, `role`, `phone`, `daily_limit`, `user_id`) VALUES
(1, 'Ravi', 'Cleaner', '9990001111', 8, 41),
(2, 'Anjali', 'Vet', '9990002222', 8, 27),
(3, 'Manoj', 'Cleaner', '9990003333', 8, 42),
(4, 'Anu', 'Groomer', '9000001111', 5, 28),
(5, 'Rahul', 'Groomer', '9000002222', 4, 29),
(6, 'Meera', 'Groomer', '9000003333', 6, 30),
(7, 'Arjun Nair', 'Vet', '9876543210', 8, 44);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_leave`
--

CREATE TABLE `tbl_staff_leave` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected','Expired') NOT NULL DEFAULT 'Pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `action_at` datetime DEFAULT NULL,
  `action_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_staff_leave`
--

INSERT INTO `tbl_staff_leave` (`id`, `staff_id`, `from_date`, `to_date`, `reason`, `status`, `created_at`, `action_at`, `action_by`) VALUES
(1, 28, '2026-02-23', '2026-02-24', '', 'Expired', '2026-02-23 09:33:28', NULL, NULL),
(2, 4, '2026-02-23', '2026-02-24', 'Medical Emergency', 'Approved', '2026-02-23 09:33:28', '2026-02-24 22:12:54', NULL),
(4, 2, '2026-02-27', '2026-02-28', NULL, 'Rejected', '2026-02-24 13:01:16', NULL, NULL),
(5, 2, '2026-02-27', '2026-02-28', NULL, 'Approved', '2026-02-24 13:01:16', NULL, NULL),
(6, 2, '2026-02-23', '2026-02-25', NULL, 'Rejected', '2026-02-24 13:01:16', '2026-02-24 22:12:42', NULL),
(7, 2, '2026-03-10', '2026-03-11', NULL, 'Approved', '2026-02-24 13:01:16', '2026-02-24 22:12:31', NULL),
(8, 6, '2026-04-13', '2026-04-14', 'Family Function.', 'Approved', '2026-02-25 01:41:26', '2026-03-01 20:27:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_salary`
--

CREATE TABLE `tbl_staff_salary` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('user','admin','vet','cleaner','groomer') NOT NULL DEFAULT 'user',
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name`, `email`, `phone`, `address`, `password`, `role`, `reset_token`, `reset_expiry`, `status`) VALUES
(1, 'Riya', 'riya@gmail.com', '9000000001', 'Kochi', '123', 'user', NULL, NULL, 'Active'),
(2, 'Kiran', 'kiran@gmail.com', '9000000002', 'Thrissur', '123', 'user', NULL, NULL, 'Active'),
(3, 'Anand', 'anand@gmail.com', '9000000003', 'Irinjalakuda', '123', 'user', NULL, NULL, 'Active'),
(4, 'Divya', 'divya@gmail.com', '9000000004', 'Alappuzha', '123', 'user', NULL, NULL, 'Active'),
(5, 'Nikhil', 'nikhil@gmail.com', '9000000005', 'Perumbavoor', '123', 'user', NULL, NULL, 'Active'),
(6, 'Shyam', 'shyam@gmail.com', '9000000006', 'Angamaly', '123', 'user', NULL, NULL, 'Active'),
(7, 'Fathima', 'fathima@gmail.com', '9000000007', 'Kalady', '123', 'user', NULL, NULL, 'Active'),
(8, 'Jithin', 'jithin@gmail.com', '9000000008', 'Muvattupuzha', '123', 'user', NULL, NULL, 'Active'),
(9, 'Asha', 'asha@gmail.com', '9000000009', 'Pala', '123', 'user', NULL, NULL, 'Active'),
(10, 'Basil', 'basil@gmail.com', '9000000010', 'Vyttila', '123', 'user', NULL, NULL, 'Active'),
(11, 'Anupama', 'anupama@gmail.com', '9000000011', 'Piravom', '123', 'user', NULL, NULL, 'Active'),
(12, 'Joel', 'joel@gmail.com', '9000000012', 'Kothamangalam', '123', 'user', NULL, NULL, 'Active'),
(13, 'Ameen', 'ameen@gmail.com', '9000000013', 'Perinthalmanna', '123', 'user', NULL, NULL, 'Active'),
(14, 'Nandhu', 'nandhu@gmail.com', '9000000014', 'Nilambur', '123', 'user', NULL, NULL, 'Active'),
(15, 'Sona', 'sona@gmail.com', '9000000015', 'Manjeri', '123', 'user', NULL, NULL, 'Active'),
(16, 'Varsha', 'varshathomas2003@gmail.com', '8848244142', 'Pala', '123', 'user', NULL, NULL, 'Active'),
(17, 'Anoopa', 'anoopa@gmail.com', NULL, NULL, '123', 'user', NULL, NULL, 'Active'),
(18, 'Reshma', 'reshma@gmail.com', NULL, NULL, '123', 'user', NULL, NULL, 'Active'),
(22, 'Admin', 'admin@petcare.com', NULL, NULL, 'admin123', 'admin', NULL, NULL, 'Active'),
(23, 'Amiya', 'amiya@gmail.com', NULL, NULL, '123', 'user', NULL, NULL, 'Active'),
(24, 'Richu', 'richu@gmail.com', '2365781904', 'Kochi', '123', 'user', NULL, NULL, 'Active'),
(27, 'Anjali', 'vet@petcare.com', '9967218899', 'Kochi', '123', 'vet', NULL, NULL, 'Active'),
(28, 'Anu', 'anu@groomer.com', '9000001111', 'Kochi', '123', 'groomer', NULL, NULL, 'Active'),
(29, 'Rahul', 'rahul@groomer.com', '9000002222', 'Thrissur', '123', 'groomer', NULL, NULL, 'Active'),
(30, 'Meera', 'meera@groomer.com', '9000003333', 'Ernakulam', '123', 'groomer', NULL, NULL, 'Active'),
(41, 'Ravi ', 'ravi@clinic.com', '9990001111', 'Kochi', '123456', 'cleaner', NULL, NULL, 'Active'),
(42, 'Manoj ', 'manoj@clinic.com', '9990003333', 'Irinjalakuda', '123456', 'cleaner', NULL, NULL, 'Active'),
(43, 'Maya', 'maya@gmail.com', '9000000016', 'Angamaly', '123', 'user', NULL, NULL, 'Active'),
(44, 'Arjun Nair', 'arjun@petcare.com', '9876543210', 'Kochi', '123', 'vet', NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vaccination`
--

CREATE TABLE `tbl_vaccination` (
  `vaccination_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `given_date` date NOT NULL,
  `next_due_date` date NOT NULL,
  `reminder_sent` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_vaccination`
--

INSERT INTO `tbl_vaccination` (`vaccination_id`, `pet_id`, `vaccine_name`, `given_date`, `next_due_date`, `reminder_sent`, `created_at`) VALUES
(1, 1, 'Rabies', '2025-02-01', '2026-02-01', 1, '2026-03-01 10:47:12'),
(2, 3, 'DHPP', '2025-03-10', '2025-09-10', 1, '2026-03-01 10:47:12'),
(3, 4, 'Rabies', '2025-02-20', '2026-02-20', 1, '2026-03-01 10:47:12'),
(4, 6, 'Distemper', '2025-01-10', '2026-01-10', 1, '2026-03-01 10:47:12'),
(5, 8, 'Parvo', '2025-02-12', '2026-02-12', 1, '2026-03-01 10:47:12'),
(6, 9, 'Booster', '2025-03-18', '2025-09-18', 1, '2026-03-01 10:47:12'),
(7, 11, 'Rabies', '2025-02-28', '2026-02-28', 1, '2026-03-01 10:47:12'),
(8, 13, 'DHPP', '2025-01-22', '2025-07-22', 1, '2026-03-01 10:47:12'),
(9, 14, 'Rabies', '2025-02-14', '2026-02-14', 1, '2026-03-01 10:47:12'),
(10, 20, 'Parvo', '2025-02-09', '2026-02-09', 1, '2026-03-01 10:47:12'),
(11, 24, 'Rabies', '2025-01-30', '2026-01-30', 1, '2026-03-01 10:47:12'),
(12, 29, 'Distemper', '2025-02-05', '2026-02-05', 1, '2026-03-01 10:47:12'),
(13, 2, 'FVRCP', '2025-03-01', '2026-03-01', 1, '2026-03-01 10:47:12'),
(14, 5, 'Rabies', '2025-02-10', '2026-02-10', 1, '2026-03-01 10:47:12'),
(15, 7, 'Booster', '2025-04-01', '2025-10-01', 1, '2026-03-01 10:47:12'),
(16, 10, 'FVRCP', '2025-03-05', '2026-03-05', 1, '2026-03-01 10:47:12'),
(17, 12, 'Rabies', '2025-01-22', '2026-01-22', 1, '2026-03-01 10:47:12'),
(18, 15, 'Booster', '2025-03-01', '2025-09-01', 1, '2026-03-01 10:47:12'),
(19, 25, 'FVRCP', '2025-02-25', '2026-02-25', 1, '2026-03-01 10:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vet_availability`
--

CREATE TABLE `tbl_vet_availability` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `available_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `status` enum('Available','Unavailable') DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_vet_availability`
--

INSERT INTO `tbl_vet_availability` (`id`, `staff_id`, `available_date`, `start_time`, `end_time`, `status`, `created_at`) VALUES
(1, 2, '2026-02-23', '10:50:00', '14:50:00', 'Available', '2026-02-20 15:17:43'),
(2, 2, '2026-02-23', '10:15:00', '16:00:00', 'Available', '2026-02-21 14:43:52'),
(3, 2, '2026-03-02', '09:15:00', '14:30:00', 'Available', '2026-02-21 14:45:25'),
(4, 2, '2026-02-23', '09:00:00', '15:50:00', 'Available', '2026-02-21 17:19:05'),
(5, 2, '2026-03-02', '09:00:00', '16:00:00', 'Available', '2026-02-24 20:24:01'),
(6, 2, '2026-03-01', '10:50:00', '15:50:00', 'Available', '2026-02-25 02:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vet_report`
--

CREATE TABLE `tbl_vet_report` (
  `report_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `vet_id` int(11) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_vet_report`
--

INSERT INTO `tbl_vet_report` (`report_id`, `appointment_id`, `vet_id`, `diagnosis`, `prescription`, `notes`, `created_at`) VALUES
(1, 3, 2, 'Health Checkup Done', 'Diagnostic Testing', NULL, '2026-02-21 17:30:43'),
(2, 5, 2, 'Vaccinated', 'Vaccinated', NULL, '2026-02-24 04:07:05'),
(3, 4, 2, 'Vaccinated', 'Abzz', NULL, '2026-02-24 04:09:35'),
(4, 41, 2, 'Canine influenza - H3N2 strain', 'Oseltamivir (Tamiflu) (2	ext{mg/kg}) orally twice daily for 5 days. Amoxicillin (10	ext{mg/kg}) orally twice daily for 7 days (if secondary bacterial infection suspected). Strict rest and isolation from other dogs for 7 days post-symptom resolution.', NULL, '2026-03-07 08:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_weekly_cleaning_schedule`
--

CREATE TABLE `tbl_weekly_cleaning_schedule` (
  `schedule_id` int(11) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `weekday` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `default_task` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_weight_log`
--

CREATE TABLE `tbl_weight_log` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `recorded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_admin_notification`
--
ALTER TABLE `tbl_admin_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_alert_queue`
--
ALTER TABLE `tbl_alert_queue`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `fk_app_user` (`user_id`),
  ADD KEY `idx_day_slots` (`appointment_date`,`time_slot`,`cancelled`,`emergency`),
  ADD KEY `fk_pet` (`pet_id`),
  ADD KEY `fk_service` (`service_id`),
  ADD KEY `idx_staff_date` (`staff_id`,`appointment_date`),
  ADD KEY `idx_app_date` (`appointment_date`);

--
-- Indexes for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tbl_availability`
--
ALTER TABLE `tbl_availability`
  ADD PRIMARY KEY (`availability_id`);

--
-- Indexes for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `fk_bill_app` (`appointment_id`);

--
-- Indexes for table `tbl_cleaner_kpi`
--
ALTER TABLE `tbl_cleaner_kpi`
  ADD PRIMARY KEY (`kpi_id`),
  ADD UNIQUE KEY `unique_kpi` (`staff_id`,`kpi_month`,`kpi_year`);

--
-- Indexes for table `tbl_cleaner_performance`
--
ALTER TABLE `tbl_cleaner_performance`
  ADD PRIMARY KEY (`performance_id`);

--
-- Indexes for table `tbl_cleaning_log`
--
ALTER TABLE `tbl_cleaning_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cleaning_task`
--
ALTER TABLE `tbl_cleaning_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_cleaning_zone`
--
ALTER TABLE `tbl_cleaning_zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `tbl_clinical_observation`
--
ALTER TABLE `tbl_clinical_observation`
  ADD PRIMARY KEY (`observation_id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_feedback_user` (`user_id`),
  ADD KEY `fk_feedback_staff` (`staff_id`),
  ADD KEY `fk_feedback_appointment` (`appointment_id`);

--
-- Indexes for table `tbl_groomer`
--
ALTER TABLE `tbl_groomer`
  ADD PRIMARY KEY (`groomer_id`);

--
-- Indexes for table `tbl_grooming_checklist`
--
ALTER TABLE `tbl_grooming_checklist`
  ADD PRIMARY KEY (`checklist_id`);

--
-- Indexes for table `tbl_grooming_note`
--
ALTER TABLE `tbl_grooming_note`
  ADD PRIMARY KEY (`grooming_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `tbl_grooming_record`
--
ALTER TABLE `tbl_grooming_record`
  ADD PRIMARY KEY (`grooming_id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `tbl_health_note`
--
ALTER TABLE `tbl_health_note`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `tbl_health_record`
--
ALTER TABLE `tbl_health_record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `fk_health_pet` (`pet_id`);

--
-- Indexes for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `tbl_medical_case`
--
ALTER TABLE `tbl_medical_case`
  ADD PRIMARY KEY (`case_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `vet_id` (`vet_id`),
  ADD KEY `idx_case_pet` (`pet_id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_bill` (`bill_id`),
  ADD KEY `idx_payment_app` (`appointment_id`);

--
-- Indexes for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `idx_pet_user` (`user_id`);

--
-- Indexes for table `tbl_pet_note`
--
ALTER TABLE `tbl_pet_note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tbl_staff_leave`
--
ALTER TABLE `tbl_staff_leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tbl_staff_salary`
--
ALTER TABLE `tbl_staff_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_vaccination`
--
ALTER TABLE `tbl_vaccination`
  ADD PRIMARY KEY (`vaccination_id`);

--
-- Indexes for table `tbl_vet_availability`
--
ALTER TABLE `tbl_vet_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vet_report`
--
ALTER TABLE `tbl_vet_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `tbl_weekly_cleaning_schedule`
--
ALTER TABLE `tbl_weekly_cleaning_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `tbl_weight_log`
--
ALTER TABLE `tbl_weight_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin_notification`
--
ALTER TABLE `tbl_admin_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_alert_queue`
--
ALTER TABLE `tbl_alert_queue`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_audit_log`
--
ALTER TABLE `tbl_audit_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_availability`
--
ALTER TABLE `tbl_availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_cleaner_kpi`
--
ALTER TABLE `tbl_cleaner_kpi`
  MODIFY `kpi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cleaner_performance`
--
ALTER TABLE `tbl_cleaner_performance`
  MODIFY `performance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cleaning_log`
--
ALTER TABLE `tbl_cleaning_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cleaning_task`
--
ALTER TABLE `tbl_cleaning_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cleaning_zone`
--
ALTER TABLE `tbl_cleaning_zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clinical_observation`
--
ALTER TABLE `tbl_clinical_observation`
  MODIFY `observation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_groomer`
--
ALTER TABLE `tbl_groomer`
  MODIFY `groomer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_grooming_checklist`
--
ALTER TABLE `tbl_grooming_checklist`
  MODIFY `checklist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grooming_note`
--
ALTER TABLE `tbl_grooming_note`
  MODIFY `grooming_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_grooming_record`
--
ALTER TABLE `tbl_grooming_record`
  MODIFY `grooming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_health_note`
--
ALTER TABLE `tbl_health_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_health_record`
--
ALTER TABLE `tbl_health_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_medical_case`
--
ALTER TABLE `tbl_medical_case`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_pet_note`
--
ALTER TABLE `tbl_pet_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_staff_leave`
--
ALTER TABLE `tbl_staff_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_staff_salary`
--
ALTER TABLE `tbl_staff_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_vaccination`
--
ALTER TABLE `tbl_vaccination`
  MODIFY `vaccination_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_vet_availability`
--
ALTER TABLE `tbl_vet_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_vet_report`
--
ALTER TABLE `tbl_vet_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_weekly_cleaning_schedule`
--
ALTER TABLE `tbl_weekly_cleaning_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_weight_log`
--
ALTER TABLE `tbl_weight_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD CONSTRAINT `fk_app_pet` FOREIGN KEY (`pet_id`) REFERENCES `tbl_pet` (`pet_id`),
  ADD CONSTRAINT `fk_app_staff` FOREIGN KEY (`staff_id`) REFERENCES `tbl_staff` (`staff_id`),
  ADD CONSTRAINT `fk_app_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `fk_pet` FOREIGN KEY (`pet_id`) REFERENCES `tbl_pet` (`pet_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`service_id`) REFERENCES `tbl_service` (`service_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_staff` FOREIGN KEY (`staff_id`) REFERENCES `tbl_staff` (`staff_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `fk_bill_app` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`appointment_id`);

--
-- Constraints for table `tbl_cleaner_kpi`
--
ALTER TABLE `tbl_cleaner_kpi`
  ADD CONSTRAINT `tbl_cleaner_kpi_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `tbl_staff` (`staff_id`);

--
-- Constraints for table `tbl_clinical_observation`
--
ALTER TABLE `tbl_clinical_observation`
  ADD CONSTRAINT `tbl_clinical_observation_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `tbl_medical_case` (`case_id`);

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `fk_feedback_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`appointment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_feedback_staff` FOREIGN KEY (`staff_id`) REFERENCES `tbl_staff` (`staff_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_feedback_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_grooming_note`
--
ALTER TABLE `tbl_grooming_note`
  ADD CONSTRAINT `tbl_grooming_note_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tbl_pet` (`pet_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grooming_record`
--
ALTER TABLE `tbl_grooming_record`
  ADD CONSTRAINT `tbl_grooming_record_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tbl_pet` (`pet_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grooming_record_ibfk_2` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`appointment_id`) ON DELETE SET NULL;

--
-- Constraints for table `tbl_health_note`
--
ALTER TABLE `tbl_health_note`
  ADD CONSTRAINT `tbl_health_note_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tbl_pet` (`pet_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_health_record`
--
ALTER TABLE `tbl_health_record`
  ADD CONSTRAINT `fk_health_pet` FOREIGN KEY (`pet_id`) REFERENCES `tbl_pet` (`pet_id`);

--
-- Constraints for table `tbl_medical_case`
--
ALTER TABLE `tbl_medical_case`
  ADD CONSTRAINT `tbl_medical_case_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tbl_pet` (`pet_id`),
  ADD CONSTRAINT `tbl_medical_case_ibfk_2` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`appointment_id`),
  ADD CONSTRAINT `tbl_medical_case_ibfk_3` FOREIGN KEY (`vet_id`) REFERENCES `tbl_staff` (`staff_id`);

--
-- Constraints for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD CONSTRAINT `tbl_notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `fk_payment_bill` FOREIGN KEY (`bill_id`) REFERENCES `tbl_bill` (`bill_id`);

--
-- Constraints for table `tbl_pet`
--
ALTER TABLE `tbl_pet`
  ADD CONSTRAINT `fk_pet_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_prescription`
--
ALTER TABLE `tbl_prescription`
  ADD CONSTRAINT `tbl_prescription_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `tbl_medical_case` (`case_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
