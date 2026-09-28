<?php
include("../db.php");
// REHIRE EMPLOYEE
if (isset($_POST['rehire'])) {

    $id = $_POST['staffID'];

    // move back to EMPLOYEE
    $stmt1 = $conn->prepare("
        INSERT INTO EMPLOYEE (StaffID, SSN, Name, YearsInService, Salary, DepartmentID)
        SELECT StaffID, SSN, Name, YearsInService, Salary, DepartmentID
        FROM INACTIVE_EMPLOYEE
        WHERE StaffID = ?
    ");
    $stmt1->bind_param("i", $id);
    $stmt1->execute();

    // remove from inactive table
    $stmt2 = $conn->prepare("DELETE FROM INACTIVE_EMPLOYEE WHERE StaffID = ?");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();

    echo "<p style='color:green;'>Employee rehired successfully.</p>";
}
// FIRE EMPLOYEE (if submitted)
if (isset($_POST['fire'])) {

    $id = $_POST['staffID'];

    // move to inactive table
    $stmt1 = $conn->prepare("
        INSERT INTO INACTIVE_EMPLOYEE (StaffID, SSN, Name, YearsInService, Salary, DepartmentID)
        SELECT StaffID, SSN, Name, YearsInService, Salary, DepartmentID
        FROM EMPLOYEE
        WHERE StaffID = ?
    ");
    $stmt1->bind_param("i", $id);
    $stmt1->execute();

    // remove from active
    $stmt2 = $conn->prepare("DELETE FROM EMPLOYEE WHERE StaffID = ?");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();

    echo "<p style='color:green;'>Employee fired successfully.</p>";
}
?>

<h1>Staff Management</h1>

 <!-- Fire employee by StaffID -->

<form method="POST">
    <label>Enter Staff ID:</label>
    <input type="number" name="staffID" required>
    <button type="submit" name="fire">Fire Employee</button>
</form>

<br>
<a href="../staffManagement.html">
    <button type="button">Back</button>
</a><br><br>

<a href="list.php">
    <button type="button">View Full Employee List</button>
</a><br>

<!-- Current Employees -->
<br>
<table border="1" cellpadding="8">
<tr>
    <th>Staff ID</th>
    <th>Name</th>
    <th>Department</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT StaffID, Name, DepartmentID FROM EMPLOYEE";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    echo "<tr>
        <td>{$row['StaffID']}</td>
        <td>{$row['Name']}</td>
        <td>{$row['DepartmentID']}</td>
        <td>
            <form method='POST' style='display:inline'>
                <input type='hidden' name='staffID' value='{$row['StaffID']}'>
                <button type='submit' name='fire'>Fire</button>
            </form>
        </td>
    </tr>";
}
?>

</table>

<h2>Inactive Employees</h2>

<table border="1" cellpadding="8">
<tr>
    <th>Staff ID</th>
    <th>Name</th>
    <th>Department</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT StaffID, Name, DepartmentID FROM INACTIVE_EMPLOYEE";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    echo "<tr>
        <td>{$row['StaffID']}</td>
        <td>{$row['Name']}</td>
        <td>{$row['DepartmentID']}</td>
        <td>
            <form method='POST' style='display:inline'>
                <input type='hidden' name='staffID' value='{$row['StaffID']}'>
                <button type='submit' name='rehire'>Rehire</button>
            </form>
        </td>
    </tr>";
}
?>
</table>