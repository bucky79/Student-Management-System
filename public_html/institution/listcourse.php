<?php
session_start();
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "inst")) {
    include '../base/database.php';
    $db = new databases();
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
        <h3>Course Details</h3>
        <br>
        Add New Course
        <form method="POST">
            <input type="text" name="course">
            <input type="submit" name="submit" value="Add">
        </form>
        <br><br><br>
        <div class="form-group">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Course name</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $s = 1;
                $course = $db->course();
                foreach ($course as $c_id => $c_name) {
                    ?>
                    <tr>
                        <td><?php echo $s; ?></td>
                        <td><?php echo $c_name ?></td>
                        <form method="POST">
                            <td><input type="submit" name="delete" value="Delete"/></td>
                            <td><input type="hidden" name="id" value="<?php echo $c_id; ?>"/></td>
                        </form>
                    </tr>
                    <?php
                    $s++;
                }
                ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
    </div>
    </body>
    </html>
    <?php
    if (isset($_POST["delete"])) {
        $id = $_POST["id"];
        try {
            $reg = $db->deletecourse($id);
            echo "<script>alert('Course Deleted');window.location.href='listcourse.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('$e');</script>";
        }
    }
    if (isset($_POST["submit"])) {
        $id = $_POST["course"];
        try {
            $reg = $db->addcourse($id);
            if ($reg == 1) {
                header("location:listcourse.php");
            }
        } catch (Exception $e) {
            echo "<script>alert('$e');</script>";
        }
    }
} else {
    header("location:../login.php");
}
?>
