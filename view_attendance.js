function fetchAttendance() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_attendancce.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            const attendanceList = document.getElementById('attendanceList');
            attendanceList.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

window.onload = fetchAttendance;