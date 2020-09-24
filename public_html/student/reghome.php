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
include '../assets/reg_stud_nav.php';
?>
<script src="../assets/jscript/validate.js"></script>
<div class="container">
    <h3>Student Registration Form</h3>
    <div class="form-group">
        <form name="Student_Registration" method="POST">
            <label for="usr">Name:</label> <span id="msg_name"></span>
            <input type="text" class="form-control" name="name" id="name">
            <br>
            <label for="usr">Email:</label> <span id="msg_email"></span>
            <input type="email" class="form-control" name="email" id="email">
            <br>
            <label for="usr">Address</label> <span id="msg_address"></span>
            <input type="textarea" class="form-control" name="address" id="address">
            <br>
            <label for="usr">DOB</label> <span id="msg_date"></span>
            <input type="date" name="date" class = "form-control" id="date">
    </div>
    <div class="radio">
        <label><input type="radio" name="optradio" value="male" checked>Male</label>
        <label><input type="radio" name="optradio" value="female">Female</label>
    </div>
    Select Course
    <select name="course">
        <?php
        try {
            $db = new databases();
            $course = $db->course();
            foreach ($course as $c_id => $c_name) {
                ?>
                ?>
                <option value= <?php echo $c_id; ?>><?php echo $c_name; ?></option>
                <?php
            }
        } catch (Exception $e) {
            echo $e;
        }
        ?>
    </select>
    <br>
    <br>
    <div class="form-group">
        <label for="pwd">Password:</label> <span id="msg_password"></span>
        <input type="password" class="form-control" name="pwd" id="pwd" onkeyup="return(Validate_password());">
        <label for="pwd">Confirm Password:</label>
        <input type="password" class="form-control" name="cpwd" id="cpwd" onkeyup="return(Validate_password());">
    </div>
    <input type="submit" name="submit" id="submit" value="submit" onclick="return(Validate_password());">
    </form>
</div>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    $username = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $date = $_POST["date"];
    $gender = $_POST["optradio"];
    $course = $_POST["course"];
    $password = $_POST["pwd"];
    $cpassword = $_POST["cpwd"];
    if ($username == "" || $email == "" || $date == "" || $gender == "" || $course == "" || $password == "") {
        echo "<script>alert('Fields cant be EMPTY')</script>";
    } else {
        try {
            $reg = $db->regstud(array($username, $email, $address, $date, $gender, $course, $password));
            echo "<script>alert('registration succesfull');window.location.href='../login.php';</script>";
        } catch (Exception $e) {
            $message = $e->getmessage();
            echo "<script>alert('$message');</script>";
        }
    }
}
?>
