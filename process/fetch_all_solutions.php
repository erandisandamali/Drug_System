<?php
// database connection
include_once "../config/db_connection.php";

$selectQuery = "SELECT id, solution FROM `solutions` WHERE deleted_at IS NULL";

$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $solutions = array();
    while ($row = $result->fetch_assoc()) {
        $solutions[] = $row;
    }
} else {
    // No wards found
    $solutions[] = array("error" => "No records found");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($solutions);
// Close the database connection
$conn->close();
