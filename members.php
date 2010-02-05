<?php
require_once ('includes/_init.php');

$message = false;

$_SESSION ['timestamp'] = date('YmdHis');

if (!isset($_SESSION ['user_id']))
{
	header('location: /');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php require_once (INCLUDE_PATH . '_meta.php'); ?>
	<title><?php echo Tools::translate('menu_members')?></title>

	<link href="/css/site.css.php" rel="stylesheet" type="text/css" />
	<link href="/css/cupertino/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />

	<script src="/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="/js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
	<script src="/js/jquery.simplemodal-1.2.3.js" type="text/javascript"></script>

	<script src="/js/srebmem.js" type="text/javascript"></script>

	<link rel="stylesheet" href="/js/jcupload/jquery.jcuploadUI.css" />
	<script type="text/javascript" src="/js/jcupload/jquery.jcupload.js"></script>
	<script type="text/javascript" src="/js/jcupload/jquery.jcuploadUI.config.js"></script>
	<script type="text/javascript" src="/js/jcupload/jquery.jcuploadUI.js"></script>
</head>

<body>
<div id="container">
	<div id="header">
		<img src="/img/banniere.jpg" alt="banniere du site" />
		<?php require_once (INCLUDE_PATH . '_menu.php'); ?>
	</div>

	<div id="body" class="body100">
		<h1><?php echo Tools::translate('menu_members')?></h1>

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
