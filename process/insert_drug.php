<?php
// Include database connection
include_once('../config/db_connection.php');

// Retrieve drug details from POST data
$drugTypeId = $_POST['drugTypeId'];
$srNumber = $_POST['srNumber'];
$drugName = $_POST['drugName'];

// SQL query to insert data into the database
$query = "INSERT INTO drugs (drug_type_id, srs_number, drug_name) VALUES ('$drugTypeId', '$srNumber', '$drugName')";

// Perform the insertion
if (mysqli_query($conn, $query)) {
    // If insertion is successful, prepare success response
    $response = array('status' => 'success', 'message' => 'Drug details inserted successfully');
} else {
    // If insertion fails, prepare error response
    $response = array('status' => 'error', 'message' => 'Error inserting drug details: ' . mysqli_error($conn));
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
