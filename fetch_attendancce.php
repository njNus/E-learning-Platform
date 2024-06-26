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

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT a.attendance_date, s.StudentID, s.username, a.status FROM attendance a JOIN student s ON a.id = s.StudentID ORDER BY a.attendance_date DESC");

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Group the attendance records by date
$attendanceRecords = array();
while ($row = $result->fetch_assoc()) {
    $date = $row['attendance_date'];
    $userId = $row['StudentID'];
    $username = $row['username'];
    $status = $row['status'];

    if (!isset($attendanceRecords[$date])) {
        $attendanceRecords[$date] = array();
    }

    $attendanceRecords[$date][] = array(
        'userId' => $userId,
        'username' => $username,
        'status' => $status
    );
}

// Generate the HTML output
$output = '';
foreach ($attendanceRecords as $date => $records) {
    $output .= "<h2>Attendance for $date</h2>";
    $output .= "<table>
                 <tr>
                     <th>User ID</th>
                     <th>Username</th>
                     <th>Attendance Status</th>
                 </tr>";

    foreach ($records as $record) {
        $statusClass = (strcasecmp(trim($record['status']), 'Present') == 0) ? 'present' : 'absent';
        $output .= "<tr>
                     <td>" . $record['userId'] . "</td>
                     <td>" . $record['username'] . "</td>
                     <td><span class='$statusClass'>" . $record['status'] . "</span></td>
                   </tr>";
    }

    $output .= "</table>";
}

echo $output;

// Close the statement and connection
$stmt->close();
$conn->close();
?>