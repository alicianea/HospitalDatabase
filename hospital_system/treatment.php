<?php
include("db.php");
?>

<h2>Add Treatment Record</h2>

<form method="POST">

    Diagnosis:<br>
    <input type="text" name="diagnosis" required><br><br>

    Prescriptions (Medication):<br>
    <input type="text" name="prescriptions"><br><br>

    Description:<br>
    <textarea name="description"></textarea><br><br>

    Visit ID:<br>
    <input type="number" name="visitID" required><br><br>

    Staff ID:<br>
    <input type="number" name="staffID" required><br><br>

    <button type="submit" name="add">Save Treatment</button><br><br>
    <button type="button" onClick="location.href='MedicalStaff.html'">Return to Dashboard</button>
</form>

<?php
if (isset($_POST['add'])) {

    $diag = $_POST['diagnosis'];
    $med = $_POST['prescriptions'];
    $desc = $_POST['description'];
    $visit = $_POST['visitID'];
    $staff = $_POST['staffID'];

    // 1. UPDATE attempt (secure)
    $updateSQL = $conn->prepare("
        UPDATE TREATMENT 
        SET Diagnosis = ?, Prescriptions = ?, Descriptions = ?, StaffID = ?
        WHERE VisitID = ?
        AND (Diagnosis = 'Pending' OR Descriptions LIKE '%Auto-generated%')
    ");

    $updateSQL->bind_param("sssii", $diag, $med, $desc, $staff, $visit);
    $updateSQL->execute();

    // 2. If nothing updated → INSERT
    if ($updateSQL->affected_rows == 0) {

        $insertSQL = $conn->prepare("
            INSERT INTO TREATMENT 
            (Diagnosis, Prescriptions, Descriptions, VisitID, StaffID)
            VALUES (?, ?, ?, ?, ?)
        ");

        $insertSQL->bind_param("sssii", $diag, $med, $desc, $visit, $staff);
        $insertSQL->execute();
    }

    echo "<p style='color:green;'>Treatment saved successfully</p>";
}
?>

<h2>All Treatment Records</h2>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Diagnosis</th>
    <th>Prescriptions</th>
    <th>Description</th>
    <th>Visit</th>
    <th>Staff</th>
</tr>

<?php
$sql = "SELECT * FROM TREATMENT";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['TreatmentID']}</td>
        <td>{$row['Diagnosis']}</td>
        <td>{$row['Prescriptions']}</td>
        <td>{$row['Descriptions']}</td>
        <td>{$row['VisitID']}</td>
        <td>{$row['StaffID']}</td>
    </tr>";
}
?>
</table>