<?php
include("../db.php");

$id = $_GET['id'] ?? '';

if ($id) {

    $stmt = $conn->prepare("SELECT Name FROM EMPLOYEE WHERE StaffID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo $row['Name'];
    } else {
        echo "Not found";
    }
}
?>