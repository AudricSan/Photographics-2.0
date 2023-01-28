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
                $ptDAO = new PictureTagDAO;
                $pts = $ptDAO->fetchAll();

                foreach ($tags as $tag) {
                    echo "
                            <label for='$tag->_id'>$tag->_name</label>
                            <input type='checkbox' id='$tag->_id' name='tagid=$tag->_id' value='$tag->_id'";

                            foreach ($pts as $pt) {
                                if ($pt->_pic === $pictures->_id) {
                                    if ($pt->_tag === $tag->_id) {
                                        echo "checked";
                                    }
                                }
                            } 
                            echo" >";
                }
                ?>
            </div>
        </div>

        <label for='share'>Sharable</label>
        <input type='checkbox' class='switch' id='share' name='share' <?php if (isset($pictures)) {if ($pictures->_sharable) {echo "checked";}} ?>>


        <label for='file'>File:</label>
        <?php
        if (isset($pictures)) {
            $img = $pictures->_link;
            echo "<div> <img src='$img'> </div>";
        }else{
            echo "<input type='file' id='file' name='file' required>";
        }
        ?>

        <input required type='hidden' id='id'   name='id'   value='<?php if (isset($pictures)) {echo $pictures->_id;} ?>'>
        <input required type='hidden' id='link' name='link' value='<?php if (isset($pictures)) {echo $pictures->_link;} ?>'>
        <input class='btn validate' type='submit' value='Submit' required>
    </form>
</main>