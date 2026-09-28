<?php
include("../db.php");

if (isset($_POST['patientID'])) {

    $id = $_POST['patientID'];

    $sql = $conn->prepare("
        SELECT 
            P.PatientID,
            P.Name,
            I.InsuranceID,
            I.Type,
            I.ProviderName,
            I.CoverDetails
        FROM INSURANCE I
        JOIN PATIENT P ON I.PatientID = P.PatientID
        WHERE I.PatientID = ?
    ");

    $sql->bind_param("i", $id);
    $sql->execute();

    $result = $sql->get_result();

    echo "<h2>Insurance Verification Result</h2>";

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            echo "
            <div style='background:whitesmoke; padding:20px; margin:10px; border-radius:10px;'>
                <p><strong>Patient ID:</strong> {$row['PatientID']}</p>
                <p><strong>Patient:</strong> {$row['Name']}</p>
                <p><strong>Insurance ID:</strong> {$row['InsuranceID']}</p>
                <p><strong>Type:</strong> {$row['Type']}</p>
                <p><strong>Provider:</strong> {$row['ProviderName']}</p>
                <p><strong>Coverage:</strong> {$row['CoverDetails']}</p>
            </div>";
        }

    } else {
        echo "<p style='color:red;'>No insurance found for this patient.</p>";
    }

} else {
    echo "No patient ID provided.";
}
?>