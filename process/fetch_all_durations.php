<?php
// database connection
include_once "../config/db_connection.php";

$selectQuery = "SELECT id, type FROM `durations` WHERE deleted_at IS NULL";

$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $durations = array();
    while ($row = $result->fetch_assoc()) {
        $durations[] = $row;
    }
} else {
    // No wards found
    $durations[] = array("error" => "No records found");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($durations);
// Close the database connection
$conn->close();
