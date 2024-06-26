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

if(isset($_POST['add_course'])){
    $name=$_POST['name'];
    $course_id=$_POST['course_id'];
    $fee=$_POST['fee'];
    
    $sql="insert into course (name,course_id,fee) values('$name','$course_id','$fee')";
    $result=mysqli_query($data,$sql);


if($result){
   
    echo "<script type='text/javascript'>
alert('Data uploaded Successfully');
</script>";
header('location:admin_add_course.php');
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

<body>
<?php
 include 'admin_sidebar.php';
 ?>
    <div class="content">
        <br>
       <h1>Add course</h1>
       
       <div class="div_deg">
        <center>
            <form action="#" method="POST" >
                <div>
                    <label>Course ID</label>
                    <input type="text" name="course_id">
                </div>
                <div>
                    <label>Course Name</label>
                    <input type="text" name="name">
                </div>
                <div>
                    <label>Course Fee</label>
                    <input type="text" name="fee">
                </div>
                
                
                <br>
                <div>
                    <input type="submit" class="btn btn-primary" name="add_course" value="Add Course">
                </div>
            </form>
        </center>
       </div>
       
  
    
       
    </div>
</body>
</html>