<?php
// Include your database connection code here
require_once "../config/db_connection.php";

// Retrieve data from the POST request
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phn = $_POST['phn'];
$bhtNum = $_POST['bhtNum'];
$clinicNum = $_POST['clinicNum'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$title = $_POST['title'];
$wardId = $_POST['ward'];
$sectionId = $_POST['section'];
$oncologistId = $_POST['oncologist'];

// Prepare SQL statement for insertion
$sql = "INSERT INTO patients (first_name, last_name, phn,bht_number,clinic_number, age,gender,title, ward_id, section_id,oncologist_id)
        VALUES ('$firstName', '$lastName', '$phn', '$bhtNum','$clinicNum','$age', '$gender', '$title', '$wardId', '$sectionId','$oncologistId')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
