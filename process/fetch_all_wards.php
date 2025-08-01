<?php
// database connection
include_once "../config/db_connection.php";

$selectQuery = "SELECT * FROM wards WHERE deleted_at IS NULL";

$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $wards = array();
    while ($row = $result->fetch_assoc()) {
        $wards[] = $row;
    }
} else {
    // No wards found
    $wards[] = array("error" => "No records found");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($wards);
// Close the database connection
$conn->close();