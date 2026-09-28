<?php
include("db.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eid = $_POST['EID'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($eid == '' || $password == '') {
        die("Please fill in all fields.");
    }

       //STAFF LOGIN (SECURE)
   

    $stmt = $conn->prepare("SELECT StaffID, Role, Password FROM STAFF WHERE StaffID=?");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        // VERIFY HASHED PASSWORD
        if (password_verify($password, $row['Password'])) {

            // Store session (important for security)
            $_SESSION['staffID'] = $row['StaffID'];
            $_SESSION['role'] = $row['Role'];

            // Role-based redirects
            $role = $row['Role'];

            if ($role == "Medical Staff" || $role == "Doctor" || $role == "Nurse") {
                header("Location: MedicalStaff.html");
                exit();
            }

            if ($role == "Receptionist") {
                header("Location: Receptionist.html");
                exit();
            }

            if ($role == "Admin") {
                header("Location: Administrator.html");
                exit();
            }

            if ($role == "Insurance") {
                header("Location: Insurance.html");
                exit();
            }

            echo "Unknown role: " . $role;
            exit();

        } else {
            echo "Invalid password.";
            exit();
        }
    }

       // USER LOGIN (ADMIN/BILLING)

$stmt = $conn->prepare("SELECT Role, Password FROM USERS WHERE Username=?");
$stmt->bind_param("s", $eid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    if (password_verify($password, $row['Password'])) {

        $_SESSION['username'] = $eid;
        $_SESSION['role'] = $row['Role'];

        if ($row['Role'] == "Admin") {
            header("Location: Administrator.html");
            exit();
        }

        if ($row['Role'] == "Billing Specialist") {
            header("Location: Insurance.html");
            exit();
        }

        echo "Unknown user role: " . $row['Role'];
        exit();

    } else {
        echo "Invalid password.";
        exit();
    }

} else {
    echo "User not found.";
    exit();
}
}
?>
