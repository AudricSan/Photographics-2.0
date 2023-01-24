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

if (isset($id)) {
    $tagDao = new TagDAO;
    $tag = $tagDao->fetch($id);
}
?>

<main class="admin">
    <h2>Add Tag</h2>

    <form method='POST' action='' enctype='multipart/form-data' target='_self'>
        <label for='title'>Tag Title :</label>
        <input type='text' id='title' name='title' required>

        <label for='desc'>Tag Description :</label>
        <input type='text' id='desc' name='desc' required>
        <input type='number' name='tag_id' value='$tag->_id' style='display:none'></input><input class='btn validate' type='submit' value='Submit' required>
    </form>
    </div>
    </div>
</main>