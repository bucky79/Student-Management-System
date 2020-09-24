<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'assets/header.php';
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "inst"))
{
    header("location:institution/insthome.php");
}
else if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "student"))
{
    header("location:student/studenthome.php");
}
else
{
?>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Student Management System</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="student/reghome.php">Sign Up</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <form method="POST">
        Enter Your Username
        <input type="email" name="username">
        <br>
        <br>
        Enter your password
        <input type="password" name="password">
        <br>
        <br>
        <input type="submit" name="submit" value="submit">
    </form>
</div>
</body>
</html>
<?php
include 'base/database.php';
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if ($password == "" || $username == "") {
        echo "<script>alert('Password and username Cant be empty')</script>";
    } else {
        $password = md5($password);
        $db = new databases();
        try {
            $log = $db->login($username, $password);
            if ($log == 1) {
                header("location:student/studenthome.php");
            } else if ($log == 3) {
                header("location:institution/insthome.php");

            }
        } catch (Exception $e) {
            $message = $e->getmessage();
            echo "<script>alert('$message');</script>";
        }
    }
}
}
?>
