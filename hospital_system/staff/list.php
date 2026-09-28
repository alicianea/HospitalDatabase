<?php
include("../db.php");
?>

<h1>Staff List</h1>

<a href="delete.php">Back</a>
<br><br>

<table border="1" cellpadding="8">
<tr>
    <th>Staff ID</th>
    <th>SSN</th>
    <th>Name</th>
    <th>Years</th>
    <th>Salary</th>
    <th>Department</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM EMPLOYEE");

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['StaffID']}</td>
        <td>{$row['SSN']}</td>
        <td>{$row['Name']}</td>
        <td>{$row['YearsInService']}</td>
        <td>{$row['Salary']}</td>
        <td>{$row['DepartmentID']}</td>
  
        </td>
    </tr>";
}
?>

</table>