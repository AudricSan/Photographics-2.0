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
    <h1>
        <a href='/admin/newpicture'>
            <i class="fa-solid fa-image"></i>
        </a>
    </h1>

    <table>
        <thead>
            <tr>
                <th>Miniature</th>
                <th>Name</th>
                <th>Description</th>
                <th>File Name</th>
                <th>Tags</th>
                <th>Sharable</th>
                <th>Quick Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> <input type='checkbox' disabled> </td>
                <td>
                    <a class='btn edit' href='/admin/picture/add/'>Edit</a>
                    <a class='btn error' href='/admin/picture/delete/'>Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
</main>