<?php
session_start();
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "student")) {
    include '../base/database.php';
    try {

        $db = new databases();
        $det = $db->display();
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
    include '../assets/stud_nav.php';
    ?>
    <div class="container">
        <h3>Student Details</h3>
        <br><br><br>
        <div class="form-group">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>Name</td>
                    <td><?php echo $det['username']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $det['email']; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $det['address']; ?></td>
                </tr>
                <tr>
                    <td>Date-Of-Birth</td>
                    <td><?php echo $det['dob']; ?></td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td><?php echo $det['course_name']; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
    </div>
    </body>
    </html>
    <?php
} else {
    header("location:../login.php");
}
?>