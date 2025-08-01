<?php
// Include database connection
require_once "../config/db_connection.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if oncologistId, firstName, lastName, and title are set in the POST data
    if (isset($_POST["oncologistId"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["title"])) {
        // Sanitize the input data (consider using mysqli_real_escape_string or prepared statements)
        $oncologistId = $_POST["oncologistId"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $title = $_POST["title"];

        // Prepare and bind the update statement
        $stmt = $conn->prepare("UPDATE oncologists SET first_name=?, last_name=?, title=? WHERE id=?");
        $stmt->bind_param("sssi", $firstName, $lastName, $title, $oncologistId);

        // Execute the update statement
        if ($stmt->execute()) {
            // Update successful
            echo json_encode(array("status" => true, "message" => "Oncologist updated successfully"));
        } else {
            // Update failed
            echo json_encode(array("status" => false, "message" => "Failed to update oncologist"));
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // If oncologistId, firstName, lastName, or title are not set in the POST data
        echo json_encode(array("status" => false, "message" => "Missing parameters"));
    }
} else {
    // If the request method is not POST
    echo json_encode(array("status" => false, "message" => "Invalid request method"));
}
?>
