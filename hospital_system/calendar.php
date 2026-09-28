<?php
include("db.php");
?>

<h1>Appointment Calendar</h1>
<button type="button" onClick="location.href='Receptionist.html'">Back to Dashboard</button><br>
<table border="1" cellpadding="8">
<tr>
    <th>Date</th>
    <th>Patient ID</th>
    <th>Department ID</th>
    <th>Actions</th>
</tr>

<?php
$sql = "SELECT * FROM VISIT ORDER BY Date ASC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    echo "<tr>
        <td>{$row['Date']}</td>
        <td>{$row['PatientID']}</td>
        <td>{$row['DepartmentID']}</td>
        <td>
            <a href='visits/editVisit.php?id={$row['VisitID']}'>Edit</a> |
            <a href='visits/deleteVisit.php?id={$row['VisitID']}' onclick='return confirm(\"Delete this visit?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

---

<h2>Full Appointment Schedule</h2>
<table border="1" cellpadding="8">
<tr>
    <th>Date</th>
    <th>Patient</th>
    <th>Department</th>
    <th>Actions</th>
</tr>

<?php
$sql = "SELECT V.VisitID, V.Date, P.Name AS Patient, D.Name AS Department
        FROM VISIT V
        JOIN PATIENT P ON V.PatientID = P.PatientID
        JOIN DEPARTMENT D ON V.DepartmentID = D.DepartmentID
        ORDER BY V.Date";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    echo "<tr>
        <td>{$row['Date']}</td>
        <td>{$row['Patient']}</td>
        <td>{$row['Department']}</td>
        <td>
            <a href='visits/editVisit.php?id={$row['VisitID']}'>Edit</a> |
            <a href='visits/deleteVisit.php?id={$row['VisitID']}' onclick='return confirm(\"Delete this visit?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>