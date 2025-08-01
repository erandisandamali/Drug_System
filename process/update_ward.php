<?php

// Include database connection
require_once "../config/db_connection.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract data from POST request
    $wardId = $_POST["wardId"];
    $wardName = $_POST["wardName"];

    // Prepare and bind SQL statement
    $query = "UPDATE wards SET ward_name = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $wardName, $wardId);

    // Execute the statement
    if ($stmt->execute()) {
        // Success response
        $response = array('status' => 'success', 'message' => 'Ward details updated successfully');
    } else {
        // Error response
        $response = array('status' => 'error', 'message' => 'Error updating ward details: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    // Invalid request method
    $response = array("status" => false, "message" => "Invalid request method.");
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
