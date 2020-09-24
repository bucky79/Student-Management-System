<?php
session_start();
include 'database.php';
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "inst")) {
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
        <h3>Student Registration Form</h3>
        <div class="form-group">
            <form method="POST">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" name="name">
                <br>
                <label for="usr">Email:</label>
                <input type="email" class="form-control" name="email">
                <br>
                <label for="usr">Address</label>
                <input type="textarea" class="form-control" name="address">
                <br>
                <label for="usr">DOB</label>
                <input type="date" name="date" id="usr">
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
                $c = $db->course();
                foreach ($c as $val => $val_v) {
                    ?>
                    ?>
                    <option value= <?php echo $val; ?>><?php echo $val_v; ?></option>
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
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="pwd">
        </div>

        <input type="submit" name="submit" value="submit">
        </form>
    </div>
    </body>
    </html>
    <?php
    if (isset($_POST["submit"])) {
        $cl = $db->manage();
        $username = $_POST["name"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $date = $_POST["date"];
        $gender = $_POST["optradio"];
        $course = $_POST["course"];
        $password = md5($_POST["pwd"]);
        try {

            $reg = $db->regstud(array($username, $email, $address, $date, $gender, $course, $password, $cl));
            if ($reg == 1) {
                echo "<script>alert('registration succesfull')</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('$e')</script>";
        }
    }
} else {
    header("location:../login.php");
}

?>
