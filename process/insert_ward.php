<?php
// Include database connection
include_once('../config/db_connection.php');

// Retrieve ward details from POST data
$wardName = $_POST['wardName'];

// SQL query to insert data into the database
$query = "INSERT INTO wards (ward_name) VALUES ('$wardName')";

// Perform the insertion
if (mysqli_query($conn, $query)) {
    // If insertion is successful, prepare success response
    $response = array('status' => 'success', 'message' => 'ward details inserted successfully');
} else {
    // If insertion fails, prepare error response
    $response = array('status' => 'error', 'message' => 'Error inserting ward details: ' . mysqli_error($conn));
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
