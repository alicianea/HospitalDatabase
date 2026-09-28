<?php
include("../db.php");

$id = $_GET['id'];

// 1. Secure SELECT
$stmt = $conn->prepare("SELECT Name, DOB, Address FROM PATIENT WHERE PatientID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $name = $_POST['Name'];
    $dob = $_POST['DOB'];
    $address = $_POST['Address'];

    // 2. Secure UPDATE
    $update = $conn->prepare("
        UPDATE PATIENT
        SET Name = ?, DOB = ?, Address = ?
        WHERE PatientID = ?
    ");

    $update->bind_param("sssi", $name, $dob, $address, $id);

    if ($update->execute()) {
        header("Location: list.php");
        exit();
    } else {
        echo "Update failed.";
    }
}
?>

<h2>Edit Patient</h2>

<form method="POST">
    Name: <input type="text" name="Name" value="<?= htmlspecialchars($row['Name']) ?>"><br><br>
    DOB: <input type="date" name="DOB" value="<?= htmlspecialchars($row['DOB']) ?>"><br><br>
    Address: <input type="text" name="Address" value="<?= htmlspecialchars($row['Address']) ?>"><br><br>

    <button type="submit" name="update">Update</button>
</form>