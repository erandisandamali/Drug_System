<?php
// database connection
include_once "../config/db_connection.php";

$selectQuery = "SELECT id,type FROM drug_types";

$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $drugTypes = array();
    while ($row = $result->fetch_assoc()) {
        $drugTypes[] = $row;
    }
} else {
    // No wards found
    $drugTypes[] = array("error" => "No records found");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($drugTypes);
// Close the database connection
$conn->close();