<?php
include_once("../config/db_connection.php");
// Check if the id is provided
if (isset($_POST['id'])) {
    // Include your database connection file

    // Prepare the delete statement
    $stmt = $conn->prepare("UPDATE sections SET deleted_at = NOW() WHERE id = ?");

    // Bind the parameters
    $stmt->bind_param('i', $_POST['id']);

    // Execute the statement
    if ($stmt->execute()) {
        // Return success message
        echo json_encode(["success" => true, "message" => "section deleted successfully."]);
    } else {
        // Return error message
        echo json_encode(["success" => false, "message" => "Failed to delete section."]);
    }

    // Close the statement
    $stmt->close();
    // Close the database connection
    $conn->close();
} else {
    // Return error message if id is not provided
    echo json_encode(["success" => false, "message" => "section id not provided."]);
}

