<?php
error_reporting(0);
session_start();
session_destroy();
if($_SESSION['message']){
    $message=$_SESSION['message'];
    echo "<script type='text/javascript'>
    alert('$message');
    </script>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>E-Learning Platform</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav>
            <label class="logo">SkillSailor</label>
            <ul class="deg">
                <li><a href="">Home</a></li>
                <li><a href="#footer">Contact</a></li>
                <li><a href="#end">Enrollment</a></li>
                <li><a href="login.php" class="btn btn-success">Login</a></li>
            </ul>
        </nav>
        <div class="section1">
            <label class="img_text">Through receiving directives, humankind picks up fresh insights</label>
            <img class="main_img" src="e-learning_app.jpg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="welcome_img" src="log.jpg">
                </div>
                <div class="col-md-8">
                    <h1>Welcome to E-School Platform!</h1>
                    <p>An electronic learning platform is an integrated set of interactive online services that provide trainers, learners, and others involved in education with information, tools, and resources to support and enhance education delivery and management.</p>
                </div>
            </div>
        </div>
        <center>
            <h1>Explore new doors with high-level learning</h1>
        </center>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img class="campus" src="ML.jpg">
                    <h3>Machine learning</h3>
                </div>

                <div class="col-md-4">
                    <img class="campus" src="AI.jpg">
                    <h3>Artificial Intelligence</h3>
                </div>

                <div class="col-md-4">
                    <img class="campus" src="cs.jfif">
                    <h3>Cybersecurity</h3>
                </div>
                <br><br>
                <div class="col-md-4">
                    <img class="campus" src="science.jpg">
                    <h3>Biotechnology</h3>
                </div>
                <div class="col-md-4">
                    <img class="campus" src="web.jpg">
                    <h3>Web Development</h3>
                </div>
                <div class="col-md-4">
                    <img class="campus" src="ux.jfif">
                    <h3>UX Design</h3>
                </div>
            </div>
        </div>

        <center>
            <h1 id="end" class="adm_">Enrollment</h1>
        </center>
        <div align="center" class="admission_form">
            <form action="data_check.php" method="POST">
                <div class="adm">
                    <label class="label_text">Name</label>
                    <input class="input_design" type="text" name="name">
                </div>
                <div class="adm">
                    <label class="label_text">Email</label>
                    <input class="input_design" type="text" name="email">
                </div>
                <div class="adm">
                    <label class="label_text">Phone</label>
                    <input class="input_design" type="text" name="phone">
                </div>
                
                <div class="adm_">
                    <input class="btn btn-primary" id="submit" type="submit" value="Entry" name="apply">
                </div>
            </form>
        </div>
        <footer>
            <h3 id="footer" class="footer_txt">All @copyright reserved by SkillSailor</h3>
            <h2 class="footer_txt">Contact Us</h2>

            <p class="footer_txt">
                For any queries or feedback, please feel free to reach out to us:
            </p>

            <div class="footer_txt">
                <p><strong>Email:</strong> jahansuchinjs@gmail.com</p>
                <p><strong>Phone:</strong> 01977717266</p>
                <p><strong>Address:</strong> Bangladesh</p>
            </div>
        </footer>
    </body>
</html>