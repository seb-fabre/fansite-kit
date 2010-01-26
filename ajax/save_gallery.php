<?php
    require_once('../includes/_init.php');
    
    $errors = array();
    foreach ($_POST['gallery_name'] as $gallery)
    {
	$gallery = Gallery::search(array(array('name', $gallery)));
	if ($gallery)
	{
	    $errors []= str_replace('{gallery_name}', $gallery, translate('A gallery already exists with the name {gallery_name}.'));
	}
    }
    
    if (count($errors) == 0)
    {
	$gallery = new Gallery();
	$gallery->name = json_encode($_POST['gallery_name']);
	$gallery->gallery_id = $_POST['parent_id'];
	$gallery->date = date('Y-m-d');
	$gallery->views = 0;
	$gallery->user_id = $_SESSION['user_id'];
	$gallery->has_images = 1;
	$gallery->save();
    }
    
    echo json_encode(array('success' => (count($errors) == 0) ? 1 : 0, 'errors' => implode("<br/>", $errors), 'message' => translate('The gallery was created successfully.')));
?>