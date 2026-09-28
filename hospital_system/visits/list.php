<?php
include("../db.php");
//Display table of visits. Allow Edits and Deletes (Receptionist only)
?>

<h1>Visits</h1>

<a href="create.php">+ Add Visit</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>Visit ID</th>
    <th>Date</th>
    <th>Patient ID</th>
    <th>Department ID</th>
    <th>Actions</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM VISIT");

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['VisitID']}</td>
        <td>{$row['Date']}</td>
        <td>{$row['PatientID']}</td>
        <td>{$row['DepartmentID']}</td>
        <td>
            <a href='edit.php?id={$row['VisitID']}'>Edit</a> |
            <a href='delete.php?id={$row['VisitID']}'>Delete</a>
        </td>
    </tr>";
}
?>

</table>