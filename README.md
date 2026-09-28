# Hospital Check-In & Insurance System

A full-stack hospital management system designed to manage patient check-ins, medical visits, staff information, treatments, insurance coverage, and billing data. The system uses relational MySQL database connected to a PHP-based web interface.

# Overview

The system was developed as a database-focused application that demonstrates relational database design, SQL queries, CRUD operations, authentication, and PHP/MySQL integration.

Different interfaces are provided based on the user's role, allowing hospital staff to access the appropriate functionalities relevant to their responsibilities.

# Features

* User Authentication
  * Staff login system with role-based access
  * Password hashing
  * Session-based authentication
  * Separate access for different hospital staff roles
* Receptionist
  * Register new patients
  * Check patients in for visits
  * View patient records
  * View scheduled visits and appointments
* Medical Staff
  * View assigned patients
  * Record diagnoses and treatments
  * Update patient visit information
* Insurance & Billing
  * Manage patient insurance
  * View billing information
  * Manage staff responsibilities and certifications
  * Generate billing summaries
* Administration
  * Manage staff accounts
  * Manage departments
  * Generate system reports

# Technologies Used
* Frontend: HTML, CSS
* Backend: PHP
* Database: MySQL
* Tools: MySQL Workbench
* Local development: XAMPP

# Database Structure
The database contains tables representing patients, staffs, departments, visits, treatments, insurance, and related information.

Some primary tables include:
* PATIENT
* PATIENT_PHONENUMBER
* INSURANCE
* DEPARTMENT
* EMPLOYEE
* EMPLOYEE_RESPONSIBILITY
* CERTIFICATION
* STAFF_CERTIFICATION
* MEDICAL_STAFF
* RECEPTIONIST
* INSURANCE
* ADMIN
* USERS
* VISIT
* TREATMENT

  <img width="512" height="502" alt="ER_Diagram" src="https://github.com/user-attachments/assets/d91e00c8-f95a-4763-bc92-b845ce1d3f20" />

Relationships between these tables reduce redundant data and maintain consistency.

# Installation and Setup
1. Install XAMPP - make sure Apache and MySQL are available.
2. Clone the Repository - clone this repository into the XAMPP htdocs directory

   `git clone <YOUR-GITHUB-REPOSITORY-URL>`

   For example:
   `C:\xampp\htdocs\hospital_system`
4. Start XAMPP - open the XAMPP Control Panel and start: Apache & MySQL
5. Create the Database - Open MySQL/phpMyAdmin and create a database named

`hospital_db`

Import the provided SQL file into the database:
`hospital_db.sql`

6. Configure the Database Connection - open the database connection file:
`db.php`

Update the database credentials if necessary:
`$host = "localhost"`
`$user = "root"`
`$password = "";`
`$database = "hospital_db`

7. Run the Application
`http://localhost/hospital_system/Login.html`

The login page should be displayed. Enter valid credentials to access the system. The system uses predefined credentials to access different dashboards. Users can create their own valid credentials in the Administrator Dashboard.
*	Admin Dashboard Access:
    * Employee ID: admin
	* Password: admin123
*	Receptionist Dashboard Access:
    * Employee ID: 10
	* Password: staff123
*	Insurance Dashboard Access:
	  * Employee ID: insurance1
	* Password: ins123
*	Medical Staff Dashboard Access:
  	* Employee ID: 4
	* Password: doc456

# Screenshots
Login Page of the Hospital Management System displayed to the user. This page is used to authenticate users before accessing their respective dashboards:

<img width="512" height="299" alt="login" src="https://github.com/user-attachments/assets/010ab12f-acfb-4960-a98c-84cc7ab202a0" />

Receptionist Dashboard displayed after a successful login. The dashboard provides access to key functions, including patient registration, visit recording, viewing patient records, and a calendar schedule overview of all recorded appointments.

<img width="512" height="298" alt="receptionist" src="https://github.com/user-attachments/assets/d69df1ba-2671-49c1-b192-d2758d7850b0" />

Patient Registration Form in the Receptionist module. This form collects patient details, including name, date of birth, address, phone number, and provider type. The insurance type field is displayed after the user selects the provider type.

<img width="512" height="302" alt="registration" src="https://github.com/user-attachments/assets/7ed077d8-55e5-4420-b7da-2ea24f933c3f" />

Patient Check-In form used to record a patient’s visit. The form requires a patientID (either newly assigned during registration or from existing records), along with the department type, visit date, and assigned staff selection (1-10). This feature links patient records to specific visits within the system.

