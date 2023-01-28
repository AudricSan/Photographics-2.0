<?php

if (isset($_SESSION['logged'])) {
    echo "<main class='admin'>";
} else {
    echo "<main>";
}

if (!empty($_GET['id'])) {
    $tagDao = new TagDAO;
    $tag = $tagDao->fetch($_GET['id']);
    $title = $tag->_name;
    $subtitle = "Some of my $tag->_name";
} else {
    $title = 'Gallery';
    $subtitle = 'Some of my Work';
}

$pictureDAO = new PictureDAO;
$pictures = $pictureDAO->fetchAll();

echo "
    <div class='card'>
        <h2> $title</h2>
        <h3> $subtitle</h3>
    </div>

    <div class='gallery'>
";

foreach ($pictures as $picture) {
    echo "
        <div class='media'>
            <a href='/see/$picture->_id'>
                <img src='/public/images/img/$picture->_link'></a>
            <div>
                <a><i class='fa-solid fa-heart'></i></a>
                <a><i class='fa-solid fa-share-nodes'></i></a>
            </div>
        </div>
    ";
}

echo "
    </div>
</main>
";
