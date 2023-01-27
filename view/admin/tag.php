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
                <th>Name</th>
                <th>Description</th>
                <th>Quick Action</th>
            </tr>
        </thead>

        <?php
        $tagDAO = new TagDAO;
        $tags = $tagDAO->fetchAll();

        foreach ($tags as $tag) {
            echo "
                <tbody>
                    <tr>
                        <td> $tag->_name </td>
                        <td> $tag->_description </td>

                        <td class=action>
                            <a class='btn edit'   href='/admin/newtag?tag=$tag->_id'>Edit</a>
                            <a class='btn delete' href='/admin/deltag?tag=$tag->_id'>Delete</a>
                        </td>
                    </tr>
                </tbody>
            ";
        }
        ?>
    </table>
</div>
</main>