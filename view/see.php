<?php
$pictureDAO = new PictureDAO;
$pic = $pictureDAO->fetch($id);
?>

<main <?php if(isset($_SESSION['logged'])){ echo "class='admin'";}?> >
  <div class='gallery'>
    <div class='media see'>
      <img src='/public/images/img/<?php echo $pic->_link ?>' alt='<?php echo $pic->_desc ?>'>
    </div>
  </div>
</main>