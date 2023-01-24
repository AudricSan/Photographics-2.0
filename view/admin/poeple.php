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
        <h1> <a href='/admin/newpeople' > <i class="fa-solid fa-user-plus"></i> </a> </h1>

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
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td class=action>
                        <a class='btn edit' href='/admin/poeple/add/'>Edit</a>
                        <a class='btn delete' href='/admin/poeple/delete/'>Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>