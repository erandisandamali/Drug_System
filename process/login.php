<?php
// Database connection
include_once('../config/db_connection.php');

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if user exists in database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'AND deleted_at IS NULL LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Login successful
        $response = array(
            "success" => true,
            "message" => "Login successful"
        );
        echo json_encode($response);
        // set username in session
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $result->fetch_assoc()['role'];

        //update the last login time
        $updateQuery = "UPDATE users SET last_login = NOW() WHERE username = '$username'";
        $conn->query($updateQuery);
    } else {
        // Login failed
        $response = array(
            "success" => false,
            "message" => "Invalid username or password!"
        );
        echo json_encode($response);
    }
}

$conn->close();
