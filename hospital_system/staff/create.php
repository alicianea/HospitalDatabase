<?php
include("../db.php");
//Create a new staff member (Admins only)
$message = "";

if (isset($_POST['submit'])) {

    $ssn = $_POST['SSN'];
    $name = $_POST['Name'];
    $years = $_POST['Years'];
    $salary = $_POST['Salary'];
    $role = $_POST['Role']; 
    $dept = null;

    if ($role === "Doctor" || $role === "Nurse") {
        $dept = $_POST['DepartmentID'];
    }

    // CHECK DUPLICATE SSN
    $check = $conn->prepare("SELECT StaffID FROM EMPLOYEE WHERE SSN = ?");
    $check->bind_param("s", $ssn);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "Error: SSN already exists!";
    } else {

        // INSERT EMPLOYEE
        $stmt = $conn->prepare("
            INSERT INTO EMPLOYEE 
            (SSN, Name, YearsInService, Salary, DepartmentID)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->bind_param("ssiii", $ssn, $name, $years, $salary, $dept);
        $stmt->execute();

        // Get generated StaffID
        $staffID = $conn->insert_id;

        // PASSWORD GENERATION
        switch ($role) {
            case "Doctor":
                $prefix = "doc";
                break;
            case "Nurse":
                $prefix = "nurse";
                break;
            case "Receptionist":
                $prefix = "staff";
                break;
            case "Insurance":
                $prefix = "ins";
                break;
            case "Admin":
                $prefix = "admin";
                break;
            default:
                $prefix = "usr";
        }

        $plainPassword = $prefix . rand(1000, 9999);

        //HASH PASSWORD
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        //INSERT LOGIN CREDENTIALS (STORE HASH)
        $login = $conn->prepare("
            INSERT INTO STAFF (StaffID, Password, Role)
            VALUES (?, ?, ?)
        ");

        $login->bind_param("iss", $staffID, $hashedPassword, $role);

        if ($login->execute()) {
            $message = "Staff created successfully. Temporary Password: $plainPassword";
        } else {
            $message = "Error creating login: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Staff</title>
</head>

<body style="background-color: lightblue; font-family: Arial;">

<h1 style="text-align:center;">Staff Management</h1>

<div style="display:flex; justify-content:center; margin-top:40px;">

<div style="background:whitesmoke; padding:30px; border-radius:10px; width:400px; box-shadow:0 2px 8px rgba(0,0,0,0.2);">
<h2 style="text-align:center; color:#2c3e50;">Add Staff</h2>

<?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>

<script>
function toggleDepartmentField() {
    var role = document.getElementById("role").value;
    var deptContainer = document.getElementById("deptContainer");
    var deptInput = document.getElementById("deptInput");

    if (role === "Doctor" || role === "Nurse") {
        deptContainer.style.display = "block";
        deptInput.required = true;
    } else {
        deptContainer.style.display = "none";
        deptInput.required = false;
        deptInput.value = ""; // clear value
    }
}

// Run once on page load
window.onload = toggleDepartmentField;
</script>

<form method="POST">

    SSN:<br>
    <input type="text" name="SSN" required><br><br>

    Name:<br>
    <input type="text" name="Name" required><br><br>

    Years in Service:<br>
    <input type="number" name="Years" required><br><br>

    Salary:<br>
    <input type="number" name="Salary" required><br><br>

    Role:<br>
    <select name="Role" id="role" onchange="toggleDepartmentField()" required>
    <option value="Doctor">Doctor</option>
    <option value="Nurse">Nurse</option>
    <option value="Receptionist">Receptionist</option>
    <option value="Insurance">Insurance</option>
    <option value="Admin">Admin</option>
    </select>
    <br><br>

    <div id="deptContainer" style="display:none;">
    Department ID:<br>
    <input type="number" name="DepartmentID" id="deptInput"><br><br>
    </div>

    <button type="submit" name="submit">Add Staff</button><br><br>

    <a href='../StaffManagement.html'>Return to Staff Management</a>

    

</form>

</div>
</div>

</body>
</html>