<?php
// Database connection details
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

// Get the raw POST data
$data = file_get_contents('php://input');
$attendances = json_decode($data, true);

if ($attendances) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO attendance (id, username, status, attendance_date) VALUES (?, ?, ?, ?)");

    foreach ($attendances as $attendance) {
        // Bind parameters
        $stmt->bind_param("isss", $attendance['id'], $attendance['username'], $attendance['status'], $attendance['attendance_date']);
        
        // Execute the statement
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
            exit;
        }
    }
    echo "Attendance marked successfully.";
} else {
    echo "No attendance data received.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
