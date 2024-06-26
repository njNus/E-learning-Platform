<?php
session_start();

// Assuming the session variables are set like this
// $_SESSION['username'] = 'john_doe';
// $_SESSION['email'] = 'john@example.com';

// Check if the session variables are set and return them as a JSON response
if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $response = array(
        'username' => $_SESSION['username'],
        'email' => $_SESSION['email']
    );
    echo json_encode($response);
} else {
    // Return an error if the session variables are not set
    $response = array('error' => 'Session data not found');
    echo json_encode($response);
}
?>
