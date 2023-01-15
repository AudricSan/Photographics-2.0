<?php

// $imgroot = $_SESSION['imgroot'];

?>

</header>
<main>
    <div class='login'>
        <img src='../public/images/logoadmin.png' alt='Photographics Admin Logo'>

        <form method='POST' action='/admin/log'>
            <h2> Login Form</h2>
            <label for='login'> login:</label>
            <input type='text' id='login' name='login'>

            <label for='pass'> password:</label>
            <input type='password' id='pass' name='pass'>

            <input type='submit' value='Submit'>
        </form>
    </div>
</main>