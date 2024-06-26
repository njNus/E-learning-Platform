<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");

}
elseif($_SESSION['usertype']=='teacher'){
    header("location:login.php");
}
$host="localhost";
$user="root";
$password="";
$db="e-schoolproject";
$data=mysqli_connect($host,$user,$password,$db);
if(isset($_POST['add_teacher'])){
    $username=$_POST['name'];
    $useremail=$_POST['email'];
    $userphone=$_POST['phone'];
    $userpass=$_POST['password'];
    $usertype="teacher";

    $check="select * from users where username = '$username'";
    $check_user=mysqli_query($data,$check);
    $row_count=mysqli_num_rows($check_user);
    
    if($row_count>=1){
        echo "<script type='text/javascript'>
        alert('Username already exists. Try another one.');
        </script>";
    }
    else{

    $sql="insert into users(username,email,phone,usertype,password) values('$username','$useremail','$userphone','$usertype','$userpass')";
    $result=mysqli_query($data,$sql);
    if($result){
        echo "<script type='text/javascript'>
    alert('Data uploaded Successfully');
    </script>";
    }
    else{
        echo "Upload failed";
    }
}
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        Admin Dashboard
    </title>
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
    <?php
    include 'admin_css.php';
    ?>
</head>

<body >
<?php
 include 'admin_sidebar.php';
 ?>
    <div class="content">
        
       <h1>Add Teacher</h1>
       <div class="div_deg">
        <center>
            <form action="#" method="POST">
                <div>
                    <label>Username</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Email</label>
                    <input type="text" name="email">
                </div>
                <div>
                    <label>Phone</label>
                    <input type="number" name="phone">
                </div>
                <div>
                    <label>Password</label>
                    <input type="text" name="password">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" name="add_teacher" value="Add Teacher">
                </div>
            </form>
        </center>
       </div>
       
    </div>
    
</body>
</html>