<?php
// database connection
include_once "../config/db_connection.php";

$selectQuery = "SELECT id, type FROM `routes` WHERE deleted_at IS NULL";

$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $routes = array();
    while ($row = $result->fetch_assoc()) {
        $routes[] = $row;
    }
} else {
    // No wards found
    $routes[] = array("error" => "No records found");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($routes);
// Close the database connection
$conn->close();
