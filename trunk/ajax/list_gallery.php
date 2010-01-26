<?php
    require_once('../includes/_init.php');
    
    $galleries = Gallery::getAll();

    $galleries = postSort($galleries, 'name');
    
    $html = listGalleryTree($_POST['id']);

    echo $html;
?>