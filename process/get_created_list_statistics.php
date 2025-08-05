<?php
// Include your database connection
include_once "../config/db_connection.php";

// Get filter parameters
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'day';

// Determine SQL query based on the filter
switch ($filter) {
    case 'month':
        $dateFormat = "%Y-%m";
        break;
    case 'year':
        $dateFormat = "%Y";
        break;
    default:
        $dateFormat = "%Y-%m-%d";
        break;
}

// Fetch the count of created drug details grouped by the specified filter
$sql = "SELECT DATE_FORMAT(created_at, '$dateFormat') AS date, COUNT(id) AS count
        FROM created_list
        GROUP BY date";
$result = $conn->query($sql);

// Process the fetched data
$dates = array();
$countPerDate = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date'];
        $countPerDate[] = (int)$row['count'];
    }
}

// Return data as JSON
echo json_encode(array("dates" => $dates, "countPerDate" => $countPerDate));

// Close connection
$conn->close();
