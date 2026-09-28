-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 05:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `CertificateID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `OrganizationIssued` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`CertificateID`, `Name`, `OrganizationIssued`) VALUES
(1, 'Board Certified Cardiologist', 'American Board of Internal Medicine'),
(2, 'Board Certified Neurologist', 'American Board of Psychiatry and Neurology'),
(3, 'Pediatric Advanced Life Support', 'American Heart Association'),
(4, 'Basic Life Support', 'American Heart Association'),
(5, 'Registered Nurse Certification', 'American Nurses Credentialing Center');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `PhoneExtension` varchar(20) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `Name`, `PhoneExtension`, `Location`) VALUES
(1, 'Cardiology', 'x1001', 'Building A Floor 2'),
(2, 'Neurology', 'x1002', 'Building B Floor 3'),
(3, 'Pediatrics', 'x1003', 'Building A Floor 1'),
(4, 'Orthopedics', 'x1004', 'Building C Floor 2'),
(5, 'Emergency', 'x1005', 'Building D Floor 1');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DoctorID` int(11) NOT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorID`, `StaffID`, `Password`) VALUES
(2, 2, NULL),
(3, 3, NULL),
(4, 4, NULL),
(5, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `StaffID` int(11) NOT NULL,
  `SSN` varchar(20) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `YearsInService` int(11) DEFAULT NULL,
  `Salary` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`StaffID`, `SSN`, `Name`, `YearsInService`, `Salary`, `DepartmentID`) VALUES
(1, '123-45-6789', 'Dr. Kevin Luong', 15, 180000, 1),
(2, '234-56-7890', 'Dr. Albert Carrera', 10, 175000, 2),
(3, '345-67-8901', 'Dr. Dhruv Tripathi', 8, 160000, 3),
(4, '456-78-9012', 'Dr. Alicia Nea', 12, 170000, 4),
(5, '567-89-0123', 'Dr. Pooja Prajith', 20, 190000, 5),
(6, '678-90-1234', 'Nurse Amy Ross', 5, 75000, 1),
(7, '789-01-2345', 'Nurse Carlos Diaz', 3, 70000, 2),
(8, '890-12-3456', 'Nurse Ashley Ramirez', 7, 78000, 3),
(9, '901-23-4567', 'Nurse Chris Evans', 6, 72000, 4),
(10, '012-34-5678', 'Staff John Mills', 4, 55000, 5),
(13, '1', 'John Doe', 0, 500, 3),
(14, '2', 'Jane Doe', 0, 10, 1),
(15, '9', 'Frank Sinatra', 0, 70, 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee_responsibility`
--

