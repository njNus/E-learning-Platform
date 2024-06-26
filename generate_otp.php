<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$msg="";

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo json_encode(array('error' => 'Invalid request method'));
    exit();
}

function generateOTP() {
    $length = 6;
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}

function sendOTPEmail($email, $otp) { 
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mmalam1063@gmail.com';   
        $mail->Password   = 'fmga xjzt tgnx mqai';
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('nusrotjahan99760@gmail.com', 'now');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP code is <b>$otp</b>";

        $mail->send();
        return 'OTP has been sent';
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$otp = generateOTP();
$msg = sendOTPEmail($_POST['email'], $otp);
if($msg=='OTP has been sent'){
    $expiry_time = date('Y-m-d H:i:s', strtotime('+5 minutes'));

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

    $email = $_POST['email'];

    $sql = "INSERT INTO otp_records (email, otp, expiry_time)
    VALUES ('$email', '$otp', '$expiry_time')";

    $response = array();

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error'] = $conn->error;
    }

    $conn->close();

    echo json_encode(array('Mailer message: ' => $msg, 'Response: ' => $response));
} else {
    echo json_encode(array('Mailer message: ' => $msg));
}
?>