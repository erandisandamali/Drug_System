<?php

include('../config/db_connection.php');

// Check if the patient ID is provided in the GET request
if (isset($_GET['id'])) {
    $drugId = $_GET['id'];

    // Your SQL query to fetch drug details based on the patient ID
    $sql = "SELECT 
    drugs.*, 
    drug_types.type AS drug_type,
    drug_types.id AS drug_type_id
FROM 
    drugs
INNER JOIN 
    drug_types ON drugs.drug_type_id = drug_types.id
WHERE 
    drugs.id = $drugId";

    // Execute the query
    // Example using mysqli:
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the result rows as an associative array
        $drugDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Return the drug details as JSON
        echo json_encode($drugDetails);
    } else {
        // If the query fails, return an error message
        echo json_encode(array("error" => "Failed to fetch drug details"));
    }
} else {
    // If the patient ID is not provided in the request, return an error message
    echo json_encode(array("error" => "drug ID is required"));
}
