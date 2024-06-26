<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="e-schoolproject";
$data=mysqli_connect($host,$user,$password,$db);
if($_GET['teacher_id']){
    $user_id=$_GET['teacher_id'];
    $sql="delete from users where id='$user_id'";
    $result=mysqli_query($data,$sql);
    if($result){
        $_SESSION['message']='Deleting is Successful';
        header("location:view_teacher.php");
    }
}



?>