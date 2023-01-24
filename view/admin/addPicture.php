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

$tagDao = new TagDAO;
$tags = $tagDao->fetchAll();

if (isset($id)) {
    $pictureDAO = new PictureDAO;
    $picture = $pictureDAO->fetch($id);

    // $pictureTagDAO = new PictureTagDAO;
    // $pictureTags = $pictureTagDAO->fetchByPic($id);

    $imgroot = $_SESSION['imgroot'];
}

?>

<main>
    <form method='POST' action='' enctype='multipart/form-data' target='_self'>
        <label for='title'>Image Title :</label>
        <input type='text' id='title' name='title'"; if (isset($picture)) {echo " value='$picture->_name'";} echo" required>

        <label for='desc'>Image Description :</label>
        <input type='text' id='desc' name='desc'"; if (isset($picture)) { echo " value='$picture->_description'";} echo" required>

        <div>
            <p>Select Tags : </p>
            <div>
                <label for='$tag->_id'>$tag->_name</label>
                <input type='checkbox' id='$tag->_id' name='tag_$tag->_id' value='$tag->_id'>
            </div>
            <div>
                <label for='$tag->_id'>$tag->_name</label>
                <input required type='radio' id='$tag->_id' name='tag' value='$tag->_id'>
            </div>
        </div>

        <label for='share'>Sharable</label>
        <input type='checkbox' class='switch' id='share' name='share'>


        <label for='file'>File:</label>
        <input type='file' id='file' name='file' required>";

        <div class='img'><img src='$imgroot/img/$picture->_link'></div>
        <input type='number' name='picture_id' value='$picture->_id' style='display:none'></input>
        <input type='text' name='link' value='$picture->_link' style='display:none'></input>
        <input class='btn validate' type='submit' value='Submit' required>
    </form>
    </div>
    </div>
</main>