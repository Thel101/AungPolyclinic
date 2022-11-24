-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2022 at 05:29 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointments`
--

CREATE TABLE `Appointments` (
  `AppointmentID` varchar(15) NOT NULL,
  `AppointmentType` varchar(20) NOT NULL,
  `DocID` varchar(10) NOT NULL,
  `DocName` varchar(50) NOT NULL,
  `scheduleID` varchar(10) NOT NULL,
  `Scheduledate` varchar(30) NOT NULL,
  `ServiceID` varchar(10) NOT NULL,
  `ServiceName` varchar(50) NOT NULL,
  `ServiceQuantity` int(11) NOT NULL,
  `ServiceCost` int(11) NOT NULL,
  `PatientID` varchar(10) NOT NULL,
  `PatientName` varchar(50) NOT NULL,
  `TokenNumber` int(11) NOT NULL,
  `Age` varchar(10) NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `Symptoms` varchar(250) NOT NULL,
  `Contact` varchar(50) NOT NULL,
  `BookingPerson` varchar(10) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `TotalFees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Appointments`
--

INSERT INTO `Appointments` (`AppointmentID`, `AppointmentType`, `DocID`, `DocName`, `scheduleID`, `Scheduledate`, `ServiceID`, `ServiceName`, `ServiceQuantity`, `ServiceCost`, `PatientID`, `PatientName`, `TokenNumber`, `Age`, `Sex`, `Symptoms`, `Contact`, `BookingPerson`, `Status`, `TotalFees`) VALUES
('AP-000003', 'ClinicConsult', 'D-000001', 'Dr. Khin Khin Lat', 'Sc-000008', '2022-11-01', '', '', 0, 0, 'P-000001', 'U Aung Htway', 1, '80', 'male', 'fever', '09 4500626347', 'P-000001', 'Booked', 20000),
('AP-000004', 'ClinicConsult', 'D-000001', 'Dr. Khin Khin Lat', 'Sc-000001', '2022-10-24', '', '', 0, 0, '', 'Choi Siwon', 1, '31', 'Male', 'fatigue', '09-23322211', 'P-000001', 'Complete', 20000),
('AP-000005', 'ClinicConsult', 'D-000001', 'Dr. Khin Khin Lat', 'Sc-000001', '2022-10-24', '', '', 0, 0, 'P-000001', 'U Aung Htway', 2, '80', 'male', 'Fever', '09 4500626347', 'P-000001', 'Complete', 12000),
('AP-000006', 'ClinicConsult', 'D-000003', 'Dr. Shaud Kham', 'Sc-000005', '2022-10-24', '', '', 0, 0, '', 'Daw Mya Khaing', 1, '50', 'Female', 'Breathlessness for past two days', '09-23322211', 'P-000001', 'Complete', 20000),
('AP-000007', 'ClinicService', '', '', '', '2022-10-13', 'S-000003', 'Ultrasound', 2, 80000, 'P-000001', 'U Aung Htway', 0, '', '', '', '09 4500626347', '', 'Booked', 160000),
('AP-000008', 'ClinicService', '', '', '', '2022-10-25', 'S-000003', 'Ultrasound', 2, 80000, 'P-000001', 'U Aung Htway', 0, '', '', '', '09 4500626347', '', 'Booked', 160000),
('AP-000009', 'ClinicConsult', 'D-000003', 'Dr. Shaud Kham', 'Sc-000005', '2022-10-31', '', '', 0, 0, '', 'Daw Hla Hla', 1, '50', 'Female', 'Chest pain for 3 days', '09-23322211', 'P-000001', 'Complete', 20000),
('AP-000010', 'ClinicService', '', '', '', '2022-11-02', 'S-000004', 'Chest X-ray', 1, 60000, 'P-000001', 'U Aung Htway', 0, '', '', '', '09 4500626347', '', 'Booked', 60000);

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `DocID` varchar(10) NOT NULL,
  `DocProfile` varchar(100) NOT NULL,
  `DocName` varchar(50) NOT NULL,
  `SpecialtyID` varchar(10) NOT NULL,
  `DocDegree` varchar(200) NOT NULL,
  `DocPhone` varchar(20) NOT NULL,
  `DocEmail` varchar(30) NOT NULL,
  `DocGender` varchar(10) NOT NULL,
  `DocStatus` varchar(20) NOT NULL,
  `ConsultationTime` varchar(20) NOT NULL,
  `ConsultationFees` int(11) NOT NULL,
  `ClinicFees` int(11) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`DocID`, `DocProfile`, `DocName`, `SpecialtyID`, `DocDegree`, `DocPhone`, `DocEmail`, `DocGender`, `DocStatus`, `ConsultationTime`, `ConsultationFees`, `ClinicFees`, `Password`) VALUES
('D-000001', '../Images/_Doc1.jpeg', 'Dr. Khin Khin Lat', 'SP-000001', 'MBBS, Yangon', '09796766633', 'khinkhin1@gmail.com', 'Female', 'active', '10:00', 9000, 5000, 'Su80*Myeon22#'),
('D-000002', '../Images/_Doc2.jpeg', 'Dr. Mg Mg Oo', 'SP-000002', 'MBBS, Yangon', '0977766633', 'mgmgoo1@gmail.com', 'Male', 'active', '15:00', 10000, 10000, 'Su80*Myeon'),
('D-000003', '../Images/_Doc3.jpeg', 'Dr. Shaud Kham', 'SP-000003', 'MBBS, Yangon/ MRCP UK (Cardiology)', '0977766642', 'kham@gmail.com', 'Male', 'active', '15:00', 10000, 10000, '89*Myeon21!'),
('D-000005', '../Images/_Doc6.jpeg', 'Dr. Maria Monro', 'Hematology', 'MBBS, Yangon/ MRCP UK (Hematology)', '09796766633', 'maria@gmail.com', 'Male', 'active', '15:00', 10000, 10000, 'Su80*Myeon12!@'),
('D-000006', '../Images/_Doc7.jpeg', 'Dr. Kinsella Chris', 'Cardiology', 'MBBS, Yangon/ MRCP UK (Cardiology)', '0943000321', 'kinsell1@gmail.com', 'Female', 'active', '15:00', 10000, 10000, 'weasd23!@#E'),
('D-000007', '../Images/_doc9.jpeg', 'Dr. Merlin Austin', 'SP-000005', 'MBBS, Yangon/ MRCP UK (Paediatrics)', '0943000321', 'merlin@gmail.com', 'Female', 'active', '15:00', 10000, 10000, 'Su80*myeon22!'),
('D-000008', '../Images/_Doc10.jpeg', 'Dr. Yuki Hana', 'SP-000005', 'MBBS, Yangon/ MRCP UK (Paediatrics)', '09432993453', 'yuki@gmail.com', 'Female', 'active', '15:00', 10000, 10000, 'Su80*myeon22#'),
('D-000009', '../Images/_Doc12.jpeg', 'Dr. Collins Morgna', 'SP-000001', 'MBBS, Yangon', '09796766633', 'colins@gmail.com', 'Male', 'active', '10:00', 7000, 5000, 'Su80*Myeon22#'),
('D-000010', '../Images/_Patient1.jpeg', 'Dr. Giaus', 'SP-000002', 'MBBS, Yangon/ MRCP UK (Neurology)', '09796766633', 'giaus@gmail.com', 'Male', 'active', '20:00', 10000, 10000, 'Su78&*Myeo22'),
('D-000011', '../Images/_Doc13.jpeg', 'Dr. Morgana Uthah', 'SP-000006', 'MBBS, Yangon/ MRCP UK (Oncology)', '09796766633', 'uthah@gmail.com', 'Female', 'active', '20:00', 10000, 10000, 'Su808Myeon22#');

-- --------------------------------------------------------

--
-- Table structure for table `DoctorSchedule`
--

CREATE TABLE `DoctorSchedule` (
  `DocID` varchar(10) NOT NULL,
  `ScheduleID` varchar(10) NOT NULL,
  `MaxPatient` int(11) NOT NULL,
  `RoomNo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `DoctorSchedule`
