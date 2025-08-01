<?php

// Include your database connection code here
require_once "../config/db_connection.php"; // Adjust the file path as per your setup

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract drug data from POST request
    $drugId = $_POST["id"];
    $drugTypeId = $_POST["type_id"];
    $srNumber = $_POST["sr_number"];
    $drugName = $_POST["name"];

    // Prepare SQL statement with placeholders
    $query = "UPDATE drugs SET drug_type_id = ?, srs_number = ?, drug_name = ? WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bind_param("issi", $drugTypeId, $srNumber, $drugName, $drugId);

    // Execute the statement
    if ($stmt->execute()) {
        // If execution is successful, prepare success response
        $response = array('status' => 'success', 'message' => 'Drug details updated successfully');
    } else {
        // If execution fails, prepare error response
        $response = array('status' => 'error', 'message' => 'Error updating drug details: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request method is not POST, prepare error response
    $response = array("status" => false, "message" => "Invalid request method.");
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
