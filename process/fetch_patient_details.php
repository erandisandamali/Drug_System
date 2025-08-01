<?php
// Include database connection code
include_once "../config/db_connection.php";

// Fetch patient details from the database based on the ID
$id = $_GET['id'] ?? null; // Assuming the ID is provided via GET parameter
if ($id === null || !is_numeric($id)) {
    // Invalid or missing ID
    echo json_encode(['error' => 'Invalid or missing patient ID']);
    exit;
}

// Perform SQL query to fetch patient details using $id
$getPatientQuery = "SELECT patients.*, wards.ward_name, sections.section_name, oncologists.first_name AS oncologist_first_name ,oncologists.last_name AS oncologist_last_name, oncologists.title AS oncologist_title FROM patients 
INNER JOIN wards ON patients.ward_id = wards.id 
INNER JOIN sections ON patients.section_id = sections.id 
INNER JOIN oncologists ON patients.oncologist_id = oncologists.id
WHERE patients.id = $id";

$result = $conn->query($getPatientQuery);

// Check if any patient was found
if ($result && $result->num_rows > 0) {
    // Fetch patient details
    $patient = $result->fetch_assoc();
    
    // Close the database connection
    $conn->close();
    
    // Return JSON response
    header('Content-Type: application/json');
    // Return the patient details as JSON
    echo json_encode($patient);
} else {
    // No patient found or error in query
    echo json_encode(['error' => 'No patient found with the given ID: ' . $id]);
}

