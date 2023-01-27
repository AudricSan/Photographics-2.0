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

if (isset($_GET['pic'])) {
    $pictureDAO = new PictureDAO;
    $pictures = $pictureDAO->fetch($_GET['pic']);
    $link = '/admin/editpic';
} else {
    $link = '/admin/addpic';
}

$tagDao = new TagDAO;
$tags = $tagDao->fetchAll();

?>

<main class="admin">
    <?php
    if (isset($pictures)) {
        echo "<h2>Edit Picture</h2>";
    } else {
        echo "<h2>Add Picture</h2>";
    }

    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $error) {
            echo "
                <div class='error'>
                <p> Something Wrong : <span> $error </span></p>
            ";
        }
        // unset($_SESSION['error']);
    }

    echo "</div>";
    ?>

    <form method='POST' action='<?php echo $link; ?>' enctype='multipart/form-data' target='_self'>
        <label for='title'>Image Title :</label>
        <input type='text' id='title' name='title' required value='<?php if (isset($pictures)) {echo $pictures->_name;} ?>'>

        <label for='desc'>Image Description :</label>
        <input type='text' id='desc' name='desc' required value='<?php if (isset($pictures)) {echo $pictures->_description;} ?>'>

        <div>
            <p>Select Tags : </p>
            <div>
                <?php
                foreach ($tags as $tag) {
                    echo "
                            <label for='$tag->_id'>$tag->_name</label>
                            <input type='checkbox' id='$tag->_id' name='tagid=$tag->_id' value='$tag->_id'>
                        ";
                }
                ?>
            </div>
        </div>

        <label for='share'>Sharable</label>
        <input type='checkbox' class='switch' id='share' name='share' <?php if (isset($pictures)) {if ($pictures->_sharable) {echo "checked";}} ?>>


        <label for='file'>File:</label>
        <input type='file' id='file' name='file' required>

        <?php
        if (isset($pictures)) {
            $img = $pictures->_link;
            echo "<div> <img src='$img'> </div>";
        }
        ?>

        <input type='number' name='picture_id' value='$picture->_id' style='display:none'></input>
        <input type='text' name='link' value='$picture->_link' style='display:none'></input>

        <input class='btn validate' type='submit' value='Submit' required>
    </form>
</main>