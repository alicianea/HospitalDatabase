<?php
include("../db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $insuranceID = $_POST["insuranceID"] ?? '';
    $type = $_POST["type"] ?? '';
    $provider = $_POST["provider"] ?? '';
    $coverDetails = $_POST["coverDetails"] ?? '';
    $patientID = $_POST["patientID"] ?? '';

    if ($insuranceID == '' || $type == '' || $provider == '' || $coverDetails == '' || $patientID == '') {
        $message = "Please fill in all fields.";
    } else {

        $sql = "UPDATE INSURANCE 
                SET Type='$type',
                    ProviderName='$provider',
                    CoverDetails='$coverDetails',
                    PatientID='$patientID'
                WHERE InsuranceID='$insuranceID'";

        if ($conn->query($sql) === TRUE) {
            $message = "Insurance info updated successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insurance Info</title>
</head>
<body style="font-family: Arial; background-color: lightblue;">

<h1>Update Insurance Information</h1>

<?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>

<form method="POST">

    Insurance ID:
    <input type="text" name="insuranceID" required><br><br>

    Patient ID:
    <input type="text" name="patientID" required><br><br>

    Type:
    <select name="type" required>
        <option value="HMO">HMO</option>
        <option value="PPO">PPO</option>
        <option value="EPO">EPO</option>
    </select><br><br>

    Provider:
    <input type="text" name="provider" required><br><br>

    Coverage Details:
    <textarea name="coverDetails" required></textarea><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="../Insurance.html">Back to Dashboard</a>

</body>
</html>