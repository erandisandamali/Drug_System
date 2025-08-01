<?php
// Include your database connection code here
require_once "../config/db_connection.php";

// Retrieve data from the POST
$id = $_POST['id'];
$firstName = $_POST['new_first_name'];
$lastName = $_POST['new_last_name'];
$phn = $_POST['new_phn'];
$bhtNum = $_POST['new_bht_num'];
$clinicNum = $_POST['new_clinic_num'];
$gender = $_POST['new_gender'];
$title = $_POST['new_title'];
$age = $_POST['new_age'];
$wardId = $_POST['new_ward'];
$sectionId = $_POST['new_section'];
$oncologistId = $_POST['new_oncologist']; // Corrected key name from 'new_oncologis' to 'new_oncologist'

// Prepare SQL statement for update
$sql = "UPDATE patients 
        SET first_name = ?, last_name = ?, phn = ?, bht_number = ?, clinic_number = ?, title = ?, gender = ?, age = ?, ward_id = ?, section_id = ?, oncologist_id = ?, updated_at = CURRENT_TIMESTAMP() 
        WHERE id = ?";

// Initialize and prepare the statement
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "Error preparing the statement: " . $conn->error;
    exit();
}

// Bind parameters
$stmt->bind_param("sssssssiiiii", $firstName, $lastName, $phn, $bhtNum, $clinicNum, $title, $gender, $age, $wardId, $sectionId, $oncologistId, $id);

// Execute the statement
if ($stmt->execute() === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
