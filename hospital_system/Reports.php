<?php
include("db.php");
?>

<h2>Number of Visits per Department</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Department</th>
    <th>Visits</th>
</tr>

<?php
$sql = "SELECT D.Name, COUNT(V.VisitID) AS Visits
        FROM DEPARTMENT D
        LEFT JOIN VISIT V ON D.DepartmentID = V.DepartmentID
        GROUP BY D.DepartmentID";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['Name']}</td>
        <td>{$row['Visits']}</td>
    </tr>";
}
?>
</table>

<h2>Most Active Department</h2>

<?php
$sql = "SELECT D.Name, COUNT(V.VisitID) AS Visits
        FROM DEPARTMENT D
        JOIN VISIT V ON D.DepartmentID = V.DepartmentID
        GROUP BY D.DepartmentID
        ORDER BY Visits DESC
        LIMIT 1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo "<p><strong>{$row['Name']}</strong> ({$row['Visits']} visits)</p>";
?>

<h2>Patients with Multiple Visits</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Patient ID</th>
    <th>Name</th>
    <th>Visits</th>
</tr>

<?php
$sql = "SELECT P.PatientID, P.Name, COUNT(V.VisitID) AS Visits
        FROM PATIENT P
        JOIN VISIT V ON P.PatientID = V.PatientID
        GROUP BY P.PatientID
        HAVING COUNT(V.VisitID) > 1";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['PatientID']}</td>
        <td>{$row['Name']}</td>
        <td>{$row['Visits']}</td>
    </tr>";
}
?>
</table>

<h2>Revenue by Insurance Type</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Insurance</th>
    <th>Total Revenue</th>
</tr>

<?php
$sql = "SELECT Type, COUNT(*) AS Count
        FROM INSURANCE
        GROUP BY Type";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $revenue = $row['Count'] * 5000; // simulated revenue

    echo "<tr>
        <td>{$row['Type']}</td>
        <td>\$$revenue</td>
    </tr>";
}
?>
</table>

<h2>Staff Count per Department</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Department</th>
    <th>Staff Count</th>
</tr>

<?php
$sql = "SELECT D.Name, COUNT(E.StaffID) AS StaffCount
        FROM DEPARTMENT D
        LEFT JOIN EMPLOYEE E ON D.DepartmentID = E.DepartmentID
        GROUP BY D.DepartmentID";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['Name']}</td>
        <td>{$row['StaffCount']}</td>
    </tr>";
}
?>
</table>