<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");

}
elseif($_SESSION['usertype']=='student'){
    header("location:login.php");
}
$host="localhost";
$user="root";
$password="";
$db="e-schoolproject";
$data=mysqli_connect($host,$user,$password,$db);
$id=$_GET['student_id'];
$sql="select * from users where id='$id'";
$result=mysqli_query($data,$sql);
$info= $result->fetch_assoc();

if(isset($_POST['update'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
  
    $password=$_POST['password'];

    $query="update users set username='$name',email='$email',phone='$phone',password='$password' where id='$id'";
    $result2=mysqli_query($data,$query);
    if($result2){
        header("location:view_student.php");
    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
       Student Update Page
    </title>
    <?php
    include 'admin_css.php';
    ?>
    <style type="text/css">
        label{
            display: inline-block;
            width: 100px;
            text-align: right;
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .div_deg{
            background-color: beige;
            width: 400px;
            padding-bottom: 20px;
            padding-top: 20px;
        }
    </style>
</head>
<body>
<?php
 include 'admin_sidebar.php';
 ?>
    <div class="content">
       <h1>Update Student</h1>
       <br>
       <div class="div_deg">
        <form action="#" method ="POST">
            <center>
            <div>
                <label>Username</label>
                <input type="text" name="name" value="<?php echo "{$info['username']}"?>">
            </div>
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
            <div>
               
                <input class="btn btn-success" type="submit" name="update" value="Update">
            </div>
            </center>
        </form>
       </div>
    </div>
</body>
</html>