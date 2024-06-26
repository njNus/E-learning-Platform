<?php
session_start();
error_reporting(0);
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
$sql="select * from course";
$result=mysqli_query($data,$sql);
if($_GET['course_id']){
    $c_id=$_GET['course_id'];
    $sql2="delete from course where id='$c_id'";
    $result2=mysqli_query($data,$sql2);
    if($result2){
        $_SESSION['message']='Deleting is Successful';
        header("location:admin_view_course.php");
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
    <?php
    include 'admin_css.php';
    ?>
     <style type="text/css">
    .table_th {
    padding: 10px;
    font-size: 16px; /* Slightly increased font size for better readability */
    margin-left: 9%;
    background: linear-gradient(to right, #023d85, #01241c);
    color: white;
    text-align: left;
    border-bottom: 2px solid #4A90E2;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table_td {
    padding: 10px;
    background: linear-gradient(to right, #b9cfea, #bff0e5);
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s;
}

.table_td:hover {
    background-color: #f1f1f1;
}
    </style>
</head>

<body>
<?php
 include 'admin_sidebar.php';
 ?>
    <div class="content">
       <h1>View Courses</h1>
       <table border="1px">
            <tr>
                <th class="table_th">Course ID</th>
                <th class="table_th">Course Name</th>
                <th class="table_th">Course Fee</th>
                <th class="table_th">Delete</th>
                
                
                
                
            </tr>
            <?php
            while($info=$result->fetch_assoc()){
                ?>

            <tr>
                <td class="table_td">
                <?php
                    echo "{$info['course_id']}"
                    ?></td>
                <td class="table_td">
                <?php
                    echo "{$info['name']}"
                    ?>
                </td>
                <td class="table_td">
                <?php
                    echo "{$info['fee']}"
                    ?></td>
                <td class="table_td"><?php
                    echo "<a onClick=\"javascript:return confirm('Are you sure to delete this? ');\" class='btn btn-danger' href='delete_course.php?course_id={$info['course_id']}'>Delete</a>";
                    ?></td>
                    
            </tr>
            <?php
            }
            ?>
       </table>
    </div>
</body>
</html>