CREATE TABLE `employee_responsibility` (
  `StaffID` int(11) NOT NULL,
  `Responsibility` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_responsibility`
--

INSERT INTO `employee_responsibility` (`StaffID`, `Responsibility`) VALUES
(2, 'Neurological assessments'),
(3, 'Pediatric checkups and vaccinations'),
(4, 'Orthopedic surgeries'),
(5, 'Emergency triage and response'),
(6, 'Patient monitoring and medication administration'),
(7, 'Neurological patient care'),
(8, 'Pediatric patient care'),
(9, 'Orthopedic patient assistance'),
(10, 'Administrative support and scheduling');

-- --------------------------------------------------------

--
-- Table structure for table `inactive_employee`
--

CREATE TABLE `inactive_employee` (
  `StaffID` int(11) NOT NULL,
  `SSN` varchar(20) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `YearsInService` int(11) DEFAULT NULL,
  `Salary` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inactive_employee`
--

INSERT INTO `inactive_employee` (`StaffID`, `SSN`, `Name`, `YearsInService`, `Salary`, `DepartmentID`) VALUES
(16, '8', 'Testing', 0, 400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `InsuranceID` int(11) NOT NULL,
  `Type` varchar(100) DEFAULT NULL,
  `CoverDetails` varchar(500) DEFAULT NULL,
  `ProviderName` varchar(100) DEFAULT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`InsuranceID`, `Type`, `CoverDetails`, `ProviderName`, `PatientID`) VALUES
(1, 'EPO', 'Full coverage for inpatient and outpatient', 'UnitedHealth', 1),
(2, 'PPO', '80% inpatient 70% outpatient', 'Aetna', 2),
(3, 'HMO', 'Full coverage inpatient only', 'UnitedHealth', 3),
(4, 'EPO', '90% coverage all services', 'Cigna', 4),
(5, 'PPO', '75% inpatient 65% outpatient', 'Humana', 5),
(6, 'HMO', 'Full coverage for inpatient and outpatient', 'BlueCross BlueShield', 6),
(7, 'PPO', '80% inpatient 70% outpatient', 'Aetna', 7),
(8, 'HMO', 'Full coverage inpatient only', 'UnitedHealth', 8),
(9, 'EPO', '90% coverage all services', 'Cigna', 9),
(10, 'PPO', '75% inpatient 65% outpatient', 'Humana', 10),
(11, 'PPO', 'Full coverage for inpatient and outpatient', 'Cigna', 11),
(13, 'PPO', 'Pending review', '', 13),
(14, 'EPO', 'Full Coverage', 'Cigna', 14),
(15, 'EPO', 'Pending review', '', 15),
(22, 'PPO', 'Pending review', 'Medicaid', 22),
(23, 'HMO', 'Partial Coverage', 'UnitedHealth', 23),
(24, 'HMO', 'Pending review', 'BCBS', 24);

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

CREATE TABLE `nurse` (
  `NurseID` int(11) NOT NULL,
  `StaffID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurse`
--

INSERT INTO `nurse` (`NurseID`, `StaffID`) VALUES
(1, 6),
(2, 7),
(3, 8),
(4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `Name`, `DOB`, `Address`) VALUES
(1, 'Robert Downey Jr.', '1990-05-21', '123 Main St Dallas TX'),
(2, 'Jennifer Lawrence', '1985-11-03', '456 Oak Ave Austin TX'),
(3, 'Channing Tatum', '2000-07-15', '789 Pine Rd Houston TX'),
(4, 'Johnny Depp', '1978-02-28', '321 Elm St Garland TX'),
(5, 'Margot Robbie', '1995-09-10', '654 Maple Dr Plano TX'),
(6, 'Ryan Reynolds', '2002-03-17', '987 Cedar Ln Irving TX'),
(7, 'Tom Holland', '1969-08-22', '111 Birch Blvd Mesquite TX'),
(8, 'Scarlett Johansson', '1983-12-01', '222 Walnut St Arlington TX'),
(9, 'Jane Smith', '1991-06-30', '333 Spruce Ave Richardson TX'),
(10, 'John Doe', '1999-04-11', '444 Willow Rd Frisco TX'),
(11, 'Tim Burton', '1958-08-25', '3651 Test St Austin TX '),
(13, 'Bobert Mickey', '2026-04-04', '9305 Test2 Dr Richardson TX '),
(14, 'Taylor Swift', '1985-02-20', '1010 Coachella St Plano TX'),
(15, 'Billie Eilish', '2002-06-20', '3651 Oscars St El PasoTX '),
(22, 'Test Patient', '2026-04-20', '3651 Test St Austin TX '),
(23, 'Bob  Marley', '2026-04-20', '3651 Test St Austin TX '),
(24, 'Justin Bieber', '2026-04-13', '1010 Coachella St Plano TX');

-- --------------------------------------------------------

--
-- Table structure for table `patient_phonenumber`
--

CREATE TABLE `patient_phonenumber` (
  `PhoneNum` varchar(20) NOT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_phonenumber`
--

INSERT INTO `patient_phonenumber` (`PhoneNum`, `PatientID`) VALUES
('1112223333', 22),
('1112223333', 23),
('1112223333', 24),
('1231231234', 15),
('2145550101', 1),
('2145550202', 2),
('2145550303', 3),
('2145550404', 4),
('2145550505', 5),
('2145550606', 6),
('2145550707', 7),
('2145550808', 8),
('2145550909', 9),
('2145551010', 10),
('2145551234', 11),
('2145557654', 13),
('2145558080', 14);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffMemberID` int(11) NOT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffMemberID`, `StaffID`, `Password`, `Role`) VALUES
(3, 2, '$2y$10$C8f8TviibUf3lqrIzk9tT.yVM5BzvOpRC13sjD4MEQEqeR14yluJq', 'Medical Staff'),
(4, 3, '$2y$10$SLz1TlA0UoBZg8FbqUTsW.CAkBttbOyDvnwdFT8dFst3w.KIJCuUi', 'Medical Staff'),
(5, 4, '$2y$10$nong9alebtwg3cIT7ajc5eo.m5ss/jwCOjjd0nnFBaPFz4JTkkoqa', 'Medical Staff'),
(6, 5, '$2y$10$82fHmsyDXzAt34lYrj263Ohged6tPyeIkI/042Dnv.GTWlKCtz9vm', 'Medical Staff'),
(7, 6, '$2y$10$NErECtZwAmiYqfPgSpPaVeUCyk./K4v3o0nvnTGuutV2V8US5Cip2', 'Medical Staff'),
(8, 7, '$2y$10$cRDh5RxCsZXwIVeo2zqb6e7cxnwLFZPudKULfdhpAwMQOtQfsevD6', 'Medical Staff'),
(9, 8, '$2y$10$F3aGWm1ExvqQvjX3HdFQM.K.kPdptPhOKH0OZLdJL8chCwhD3xvBG', 'Medical Staff'),
(10, 9, '$2y$10$QAR/i3w2ITSYdq7osE4QuOh2kjKBh0zXm9Nws51FRYlidpuHwT5nq', 'Medical Staff'),
(11, 10, '$2y$10$w8XPFAsVyEYnNcwvsLbCee2Lav7zofTWDEMC8La0SW3WxBC6mRpoS', 'Receptionist'),
(15, 13, '$2y$10$YFOrLQGWAXGC3lpDsdvAs.B1VWtDNCZI9RQ33v/x9ebhZBIyUM2ha', 'Doctor'),
(16, 14, '$2y$10$yWuQGBmWdAfdK/ymGBTK6uyqt1Y6O1WVmAoIO6dimvPtwanPIdmyG', 'Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `staff_certification`
--

CREATE TABLE `staff_certification` (
  `CertificateID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_certification`
--

INSERT INTO `staff_certification` (`CertificateID`, `StaffID`) VALUES
(1, 1),
(2, 2),
(2, 13),
(3, 3),
(4, 4),
(4, 5),
(4, 10),
(4, 13),
(5, 6),
(5, 7),
(5, 8),
(5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `TreatmentID` int(11) NOT NULL,
  `Diagnosis` varchar(500) DEFAULT NULL,
  `Prescriptions` varchar(100) DEFAULT NULL,
  `Descriptions` varchar(500) DEFAULT NULL,
  `VisitID` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`TreatmentID`, `Diagnosis`, `Prescriptions`, `Descriptions`, `VisitID`, `StaffID`) VALUES
(1, 'Hypertension', 'Lisinopril', 'Blood pressure management and lifestyle counseling', 1, 1),
(2, 'Migraine', 'Sumatriptan', 'Neurological evaluation and pain management', 2, 2),
(3, 'Ear Infection', 'Amoxicillin', 'Pediatric examination and antibiotic treatment', 3, 3),
(4, 'Knee Injury', 'Ibuprofen', 'Orthopedic assessment and physical therapy referral', 4, 4),
(5, 'Laceration', 'None', 'Emergency wound cleaning and suturing', 5, 5),
(6, 'Arrhythmia', 'Metoprolol', 'Cardiac monitoring and medication adjustment', 6, NULL),
(7, 'Epilepsy', 'Levetiracetam', 'Seizure management and neurological follow-up', 7, 2),
(8, 'Asthma', 'Albuterol', 'Respiratory evaluation and inhaler prescription', 8, 3),
(9, 'Fracture', 'Ibuprofen', 'X-ray and cast application', 9, 4),
(10, 'Appendicitis', 'None', 'Emergency surgical referral', 10, 5),
(12, 'Stomach Ulcers', 'Proton Pump Inhibitors', 'Reduce stomach acid, allowing ulcer to heal.', 16, 4),
(19, 'Pending', 'Pending', 'Auto-generated on check-in', 17, 2),
(20, 'Pending', 'Pending', 'Auto-generated on check-in', 18, 5),
(21, 'Stomach Ulcers', 'Proton Pump Inhibitors', 'Reduce stomach acid, allowing ulcer to heal.', 19, 5),
(25, 'Arthritis', 'Painkillers', 'Numb Pain', 23, 4),
(26, 'Stomach Pain', 'Pepto Bismol', 'Tummy Ache', 24, 4),
(28, 'Pending', 'Pending', 'Auto-generated on check-in', 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Role`) VALUES
(1, 'admin', '$2y$10$6yvO4XKeHI0iwE0CYYrjOe.VDbmKpKgT8yiLh0GIHO/jKumFtgOvC', 'Admin'),
(10, 'insurance1', '$2y$10$QmiP.JuYJxe4Cq.tz9cxXOpupLLRTZ8SzKvIPhurERcL5OmAU2QF6', 'Billing Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `VisitID` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`VisitID`, `Date`, `PatientID`, `DepartmentID`, `StaffID`) VALUES
(1, '2024-01-10', 1, 1, 1),
(2, '2024-01-15', 2, 2, 2),
(3, '2024-02-03', 3, 3, 3),
(4, '2024-02-20', 4, 4, 4),
(5, '2024-03-05', 5, 5, 5),
(6, '2024-03-18', 6, 1, 1),
(7, '2024-04-01', 7, 2, 2),
(8, '2024-04-14', 8, 3, 3),
(9, '2024-05-07', 9, 4, 4),
(10, '2024-05-22', 10, 5, 5),
(13, '2024-07-08', 3, 2, 2),
(14, '2024-07-19', 4, 3, 3),
(15, '2024-08-02', 5, 4, 4),
(16, '2026-04-22', 11, 4, 4),
(17, '2026-03-30', 13, 2, NULL),
(18, '2026-04-20', 13, 4, NULL),
(19, '2026-04-20', 15, 5, NULL),
(23, '2026-04-14', 22, 3, 1),
(24, '2026-04-20', 23, 2, 1),
(25, '2026-04-02', 23, 5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`CertificateID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DoctorID`),
  ADD UNIQUE KEY `StaffID` (`StaffID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`StaffID`),
  ADD UNIQUE KEY `SSN` (`SSN`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `employee_responsibility`
--
ALTER TABLE `employee_responsibility`
  ADD PRIMARY KEY (`StaffID`,`Responsibility`);

--
-- Indexes for table `inactive_employee`
--
ALTER TABLE `inactive_employee`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`InsuranceID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `nurse`
--
ALTER TABLE `nurse`
  ADD PRIMARY KEY (`NurseID`),
  ADD UNIQUE KEY `StaffID` (`StaffID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `patient_phonenumber`
--
ALTER TABLE `patient_phonenumber`
  ADD PRIMARY KEY (`PhoneNum`,`PatientID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffMemberID`),
  ADD UNIQUE KEY `StaffID` (`StaffID`);

--
-- Indexes for table `staff_certification`
--
ALTER TABLE `staff_certification`
  ADD PRIMARY KEY (`CertificateID`,`StaffID`),
  ADD UNIQUE KEY `StaffID` (`StaffID`,`CertificateID`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`TreatmentID`),
  ADD KEY `VisitID` (`VisitID`),
  ADD KEY `StaffID` (`StaffID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`VisitID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certification`
--
ALTER TABLE `certification`
  MODIFY `CertificateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `InsuranceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `nurse`
--
ALTER TABLE `nurse`
  MODIFY `NurseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffMemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `TreatmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `VisitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `employee` (`StaffID`) ON DELETE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `employee_responsibility`
--
ALTER TABLE `employee_responsibility`
  ADD CONSTRAINT `employee_responsibility_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `employee` (`StaffID`) ON DELETE CASCADE;

--
-- Constraints for table `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nurse`
--
ALTER TABLE `nurse`
  ADD CONSTRAINT `nurse_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `employee` (`StaffID`) ON DELETE CASCADE;

--
-- Constraints for table `patient_phonenumber`
--
ALTER TABLE `patient_phonenumber`
  ADD CONSTRAINT `patient_phonenumber_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`StaffID`) REFERENCES `employee` (`StaffID`) ON DELETE CASCADE;

--
-- Constraints for table `staff_certification`
--
ALTER TABLE `staff_certification`
  ADD CONSTRAINT `staff_certification_ibfk_1` FOREIGN KEY (`CertificateID`) REFERENCES `certification` (`CertificateID`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_certification_ibfk_2` FOREIGN KEY (`StaffID`) REFERENCES `employee` (`StaffID`) ON DELETE CASCADE;

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`VisitID`) REFERENCES `visit` (`VisitID`) ON DELETE CASCADE,
  ADD CONSTRAINT `treatment_ibfk_2` FOREIGN KEY (`StaffID`) REFERENCES `employee` (`StaffID`) ON DELETE SET NULL;

--
-- Constraints for table `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`) ON DELETE CASCADE,
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
