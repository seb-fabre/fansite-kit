<?php
require_once ('includes/_init.php');

$message = false;

$_SESSION ['timestamp'] = date('YmdHis');

if (!isset($_SESSION ['user_id']))
{
	header('location: /');
}

$title = Tools::translate('menu_members');

$headers = array();
$headers['css'] = array(
	'css/cupertino/jquery-ui-1.7.2.custom.css',
	'js/jcupload/jquery.jcuploadUI.css',
);

$headers['js'] = array(
	'js/jquery-ui-1.7.2.custom.min.js',
	'js/jquery.simplemodal-1.2.3.js',
	'js/srebmem.js',
	'js/jcupload/jquery.jcupload.js',
	'js/jcupload/jquery.jcuploadUI.config.js',
	'js/jcupload/jquery.jcuploadUI.js'
);

Tools::echoHTMLHead($title, $headers);
?>
<body>
<div id="container">
	<?= Tools::echoHeader(); ?>

	<div id="body" class="body100">
		<h1><?= $title ?></h1>

		<p class="linkWithArrow"><a href="javascript:;" onclick="addGallery()"><?php echo Tools::translate('Add a gallery')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="addPhotos()"><?php echo Tools::translate('Add pictures in an existing gallery')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="changePassword()"><?php echo Tools::translate('Change my password')?></a></p>

		<div class="clearBoth">&nbsp;</div>
	</div>

	<div id="footer">
		<?php require_once (INCLUDE_PATH . '_footer.php'); ?>
	</div>
</div>

<div id="fenetre">
	<form action="" methode="post">
		<div id="fenetreText"></div>
		<div id="fenetreBottom"></div>
	</form>
</div>

<script type="text/javascript">
	var emptyFieldsMsg = "<?php echo Tools::translate('All the name fields must be filled')?>";
	var invalidGallery = "<?php echo Tools::translate("Invalid gallery selected : you can't select a main category")?>";
	var emptyParentMsg = "<?php echo Tools::translate('You must select a parent gallery for the new gallery')?>";
	var emptyPhotosMsg = "<?php echo Tools::translate('You must choose at least one photo')?>";
	var allowedFileFormatsStr = "<?php echo Tools::translate('Allowed file formats : jpg, zip')?>";

	var currentTimestamp = "<?php echo date('YmdHis')?>";
	var userId = "<?php echo $_SESSION ['user_id']?>";
</script>

</body>
</html>
