<?php
include('../config/db_connection.php');

// SQL query to fetch all patient details
$sql = "
    SELECT 
        p.id, 
        p.first_name, 
        p.last_name, 
        p.phn,
        p.bht_number,
        p.clinic_number,
        p.age, 
        w.ward_name, 
        o.first_name AS oncologist_first_name, 
        o.last_name AS oncologist_last_name, 
        s.section_name 
    FROM 
        patients p 
    INNER JOIN 
        wards w ON p.ward_id = w.id 
    LEFT JOIN 
        oncologists o ON p.oncologist_id = o.id 
    LEFT JOIN 
        sections s ON p.section_id = s.id 
    WHERE 
        p.deleted_at IS NULL 
    ORDER BY 
        p.id DESC";

$result = $conn->query($sql);

$patients = array();

if ($result->num_rows > 0) {
    // Fetch patient details and store them in an array
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}

// Close the connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($patients);
