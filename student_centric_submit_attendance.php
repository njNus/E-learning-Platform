<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-schoolproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studentId = $_POST['studentId'];
$username = $_POST['username'];
$date = $_POST['date'];

$email = $_POST['email'];

$sql = "INSERT INTO attendance_records (student_id, username, date,  email)
VALUES ('$studentId', '$username','$date', '$email')";

$response = array();

if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $conn->error;
}

echo json_encode($response);

$conn->close();
?>