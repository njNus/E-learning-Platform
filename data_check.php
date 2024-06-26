<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="e-schoolproject";
$data=mysqli_connect($host,$user,$password,$db);

if($data===false){
    die("connection error");
}
if(isset($_POST['apply'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
   

    $sql="insert into admission(name,email,phone) values('$name','$email','$phone')";
    $result=mysqli_query($data,$sql);
    if($result){
        $_SESSION['message']="Your Application is Successful";
        header("location:index.php");

    }
    else{
        echo "Apply Failed!";
    }

}
?>