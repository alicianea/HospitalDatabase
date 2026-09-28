<?php
include("../db.php");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM PATIENT WHERE PatientID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: list.php");
        exit();
    } else {
        echo "Error deleting record.";
    }

} else {
    echo "No ID provided.";
}
?>