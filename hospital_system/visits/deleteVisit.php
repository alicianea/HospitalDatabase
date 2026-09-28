<?php
include("../db.php");

$id = $_GET['id'];

// delete treatment first if FK blocks it
$conn->query("DELETE FROM TREATMENT WHERE VisitID=$id");

$conn->query("DELETE FROM VISIT WHERE VisitID=$id");

header("Location: ../calendar.php");
exit();
?>