<?php
session_start();
if (($_SESSION["id"] == session_id()) && ($_SESSION['type'] == "inst")) {
    include '../base/database.php';
    try {
        $db = new databases();
        $det = $db->displaystud();
    } catch (Exception $e) {
        echo $e;
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
        <br>
        <a href="add.php">
            <button name="add">ADD NEW STUDENT</button>
        </a>
        <br><br><br>
        <div class="form-group">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $c = 1;
                    foreach ($det as $val => $val_i)
                    {
                    ?>
                        <td><?php echo $c; ?></td>
                        <td><?php echo $val_i ?></td>
                        <td><form action="editstudpro.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $val;?>"/>
                        <input type="submit" name="edit" value="View"/>
                    </form></td>
                    <td>
                 <form method="POST">
                    <input type="submit" name="action" value="Delete"/>
                    <input type="hidden" name="id" value="<?php echo $val; ?>"/>
                </form>
                </td>
                </tr>
                <?php
                $c++;
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
    if (isset($_POST['action'])) {
        $id = $_POST['id'];
        try {
            $det = $db->deletestud($id);
        } catch (Exception $e) {
            echo "<script>alert('$e');</script>";
        }
    }
} else {
    header("location:../login.php");
}
?>
