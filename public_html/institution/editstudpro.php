<?php
session_start();
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "inst")) {
    $logid = $_POST['id'];
    include '../base/database.php';
    try {
        $db = new databases();
        $det = $db->displaypro($logid);
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
    <script src="../assets/jscript/validate.js"></script>
    <?php
    include '../assets/inst_nav.php';
    ?>
    <div class="container">
        <h3>Institution Details</h3>
        <br><br><br>
        <div class="form-group">
            <form method="POST">
                <label for="usr">Name:</label> <span id="msg_name"></span>
                <input type="text" class="form-control" name="name" id="name"
                       value= <?php echo $det['username']; ?> onfocusout = "return(validate());">
                <br>
                <label for="usr">Email:</label> <span id="msg_email"></span>
                <input type="email" class="form-control" name="email" id="email"
                       value= <?php echo $det['email']; ?> onfocusout = "return(validate());">
                <br>
                <label for="usr">Address</label> <span id="msg_address"></span>
                <input type="textarea" class="form-control" name="address" id="address"
                       value= <?php echo $det['address']; ?> onfocusout = "return(validate());">
                <br>
                <label for="usr">DOB</label>
                <input type="date" name="date" id="date" value= <?php echo $det['dob']; ?> onfocusout = "
                return(validate());"><span id="msg_date"></span>
                <input type="hidden" name="id" value="<?php echo $logid; ?>"/>
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
        Select Course
        <select name="course">
            <?php
            $course = $db->coursed($det['courseid']);
            foreach ($course as $courseid => $coursename) {
                ?>
                ?>
                <option value= <?php echo $courseid; ?>><?php echo $coursename; ?></option>
                <?php
            }
            ?>
        </select>
        <br>
        <br>
        <br>
        <input type="submit" name="submit" id="submit" value="submit" onclick="return(Validate_password());">
        </form>
    </div>
    <br>
    <br>
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
        $logid = $_POST["id"];
        try {
            $reg = $db->editprostud(array($username, $email, $address, $date, $gender, $course, $logid));
            if ($reg == 1) {
                echo "<script>alert('updated succesfully');window.location.href='editstudpro.php';</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('$e')</script>";
        }
    }
} else {
    header("location:../login.php");
}
?>
