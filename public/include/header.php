<!DOCTYPE HTML>
<html lang='en/us'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'>

    <title>Title</title>

    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <meta name='keywords' content='$keyword'>
    <meta name='description' content='$description'>
    <meta name='auteur' content='$autor'>

    <link rel='apple-touch-icon' sizes='180x180' href='$imglink/ico/apple-touch-icon.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='$imglink/ico/favicon-32x32.png'>
    <link rel='icon' type='image/png' sizes='16x16' href='$imglink/ico/favicon-16x16.png'>
    <link rel='manifest' href='$imglink/ico/site.webmanifest'>
    <link rel='mask-icon' href='$imglink/ico/safari-pinned-tab.svg' color='#5bbad5'>
    <meta name='apple-mobile-web-app-title' content='Photographics'>
    <meta name='application-name' content='Photographics'>
    <meta name='msapplication-TileColor' content='#ffffff'>
    <meta name='theme-color' content='#ffffff'>

    <link rel='stylesheet' type='text/css' href='../css/header.css' />
    <link rel='stylesheet' type='text/css' href='../css/footer.css' />
    <link rel='stylesheet' type='text/css' href='../css/index.css' />
    <link rel='stylesheet' type='text/css' href='../css/error.css' />

    <link rel='stylesheet' type='text/css' href='../css/reset.css' />

    <!--icones importées-->
    <script src='https://kit.fontawesome.com/eb747bd21c.js' crossorigin='anonymous'></script>

</head>

<header>
    <nav>
        <a href='/'><img src='../images/logo.svg' alt='Logo' title='Photographics Logo'></a>

        <ul>
            <li> <a href='/about'>About</a> </li>
            <li> <a href='/contact'>Contact</a> </li>
        </ul>
    </nav>

    <?php
    $adminDAO = new AdminDAO;

    if (isset($_SESSION['logged'])) {
        if ($adminDAO->fetch($_SESSION['logged'])) {
            echo "
                <nav class='admin'>
                    <ul>
                        <li>
                            <i class='fa-solid fa-house'></i>
                            <a href='/admin'>dashboard</a>
                        </li>
                
                        <li>
                            <i class='fa-solid fa-house'></i>
                            <a href='/admin/picture'>Pictures Dashborad</a>
                        </li>
                
                        <li>
                            <i class='fa-solid fa-house'></i>
                            <a href='/admin/tag'>Tags Dashboard</a>
                        </li>
                
                        <li>
                            <i class='fa-solid fa-house'></i>
                            <a href='/admin/user'>User dashboard</a>
                        </li>
                
                        <li>
                            <i class='fa-solid fa-house'></i>
                            <a href='/admin/doc'>Documentation</a>
                        </li>
                
                        <li>
                            <i class='fa-solid fa-house'></i>
                            <a href='https://github.com/AudricSan/Photographics/issues' target='_BLANC'>Bugs Report</a>
                        </li>
                
                        <li>
                            <i class='fa-solid fa-house'></i>
                            <a href='/admin/disconnect'>DISCONNECTED</a>
                        </li>
                    </ul>
                </nav>
            ";
        }
    }
    ?>
</header>