<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="../index.php">Student Management System</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#"><?php echo $_SESSION['username']; ?></a></li>
            <li><a href="../student/editprostud.php">Edit Profile</a></li>
            <li><a href="../student/changestud.php">Change Password</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</nav>