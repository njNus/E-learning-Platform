<?php
error_reporting(0);
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
$sql="select * from users where usertype='student'";
$result=mysqli_query($data,$sql);



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
 include 'admin_view_student_sidebar.php';
 ?>
    <div class="content">
        
       <h1>Student Data</h1><br>
       <?php
       if($_SESSION['message']){
        echo $_SESSION['message'];
       }
       unset($_SESSION['message']);
       ?>
    
       <table border="1px">
            <tr>
                <th class="table_th">UserName</th>
                <th class="table_th">Email</th>
                <th class="table_th">Phone</th>
                <th class="table_th">Password</th>
                <th class="table_th">Delete</th>
                <th class="table_th">Update</th>
            </tr>
            <?php
            while($info=$result->fetch_assoc()){
                
            
            ?>
            <tr>
                <td class="table_td">
                    <?php
                    echo "{$info['username']}"
                    ?>
                </td>
                <td class="table_td"><?php
                    echo "{$info['email']}";
                    ?></td>
                <td class="table_td"><?php
                    echo "{$info['phone']}";
                    ?></td>
                <td class="table_td"><?php
                    echo "{$info['password']}";
                    ?></td>
                <td class="table_td"><?php
                    echo "<a onClick=\"javascript:return confirm('Are you sure to delete this? ');\" class='btn btn-danger' href='delete.php?student_id={$info['id']}'>Delete</a>";
                    ?></td>

                <td class="table_td"><?php
                    echo "<a class='btn btn-primary' href='update_student.php?student_id={$info['id']}'>Update</a>";
                    ?></td>
            </tr>
            <?php
            }
            ?>
       </table>
        
    </div>
</body>
</html>