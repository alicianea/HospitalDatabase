<?php
include("db.php");
//patientInfo.php grabs data from the form submitted in html and insert into necessary tables.

// Get form data safely
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$dob = $_POST['dob'] ?? '';
$addr = $_POST['addr'] ?? '';
$phonenum = $_POST['phonenum'] ?? '';
$type = $_POST['type'] ?? '';
$provider = $_POST['insurance'] ?? '';

$name = $fname . " " . $lname;

// Start transaction (important for multi-step inserts)
$conn->begin_transaction();

try {

    // Insert PATIENT
    $stmt1 = $conn->prepare(
        "INSERT INTO PATIENT (Name, DOB, Address) VALUES (?, ?, ?)"
    );
    $stmt1->bind_param("sss", $name, $dob, $addr);
    $stmt1->execute();

    $patientID = $conn->insert_id;

    // Insert PHONE
    $stmt2 = $conn->prepare(
        "INSERT INTO PATIENT_PHONENUMBER (PhoneNum, PatientID) VALUES (?, ?)"
    );
    $stmt2->bind_param("si", $phonenum, $patientID);
    $stmt2->execute();

    // Insert INSURANCE
    $stmt3 = $conn->prepare(
        "INSERT INTO INSURANCE (Type, ProviderName, CoverDetails, PatientID)
         VALUES (?, ?, 'Pending review', ?)"
    );
    $stmt3->bind_param("ssi", $type, $provider, $patientID);
    $stmt3->execute();

    // Commit all if successful
    $conn->commit();

    echo "<div style='background:whitesmoke; padding:20px; border-radius:10px; margin-top-20px;'>
            <h2 style='color:green;'>Patient registered successfully!</h2>

            <p><strong>Patient ID: </strong> $patientID </p>

            <br>

            <a href='Receptionist.html'>
                <button>Return to Dashboard</button>
            </a>
    </div>";

} catch (Exception $e) {

    // Rollback if anything fails
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}
?>