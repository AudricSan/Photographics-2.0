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

// $imgroot = $_SESSION['imgroot'];

?>
<main class="admin">
    <div class='poeple'>
        <h1> <a href='/admin/admin/add' class='btn additems success'> <span class='material-icons-round'> add </span> </a> </h1>

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
                    <td> $admin->_name </td>
                    <td> $admin->_mail </td>
                    <td></td>

                    <td class=action>
                        <a class='btn edit' href='/admin/add/$admin->_id'>Edit</a>
                        <a class='btn delete' href='/admin/delete/$admin->_id'>Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>