<?php
    require_once('../includes/_init.php');
    
    $galleries = Gallery::getAll();

    $galleries = Tools::postSort($galleries, 'name');
    
    $html = Tools::listGalleryTree($_POST['id']);

    echo $html;
?>