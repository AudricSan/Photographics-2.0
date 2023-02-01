<?php

if (isset($_SESSION['logged'])) {
    echo "<main class='admin'>";
} else {
    echo "<main>";
}

$pictureDAO = new PictureDAO;

if (isset($tagID)) {
    $tagDao = new TagDAO;
    $tag = $tagDao->fetch($tagID);
    
    if ($tag === false) {
        header('location: /');
        die;
    }

    $title = $tag->_name;
    $subtitle = "Some of my $tag->_name Work";
    $pictures = $pictureDAO->fetchByTag($tag->_id);

} else {   
    $title = 'Gallery';
    $subtitle = 'Some of my Work';
    $pictures = $pictureDAO->fetchAll();

}

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
                <img src='../images/img/$picture->_link'></a>
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
