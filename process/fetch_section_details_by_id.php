<?php

include('../config/db_connection.php');

if (isset($_GET['id'])) {
    $sectionId = $_GET['id'];

    $sql = "SELECT * FROM sections WHERE id = $sectionId AND deleted_at IS NULL";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the result rows as an associative array
        $sectionDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Return the drug details as JSON
        echo json_encode($sectionDetails);
    } else {
        // If the query fails, return an error message
        echo json_encode(array("error" => "Failed to fetch section details"));
    }
} else {
    echo json_encode(array("error" => "section ID is required"));
}
