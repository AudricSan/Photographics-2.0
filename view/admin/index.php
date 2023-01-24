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

?>
<main class="admin">
    <div class='dash-content'>
        <h2>$value->_name</h2>
        <h3>$picture->_name</h3>

        <form method='POST' action='/basicinfo/$value->_id/edit/' target='_self'>
            <label for='content'>New data : </label><textarea id='content' name='content' required>$value->_content</textarea>
            <select name='content' id='pictureSelect'>
                <option value='$picture->_id'></option><input type='text' id='content' name='content' required>
                <input type='number' name='id' value='$value->_id' required style='display:none'>

                <div class='submit'>
                    <input class='btn validate' type='submit' value='Submit'>
                    <a class='btn error' href='/basicinfo/$value->_id/delete'> Delete</a>
                </div>
        </form>
    </div>
</main>