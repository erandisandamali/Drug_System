<?php
// Check if the patient id is provided
if (isset($_POST['id'])) {
    // Include your database connection file
    include_once("../config/db_connection.php");

    // Prepare the delete statement
    $stmt = $conn->prepare("UPDATE patients SET deleted_at = NOW() WHERE id = ?");

    // Bind the parameters
    $stmt->bind_param('i', $_POST['id']);

    // Execute the statement
    if ($stmt->execute()) {
        // Return success message
        echo json_encode(["success" => true, "message" => "Patient deleted successfully."]);
    } else {
        // Return error message
        echo json_encode(["success" => false, "message" => "Failed to delete patient."]);
    }

    // Close the statement
    $stmt->close();
    // Close the database connection
    $conn->close();
} else {
    // Return error message if patient id is not provided
    echo json_encode(["success" => false, "message" => "Patient id not provided."]);
}

