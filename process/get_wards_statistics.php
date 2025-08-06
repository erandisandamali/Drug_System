<?php
// Include your database connection
include_once "../config/db_connection.php";

// Initialize variables
$response = [];

// Fetch ward names and patient counts from patients table
$sql = "SELECT wards.ward_name, COUNT(patients.id) AS patient_count
        FROM wards
        LEFT JOIN patients ON wards.id = patients.ward_id
        GROUP BY wards.id";
$result = $conn->query($sql);

// Process the fetched data
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'ward_name' => $row['ward_name'],
            'patient_count' => (int) $row['patient_count']
        ];
    }
} else {
    $response['error'] = "Error fetching data: " . $conn->error;
}

// Close connection
$conn->close();

// Output response as JSON
header('Content-Type: application/json');
echo json_encode($response);
