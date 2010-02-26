<?php
require_once ('../includes/_init.php');

$message = false;

//if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
//{
//	header('location: ' . APPLICATION_URL);
//	exit;
//}

$title = Tools::translate('menu_admin');

$headers = array();
$headers['css'] = array(
	'css/cupertino/jquery-ui-1.7.2.custom.css',
	'css/colorpicker.css',
);

$headers['js'] = array(
	'js/jquery-ui-1.7.2.custom.min.js',
	'js/jquery.simplemodal-1.2.3.js',
	'js/nimda.js',
	'js/jquery.form.js',
	'js/colorpicker.js',
);

// process post data
if (!empty($_POST['save']))
{

}

Tools::echoHTMLHead($title, $headers);
?>
<body>
<div id="container">
	<?=Tools::echoHeader();?>

	<div id="body" class="body100">
		<h1><?php echo Tools::translate('Edit site configuration')?></h1>

		<form methode="post">
			<?= echoFieldsetStart(Tools::translate('General configuration')); ?>
			<p><input type="checkbox" name="VIDEOS_ENABLED" value="1" <?=Config::getValue('VIDEOS ENABLED') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Enable videos')?></label></p>
			Config::setValue('GUESTBOOK ENABLED', 1);
			Config::setValue('REGISTRATIONS ENABLED', 1);
			Config::setValue('LANGUAGES', json_encode($languages));
			Config::setValue('COUNT LATEST NEWS', 5);
			Config::setValue('COUNT LATEST UPDATES', 10);
			Config::setValue('COUNT NEWS PER PAGE', 0);
			<?= echoFieldsetEnd(); ?>
		</form>

		<div class="clearBoth">&nbsp;</div>
	</div>

	<?php Tools::echoFooter() ?>
</div>
</body>
</html>
