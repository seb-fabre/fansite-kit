<?php
require_once ('../includes/_init.php');

$message = false;

//if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
//{
//	header('location: ' . APPLICATION_URL);
//	exit;
//}

$title = Tools::translate('Edit site configuration');

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
		<h1><?=$title?></h1>

		<form methode="post">
			<?= echoFieldsetStart(Tools::translate('General configuration')); ?>
			<p><input type="checkbox" name="VIDEOS_ENABLED" value="1" <?=Config::getValue('VIDEOS ENABLED') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Enable videos')?></label></p>
			<p><input type="checkbox" name="GUESTBOOK_ENABLED" value="1" <?=Config::getValue('GUESTBOOK ENABLED') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Enable guestbook')?></label></p>
			<p><input type="checkbox" name="REGISTRATIONS_ENABLED" value="1" <?=Config::getValue('REGISTRATIONS ENABLED') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Enable registrations')?></label></p>
			<p><input type="checkbox" name="LANGUAGES" value="1" <?=Config::getValue('LANGUAGES') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Languages')?></label></p>
			<p><input type="checkbox" name="COUNT_LATEST_NEWS" value="1" <?=Config::getValue('COUNT LATEST NEWS') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Count latest news')?></label></p>
			<p><input type="checkbox" name="COUNT_LATEST_UPDATES" value="1" <?=Config::getValue('COUNT LATEST UPDATES') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Count latest updates')?></label></p>
			<p><input type="checkbox" name="COUNT_NEWS_PER_PAGE" value="1" <?=Config::getValue('COUNT NEWS PER PAGE') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Count news per page')?></label></p>
			<?= echoFieldsetEnd(); ?>
		</form>

		<div class="clearBoth">&nbsp;</div>
	</div>

	<?php Tools::echoFooter() ?>
</div>
</body>
</html>
