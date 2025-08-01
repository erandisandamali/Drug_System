<?php


// get total number of patients
$query = "SELECT COUNT(*) AS total_patients FROM patients WHERE deleted_at IS NULL";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$total_patients = $row['total_patients'];

// get tota number of wards
$query = "SELECT COUNT(*) AS total_drugs FROM drugs WHERE deleted_at IS NULL";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$total_drugs = $row['total_drugs'];

//get total number of created
$query = "SELECT COUNT(*) AS total_created FROM created_list WHERE deleted_at IS NULL";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$total_created = $row['total_created'];

//get total number of today created
$query = "SELECT COUNT(*) AS total_today_created FROM created_list WHERE DATE(created_at) = CURDATE() AND deleted_at IS NULL";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$total_today_created = $row['total_today_created'];



?>