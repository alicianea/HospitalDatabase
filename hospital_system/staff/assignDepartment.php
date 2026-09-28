<?php
include("../db.php");

$message = "";

// UPDATE department
if (isset($_POST['submit'])) {

    $staffID = $_POST['StaffID'];
    $deptID = $_POST['DepartmentID'];

    //Check staff exists AND get role
    $check = $conn->prepare("
        SELECT Role 
        FROM STAFF 
        WHERE StaffID = ?
    ");

    $check->bind_param("i", $staffID);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        $message = "Staff ID not found!";
    } else {

        $row = $result->fetch_assoc();
        $role = $row['Role'];

        // ROLE VALIDATION 
        if ($role != "Doctor" && $role != "Nurse") {
            $message = "Only Doctors and Nurses can change departments!";
        } else {

            //SAFE UPDATE
            $sql = $conn->prepare("
                UPDATE EMPLOYEE
                SET DepartmentID = ?
                WHERE StaffID = ?
            ");

            $sql->bind_param("ii", $deptID, $staffID);

            if ($sql->execute()) {
                $message = "Department updated successfully!";
            } else {
                $message = "Error updating department.";
            }
        }
    }
}
// FETCH updated staff list
$result = $conn->query("
    SELECT 
        e.StaffID,
        e.Name,
        e.DepartmentID,
        d.Name AS DepartmentName
    FROM EMPLOYEE e
    LEFT JOIN DEPARTMENT d ON e.DepartmentID = d.DepartmentID
    ORDER BY e.StaffID
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Move Staff Department</title>
</head>

<body style="background-color: lightblue; font-family: Arial;">

<h1 style="text-align:center;">Staff Department Management</h1>

<div style="display:flex; justify-content:center; margin-top:30px;">

<div style="background:whitesmoke; padding:25px; border-radius:10px; width:600px; box-shadow:0 2px 8px rgba(0,0,0,0.2);">

<h2>Assign New Department</h2>

<?php if ($message) echo "<p style='color:green;'><b>$message</b></p>"; ?>

<form method="POST">

    Staff ID:<br>
    <input type="number" name="StaffID" required><br><br>

    Department ID:<br>
    <input type="number" name="DepartmentID" required><br><br>

    <button type="submit" name="submit">Update</button><br><br>
    <a href='../StaffManagement.html'>Return to Staff Management</a>

</form>

<hr>

<h3>Current Staff Department List</h3>

<table border="1" cellpadding="8" width="100%">
<tr>
    <th>Staff ID</th>
    <th>Name</th>
    <th>Department ID</th>
    <th>Department Name</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['StaffID'] ?></td>
    <td><?= $row['Name'] ?></td>
    <td><?= $row['DepartmentID'] ?></td>
    <td><?= $row['DepartmentName'] ?></td>
</tr>
<?php } ?>

</table>

</div>
</div>

</body>
</html>