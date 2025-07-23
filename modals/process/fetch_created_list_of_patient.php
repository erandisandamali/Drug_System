<?php

// Get the patient ID from the AJAX request
$id = $_GET['id'];

// Include the database connection file
require_once "../config/db_connection.php";

// Query to fetch created details by patient ID
$getCreatedListQuery = "SELECT created_list.id, 
patients.id AS patientId,
drugs.drug_name, 
drugs.drug_type_id,  
drug_types.type AS drug_type,
routes.type AS route,
created_list.strength, 
created_list.volume, 
created_list.location, 
created_list.dosage, 
created_list.created_at,
solutions.solution, 
durations.type AS duration_type
FROM created_list
INNER JOIN patients ON created_list.patient_id = patients.id
INNER JOIN drugs ON created_list.drug_id = drugs.id
INNER JOIN drug_types ON drugs.drug_type_id = drug_types.id  
INNER JOIN solutions ON created_list.solution_id = solutions.id
INNER JOIN durations ON created_list.duration_id = durations.id
INNER JOIN routes ON created_list.route_id = routes.id
WHERE created_list.patient_id = $id AND created_list.deleted_at IS NULL 
ORDER BY created_list.id DESC";

// Execute the query
$result = $conn->query($getCreatedListQuery);

$createListOfPerson = array();

// Check if the query executed successfully
if ($result) {
    // Check if any drugs are found
    if ($result->num_rows > 0) {
        // Fetch drug details and add them to the array
        while ($row = $result->fetch_assoc()) {
            $createListOfPerson[] = $row;
        }
        // Add status and message indicating success
        $createListOfPerson['status'] = true;
        $createListOfPerson['message'] = "Drug details found for patient with ID: $id";
    } else {
        // No drugs found
        $createListOfPerson['status'] = false;
        $createListOfPerson['message'] = "No drug details found for patient with ID: $id";
    }
} else {
    // Error in query execution
    $createListOfPerson['status'] = false;
    $createListOfPerson['error'] = "Error executing query: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($createListOfPerson);

// Close the database connection
$conn->close();
