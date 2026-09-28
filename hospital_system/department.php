<?php
include("db.php");

$message = "";

// INSERT department
if (!empty($_POST['name']) && !empty($_POST['location']) && !empty($_POST['phoneExtension'])) {

    $name = $_POST['name'];
    $location = $_POST['location'];
    $phoneExtension = $_POST['phoneExtension'];

    $stmt = $conn->prepare("INSERT INTO DEPARTMENT (Name, Location, PhoneExtension) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $location, $phoneExtension);

    if ($stmt->execute()) {
        $message = "Department added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// FETCH departments
$result = $conn->query("SELECT * FROM DEPARTMENT");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Departments</title>
</head>
<body style="font-family:Arial; background-color:lightblue;">

<h1>Department Management</h1>

<?php if ($message) echo "<p><b>$message</b></p>"; ?>

<!-- FORM -->
<form method="POST">
    <input type="text" name="name" placeholder="Department Name" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="text" name="phoneExtension" placeholder="Phone Extension" required>
    <button type="submit">Add Department</button>
</form>

<hr>

<h2>Existing Departments</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Location</th>
    <th>Phone Extension</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['DepartmentID'] ?></td>
    <td><?= $row['Name'] ?></td>
    <td><?= $row['Location'] ?></td>
    <td><?= $row['PhoneExtension'] ?></td>
</tr>
<?php } ?>

</table>

<br>
    <div style="position:fixed;">
        <button type="button" onClick="location.href='Administrator.html'">Back to Dashboard</button>
    </div>

</body>
</html>