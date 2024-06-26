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
session_start();
$username = $_SESSION['username'];

// Prepare the SQL query to fetch attendance data
$sql = "SELECT username, attendance_date, status FROM attendance WHERE username = ?";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #80ace1, #94ecd9);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form_deg {
            background: linear-gradient(to right, #4A90E2, #50E3C2);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        .title_deg h1 {
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: linear-gradient(to right, #023d85, #01241c);
            color: white;
        }

        td {
            background: linear-gradient(to right, #80ace1, #c4eae1);
        }

        .present {
            color: green;
        }

        .absent {
            color: red;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form_deg">
        <center class="title_deg">
            <h1>Attendance Records</h1>
        </center>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Username</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php
            // Fetch and display the attendance data
            while ($row = $result->fetch_assoc()) {
                $statusClass = (strtolower($row['status']) === 'present') ? 'present' : 'absent';
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                echo '<td>' . htmlspecialchars($row['attendance_date']) . '</td>';
                echo '<td class="' . $statusClass . '">' . htmlspecialchars($row['status']) . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
<?php
// Close the statement
$stmt->close();

// Close the database connection
$conn->close();
?>


