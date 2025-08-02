<?php
// database connection
include_once "../config/db_connection.php";

$selectQuery = "SELECT drugs.id, drugs.drug_type_id, drugs.srs_number, drugs.drug_name,  drug_types.type
FROM drugs
INNER JOIN drug_types ON drugs.drug_type_id = drug_types.id WHERE drugs.deleted_at IS NULL ORDER BY drugs.id ASC";

$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $drugs = array();
    while ($row = $result->fetch_assoc()) {
        $drugs[] = $row;
    }
    echo json_encode($drugs);
} else {
    // No drugs found
    echo json_encode(['error' => 'No drugs found']);
}

