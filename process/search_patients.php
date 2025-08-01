<?php
// Check if the search parameters are provided
if(isset($_POST['phn']) || isset($_POST['bht']) || isset($_POST['name'])) {
    // Sanitize and store the search parameters
    $phn = isset($_POST['phn']) ? trim($_POST['phn']) : '';
    $bht = isset($_POST['bht']) ? trim($_POST['bht']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';

    // Include your database connection code here
    require_once "../config/db_connection.php";

    // Query to fetch patient details by PHN number or BHT number or name

       // Build the query based on the provided parameters
       $getPatientsQuery = "SELECT * FROM patients WHERE 1=1"; // Start with a generic query

       if (!empty($phn)) {
           $getPatientsQuery .= " AND phn_number = '$phn'";
       }
       if (!empty($bht)) {
           $getPatientsQuery .= " AND bht_number = '$bht'";
       }
       if (!empty($name)) {
           $getPatientsQuery .= " AND patient_name LIKE '%$name%'";
       }

       $getPatientsQuery. " AND is_deleted = 0";

    $result = $conn->query($getPatientsQuery);

    // Check if any patients are found
    if ($result->num_rows > 0) {
        // Fetch patient details and add them to the array
        $patients = array();
        while ($row = $result->fetch_assoc()) {
            $patients[] = $row;
        }

        // Convert patient details to JSON format and send response
        echo json_encode($patients);
    } else {
        // No patients found
        echo json_encode(['error' => 'No patients found']);
    }

    // Close the database connection
    $conn->close();
}
?>