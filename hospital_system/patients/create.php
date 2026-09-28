<?php
include("../db.php");

if (isset($_POST['submit'])) {

    $id = $_POST['PatientID'];
    $name = $_POST['Name'];
    $dob = $_POST['DOB'];
    $address = $_POST['Address'];

    $stmt = $conn->prepare("
        INSERT INTO PATIENT (PatientID, Name, DOB, Address)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param("isss", $id, $name, $dob, $address);

    if ($stmt->execute()) {
        header("Location: list.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Add Patient</h2>

<form method="POST">
    ID: <input type="number" name="PatientID" required><br><br>
    Name: <input type="text" name="Name" required><br><br>
    DOB: <input type="date" name="DOB" required><br><br>
    Address: <input type="text" name="Address" required><br><br>

    <button type="submit" name="submit">Add</button>
</form>