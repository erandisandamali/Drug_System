<?php

include('../config/db_connection.php');

if (isset($_GET['id'])) {
    $wardId = $_GET['id'];

    $sql = "SELECT * FROM wards WHERE id = $wardId AND deleted_at IS NULL";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the result rows as an associative array
        $wardDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Return the drug details as JSON
        echo json_encode($wardDetails);
    } else {
        // If the query fails, return an error message
        echo json_encode(array("error" => "Failed to fetch ward details"));
    }
} else {
    echo json_encode(array("error" => "ward ID is required"));
}
