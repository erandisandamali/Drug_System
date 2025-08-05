<?php
// Include your database connection
include_once "../config/db_connection.php";

// Fetch wards from the database
$query = "SELECT id, ward_name FROM wards WHERE deleted_at IS NULL";
// Execute the query
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch data from the result set and store it in an array
$wards = array();
while ($row = mysqli_fetch_assoc($result)) {
    $wards[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Set the appropriate header to indicate JSON content
header('Content-Type: application/json');

// Encode the data as JSON and output it
echo json_encode($wards);
?>
