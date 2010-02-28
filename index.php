<?php
require_once('includes/_init.php');

$latestNews = News::search(null, 'date desc', 10);

$latestGalleries = Gallery::search(null, 'date desc', 10);
$latestGalleries = Tools::reindexBy($latestGalleries, 'date desc');

if (Config::getValue('VIDEOS ENABLED'))
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
	<?= Tools::echoHeader(); ?>

	<div id="content">
		<div id="latest_updates" class="blockWithHeader">
			<h2><?php echo Tools::translate('latest updates'); ?></h2>
			<div class="blockWithHeaderContent">
				<?php
					foreach ($latestUpdates as $update)
					{
						echo '<p>' . $update->name . ' - ' . $update->date . '</p>';
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
				<h2><?php echo $news->title ?></h2>
				<div class="blockWithHeaderContent">
					<?php echo $news->text ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<div style="clear:both"></div>
	</div>

	<?php echo Tools::echoFooter(); ?>
</body>
</html>