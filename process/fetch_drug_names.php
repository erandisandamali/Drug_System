<?php
// database connection
include_once "../config/db_connection.php";

$selectQuery = "SELECT drugs.id, drugs.drug_name,  drug_types.type
FROM drugs
INNER JOIN drug_types ON drugs.type_id = drug_types.id WHERE drugs.deleted_at IS NULL;";

$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $drugNames = array();
    while ($row = $result->fetch_assoc()) {
        $drugNames[] = $row;
    }
} else {
    // No wards found
    $drugNames[] = array("error" => "No records found");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($drugNames);
// Close the database connection
$conn->close();
