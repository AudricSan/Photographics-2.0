<?php
if (!isset($_SESSION['logged'])) {
    header("location: /admin/login");
    die;
} else {
    $adminDAO = new AdminDAO;
    $adminConnected = $adminDAO->fetch($_SESSION['logged']);

    if (!$adminConnected) {
        session_unset();
        header("location: /");
        die;
    }
}

if (isset($_GET['user'])) {
    $adminDAO = new AdminDAO;
    $admin = $adminDAO->fetch($_GET['user']);
    $link = '/admin/edituser';
} else {
    $link = '/admin/adduser';
}

$roleDAO = new RoleDAO;
$roles = $roleDAO->fetchAll();

?>
<main class="admin">
    <?php if (isset($admin)) {
        echo "<h2>Edit User</h2>";
    } else {
        echo "<h2>Add User</h2>";
    }

    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        echo "
                <div class='error'>";

        foreach ($_SESSION['error'] as $key => $value) {
            echo "<p> Something Wrong : <span> $value </span></p>";
            unset($_SESSION['error']);
        }

        echo "</div>";
    }
    ?>

    <form method='POST' action=' <?php echo "$link" ?> ' enctype='multipart/form-data' target='_self'>
        <label for='name'>Name :</label>
        <input type='text' id='name' name='name' required value='<?php if (isset($admin)) {
                                                                        echo $admin->_name;
                                                                    } ?>'>

        <label for='mail'>Mail :</label>
        <input type='mail' id='mail' name='mail' required value='<?php if (isset($admin)) {
                                                                        echo $admin->_mail;
                                                                    } ?>'>

        <label for='pass'> <?php if (isset($admin)) {
                                echo "Confirm";
                            } ?> Password :</label>
        <i class='bi bi-eye-slash' id='togglePassword'></i>
        <input type='password' id='pass' name='pass' required>

        <div>
            <p>Select Tags : </p>
            <div>
                <?php
                foreach ($roles as $role) {
                    // var_dump($role);
                    // var_dump($admin->_role);

                    echo "
                        <label for='$role->_id'>$role->_name</label>
                        <input required type='radio' id='$role->_id' name='role' value='$role->_id'
                    ";

                    if (isset($admin)) {
                        if ($role->_id === $admin->_role) {
                            echo " checked >";
                        } else {
                            echo ">";
                        }
                    } else {
                        echo ">";
                    }
                }
                ?>
            </div>
        </div>
        <input required type='hidden' id='id' name='id' value='$admin->_id'>
        <input class='btn validate' type='submit' value='Submit'>
    </form>
</main>