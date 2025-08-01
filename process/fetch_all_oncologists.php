<?php
// Include your database connection
include_once "../config/db_connection.php";

// Fetch oncologists from the database
$query = "SELECT * FROM oncologists WHERE deleted_at IS NULL";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch data from the result set and store it in an array
$oncologists = array();
while ($row = mysqli_fetch_assoc($result)) {
    $oncologists[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Set the appropriate header to indicate JSON content
header('Content-Type: application/json');

// Encode the data as JSON and output it
echo json_encode($oncologists);
