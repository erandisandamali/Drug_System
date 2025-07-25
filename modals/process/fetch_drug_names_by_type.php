<?php

if (isset($_GET['drugType'])) {
    // Sanitize and validate the input
    $drugType = intval($_GET['drugType']);

    // Database connection
    include_once "../config/db_connection.php";

    // Prepare the SQL statement
    $selectQuery = "SELECT d.id, dt.type, d.drug_name
                    FROM drugs d
                    INNER JOIN drug_types dt ON d.drug_type_id = dt.id
                    WHERE dt.id = ? AND d.deleted_at IS NULL";

    // Prepare the statement
    if ($stmt = $conn->prepare($selectQuery)) {
        // Bind the parameter
        $stmt->bind_param("i", $drugType);

        // Execute the statement
        if ($stmt->execute()) {
            // Get the result
            $result = $stmt->get_result();

            // Check if any rows were returned
            if ($result->num_rows > 0) {
                $drugs = array();
                // Fetch rows and store them in an array
                while ($row = $result->fetch_assoc()) {
                    $drugs[] = $row;
                }
            } else {
                // No drugs found
                $drugs[] = array("error" => "No records found");
            }

            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode($drugs);
        } else {
            die('Error executing query: ' . $stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        die('Error preparing statement: ' . $conn->error);
    }

    // Close the database connection
    $conn->close();
}
