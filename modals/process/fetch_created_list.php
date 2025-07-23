<?php
// Database connection
include_once('../config/db_connection.php');

// SQL query to fetch data
$sql = "SELECT created_list.id, 
patients.first_name,
patients.last_name,
patients.phn,
drugs.drug_name, 
created_list.strength, 
created_list.volume, 
created_list.location, 
created_list.dosage, 
created_list.created_at, 
solutions.solution, 
durations.type AS duration_type,
routes.type AS route
FROM created_list
INNER JOIN patients ON created_list.patient_id = patients.id
INNER JOIN drugs ON created_list.drug_id = drugs.id
INNER JOIN solutions ON created_list.solution_id = solutions.id
INNER JOIN durations ON created_list.duration_id = durations.id
INNER JOIN routes ON created_list.route_id = routes.id
WHERE created_list.deleted_at IS NULL AND patients.deleted_at IS NULL ORDER BY created_list.id DESC"; 

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($data);