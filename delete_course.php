<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="e-schoolproject";
$data=mysqli_connect($host,$user,$password,$db);
if($_GET['course_id']){
    $user_id=$_GET['course_id'];
    $sql="delete from course where course_id='$user_id'";
    $result=mysqli_query($data,$sql);
    if($result){
        $_SESSION['message']='Deleting is Successful';
        header("location:admin_view_course.php");
    }
}



?>