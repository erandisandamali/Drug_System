<?php
// Include database connection
include_once('../config/db_connection.php');

// Retrieve drug details from POST data
$wardId = $_POST['wardId'];
$sectionName = $_POST['sectionName'];

// SQL query to insert data into the database
$query = "INSERT INTO sections (ward_id, section_name) VALUES ('$wardId', '$sectionName')";

// Perform the insertion
if (mysqli_query($conn, $query)) {
    // If insertion is successful, prepare success response
    $response = array('status' => 'success', 'message' => 'Section details inserted successfully');
} else {
    // If insertion fails, prepare error response
    $response = array('status' => 'error', 'message' => 'Error inserting section details: ' . mysqli_error($conn));
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);
