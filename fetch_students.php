<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <style>
        input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 16px;
            height: 16px;
            border: 1px solid blue;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            vertical-align: middle;
            margin: 0 5px;
        }

        input[type="radio"]:checked {
            background-color: #2196F3;
            border-color: blue;
        }

        input[type="radio"]:hover {
            border-color: #999;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #80ace1, #94ecd9);
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            color: #333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        label {
            cursor: pointer;
            vertical-align: middle;
            margin-left: 5px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        td{
            background: linear-gradient(to right, #b9cfea, #bff0e5);
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background: linear-gradient(to right, #023d85, #01241c);
            border: 1px solid #dddddd;
            padding: 8px;
        }

        th {
            background-color: green;
            color: white;
        }

        button#saveAttendanceBtn {
            background: linear-gradient(to right, #023d85, #01241c);
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        button#saveAttendanceBtn:hover {
            background-color: #45a049;
        }

        label {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            margin-right: 10px;
        }

        input[type="date"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="date"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
        }
    </style>
</head>
<body>
    <h1>Student List</h1>

<div>
    <label for="attendance_date">Attendance Date:</label>
    <input type="date" id="attendance_date">
</div>

<table id="attendanceTable">
    <tr>
        <th>Student ID</th>
        <th>Username</th>
        <th>Attendance</th>
    </tr>
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

    // Fetch students from the users table
    $sql = "SELECT StudentID, username FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['StudentID'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>";
            echo "<input type='radio' id='present_" . $row['StudentID'] . "' name='attendance_" . $row['StudentID'] . "' value='present' >";
            echo "<label for='present_" . $row['StudentID'] . "'> Present</label>";
            echo "<input type='radio' id='absent_" . $row['StudentID'] . "' name='attendance_" . $row['StudentID'] . "' value='absent' checked>";
            echo "<label for='absent_" . $row['StudentID'] . "'> Absent</label>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No students found</td></tr>";
    }

    $conn->close();
    ?>
</table>

<button id="saveAttendanceBtn">Save Attendance</button>

<script>
document.getElementById('saveAttendanceBtn').addEventListener('click', function() {
    const attendanceDate = document.getElementById('attendance_date').value;
    const attendanceData = [];
    const rows = document.querySelectorAll('#attendanceTable tr');

    rows.forEach((row, index) => {
        if (index === 0) return; // Skip the header row

        const studentID = row.cells[0].innerText;
        const username = row.cells[1].innerText;
        const presentRadio = row.querySelector(`#present_${studentID}`);
        const absentRadio = row.querySelector(`#absent_${studentID}`);

        let status = '';
        if (presentRadio.checked) {
            status = 'present';
        } else if (absentRadio.checked) {
            status = 'absent';
        }

        if (status) {
            attendanceData.push({
                id: studentID,
                username: username,
                status: status,
                attendance_date: attendanceDate
            });
        }
    });

    // Send the collected data to the server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'mark_attendance.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            alert('Attendance saved successfully.');
        }
    };

    xhr.send(JSON.stringify(attendanceData));
});
</script>

</body>
</html>




