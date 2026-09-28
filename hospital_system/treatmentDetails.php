<?php
include("db.php");

$visitID = $_GET['visitID'];

$stmt = $conn->prepare("
    SELECT Diagnosis, Prescriptions
    FROM TREATMENT
    WHERE VisitID = ?
");

$stmt->bind_param("i", $visitID);
$stmt->execute();

$result = $stmt->get_result();

echo "<h2>Treatment Details</h2>";

if ($row = $result->fetch_assoc()) {
    echo "<p><strong>Diagnosis:</strong> {$row['Diagnosis']}</p>";
    echo "<p><strong>Prescriptions:</strong> {$row['Prescriptions']}</p>";
} else {
    echo "<p>No treatment recorded yet for this visit.</p>";
}

echo "<br><a href='javascript:history.back()'>Back</a>";
?>