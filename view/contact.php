<main <?php if(isset($_SESSION['logged'])){ echo "class='admin'";}?>>
    <div class='contact'>
        <h2>Title</h2>
        <p> You like my work, do not hesitate to contact me.</p>

        <form class='' method='POST' action='/email/send' target='_self'>
            <label for='name'> Name:</label>
            <input type='name' id='name' name='name'>

            <label for='mail'> Mail:</label>
            <input type='mail' id='mail' name='mail'>

            <label for='sujet'> Sujet:</label>
            <input type='sujet' id='sujet' name='sujet'>

            <label for='message'>Votre message:</label>
            <textarea id='message' name='message' rows='2' cols='5'></textarea>

            <input class='btn validate' type='submit' value='Submit'>
        </form>
    </div>
</main>