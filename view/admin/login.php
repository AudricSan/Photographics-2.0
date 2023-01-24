<?php

require_once('../model/class/config.php');
$link = $oauth->get_link_connect();
$_SESSION['TLink'] = $link;

?>

<main class="admin">
    <div class='login'>
        <img src='../public/images/logoadmin.png' alt='Photographics Admin Logo'>

        <?php
        // var_dump($_SESSION);

        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo "
            <div class='error'>";

            foreach ($_SESSION['error'] as $key => $value) {
                echo "<p> Something Wrong : <span> $value </span></p>";
                unset($_SESSION['error']);
            }

            echo "</div>";
        }
        ?>

        <h2>Connection Email</h2>
        <form method='POST' action='/admin/log'>
            <label for='login'> Email:</label>
            <input type='text' id='login' name='login'>

            <label for='pass'> password:</label>
            <input type='password' id='pass' name='pass'>

            <input type='submit' value='Submit'>
        </form>

        <!-- <h2>Connection Twitch</h2>
        <form method='POST' action='$link'>
            <input type='submit' value='Submit'>
        </form> -->
    </div>
</main>