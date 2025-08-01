<?php
// Connect to database
include_once('../config/db_connection.php');

// Check if ID is provided
if(isset($_GET['id'])) {
    // Escape user inputs for security
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL query to fetch details of the selected item
    $sql = "SELECT 
    created_list.id, 
    patients.id AS patient_id,
    patients.phn,
    patients.clinic_number,
    patients.bht_number,
    patients.first_name AS patient_first_name,
    patients.last_name AS patient_last_name,
    patients.age AS age,
    patients.gender,
    patients.title AS patient_title,
    wards.ward_name, 
    sections.section_name,
    oncologists.title AS oncologist_title,
    oncologists.first_name AS oncologist_first_name,
    oncologists.last_name AS oncologist_last_name,
    drugs.drug_name, 
    drug_types.type,
    routes.type AS route,
    created_list.strength, 
    created_list.volume, 
    created_list.location, 
    created_list.dosage, 
    created_list.created_at, 
    solutions.solution,
    durations.type AS duration_type
FROM 
    created_list
INNER JOIN 
    patients ON created_list.patient_id = patients.id
INNER JOIN 
    drugs ON created_list.drug_id = drugs.id
INNER JOIN 
    drug_types ON drugs.drug_type_id = drug_types.id 
INNER JOIN 
    solutions ON created_list.solution_id = solutions.id
INNER JOIN 
    durations ON created_list.duration_id = durations.id
INNER JOIN 
    wards ON patients.ward_id = wards.id
    INNER JOIN
    sections on patients.section_id = sections.id
    INNER JOIN
    routes on created_list.route_id = routes.id
    INNER JOIN
    oncologists on patients.oncologist_id = oncologists.id
WHERE 
    created_list.deleted_at IS NULL 
    AND created_list.id = $id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }

    $data = array();

    // Check if record exists
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } else {
        $data[] = array("error" => "No records found");
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($data);
    
    // Close connection
    mysqli_close($conn);
} else {
    echo "Error: No ID provided.";
}

