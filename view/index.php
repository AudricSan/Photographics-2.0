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

echo "
    <div class='card'>
        <h2> $title</h2>
        <h3> $subtitle</h3>
    </div>

    <div class='gallery'>
        <div class='media'>
            <a href='/01'>
                <img src='/public/images/img/002.png'></a>

            <div>
                <a><i class='fa-solid fa-heart'></i></a>
                <a><i class='fa-solid fa-share-nodes'></i></a>
            </div>
        </div>

        <div class='media'>
            <a href=''>
                <img src=' ../public/images/img/001.jpg'></a>
            <div>
                <a><i class='fa-solid fa-heart'></i></a>
                <a><i class='fa-solid fa-share-nodes'></i></a>
            </div>
        </div>
    </div>
</main>
";

// <main>
    

//     <div class='gallery'>
//         <div class='media'>
//             <a href='/01'>
//                 <img src='/public/images/img/002.png'></a>

//             <div>
//                 <a><i class='fa-solid fa-heart'></i></a>
//                 <a><i class='fa-solid fa-share-nodes'></i></a>
//             </div>
//         </div>

//         <div class='media'>
//             <a href=''>
//                 <img src=' ../public/images/img/001.jpg'></a>
//             <div>
//                 <a><i class='fa-solid fa-heart'></i></a>
//                 <a><i class='fa-solid fa-share-nodes'></i></a>
//             </div>
//         </div>
//     </div>
// </main>