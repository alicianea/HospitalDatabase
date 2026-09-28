<?php
include("db.php");
?>

<h2>View Assigned Patients</h2>

<form method="GET">
    Enter Staff ID:
    <input type="number" name="staffID" required>
    <button type="submit">View</button>
</form>

<?php
if (isset($_GET['staffID'])) {

    $staffID = $_GET['staffID'];

    $sql = "SELECT 
                P.PatientID,
                P.Name,
                V.Date,
                T.Diagnosis,
                T.Prescriptions
            FROM TREATMENT T
            JOIN VISIT V ON T.VisitID = V.VisitID
            JOIN PATIENT P ON V.PatientID = P.PatientID
            WHERE T.StaffID = ?
            ORDER BY V.Date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $staffID);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h3>Patients for Staff ID: $staffID</h3>";

    echo "<table border='1' cellpadding='8'>
    <tr>
        <th>Patient ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Diagnosis</th>
        <th>Prescriptions</th>
    </tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['PatientID']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Date']}</td>
                <td>{$row['Diagnosis']}</td>
                <td>{$row['Prescriptions']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }

    echo "</table>";
}
?>