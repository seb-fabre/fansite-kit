<?php
require_once('includes/_init.php');

$latestNews = News::search(null, 'date desc', 10);

$latestVideos = Video::search(null, 'date desc', 10);
$latestVideos = Tools::reindexBy($latestVideos);

$latestGalleries = Gallery::search(null, 'date desc', 10);
$latestGalleries = Tools::reindexBy($latestGalleries);

Tools::echoHTMLHead();
?>
<body>
	<div id="header">
		<img src="/img/banniere.jpg" alt="banniere du site" />
		<?php require_once(INCLUDE_PATH . '_menu.php'); ?>
	</div>

	<div id="content">
		<div id="latest_updates" class="blockWithHeader">
			<h2><?php echo Tools::translate('latest updates'); ?></h2>
			<div class="blockWithHeaderContent">
				<p>sigfdg,drfgf</p>
				<p>hrd</p>
				<p>xtfdrdxt</p>
				<p>rxttcy</p>
				<p>jt</p>
				<p>ct</p>
				<p>fdfkghe_èy'enkhudio</p>
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