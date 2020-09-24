<?php
include '../base/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../assets/header.php';
?>
<body>
<?php
include '../assets/reg_inst_nav.php';
?>
<script src="../assets/jscript/validate.js"></script>
<div class="container">
    <h3>Institution Registration Form</h3>
    <div class="form-group">
        <form method="POST">
            <label for="usr">Institution Name:</label><span id="msg_name"></span>
            <input type="text" class="form-control" name="name" id="name" onfocusout="return(validate_institution());">
            <br>
            <label for="usr">Email:</label><span id="msg_email"></span>
            <input type="email" class="form-control" name="email" id="email">
            <br>
            <label for="usr">Address</label><span id="msg_address"></span>
            <input type="textarea" class="form-control" name="address" id="address"
                   onfocusout="return(validate_institution());">
            <br>
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label><span id="msg_password"></span>
        <input type="password" class="form-control" name="pwd" id="pwd" onkeyup="return(Validate_password());">
        <label for="pwd">Confirm Password:</label>
        <input type="password" class="form-control" name="cpwd" id="cpwd" onkeyup="return(Validate_password());">
    </div>
    <input type="submit" name="submit" id="submit" value="submit">
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    $username = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $password = $_POST["pwd"];
    $cpassword = $_POST["cpwd"];
    if ($username == "" || $email == "" || $address == "" || $password == "") {
        echo "<script>alert('Fields cant be EMPTY')</script>";
    } else {
        if ($password == $cpassword) {
            $password = md5($password);
            try {
                $db = new databases();
                $reg = $db->reginst(array($username, $email, $address, $password));
                echo "<script>alert('Registration Successfull');window.location.href='liststud.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('$e')</script>";
            }
        } else {
            echo "<script>alert('Password Mismatch')</script>";
        }
    }
}
?>

