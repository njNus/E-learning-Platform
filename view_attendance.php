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

// Get the selected date from the query parameter
$attendance_date = $_GET['date'];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT s.StudentID s.username, a.status FROM students s LEFT JOIN attendance a ON s.StudentID = a.id AND a.attendance_date = ? ORDER BY s.StudentID");

// Bind parameters
$stmt->bind_param("s", $attendance_date);

// Execute the statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Generate the HTML output
$output = "<table>
             <tr>
                 <th>Username</th>
                 <th>Attendance Status</th>
             </tr>";

while ($row = $result->fetch_assoc()) {
    $output .= "<tr>
    <td>" . $row['username'] . "</td>
    <td class='" . (($row['status'] == 'present') ? 'status-present' : (($row['status'] == 'absent') ? 'status-absent' : '')) . "'>" . ($row['status'] ? $row['status'] : 'No Record') . "</td>
  </tr>";

}

$output .= "</table>";

echo $output;

// Close the statement and connection
$stmt->close();
$conn->close();
?>