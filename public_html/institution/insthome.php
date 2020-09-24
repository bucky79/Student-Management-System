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
        <h3>Institution Details</h3>
        <br><br><br>
        <div class="form-group">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>Name</td>
                    <td><?php echo $det['management_username']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $det['email']; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $det['address']; ?></td>
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