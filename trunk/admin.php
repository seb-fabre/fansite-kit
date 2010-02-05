<?php
require_once ('includes/_init.php');

$message = false;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
{
	header('location: /');
}

$title = Tools::translate('menu_admin');

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
		<h1><?php echo Tools::translate('menu_admin')?></h1>

		<p class="linkWithArrow"><a href="javascript:;" onclick="editTranslations()"><?php echo Tools::translate('Edit translations')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="editConfig()"><?php echo Tools::translate('Edit configuration')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="getVideos()"><?php echo Tools::translate('Manage the videos')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="getMembers()"><?php echo Tools::translate('Manage the members')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="getGalleries()"><?php echo Tools::translate('Manage the galleries')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="getPictures()"><?php echo Tools::translate('Manage the pictures')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="getComments()"><?php echo Tools::translate('Comments')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="getLinks()"><?php echo Tools::translate('Links')?></a></p>
		<p class="linkWithArrow"><a href="javascript:;" onclick="getNews()"><?php echo Tools::translate('News')?></a></p>

		<div class="clearBoth">&nbsp;</div>
	</div>

	<div id="footer">
		<?php require_once (INCLUDE_PATH . '_footer.php'); ?>
	</div>
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
