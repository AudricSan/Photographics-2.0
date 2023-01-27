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

    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "
                <div class='error'>
                <p> Something Wrong : <span> $error </span></p>
        ";
        unset($_SESSION['error']);
        }

        echo "</div>";
    ?>

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

        <?php
        $pictureDAO = new PictureDAO;
        $pictures = $pictureDAO->fetchAll();

        var_dump($pictures);

        foreach ($pictures as $picture) {
            echo "
                <tbody>
                    <tr>
                        <td> $picture->_id </td>
                        <td> <img src='../img/$picture->_link' > </td>
                        <td> $picture->_name </td>
                        <td> $picture->_description </td>
                        <td> $picture->_link </td>
                        <td> $picture->_tag </td>
                        <td> $picture->_sharable </td>

                        <td class=action>
                            <a class='btn edit'   href='/admin/newtag?tag=$picture->_id'>Edit</a>
                            <a class='btn delete' href='/admin/deltag?tag=$picture->_id'>Delete</a>
                        </td>
                    </tr>
                </tbody>
            ";
        }
        ?>
    </table>
    </div>
</main>