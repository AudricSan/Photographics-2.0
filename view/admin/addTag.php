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

if (isset($_GET['tag'])) {
    $tagDAO = new TagDAO;
    $tag = $tagDAO->fetch($_GET['tag']);
    $link = '/admin/edittag';
} else {
    $link = '/admin/addtag';
}
?>

<main class="admin">
    <?php
    if (isset($tag)) {
        echo "<h2>Edit Tag</h2>";
    } else {
        echo "<h2>Add Tag</h2>";
    }

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

    <form method='POST' action=' <?php echo "$link" ?> ' enctype='multipart/form-data' target='_self'>
        <label for='title'>Tag Title :</label>
        <input type='text' id='title' name='title' required value='<?php if (isset($tag)) {echo $tag->_name;} ?>'>

        <label for='desc'>Tag Description :</label>
        <input type='text' id='desc' name='desc' required value='<?php if (isset($tag)) {echo $tag->_description;} ?>'>

        <input required type='hidden' id='id' name='id' value='<?php if (isset($tag)) {echo $tag->_id;} ?>'>
        <input class='btn validate' type='submit' value='Submit'>
    </form>
</main>