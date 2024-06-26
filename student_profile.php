<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
}
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");
}


$host="localhost";
$user="root";
$password="";
$db="e-schoolproject";
$data=mysqli_connect($host,$user,$password,$db);
$name=$_SESSION['username'];
$sql="select * from users where username='$name'";
$result=mysqli_query($data,$sql);
$info=mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
   
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=$_POST['password'];

    $query="update users set email='$email',phone='$phone',password='$password' where username='$name'";
    $result2=mysqli_query($data,$query);
    if($result2){
        header("location:student_profile.php");
    }

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
    <style type="text/css">
       label {
    display: inline-block;
    text-align: right;
    width: 120px; /* Slightly increased width for better alignment */
    margin-right: 10px;
    font-weight: bold;
    color: black; /* A vibrant blue color */
}

.div_deg {
    background: linear-gradient(135deg, #f6d365 0%, #4A90E2 100%); /* Gradient background */
    width: 400px;
    padding: 40px 20px; /* Unified padding for better aesthetics */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    text-align: center; /* Centered text alignment */
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for hover effect */
}

.div_deg:hover {
    transform: translateY(-5px); /* Slight lift effect on hover */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

    </style>

</head>

<body>
    <?php
    include 'student_sidebar.php';
    ?>
    <div class="content">
    <h1>Update Profile</h1>
    <br>
   
        <form action="#" method ="POST">
            <div class="div_deg">
            
            <div>
                <label>Email</label>
                <input type="text" name="email" value="<?php echo "{$info['email']}"?>">
            </div>
            <div>
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo "{$info['phone']}"?>">
            </div>
            <div>
                <label>Password</label>
                <input type="text" name="password" value="<?php echo "{$info['password']}"?>">
            </div>

            <br>
            <div>
                
                <input type="submit" class="btn btn-success" name="update" value="Update">
            </div>
            </div>
           
        </form>
    
    </div>