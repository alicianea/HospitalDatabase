<?php

//Display patient information based on staffID.
include("db.php");

// Get values safely
$patientID = $_POST['patientID'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$phonenum = $_POST['phonenum'] ?? '';

// Base query
$sql = "SELECT 
            P.PatientID,
            P.Name,
            P.DOB,
            P.Address,
            PH.PhoneNum,
            V.Date AS VisitDate,
            E.Name AS StaffName,
            E.StaffID,
            D.Name AS Department
        FROM PATIENT P
        LEFT JOIN PATIENT_PHONENUMBER PH
            ON P.PatientID = PH.PatientID
        LEFT JOIN VISIT V
            ON P.PatientID = V.PatientID
        LEFT JOIN TREATMENT T
            ON V.VisitID = T.VisitID
        LEFT JOIN EMPLOYEE E
            ON T.StaffID = E.StaffID
        LEFT JOIN DEPARTMENT D
            ON V.DepartmentID = D.DepartmentID
        WHERE 1=1";
$params = [];
$types = "";

// Filters (safe)
if (!empty($patientID)) {
    $sql .= " AND P.PatientID = ?";
    $params[] = $patientID;
    $types .= "i";
}

if (!empty($fname) || !empty($lname)) {
    $fullName = $fname . " " . $lname;
    $sql .= " AND P.Name LIKE ?";
    $params[] = "%$fullName%";
    $types .= "s";
}

if (!empty($phonenum)) {
    $sql .= " AND PH.PhoneNum LIKE ?";
    $params[] = "%$phonenum%";
    $types .= "s";
}

// Prepare + execute
$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Search Results</h2>

<?php
echo "<table border='1' cellpadding='8'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>DOB</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Visit Date</th>
    <th>Department</th>
    <th>Assigned Staff</th>
    <th>Action</th>
</tr>";
?>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['PatientID']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['DOB']}</td>
                <td>{$row['Address']}</td>
                <td>{$row['PhoneNum']}</td>
                <td>{$row['VisitDate']}</td>
                <td>{$row['Department']}</td>
                <td>{$row['StaffName']} (ID: {$row['StaffID']})</td>
                <td>
                    <a href='staff/editStaff.php?staffID={$row['StaffID']}&patientID={$row['PatientID']}'>Edit</a>
                </td>
            </tr>";
        }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
?>

</table>

<br>
<!--
<a href='PatientRecord.html'>
    <button>Back</button>
</a>
-->