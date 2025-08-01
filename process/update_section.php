<?php
// Include database connection
require_once "../config/db_connection.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if sectionId, wardId, and sectionName are set in the POST data
    if (isset($_POST["sectionId"]) && isset($_POST["wardId"]) && isset($_POST["sectionName"])) {
        // Sanitize the input data
        $sectionId = $_POST["sectionId"];
        $wardId = $_POST["wardId"];
        $sectionName = $_POST["sectionName"];

        // Prepare and bind the update statement
        $stmt = $conn->prepare("UPDATE sections SET ward_id=?, section_name=? WHERE id=?");
        $stmt->bind_param("iss", $wardId, $sectionName, $sectionId);

        // Execute the update statement
        if ($stmt->execute()) {
            // Update successful
            echo json_encode(array("status" => true, "message" => "Section updated successfully"));
        } else {
            // Update failed
            echo json_encode(array("status" => false, "message" => "Failed to update section"));
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        // If sectionId, wardId, or sectionName are not set in the POST data
        echo json_encode(array("status" => false, "message" => "Missing parameters"));
    }
} else {
    // If the request method is not POST
    echo json_encode(array("status" => false, "message" => "Invalid request method"));
}
?>
