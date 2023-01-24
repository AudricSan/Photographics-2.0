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
    <h1> <a href='/admin/newtag'> <i class="fa-solid fa-tags"></i> </a> </h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quick Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td> </td>
                <td> </td>
                <td class=action with=500>
                    <a class='btn edit' href=''>Edit</a>
                    <a class='btn error' href=''>Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</main>