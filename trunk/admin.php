<?php
require_once ('includes/_init.php');

$message = false;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
{
	header('location: ' . APPLICATION_URL);
}

$title = Tools::translate('Administration');

$headers = array();
$headers['css'] = array(
	'css/cupertino/jquery-ui-1.7.2.custom.css',
	'js/jcupload/jquery.jcuploadUI.css',
	'css/colorpicker.css',
);

$headers['js'] = array(
	'js/jquery-ui-1.7.2.custom.min.js',
	'js/jquery.simplemodal-1.2.3.js',
	'js/nimda.js',
	'js/jcupload/jquery.jcupload.js',
	'js/jcupload/jquery.jcuploadUI.config.js',
	'js/jcupload/jquery.jcuploadUI.js',
	'js/jquery.form.js',
	'js/colorpicker.js',
	'js/scrolltable.js',
);

Tools::echoHTMLHead($title, $headers);
?>
<body>
<div id="container">
	<?=Tools::echoHeader();?>

	<div id="body" class="body100">
		<h1><?php echo $title ?></h1>

		<?= Tools::echoAction(APPLICATION_URL . "admin_config", Tools::translate('Site configuration')) ?>

		<?= Tools::echoJSAction("editTranslations()", Tools::translate('Edit translations')) ?>
		<?= Tools::echoJSAction("editConfig()", Tools::translate('Edit configuration')) ?>
		<?= Tools::echoJSAction("getVideos()", Tools::translate('Manage the videos')) ?>
		<?= Tools::echoJSAction("getMembers()", Tools::translate('Manage the members')) ?>
		<?= Tools::echoJSAction("getGalleries()", Tools::translate('Manage the galleries')) ?>
		<?= Tools::echoJSAction("getPictures()", Tools::translate('Manage the pictures')) ?>
		<?= Tools::echoJSAction("getComments()", Tools::translate('Comments')) ?>
		<?= Tools::echoJSAction("getLinks()", Tools::translate('Links')) ?>
		<?= Tools::echoJSAction("getNews()", Tools::translate('News')) ?>

		<div class="clearBoth">&nbsp;</div>
	</div>

	<?= Tools::echoFooter(); ?>
</div>

<div id="fenetre">
	<div id="fenetreText"></div>
	<div id="fenetreBottom"></div>
</div>

<script type="text/javascript">
	var emptyFieldsMsg = "<?php echo addslashes(Tools::translate('All the name fields must be filled'))?>";
	var invalidGallery = "<?php echo addslashes(Tools::translate("Invalid gallery selected : you can't select a main category"))?>";
	var emptyParentMsg = "<?php echo addslashes(Tools::translate('You must select a parent gallery for the new gallery'))?>";
	var emptyPhotosMsg = "<?php echo addslashes(Tools::translate('You must choose at least one photo'))?>";

	var deleteMemberStr = "<?php echo addslashes(Tools::translate('Are you sure you want to delete this member ?'))?>";
	var disableMemberStr = "<?php echo addslashes(Tools::translate('Are you sure you want to disable this member ?'))?>";
	var enableMemberStr = "<?php echo addslashes(Tools::translate('Are you sure you want to enable this member ?'))?>";

	var isadminMemberStr = "<?php echo addslashes(Tools::translate('Are you sure you want to promote this member ?'))?>";
	var isnotadminMemberStr = "<?php echo addslashes(Tools::translate('Are you sure you want to downgrade this member ?'))?>";

	var titleDisableStr = "<?php echo addslashes(Tools::translate('disable member'))?>";
	var titleEnableStr = "<?php echo addslashes(Tools::translate('enable member'))?>";
	var titleMakeAdminStr = "<?php echo addslashes(Tools::translate('promote member'))?>";
	var titleMakeNotAdminStr = "<?php echo addslashes(Tools::translate('downgrade member'))?>";
</script>
</body>
</html>
