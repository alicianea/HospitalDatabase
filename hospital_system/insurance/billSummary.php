<?php
include("../db.php");

// Base pricing model (OPTION B: transparent logic layer)
$deptPrices = [
    "Cardiology" => 300,
    "Neurology" => 350,
    "Pediatrics" => 200,
    "Orthopedics" => 250,
    "Emergency" => 500
];

// Get visits + department info
$sql = "SELECT D.Name AS Department
        FROM VISIT V
        JOIN DEPARTMENT D ON V.DepartmentID = D.DepartmentID";

$result = $conn->query($sql);

$totalVisits = 0;
$totalAmount = 0;

while ($row = $result->fetch_assoc()) {
    $dept = $row['Department'];

    if (isset($deptPrices[$dept])) {
        $totalAmount += $deptPrices[$dept];
    } else {
        $totalAmount += 200; // fallback base rate
    }

    $totalVisits++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Billing Summary</title>
</head>
<body style="font-family: Arial; background-color: lightblue;">

<h1>Billing Summary</h1>

<!-- MAIN OUTPUT -->
<div style="background:whitesmoke; padding:20px; border-radius:10px;">
    <p><strong>Total Visits:</strong> <?= $totalVisits ?></p>
    <p><strong>Total Estimated Amount:</strong> $<?= $totalAmount ?></p>
</div>

<br>

<!-- CALCULATION MODEL (OPTION B transparency section) -->
<div style="background:#f8f8f8; padding:20px; border-radius:10px;">
    <h3>Calculation Model (Department Base Rates)</h3>

    <ul>
        <li>Cardiology: $300 per visit</li>
        <li>Neurology: $350 per visit</li>
        <li>Pediatrics: $200 per visit</li>
        <li>Orthopedics: $250 per visit</li>
        <li>Emergency: $500 per visit</li>
    </ul>

    <p style="font-size:12px; color:gray;">
        Note: These values are simplified estimates used for system demonstration purposes.
    </p>
</div>

<br>
<a href="../insurance.html">Back to Dashboard</a>

</body>
</html>