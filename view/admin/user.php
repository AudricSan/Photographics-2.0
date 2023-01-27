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
?>

<main class="admin">
    <h1>
        <a href='/admin/newuser'>
            <i class="fa-solid fa-user-plus"></i>
        </a>
    </h1>

    <?php
        // var_dump($_SESSION);

        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            $error = $_SESSION['error'];
            echo "
                <div class='error'>
                    <p> Something Wrong : <span> $error </span></p>
                </div>
            ";
            unset($_SESSION['error']);
        }
    ?>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Mail</th>
                <th>Role</th>
                <th>Quick Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <?php
                $adminDAO = new AdminDAO;
                $roleDAO = new RoleDAO;
                $users = $adminDAO->fetchAll();

                foreach ($users as $user) {
                    $role = $roleDAO->fetch($user->_role);

                    echo "
                            <td> $user->_name </td>
                            <td> $user->_mail </td>
                            <td> $role->_name </td>

                            <td class=action>
                                <a class='btn edit'   href='/admin/newuser?$user->_id'>Edit</a>
                                <a class='btn delete' href='/admin/deluser?$user->_id'>Delete</a>
                            </td>
                        ";
                }
                ?>
            </tr>
        </tbody>
    </table>
    </div>
</main>