<img width="512" height="298" alt="check-in" src="https://github.com/user-attachments/assets/8e5ea914-71ca-4c4c-bc8c-726d40e18081" />

Patient Records search interface used to retrieve patient information from the database. The system allows searching using PatientID, First Name, Last Name, or Phone Number, where not all fields are required. The results display the patient’s stored details, including Contact Information, Date of Birth, Department, Visit Date, and Assigned Staff.

<img width="512" height="299" alt="records" src="https://github.com/user-attachments/assets/9d8d437a-5b2e-4ada-ae7d-fa6662adbaa0" />

Appointment Calendar displaying scheduled patient appointments, including both past and upcoming entries. The interface allows users to view the full schedule and provides options to edit or delete existing appointments, supporting appointment management within the system.

<img width="381" height="512" alt="schedule" src="https://github.com/user-attachments/assets/0813b5d4-70b2-41f7-b87b-b395e75cf38a" />

Medical Staff Dashboard showing functions for viewing assigned patients, accessing patient records, and recording diagnoses and treatments. The dashboard supports medical workflow and patient care management. 

<img width="512" height="298" alt="staff" src="https://github.com/user-attachments/assets/50c2096f-a432-4e8c-ba7f-1ba3b0205dc8" />

View Assigned Patients screen showing all patients linked to staffID 4. The system displays patient details, including visit date, diagnosis, and treatment. 

<img width="512" height="344" alt="view_assigned" src="https://github.com/user-attachments/assets/c7ac6759-eda2-4997-99f8-f1cc01f095ac" />

Patient Records table showing patients' details such as ID, Personal Information, Visit History, Department, and Assigned Staff. The system allows records to be edited and supports multiple entries per patient across different departments and staff.

<img width="512" height="356" alt="records_table" src="https://github.com/user-attachments/assets/d18b2083-3cbd-49f1-a267-725bcc26c93f" />

Treatment and Diagnosis entry page where medical staff can record patient diagnoses, prescriptions, and related details. A table below displays all existing treatment records in the system.

<img width="512" height="440" alt="treatment" src="https://github.com/user-attachments/assets/af737713-9fea-4633-b37e-a5f9e56995fc" />

Insurance Dashboard for Billing Specialist showing functions for verifying insurance coverage, viewing and updating billing details, and generating billing summaries. 

<img width="512" height="299" alt="insurance" src="https://github.com/user-attachments/assets/d93b6d78-5222-424d-af7d-a3fdb0e7e71f" />

Insurance verification output showing patient’s insurance details retrieved using PatientID. The system displays InsuranceID, Type, Provider, and Coverage Information.

<img width="512" height="185" alt="verification" src="https://github.com/user-attachments/assets/57b06d36-ea0d-4989-b7c8-65da9040bdd9" />

Billing details page showing patient’s billing information, including VisitID, Department, and Insurance Type.

<img width="512" height="502" alt="billing" src="https://github.com/user-attachments/assets/6897c74d-88e1-44b3-ae0f-78045b86870f" />

Update Insurance Information Form used to modify a patient’s insurance details, including Provider and Coverage Information.

<img width="512" height="355" alt="update" src="https://github.com/user-attachments/assets/df502130-2129-4062-8cb7-18c8f2286066" />

Billing Summary page showing the total visits and estimated billing amount based on the predefined department rate displayed below.

<img width="512" height="469" alt="summary" src="https://github.com/user-attachments/assets/617cef46-ad0b-4653-97b7-4228236b8b17" />

Administrator Dashboard showing the system management features such as Staff Management, Department Management, User Access Control, and System Reports.

<img width="512" height="300" alt="admin" src="https://github.com/user-attachments/assets/f1a8c5d9-0224-4e15-9c1a-4cb8724c5be8" />

Staff Management Dashboard allowing administrators to Add, Remove, and Update Employee Records, including Department Assignments, and Salary Details.

<img width="512" height="301" alt="staff_manage" src="https://github.com/user-attachments/assets/8867dd66-fe10-4bfb-aafb-849196db6fec" />

The Manage User Access feature will display a Staff Access Management page, which allows staff to update their passwords by verifying their StaffID and existing credentials.

<img width="512" height="300" alt="user_manage" src="https://github.com/user-attachments/assets/db7e584b-9af2-469b-a3d3-59207b26cc5d" />




