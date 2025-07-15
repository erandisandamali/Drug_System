<?php
// Include your database connection
include_once "../config/db_connection.php";

// Fetch sections from the database
$query = "SELECT sections.*, wards.ward_name
FROM sections
INNER JOIN wards ON sections.ward_id = wards.id WHERE sections.deleted_at IS NULL";

$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch data from the result set and store it in an array
$sections = array();
while ($row = mysqli_fetch_assoc($result)) {
    $sections[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Set the appropriate header to indicate JSON content
header('Content-Type: application/json');

// Encode the data as JSON and output it
echo json_encode($sections);
?>
