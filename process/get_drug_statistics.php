<?php
// Include your database connection
include_once "../config/db_connection.php";

// Fetch drug types and drug counts from the database
$sql = "SELECT drug_types.type AS drug_type, COUNT(drugs.id) AS drug_count
        FROM drug_types
        LEFT JOIN drugs ON drug_types.id = drugs.drug_type_id
        GROUP BY drug_types.id";
$result = $conn->query($sql);

// Process the fetched data
$drugTypeLabels = array();
$drugCounts = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $drugTypeLabels[] = $row['drug_type'];
        $drugCounts[] = (int)$row['drug_count'];
    }
}

// Return data as JSON
echo json_encode(array("drugTypeLabels" => $drugTypeLabels, "drugCounts" => $drugCounts));

// Close connection
$conn->close();
?>
