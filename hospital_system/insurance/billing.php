<?php
include("../db.php");

$sql = "SELECT 
            P.PatientID,
            P.Name,
            V.VisitID,
            D.Name AS Department,
            I.Type AS InsuranceType
        FROM VISIT V
        JOIN PATIENT P ON V.PatientID = P.PatientID
        JOIN DEPARTMENT D ON V.DepartmentID = D.DepartmentID
        LEFT JOIN INSURANCE I ON P.PatientID = I.PatientID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Billing Details</title>
</head>
<body style="font-family: Arial; background-color: lightblue;">

<h1>Billing Details</h1>

<table border="1" cellpadding="10">
<tr>
    <th>Patient ID</th>
    <th>Name</th>
    <th>Visit ID</th>
    <th>Department</th>
    <th>Insurance Type</th>
</tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['PatientID']}</td>
            <td>{$row['Name']}</td>
            <td>{$row['VisitID']}</td>
            <td>{$row['Department']}</td>
            <td>{$row['InsuranceType']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No billing records found</td></tr>";
}
?>

</table>

<br>
<a href="../insurance.html">Back to Dashboard</a>

</body>
</html>