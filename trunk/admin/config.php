<?php
require_once ('../includes/_init.php');

$message = false;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
{
	header('location: ' . APPLICATION_URL);
	exit;
}

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

$languages = Params::getValue('LANGUAGES');

// process post data
if (!empty($_POST['save']))
{
	// check
	$okSave = true;

	$languageCodes = explode("\n", $_POST['languages_short']);
	$languageLabels = explode("\n", $_POST['languages_long']);

	if (count($languageLabels) != count($languageLabels))
	{
		$okSave = false;
	}

	// do the save
	if ($okSave)
	{
		Params::setValue('VIDEOS ENABLED', $_POST['VIDEOS_ENABLED']);
		Params::setValue('GUESTBOOK ENABLED', $_POST['GUESTBOOK_ENABLED']);
		Params::setValue('REGISTRATIONS ENABLED', $_POST['REGISTRATIONS_ENABLED']);

		Params::setValue('LANGUAGES', serialize(array_combine($languageCodes, $languageLabels)));
	}
}

Tools::echoHTMLHead($title, $headers);
?>
<body>
<div id="container">
	<?=Tools::echoHeader();?>

	<div id="body" class="body100">
		<h1><?=$title?></h1>

		<form method="post">
			<?= echoFieldsetStart(Tools::translate('General configuration')); ?>
			<p><input type="checkbox" name="VIDEOS_ENABLED" value="1" <?=Params::getValue('VIDEOS ENABLED') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Enable videos')?></label></p>
			<p><input type="checkbox" name="GUESTBOOK_ENABLED" value="1" <?=Params::getValue('GUESTBOOK ENABLED') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Enable guestbook')?></label></p>
			<p><input type="checkbox" name="REGISTRATIONS_ENABLED" value="1" <?=Params::getValue('REGISTRATIONS ENABLED') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Enable registrations')?></label></p>
			<?= echoFieldsetEnd(); ?>

			<?= echoFieldsetStart(Tools::translate('Languages')); ?>
			<p class="infos"><?=Tools::translate('Choose the languages you want avaiable in your site. This parameter can be changed at any time in the admin area. You will also have to go to the admin area to translate the text displayed in the site (only french and english translations are given).')?></p>
			<p class="infos"><?=Tools::translate("English is the default language, so if you don't put it in the list it will automatically be added.")?></p>
			<p class="infos"><?=Tools::translate('One language per line.')?></p>
			<table width="100%" style="margin-bottom: 10px">
				<tr>
					<td width="45%" align="center">Language code (ex: "en")</td>
					<td width="45%" align="center">Language label (ex: 'English')</td>
				</tr>
				<tr>
					<td align="center"><textarea name="languages_short" style="width: 90%; display: block;" rows="5"></textarea></td>
					<td align="center"><textarea name="languages_long" style="width: 90%; display: block;" rows="5"></textarea></td>
				</tr>
			</table>
			<?= echoFieldsetEnd(); ?>

			<?= echoFieldsetStart(Tools::translate('Number of results')); ?>
			<p><input type="checkbox" name="COUNT_LATEST_NEWS" value="1" <?=Params::getValue('COUNT LATEST NEWS') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Number of results in the "latest news" block')?></label></p>
			<p><input type="checkbox" name="COUNT_LATEST_UPDATES" value="1" <?=Params::getValue('COUNT LATEST UPDATES') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Number of results in the "latest updates" block')?></label></p>
			<p><input type="checkbox" name="COUNT_NEWS_PER_PAGE" value="1" <?=Params::getValue('COUNT NEWS PER PAGE') ? 'checked="checked"' : ''?> class="left" /><label><?=Tools::translate('Number of news per page (0 = infinite)')?></label></p>
			<?= echoFieldsetEnd(); ?>
		</form>

		<div class="clearBoth">&nbsp;</div>
	</div>

	<?php Tools::echoFooter() ?>
</div>
</body>
</html>
