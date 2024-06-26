<?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo json_encode(array('error' => 'Invalid request method'));
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];
$otp = $data['otp'];
$time = date('Y-m-d H:i:s');

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

$sql = "SELECT * FROM otp_records WHERE email='$email' AND otp='$otp' AND expiry_time > '$time'";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM otp_records WHERE email='$email' AND otp='$otp'";
$result2 = $conn->query($sql2);

$response = array();

if($result->num_rows > 0){
    $response['success'] = true;
    $sql = "DELETE FROM otp_records WHERE email='$email'";
    $conn->query($sql);
} else {
    $response['success'] = false;
}

if($result2->num_rows > 0){
    $sql = "DELETE FROM otp_records WHERE email='$email'";
    $conn->query($sql);
}


echo json_encode($response);

$conn->close();

?>