--

INSERT INTO `DoctorSchedule` (`DocID`, `ScheduleID`, `MaxPatient`, `RoomNo`) VALUES
('D-000001', 'Sc-000001', 3, '1'),
('D-000001', 'Sc-000008', 3, '1'),
('D-000001', 'Sc-000019', 3, '1'),
('D-000002', 'Sc-000001', 2, '2'),
('D-000002', 'Sc-000008', 2, '2'),
('D-000002', 'Sc-000019', 2, '2'),
('D-000006', 'Sc-000002', 10, '1'),
('D-000006', 'Sc-000010', 10, '1'),
('D-000005', 'Sc-000004', 10, '3'),
('D-000007', 'Sc-000017', 8, '4'),
('D-000008', 'Sc-000009', 8, '1'),
('D-000008', 'Sc-000019', 8, '3'),
('D-000007', 'Sc-000012', 8, '1'),
('D-000009', 'Sc-000003', 8, '1'),
('D-000009', 'Sc-000014', 8, '2'),
('D-000005', 'Sc-000010', 8, '3'),
('D-000009', 'Sc-000013', 8, '2'),
('D-000003', 'Sc-000005', 8, '1'),
('D-000003', 'Sc-000010', 8, '2'),
('D-000011', 'Sc-000013', 8, '4'),
('D-000011', 'Sc-000020', 8, '3');

