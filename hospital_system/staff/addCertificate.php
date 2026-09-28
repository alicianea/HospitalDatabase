<?php
include("../db.php");

$message = "";

    // DELETE CERTIFICATION
    if (isset($_POST['delete'])) {

    $certID = $_POST['CertificateID'];
    $staffID = $_POST['StaffID'];

    $stmt = $conn->prepare("
        DELETE FROM STAFF_CERTIFICATION
        WHERE CertificateID = ? AND StaffID = ?
    ");

    $stmt->bind_param("ii", $certID, $staffID);

    if ($stmt->execute()) {
        $message = "Certification removed successfully!";
    } else {
        $message = "Error deleting certification.";
    }
    }

if (isset($_POST['submit'])) {

    $certID = $_POST['CertificateID'];
    $staffID = $_POST['StaffID'];

    // CHECK DUPLICATE (ONLY AFTER POST)
    $check = $conn->prepare("
        SELECT * FROM STAFF_CERTIFICATION
        WHERE StaffID = ? AND CertificateID = ?
    ");

    $check->bind_param("ii", $staffID, $certID);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "This staff already has this certificate!";
    } else {

        // INSERT (SAFE VERSION)
        $stmt = $conn->prepare("
            INSERT INTO STAFF_CERTIFICATION (CertificateID, StaffID)
            VALUES (?, ?)
        ");

        $stmt->bind_param("ii", $certID, $staffID);

        if ($stmt->execute()) {
            $message = "Certification assigned successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

// FETCH UPDATED DATA
$result = $conn->query("
    SELECT 
        sc.CertificateID,
        c.Name AS CertificateName,
        c.OrganizationIssued,
        sc.StaffID,
        e.Name AS StaffName
    FROM STAFF_CERTIFICATION sc
    JOIN EMPLOYEE e ON sc.StaffID = e.StaffID
    JOIN CERTIFICATION c ON sc.CertificateID = c.CertificateID
    ORDER BY sc.CertificateID
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Certification Management</title>
</head>

<body style="background-color: lightblue; font-family: Arial;">

<h1 style="text-align:center;">Certification Management</h1>

<div style="display:flex; justify-content:center; margin-top:30px;">

<div style="background:whitesmoke; padding:25px; border-radius:10px; width:600px; box-shadow:0 2px 8px rgba(0,0,0,0.2);">

<h2>Assign Certification</h2>

<?php if ($message) echo "<p style='color:green;'><b>$message</b></p>"; ?>

<form method="POST">

    Certificate ID:<br>
    <input type="number" name="CertificateID" required><br><br>

    Staff ID:<br>
    <input type="number" name="StaffID" required><br><br>

    <button type="submit" name="submit">Assign Certification</button><br><br>
    <a href='../StaffManagement.html'>Return to Staff Management</a>

</form>

<hr>

<h3>Existing Certifications</h3>

<table border="1" cellpadding="8" width="100%">
<tr>
    <th>Certificate ID</th>
    <th>Certificate Name</th>
    <th>Organization</th>
    <th>Staff ID</th>
    <th>Staff Name</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['CertificateID'] ?></td>
    <td><?= $row['CertificateName'] ?></td>
    <td><?= $row['OrganizationIssued'] ?></td>
    <td><?= $row['StaffID'] ?></td>
    <td><?= $row['StaffName'] ?></td>
    <td>
        <form method="POST" style="display:inline;">
            <input type="hidden" name="CertificateID" value="<?= $row['CertificateID'] ?>">
            <input type="hidden" name="StaffID" value="<?= $row['StaffID'] ?>">
            <button type="submit" name="delete"
                onclick="return confirm('Remove this certification?')">
                Delete
            </button>
        </form>
    </td>
</tr>
<?php } ?>
</table>

</div>
</div>

</body>
</html>