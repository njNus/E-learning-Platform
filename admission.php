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
$sql="select * from admission";
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
</head>

<body>
 <?php
 include 'admin_sidebar.php';
 ?>
    <div class="content">
       
       <h1>Applied for Admission</h1>
       <br>
       <table border="1px">
        <tr>
            <th style="padding: 10px; font-size: 15px;">Name</th>
            <th style="padding: 10px; font-size: 15px;">E-mail</th>
            <th style="padding: 10px; font-size: 15px;">Phone</th>
            
        </tr>
        <?php
        while($info=$result->fetch_assoc()){
        ?>
        <tr>
            <td style="padding: 5px"> <?php echo "{$info['name']}"?></td>
            <td style="padding: 5px"><?php echo "{$info['email']}"?></td>
            <td style="padding: 5px"><?php echo "{$info['phone']}"?></td>
            
        </tr>
        <?php
        }
        ?>
       </table>
        
    </div>
</body>
</html>