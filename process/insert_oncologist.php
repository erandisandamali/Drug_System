<?php
// Include database connection
require_once "../config/db_connection.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if firstName, lastName, and title are set in the POST data
    if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["title"])) {
        // Sanitize the input data (assuming db_connection.php handles SQL injection prevention)
        $title = $_POST["title"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];

        // Prepare and bind the insert statement
        $stmt = $conn->prepare("INSERT INTO oncologists (first_name, last_name, title) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $firstName, $lastName, $title);

        // Execute the insert statement
        if ($stmt->execute()) {
            // Insert successful
            echo json_encode(array("status" => true, "message" => "Oncologist added successfully"));
        } else {
            // Insert failed
            echo json_encode(array("status" => false, "message" => "Failed to add oncologist"));
        }

        // Close statement
        $stmt->close();
    } else {
        // If firstName, lastName, or title are not set in the POST data
        echo json_encode(array("status" => false, "message" => "Missing parameters"));
    }
} else {
    // If the request method is not POST
    echo json_encode(array("status" => false, "message" => "Invalid request method"));
}

// Close connection
$conn->close();
?>
