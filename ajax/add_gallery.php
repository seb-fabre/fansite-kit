<?php
    require_once('../includes/_init.php');

    $galleries = Gallery::getAll();

    $galleries = Tools::postSort($galleries, 'name');

    $html = '<p id="formResult"></p>
	<p>' . Tools::translate("Parent gallery selected : ") . ' <span id="parentGallerySelected"> -- </span></p>
	<fieldset id="fieldsetTree0"><input type="hidden" name="parent_id" id="parent_id" />
	    ' . Tools::listGalleryTree(NULL);

    $html .= '<p>' . Tools::translate("Gallery's names : ") . '</p>';
    foreach ($GLOBALS['LANGUAGES'] as $l)
	$html .= '<p class="shortLabel"><label>' . strtoupper($l) . ' : </label><input class="gallery_name" name="gallery_name[' . $l . ']" /></p>';

    $html .= '</fieldset>';

    echo json_encode(array(
	'text' => $html,
	'bottom' => '<p style="text-align: center">
	    <input type="button" onclick="submitAddGallery()" value="' . Tools::translate('Create the gallery') . '" />
	    <input type="button" onclick="$.modal.close()" value="' . Tools::translate('Close') . '" />
	</p>'
    ));
