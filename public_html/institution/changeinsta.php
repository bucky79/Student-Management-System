<?php
session_start();
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "inst")) {
    include '../base/database.php';
    try {
        $db = new databases();
        $det = $db->displayinst();
    } catch (Exception $e) {
        echo "<script>alert('$e')</script>";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    include '../assets/header.php';
    ?>
    <body>
    <?php
    include '../assets/inst_nav.php';
    ?>
    <div class="container">
        <div class="form-group">
            <form method="POST">
                <label for="usr">Old Password</label>
                <input type="password" class="form-control" name="old">
                <br>
                <label for="usr">New Password:</label>
                <input type="password" class="form-control" name="pass1">
                <br>
        </div>
        <br>
        <br>
        <input type="submit" name="submit" value="Update">
        </form>
    </div>
    </body>
    </html>
    <?php
    if (isset($_POST["submit"])) {
        $oldp = md5($_POST['old']);
        $pas = md5($_POST['pass1']);
        if ($oldp == $det['password']) {
            try {

                $pass = $db->passupdate($pas);
                if ($pass == 1) {
                    echo "<script>alert('Password updated succesfully');window.location.href='instahome.php';</script>";
                }
            } catch (Exception $e) {
                echo "<script>alert('$e');</script>";
            }
        } else {
            echo "<script>alert('Old Password Mismatch')</script>";
        }
    }
} else {
    header("location:../login.php");
}
?>