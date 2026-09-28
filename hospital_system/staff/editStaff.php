<?php
include("../db.php");

$patientID = $_GET['patientID'];
$currentStaffID = $_GET['staffID'] ?? '';

if (isset($_POST['update'])) {

    $newStaffID = $_POST['staffID'];

    $stmt = $conn->prepare("
        UPDATE TREATMENT T
        JOIN VISIT V ON T.VisitID = V.VisitID
        SET T.StaffID = ?
        WHERE V.PatientID = ?
    ");

    $stmt->bind_param("ii", $newStaffID, $patientID);

    if ($stmt->execute()) {
        header("Location: ../patientRecord.php");
        exit();
    } else {
        echo "Update failed.";
    }
}
?>

<h2>Edit Assigned Staff</h2>

<form method="POST">
    Patient ID: <b><?= $patientID ?></b><br><br>

    New Staff ID:
    <input type="number" name="staffID" id="staffID" required>
    <br><br>

    Staff Name:
    <input type="text" id="staffName" readonly>
    <br><br>

    <button type="submit" name="update">Update</button>
</form>

<script>
document.getElementById("staffID").addEventListener("input", function() {

    let staffID = this.value;

    if (staffID === "") {
        document.getElementById("staffName").value = "";
        return;
    }

    fetch("getStaff.php?id=" + staffID)
        .then(response => response.text())
        .then(data => {
            document.getElementById("staffName").value = data;
        });
});
</script>