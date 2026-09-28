<?php
include("../db.php");
?>

<h1>Patients</h1>

<a href="create.php">+ Add Patient</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>DOB</th>
    <th>Address</th>
    <th>Actions</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM PATIENT");

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['PatientID']}</td>
        <td>{$row['Name']}</td>
        <td>{$row['DOB']}</td>
        <td>{$row['Address']}</td>
        <td>
            <a href='edit.php?id={$row['PatientID']}'>Edit</a> |
            <a href='delete.php?id={$row['PatientID']}'>Delete</a>
        </td>
    </tr>";
}
?>

</table>