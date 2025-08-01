<?php

    // Get the PHN number from the AJAX request
    $phn = $_GET['phn'];

    // Include your database connection code here
    require_once "../config/db_connection.php"; // Adjust the file path as per your setup

    // Query to fetch created details by PHN number
    $getCreatedListQuery = "SELECT created_list.id, patients.name AS patient_name, patients.bht_number, patients.phn_number, drugs.drug_name, created_list.stregnth, created_list.solution, created_list.volume, created_list.location, created_list.days, created_list.dosage, created_list.created_at, created_list.is_deleted FROM created_list INNER JOIN patients ON created_list.patient_id = patients.id INNER JOIN drugs ON created_list.drug_id = drugs.id WHERE patients.phn_number = '$phn' AND created_list.is_deleted = 0;
    ";
    

    $result = $conn->query($getCreatedListQuery);
    $createList = array();

    // Check if any patients are found
    if ($result->num_rows > 0) {
        // Fetch patient details and add them to the array 
        while ($row = $result->fetch_assoc()) {
            $createList[] = $row;
        }

        // Convert patient details to JSON format and send response
        echo json_encode($createList);
    } else {
        // No patients found
        echo json_encode(['error' => 'No patients found']);
    }

    // Close the database connection
    $conn->close();

?>