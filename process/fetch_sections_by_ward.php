<?php
// Include your database connection
include_once "../config/db_connection.php";

// Check if ward_id parameter is set
if(isset($_GET['ward_id'])) {
    // Sanitize the input to prevent SQL injection
    $ward_id = mysqli_real_escape_string($conn, $_GET['ward_id']);

    // Fetch sections based on the selected ward
    $query = "SELECT * FROM sections WHERE ward_id = $ward_id";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if($result) {
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
    } else {
        // Query failed
        echo json_encode(array('error' => 'Query failed: ' . mysqli_error($conn)));
    }
} else {
    // ward_id parameter is not set
    echo json_encode(array('error' => 'Ward ID not provided'));
}

