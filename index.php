<?php
require_once('includes/_init.php');

$latestNews = News::search(null, 'date desc', 10);

$latestGalleries = Gallery::search(null, 'date desc', 10);
$latestGalleries = Tools::reindexBy($latestGalleries, 'date desc');

if (Params::get('VIDEOS ENABLED'))
{
	$latestVideos = Video::search(null, 'date desc', 10);
	$latestVideos = Tools::reindexBy($latestVideos, 'date desc');

	$latestUpdates = array_merge_recursive($latestGalleries, $latestVideos);
	$latestUpdates = Tools::array_flatten($latestUpdates);
}
else
{
	$latestUpdates = $latestGalleries;
}

$title = Tools::translate('Home page');

Tools::echoHTMLHead($title);

?>
<body>
	<div id="body">
		<?= Tools::echoHeader(); ?>

		<div id="content">
			<div id="latest_updates" class="blockWithHeader">
				<h2><?php echo Tools::translate('Latest updates'); ?></h2>
				<div class="blockWithHeaderContent">
					<?php
						foreach ($latestUpdates as $update)
						{
							echo '<p>' . $update->getTranslatedValue('name') . ' - ' . $update->getDateValue('date') . '</p>';
						}
					?>
				</div>
			</div>

			<div id="disclaimer">
				<?php echo Tools::getDisclaimer() ?>
			</div>

			<div id="latest_news">
				<?php foreach ($latestNews as $news): ?>

				<div class="blockWithHeader">
					<h2><?php echo $news->getTranslatedValue('title') ?><span style="float: right"><?php echo $news->getValue('date') ?></span></h2>
					<div class="blockWithHeaderContent">
						<?php echo $news->getTranslatedValue('text') ?>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

			<div style="clear:both"></div>
		</div>

		<?php echo Tools::echoFooter(); ?>
	</div>
</body>
</html>