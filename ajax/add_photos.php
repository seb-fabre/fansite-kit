<?php
    require_once('../includes/_init.php');
    
    $galleries = Gallery::getAll();

    $galleries = Tools::postSort($galleries, 'name');
    
    $dir = $GLOBALS['ROOTPATH'] . 'temporary files/' . $_SESSION['timestamp'] . '_' . $_SESSION['user_id'] . '/';
    if (!is_dir($dir))
	mkdir($dir, 0777, true);
    
    $html = '';
    
    $html .= '<div style="width: 450px; float: left; margin-left: 10px">';
    
    $html .= '<p id="formResult"></p>
	<p>' . Tools::translate("Gallery selected : ") . ' <span id="parentGallerySelected"> -- </span></p>
	<fieldset id="fieldsetTree1"><input type="hidden" name="parent_id" id="parent_id" />
	    ' . Tools::listGalleryTree(NULL);
    
    $html .= '</fieldset>';
    
    $html .= '</div>';
    
    $html .= '<div style="width: 450px; float: left; margin-left: 30px">';
    $html .= '<div id="jcupload_content"></div>';
    $html .= '</div>';

    echo json_encode(array(
	'text' => $html,
	'bottom' => '<p style="text-align: center">
	    <input type="button" onclick="submitPhotos()" value="' . Tools::translate('Save the photos in the gallery') . '" />
	    <input type="button" onclick="$.modal.close()" value="' . Tools::translate('Close') . '" />
	</p>'
    ));
