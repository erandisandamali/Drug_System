<?php
// database connection
include_once "../config/db_connection.php";

// delete created drug
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "UPDATE created_list SET deleted_at = NOW() WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Drug deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete drug."]);
    }
}
