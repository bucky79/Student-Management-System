<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'assets/header.php';
?>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.php">Student Management System</a>
        </div>
        <ul class="nav navbar-nav">
            <?php
            if ($_SESSION["id"] == session_id()) {
                if ($_SESSION['type'] == "student") {
                    ?>
                    <li class="active"><a href="#"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="student/studenthome.php">Dashboard</a></li>
                    <li><a href="logout.php">Log out</a></li>
                    <?php
                } else if ($_SESSION['type'] == "inst") {
                    ?>
                    <li class="active"><a href="#"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a href="institution/insthome.php">Dashboard</a></li>
                    <li><a href="logout.php">Log out</a></li>
                    <?php
                }
            } else {
                ?>
                <li><a href="login.php">Log in</a></li>
                <li><a href="student/reghome.php">Sign up</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
<div class="container">
    <h3>Welcome to Student Management System</h3>
</div>
</body>
</html>
