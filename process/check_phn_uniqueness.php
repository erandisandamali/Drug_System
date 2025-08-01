<?php
// Include your database connection code here
require_once "../config/db_connection.php";


// Check if the POST request contains the 'phn_number' parameter
if(isset($_POST['phn'])) {
    // Get PHN number from the request
    $phn = $_POST['phn'];

    // Prepare SQL statement to check if PHN number exists using a prepared statement
    $sql = "SELECT * FROM patients WHERE phn = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $phn);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // PHN number already exists
        echo "exists";
    } else {
        // PHN number is unique
        echo "unique";
    }

    // Close statement
    $stmt->close();
} else {
    // If 'phn_number' parameter is not provided in the POST request, return an error message
    echo "Error: 'phn' parameter is missing in the POST request.";
}

// Close connection
$conn->close();
?>