-- --------------------------------------------------------

--
-- Table structure for table `MedicalRecords`
--

CREATE TABLE `MedicalRecords` (
  `RecordID` varchar(10) NOT NULL,
  `AppointID` varchar(10) NOT NULL,
  `PatientName` varchar(50) NOT NULL,
  `PatientAge` varchar(10) NOT NULL,
  `PatientBloodType` varchar(5) NOT NULL,
  `Symptoms` varchar(200) NOT NULL,
  `RecordDate` varchar(30) NOT NULL,
  `DocID` varchar(10) NOT NULL,
  `Doctor` varchar(50) NOT NULL,
  `UnderlyingDisease` varchar(200) NOT NULL,
  `SurgeryHistory` varchar(200) NOT NULL,
  `Diagnosis` varchar(200) NOT NULL,
  `Treatment` varchar(200) NOT NULL,
  `Notes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MedicalRecords`
--

INSERT INTO `MedicalRecords` (`RecordID`, `AppointID`, `PatientName`, `PatientAge`, `PatientBloodType`, `Symptoms`, `RecordDate`, `DocID`, `Doctor`, `UnderlyingDisease`, `SurgeryHistory`, `Diagnosis`, `Treatment`, `Notes`) VALUES
('MR-000001', 'AP-000007', 'U Aung Htway', '80 years', 'A', 'Joint pain', '19/10/2022', 'D-000001', 'Dr. Khin Khin Lat', 'Hypertension', 'none', 'Degenerative Joint disease', 'Diclofenac for 1 week after meal together with Pantoprazole', '-'),
('MR-000002', 'AP-000001', 'U Aung Htway', '80 years', 'A', 'Fever with rash', '17/10/2022', 'D-000001', 'Dr. Khin Khin Lat', 'Hypertension', 'none', 'Viral infection with xerosis', 'Moisturizer for 1 month', '-'),
('MR-000003', 'AP-000007', 'U Aung Htway', '80 years', 'A', 'Joint pain', '19/10/2022', 'D-000001', 'Dr. Khin Khin Lat', 'Hypertension', 'none', 'Degenerative joint disease', 'Diclofenac for 1 week after meal,\r\nPantoprazole for 1 weeek t.d.s', '-'),
('MR-000004', 'AP-000004', 'Choi Siwon', '31 years', 'A', 'fatigue', '24/10/2022', 'D-000001', 'Dr. Khin Khin Lat', 'Hypertension', 'none', 'dehydration', 'ORS for three days', 'next follow up after 2 weeks'),
('MR-000005', 'AP-000006', 'Daw Mya Khaing', '50 years', 'AB', 'Breathlessness for past two days', '24/10/2022', 'D-000003', 'Dr. Shaud Kham', 'Hypertension, Ashtma', 'none', 'Cardiac Dynspnoea', 'Ipratopium bromide b.d for 2 week', 'next follow up in 2 weeks'),
('MR-000006', 'AP-000005', 'U Aung Htway', '80 years', 'A', 'Fever', '24/10/2022', 'D-000001', 'Dr. Khin Khin Lat', 'Hypertension', 'none', 'Viral infection', 'Paracetamol t.d.s for one week', 'next follow up in 2 weeks'),
('MR-000007', 'AP-000009', 'Daw Hla Hla', '50 years', 'A', 'Chest pain for 3 days', '31/10/2022', 'D-000003', 'Dr. Shaud Kham', 'Cardiac hypertrophy', 'none', 'Pulmonary congestion due to RH failure', 'Lasix b.d for 1 week', 'next follow up after 1 week');

-- --------------------------------------------------------

--
-- Table structure for table `MedicalServices`
--

CREATE TABLE `MedicalServices` (
  `ServiceID` varchar(10) NOT NULL,
  `ServiceName` varchar(50) NOT NULL,
  `ServiceImage` varchar(100) NOT NULL,
  `Components` varchar(200) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MedicalServices`
--

INSERT INTO `MedicalServices` (`ServiceID`, `ServiceName`, `ServiceImage`, `Components`, `Description`, `Cost`) VALUES
('S-000001', 'Routine Blood Examination', '../Images/_Servie1.jpeg', 'Full blood count\r\nC-Reactive Protein\r\nBlood glucose profile\r\nBlood Electrolytes', 'A complete blood count (CBC) is a blood test used to evaluate your overall health and detect a wide range of disorders, including anemia, infection and leukemia.\r\nA complete blood count test measures several components and features of your blood,', 150000),
('S-000003', 'Ultrasound', '../Images/_ultrasound.jpeg', 'Abdominal ultrasound', 'Ultrasound imaging has many uses in medicine, from confirming and dating a pregnancy to diagnosing certain conditions and guiding doctors through precise medical procedures.', 80000),
('S-000004', 'Chest X-ray', '../Images/_x-ray.jpeg', 'Anterior and Lateral Chest X-ray', 'Chest X-ray can detect many things inside body\r\nThe condition of your lungs\r\nHeart-related lung problems\r\nThe size and outline of your heart\r\nBlood vessels condition\r\nPostoperative changes\r\nFractures\r\n', 60000),
('S-000005', 'Covid Vaccination', '../Images/_Covid.jpeg', 'Covid mRNA vaccine (2 doses and one booster dose)', 'COVID-19 vaccines provide strong protection against serious illness, hospitalization and death. There is also some evidence that being vaccinated will make it less likely that you will pass the virus on to others, .', 50000),
('S-000006', 'Flu Vaccine', '../Images/_FluVaccine.jpeg', 'Egg-based quadrivalent influenza vaccine', 'Seasonal flu vaccines are designed to protect against infection and illness caused by the four flu viruses that research indicates will be most common during the upcoming flu season.', 30000),
('S-000007', 'Hepatitis B vaccination', '../Images/_HBV.jpeg', 'Hepatitis B vaccines contain one of the proteins from the surface of the hepatitis B virus (HepB surface antigen, or HBsAg) . This protein is made by inserting the genetic code into yeast cells,', 'There should be at least 4 weeks between doses 1 and 2, and at least 8 weeks between doses 2 and 3. The minimum interval for the overall series from dose 1 to final dose is 4 months (16 weeks).', 15000),
('S-000008', 'Tetanus Vaccine', '../Images/_Tetanus.jpeg', 'Killed Bacteria', 'Four kinds of vaccines Diphtheria and tetanus (DT) vaccines Diphtheria, tetanus, and pertussis (DTaP) vaccines Tetanus and diphtheria (Td) vaccines Tetanus, diphtheria, and pertussis (Tdap) vaccines', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `Messages`
--

CREATE TABLE `Messages` (
  `MessageID` varchar(10) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `UserEmail` varchar(30) NOT NULL,
  `Contact` varchar(30) NOT NULL,
  `Subject` varchar(220) NOT NULL,
  `ReplyMethod` varchar(10) NOT NULL,
  `MessageDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Messages`
--

INSERT INTO `Messages` (`MessageID`, `UserName`, `UserEmail`, `Contact`, `Subject`, `ReplyMethod`, `MessageDate`) VALUES
('MD-000001', 'Phyu', 'phyusnoe846@gmail.com', '09-400626347', 'I would like to know what check up services are suitable for a 60-year-old patient.', 'email', '0000-00-00 00:00:00'),
('MD-000002', 'Phoo Phoo', 'phoophoo@gmail.com', '09-400626347', 'I want to know more details about blood examination,', '', '2022-10-22 21:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `PatientID` varchar(10) NOT NULL,
  `patientProfile` varchar(30) NOT NULL,
  `patientName` varchar(100) NOT NULL,
  `patientPhone` varchar(20) NOT NULL,
  `patientAddress` varchar(100) NOT NULL,
  `patientEmail` varchar(20) NOT NULL,
  `patientPassword` varchar(20) NOT NULL,
  `patientGender` varchar(10) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `patientAge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`PatientID`, `patientProfile`, `patientName`, `patientPhone`, `patientAddress`, `patientEmail`, `patientPassword`, `patientGender`, `DateOfBirth`, `patientAge`) VALUES
('P-000001', 'Images/_Patient2.jpeg', 'U Aung Htway', '09 4500626347', 'No. (64)/ Baho Road/ Ward 2, Mayangone township, Yangon', 'htway@gmail.com', 'Su80*Myeon22#', 'male', '1969-02-13', 80),
('P-000002', 'Images/_Patient.png', 'Daw Hla Hla', '09400626438', '', 'hla@gmail.com', 'Su80*Myeon22#', 'female', '0000-00-00', 50);

-- --------------------------------------------------------

--
-- Table structure for table `Position`
--

CREATE TABLE `Position` (
  `RoleID` varchar(10) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Position`
--

INSERT INTO `Position` (`RoleID`, `RoleName`) VALUES
('R-000001', 'Admin'),
('R-000002', 'Nurses'),
('R-000003', 'Front desk');

-- --------------------------------------------------------

--
-- Table structure for table `Schedules`
--

CREATE TABLE `Schedules` (
  `ScheduleID` varchar(10) NOT NULL,
  `scheduleDate` varchar(10) NOT NULL,
  `StartTime` varchar(20) NOT NULL,
  `EndTime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Schedules`
--

INSERT INTO `Schedules` (`ScheduleID`, `scheduleDate`, `StartTime`, `EndTime`) VALUES
('Sc-000001', 'Monday', '7:00 AM', '9:00 AM'),
('Sc-000002', 'Monday', '9:00 AM', '11:00 AM'),
('Sc-000003', 'Monday', '11:00 AM', '1:00 PM'),
('Sc-000004', 'Monday', '1:00 PM', '3:00 PM'),
('Sc-000005', 'Monday', '3:00 PM', '5:00 PM'),
('Sc-000006', 'Monday', '5:00 PM', '7:00 PM'),
('Sc-000007', 'Monday', '7:00 PM', '9:00 PM'),
('Sc-000008', 'Tuesday', '7:00 AM', '9:00 AM'),
('Sc-000009', 'Tuesday', '9:00 AM', '11:00 AM'),
('Sc-000010', 'Wednesday', '11:00 AM', '1:00 PM'),
('Sc-000012', 'Wednesday', '3:00 PM', '5:00 PM'),
('Sc-000013', 'Wednesday', '5:00 PM', '7:00 PM'),
('Sc-000014', 'Tuesday', '11:00 AM', '1:00 PM'),
('Sc-000015', 'Tuesday', '1:00 PM', '3:00 PM'),
('Sc-000016', 'Tuesday', '3:00 PM', '5:00 PM'),
('Sc-000017', 'Tuesday', '5:00 PM', '7:00 PM'),
('Sc-000018', 'Tuesday', '7:00 PM', '9:00 PM'),
('Sc-000019', 'Wednesday', '7:00 AM', '9:00 AM'),
('Sc-000020', 'Friday', '7:00 AM', '9:00 AM'),
('Sc-000021', 'Friday', '1:00 PM', '3:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `SelfMedicalRecord`
--

CREATE TABLE `SelfMedicalRecord` (
  `PatientID` varchar(10) NOT NULL,
  `PatientName` varchar(50) NOT NULL,
  `RecordType` varchar(50) NOT NULL,
  `Record` varchar(200) NOT NULL,
  `uploadedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `SelfMedicalRecord`
--

INSERT INTO `SelfMedicalRecord` (`PatientID`, `PatientName`, `RecordType`, `Record`, `uploadedOn`) VALUES
('P-000001', 'U Aung Htway', 'Blood', 'Images/_Record1.jpeg', '2022-10-19 01:57:24'),
('P-000001', 'U Aung Htway', 'Imaging', 'Images/_x-ray.jpeg', '2022-10-22 14:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `Specialty`
--

CREATE TABLE `Specialty` (
  `SpecialtyID` varchar(10) NOT NULL,
  `SpecialtyName` varchar(50) NOT NULL,
  `SpecialtyImage` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Specialty`
--

INSERT INTO `Specialty` (`SpecialtyID`, `SpecialtyName`, `SpecialtyImage`) VALUES
('SP-000001', 'General Practitioner', '../Images/_GPrac.jpeg'),
('SP-000002', 'Neurology', '../Images/_neuro.jpeg'),
('SP-000003', 'Cardiology', '../Images/_cardio.jpeg'),
('SP-000004', 'Hematology', '../Images/_haemato.jpeg'),
('SP-000005', 'Paediatrician', '../Images/_pediat.jpeg'),
('SP-000006', 'Oncology', '../Images/_oncology-1.jpeg'),
('SP-000007', 'Dermatology', '../Images/_Dermatology.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `StaffID` varchar(20) NOT NULL,
  `staffName` varchar(50) NOT NULL,
  `staffEmail` varchar(30) NOT NULL,
  `staffPhone` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `staffPosition` varchar(20) NOT NULL,
  `staffStatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`StaffID`, `staffName`, `staffEmail`, `staffPhone`, `Password`, `staffPosition`, `staffStatus`) VALUES
('S-000003', 'Parker', 'parer@gmail.com', '0934562000', 'assdasa', 'Admin', 'active'),
('S-000004', 'Brady', 'brady@gmail.com', '0934562100', 'ghjktyui', 'Nurse', 'active'),
('S-000005', 'Monro', 'monro@gmail.com', '0988877765', 'Su80*Myeon22#', 'R-000001', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Schedules`
--
ALTER TABLE `Schedules`
  ADD PRIMARY KEY (`ScheduleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
