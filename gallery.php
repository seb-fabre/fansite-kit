<?php
  require_once('includes/_init.php');

  $pathinfo = $_SERVER['PATH_INFO'];

  $matches = false;
  $match = preg_match('@^/([0-9]+)(/[^/]+)?$@', $pathinfo, $matches);
  // 0 => total string (if matches)
  // 1 => id value
  // 2 => name value

	if (!$match)
		$id = 0;
	else
		$id = $matches[1];

  $gallery = Gallery::find($id);

	if ($id != 0 && $gallery)
		$subgalleries = $gallery->getSubgalleries();
	else
		$subgalleries = Gallery::search(array(array('fan_gallery_id', 0)));

//	$subgalleries = Tools::postSort($subgalleries, 'fan_translation.name');

	if ($gallery)
		$images = $gallery->getImages();
	else
		$images = array();

	if ($gallery)
	{
		$hierarchy = $gallery->getParents();

		unset($hierarchy[0]);
		
		if (empty($hierarchy))
		{
			$title = Tools::translate('Gallery') . ' - ' . $gallery->getTranslatedValue('name');
		}
		else
		{
			$title = Tools::translate('Gallery');
			foreach ($hierarchy as $aGallery)
			{
				$title .= ' - ' . $aGallery->getTranslatedValue('name');
			}
		}
	}
  else
  {
  	$title = Tools::translate('Main categories');
  }

	if (empty($images) && empty($subgalleries))
		$noContentFound = true;
	else
		$noContentFound = false;
	
	Tools::echoHTMLHead($title);
?>

<body>
  <div id="body">
    <?= Tools::echoHeader(); ?>

		<div id="content">
			<div id="galleryTree">
				<h2><?php echo Tools::translate('Galleries tree') ?></h2>
				<?php echo Tools::generateGalleryTree($gallery) ?>
			</div>

			<div id="galleryContent">
				<h1 class="galleries"><?php if ($gallery) echo $gallery->getTranslatedValue('name'); else echo Tools::translate('Main categories') ?></h1>

				<?php if (($c = count($subgalleries)) != 0) { ?>
					<div class="subGalleries">
					<?php
						$i = 0;
						foreach ($subgalleries as $aGallery)
						{
				      $i++;
							$img = $aGallery->getRandomImage();
							echo '<p>
								' . $aGallery->getLink() .
								($img ? '<img src="' . $img->getSmallUrl() . '" alt="' . Tools::cleanLink($img->name) . '" />' : '') .
							'</p>';

							if ($i%5 == 0 && $i != 0 && $i != $c)
							{
								if ($c - $i > 5)
									echo '<div class="clearBoth">&nbsp;</div></div><div class="subGalleries">';
								else
									echo '<div class="clearBoth">&nbsp;</div></div><div class="subGalleries subGalleries' . ($c - $i) . '">';
							}
							else if ($i == $c)
							{
								echo '<div class="clearBoth">&nbsp;</div>';
							}
						}
					?>
					</div>
				<?php } ?>

				<?php if (count($images) != 0) { ?>
					<div id="galleryImages">
					<?php
						foreach ($images as $img)
						{
							echo '<a href="' . APPLICATION_URL . 'preview/' . $img->id . '/' . Tools::cleanLink($img->name) . '"><img src="' . $img->getSmallUrl() . '" alt="' . Tools::cleanLink($img->name) . '" /></a> ';
						}
					?>
					</div>
				<?php } ?>

			</div>

			<?php if ($noContentFound) { ?>
				<p class="infos" align="center"><?=Tools::translate("This gallery is empty.")?></p>
			<?php } ?>

			<div class="clearBoth">&nbsp;</div>
		</div>

		 <?= Tools::echoFooter(); ?>
	</div>
</body>
</html>