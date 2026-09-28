<?php
include("db.php");

$patientID = $_POST['patientID'] ?? '';
$departmentID = $_POST['department'] ?? '';
$visitDate = $_POST['visitDate'] ?? '';
$staff = $_POST['staff'] ?? '';

// Start transaction (important)
$conn->begin_transaction();

try {

    // Insert VISIT
    $stmt1 = $conn->prepare(
        "INSERT INTO VISIT (Date, PatientID, DepartmentID, StaffID)
         VALUES (?, ?, ?, ?)"
    );
    $stmt1->bind_param("siii", $visitDate, $patientID, $departmentID, $staff);
    $stmt1->execute();

    $visitID = $conn->insert_id;

    // Insert TREATMENT
    $stmt2 = $conn->prepare(
        "INSERT INTO TREATMENT
        (Diagnosis, Prescriptions, Descriptions, VisitID, StaffID)
        VALUES (?, ?, ?, ?, ?)"
    );

    $diagnosis = "Pending";
    $prescriptions = "Pending";
    $description = "Auto-generated on check-in";

    $stmt2->bind_param(
        "sssii",
        $diagnosis,
        $prescriptions,
        $description,
        $visitID,
        $staff
    );
    $stmt2->execute();

    // Commit both inserts
    $conn->commit();

    echo"<div style='background:lightblue; padding:20px; border-radius:10px; margin-top-20px;'>
            <h2 style='color:green;'>Check-in successful</h2>

            <p><strong>Visit ID: </strong>$visitID</p><br>
            <p><strong>Patient ID: </strong>$patientID</p><br>
            <p><strong>Department ID: </strong>$departmentID</p><br>
            <p><strong>Assigned Staff ID: </strong>$staff</p><br>

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