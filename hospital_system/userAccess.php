<?php
include("db.php");

if (isset($_POST['staffID'], $_POST['role'], $_POST['oldPassword'], $_POST['newPassword'])) {

    $staffID = $_POST['staffID'];
    $role = $_POST['role'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // 1. Get user from DB
    $stmt = $conn->prepare("SELECT Password FROM STAFF WHERE StaffID=? AND Role=?");
    $stmt->bind_param("is", $staffID, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        // 2. Verify old password (works for hashed passwords)
        if (password_verify($oldPassword, $row['Password'])) {

            // 3. Hash new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // 4. Update DB
            $update = $conn->prepare("UPDATE STAFF SET Password=? WHERE StaffID=? AND Role=?");
            $update->bind_param("sis", $hashedNewPassword, $staffID, $role);

            if ($update->execute()) {
                header("Location: userAccess.php?success=1");
                exit();
            } else {
                echo "Update failed: " . $conn->error;
            }

        } else {
            echo "Incorrect old password.";
        }

    } else {
        echo "Staff not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Access</title>
</head>
<body style="font-family:Arial; background-color:lightblue;">

<h1>Staff Access Management</h1>

<?php
if (isset($_GET['success'])) {
    echo "<p style='color:green;'><b>Password updated successfully!</b></p>";
}
?>

<form method="POST">

    <input type="text" name="staffID" placeholder="Staff ID" required><br><br>

    <select name="role" required>
        <option value="Receptionist">Receptionist</option>
        <option value="Doctor">Doctor</option>
        <option value="Medical Staff">Medical Staff</option>
    </select><br><br>

    <input type="password" name="oldPassword" placeholder="Old Password" required><br><br>

    <input type="password" name="newPassword" placeholder="New Password" required><br><br>

    <button type="submit">Update Password</button>

</form>

</body>
</html>