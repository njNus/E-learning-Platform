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

$month = $_GET['month']; // Format: YYYY-MM

$sql = "SELECT student_id, username, DATE_FORMAT(date, '%Y-%m-%d') as date,  email 
        FROM attendance_records 
        WHERE DATE_FORMAT(date, '%Y-%m') = '$month'";
$result = $conn->query($sql);

$attendanceRecords = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $attendanceRecords[] = $row;
    }
}

echo json_encode($attendanceRecords);

$conn->close();
?>