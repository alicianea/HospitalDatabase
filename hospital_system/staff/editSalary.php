<?php
include("../db.php");

$message = "";

if (isset($_POST['submit'])) {

    $staffID = $_POST['StaffID'];
    $salary = $_POST['Salary'];

    // 1. BASIC VALIDATION
    if ($salary <= 0) {
        $message = "Salary must be greater than 0.";
    } else {

        // CHECK IF STAFF EXISTS
        $check = $conn->prepare("SELECT StaffID FROM EMPLOYEE WHERE StaffID = ?");
        $check->bind_param("i", $staffID);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows == 0) {
            $message = "Staff ID not found!";
        } else {


            $oldSalary = null;
            $staffName = "";

            // Get current salary + name
            $info = $conn->prepare("
                SELECT Salary, Name 
                FROM EMPLOYEE 
                WHERE StaffID = ?
            ");

            $info->bind_param("i", $staffID);
            $info->execute();
            $res = $info->get_result();

            if ($row = $res->fetch_assoc()) {
                $oldSalary = $row['Salary'];
                $staffName = $row['Name'];
            }

            // SAFE UPDATE
            $stmt = $conn->prepare("
                UPDATE EMPLOYEE
                SET Salary = ?
                WHERE StaffID = ?
            ");

            $stmt->bind_param("di", $salary, $staffID);

            if ($stmt->execute()) {
                $message = "Salary updated successfully!";
                $newSalary = $salary; // store new value
            } else {
                $message = "Error updating salary.";
            }
        }
    }
}
?>

<?php if (isset($oldSalary) && isset($newSalary)) { ?>
    <div style="background:#e8f5e9; padding:15px; border-radius:8px; margin-top:15px;">
        <b>Salary Change Summary</b><br><br>
        Staff: <?= $staffName ?> (ID: <?= $staffID ?>)<br>
        Old Salary: $<?= number_format($oldSalary, 2) ?><br>
        New Salary: $<?= number_format($newSalary, 2) ?>
    </div>
<?php } ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Salary</title>
</head>

<body style="background-color: lightblue; font-family: Arial;">

<h1 style="text-align:center;">Salary Management</h1>

<div style="display:flex; justify-content:center; margin-top:30px;">

<div style="background:whitesmoke; padding:25px; border-radius:10px; width:400px; box-shadow:0 2px 8px rgba(0,0,0,0.2);">

<h2>Edit Salary</h2>

<?php if ($message) echo "<p style='color:green;'><b>$message</b></p>"; ?>

<form method="POST">

    Staff ID:<br>
    <input type="number" name="StaffID" required><br><br>

    New Salary:<br>
    <input type="number" name="Salary" step="0.01" required><br><br>

    <button type="submit" name="submit">Update Salary</button><br><br>
    <a href='../StaffManagement.html'>Return to Staff Management</a>

</form>

</div>
</div>

</body>
</html>