<?php

// if (!isset($_SESSION['logged'])) {
//     header("location: /admin/login");
//     die;

// } else {
//     $adminDAO = new AdminDAO;
//     $adminConnected = $adminDAO->fetch($_SESSION['logged']);

//     if (!$adminConnected) {
//         session_unset();
//         header("location: /");
//         die;
//     }
// }

if (isset($id)) {
    $adminDAO = new AdminDAO;
    $admin = $adminDAO->fetch($id);
    $link = '/admin/add/edit';
} else {
    $link = '/admin/add/new';
}

$roleDAO = new RoleDAO;
$roles = $roleDAO->fetchAll();

?>
<main>
    <div class='add'>

        <h2>Add Poeple</h2>

        <?php
        // var_dump($_SESSION);

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

        <form method='POST' action=' <?php echo"$link" ?> ' enctype='multipart/form-data' target='_self'>
            <label for='name'>Name :</label>
            <input type='text' id='name' name='name' required>

            <label for='mail'>Mail :</label>
            <input type='mail' id='mail' name='mail' required>

            <label for='pass'>Password :</label>
            <i class='bi bi-eye-slash' id='togglePassword'></i>
            <input type='password' id='pass' name='pass' required>

            <div>
                <p>Select Tags : </p>
                <div>
                    <?php
                    foreach ($roles as $role) {
                        echo "
                        <label for='$role->_id'>$role->_name</label>
                        <input required type='radio' id='$role->_id' name='role' value='$role->_id'";

                        if ($role->_id = $admin->_role) {
                            echo "checked >";
                        } else {
                            echo ">";
                        }
                    }
                    ?>
                </div>
            </div><input type='number' name='admin_id' value='$admin->_id' style='display:none'></input>
            <input class='btn validate' type='submit' value='Submit'>
        </form>
    </div>
</main>