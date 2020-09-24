<?php
session_start();
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "student")) {
    include '../base/database.php';
    $db = new databases();
    $det = $db->display();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    include '../assets/header.php';
    ?>
    <body>
    <script src="../assets/jscript/validate.js"></script>
    <?php
    include '../assets/stud_nav.php';
    ?>
    <div class="container">
        <div class="form-group">
            <form method="POST">
                <label for="usr">Name:</label><span id="msg_name"></span>
                <input type="text" class="form-control" name="name" id="name"
                       value= <?php echo $det['username']; ?> onfocusout = "return(validate());">
                <br>
                <label for="usr">Email:</label><span id="msg_email"></span>
                <input type="email" class="form-control" name="email" id="email"
                       value= <?php echo $det['email']; ?> onfocusout = "return(validate());">
                <br>
                <label for="usr">Address</label><span id="msg_address"></span>
                <input type="textarea" class="form-control" name="address" id="address"
                       value= <?php echo $det['address']; ?> onfocusout = "return(validate());">
                <br>
                <label for="usr">DOB</label><span id="msg_date"></span>
                <input type="date" name="date" id="date" value= <?php echo $det['dob']; ?> onfocusout = "
                return(validate());">
        </div>
        <div class="radio">
            <label><input type="radio" name="optradio" value="male" <?php if ($det['gender'] == "male") {
                    echo "checked";
                } ?>>Male</label>
            <label><input type="radio" name="optradio" value="female" <?php if ($det['gender'] == "female") {
                    echo "checked";
                } ?>>Female</label>
        </div>
        <br>
        <br>
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
        $date = $_POST["date"];
        $gender = $_POST["optradio"];
        try {
            $reg = $db->editstud(array($username, $email, $address, $date, $gender));
            if ($reg == 1) {
                echo "<script>alert('updated succesfully');window.location.href='studenthome.php';</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('$e');</script>";
        }
    }
} else {
    header("location:../login.php");
}
?>