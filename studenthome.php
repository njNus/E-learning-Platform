<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        Student Dashboard
    </title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <?php
    include 'admin_css.php';
    ?>

</head>

<body>
    <?php
    include 'student_sidebar.php';
    ?>
    
    <div class="content">
    <h1>Student Dashboard</h1>
    </div>
</body>
</html>