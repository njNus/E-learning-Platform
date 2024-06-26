<?php
error_reporting(0);
session_start();
$host="localhost";
$user="root";
$password="";
$db="e-schoolproject";
$data=mysqli_connect($host,$user,$password,$db);

if($data===false){
    die("connection error");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['username'];
    $pass=$_POST['password'];
    $email=$_POST['email'];
    $sql="select * from users where username='".$name."' and password='".$pass."' and email='".$email."' ";
    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if($row["usertype"]=="student" ){
        
        $_SESSION['username']=$name;
        $_SESSION['email']=$email;
        $_SESSION['usertype']="student";

        header("location:studenthome.php");
    }
    elseif($row["usertype"]=="admin"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="admin";
        header("location:adminhome.php");
    }
    elseif($row["usertype"]=="teacher"){
        $_SESSION['username']=$name;
        $_SESSION['usertype']="teacher";
        header("location:teacherhome.php");
    }
   
    else{
        session_start();
        $message= "username, email or password didn't match";
        $_SESSION['loginMessage']=$message;
        header("location:login.php");
    }

}






?>