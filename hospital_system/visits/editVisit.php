<?php
include("../db.php");

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM VISIT WHERE VisitID=$id");
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $date = $_POST['date'];
    $patient = $_POST['patient'];
    $dept = $_POST['department'];

    $stmt = $conn->prepare(
        "UPDATE VISIT SET Date=?, PatientID=?, DepartmentID=? WHERE VisitID=?"
    );

    $stmt->bind_param("siii", $date, $patient, $dept, $id);

    if ($stmt->execute()) {
        header("Location: ../calendar.php");
        exit();
    } else {
        echo "Update failed.";
    }
}
?>

<h2>Edit Visit</h2>

<form method="POST">
    Date: <input type="date" name="date" value="<?= $row['Date'] ?>"><br><br>
    Patient ID: <input type="number" name="patient" value="<?= $row['PatientID'] ?>"><br><br>
    Department ID: <input type="number" name="department" value="<?= $row['DepartmentID'] ?>"><br><br>

    <button type="submit" name="update">Update</button>
</form>