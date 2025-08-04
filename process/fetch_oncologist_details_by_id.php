<?php
include('../config/db_connection.php');

if (isset($_GET['id'])) {
    $oncologistId = $_GET['id'];

    $sql = "SELECT * FROM oncologists WHERE id = $oncologistId AND deleted_at IS NULL";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the result rows as an associative array
        $oncologistDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo json_encode($oncologistDetails);
    } else {
        // If the query fails, return an error message
        echo json_encode(array("error" => "Failed to fetch oncologist details"));
    }
} else {
    echo json_encode(array("error" => "oncologist ID is required"));
}
