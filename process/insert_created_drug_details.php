<?php

// Include your database connection file
include_once("../config/db_connection.php");

// Get the raw POST data
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true); // Decode the JSON into a PHP associative array

if (json_last_error() === JSON_ERROR_NONE) {
    // Prepare the statement once
    $stmt = $conn->prepare("INSERT INTO created_list (patient_id, drug_id, solution_id, duration_id, route_id, strength, volume, location, dosage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Error preparing statement: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("iiiisssss", $patientID, $drugID, $solutionID, $daysID, $route, $strength, $volume, $location, $dosage);

    $errors = [];
    
    foreach ($input as $data) {
        // Sanitize inputs
        $patientID = filter_var($data['patientId'], FILTER_SANITIZE_NUMBER_INT);
        $route = filter_var($data['route'], FILTER_SANITIZE_STRING);
        $drugID = filter_var($data['drugName'], FILTER_SANITIZE_NUMBER_INT);
        $strength = filter_var($data['strength'], FILTER_SANITIZE_STRING);
        $solutionID = filter_var($data['solution'], FILTER_SANITIZE_NUMBER_INT);
        $volume = filter_var($data['volume'], FILTER_SANITIZE_STRING);
        $location = filter_var($data['location'], FILTER_SANITIZE_STRING);
        $daysID = filter_var($data['days'], FILTER_SANITIZE_NUMBER_INT);
        $dosage = filter_var($data['dosage'], FILTER_SANITIZE_STRING);

        // Execute the statement
        if (!$stmt->execute()) {
            $errors[] = ["data" => $data, "error" => $stmt->error];
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    if (empty($errors)) {
        echo json_encode(["status" => "success", "message" => "All records created successfully"]);
    } else {
        echo json_encode(["status" => "partial_success", "message" => "Some records could not be created", "errors" => $errors]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid JSON data"]);
}
?>
