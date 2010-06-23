<?php
  require_once('includes/_init.php');

	if (isset($_SERVER['PATH_INFO']))
		$pathinfo = $_SERVER['PATH_INFO'];
	else
		$pathinfo = '/';

  $matches = false;
  $match = preg_match('@^/([0-9]+)(/[^/]+)?$@', $pathinfo, $matches);
  // 0 => total string (if matches)
  // 1 => id value
  // 2 => name value

	$currentGallery = null;
	$headTitle = null;
	$h1 = null;
	$subgalleries = array();
	$images = array();

	// if we have a gallery id in the url
	if ($match)
	{
		$id = $matches[1];

		$currentGallery = Gallery::find($id);

		if ($id != 0 && $currentGallery)
			$subgalleries = $currentGallery->getSubgalleries();
		else
			$subgalleries = Gallery::search(array(array('fan_gallery_id', 0)));
	}

	if ($currentGallery)
		$images = $currentGallery->getImages();
	else
		$images = array();

	if ($currentGallery)
	{
		$hierarchy = $currentGallery->getParents();

		unset($hierarchy[0]);
		
		$h1 = $currentGallery->getTranslatedValue('name');

		if (empty($hierarchy))
		{
			$headTitle = Tools::translate('Gallery') . ' - ' . $currentGallery->getTranslatedValue('name');
		}
		else
		{
			$headTitle = Tools::translate('Gallery');
			foreach ($hierarchy as $aGallery)
			{
				$headTitle .= ' - ' . $aGallery->getTranslatedValue('name');
			}
		}
	}
	// if in the url we have a "mode"
  else if ($pathinfo != '/')
	{
		$matches = false;
		$match = preg_match('@^/(.+)$@', $pathinfo, $matches);

		if ($match && in_array($matches[1], array('latest-galleries', 'latest-photos', 'most-viewed-galleries', 'most-viewed-photos', 'search', 'zip')))
		{
			switch ($matches[1])
			{
				case 'latest-galleries':
					$headTitle = Tools::translate('Latest galleries');
					$subgalleries = Gallery::getLatest(20);
					break;

				case 'latest-photos':
					$headTitle = Tools::translate('Latest photos');
					$images = Image::getLatest(20);
					break;

				case 'most-viewed-galleries':
					$headTitle = Tools::translate('Most viewed galleries');
					$subgalleries = Gallery::getTop(20);
					break;

				case 'most-viewed-photos':
					$headTitle = Tools::translate('Most viewed photos');
					$images = Image::getTop(20);
					break;

				case 'search':
					$headTitle = Tools::translate('Search');
					break;

				case 'zip':
					$headTitle = Tools::translate('Zip');
					break;
		 }

		 if (!empty($headTitle))
			 $h1 = $headTitle;
		}
	}

	// if every attempt to load params the url failed
  if (empty($headTitle))
  {
  	$headTitle = Tools::translate('Main categories');
  	$h1 = Tools::translate('Main categories');
  }


	if (empty($images) && empty($subgalleries))
		$noContentFound = true;
	else
		$noContentFound = false;
	
	Tools::echoHTMLHead($headTitle);
?>

<body>
  <div id="body">
    <?= Tools::echoHeader(); ?>

		<div id="content">
			<div id="galleryTree">
				<h2><?php echo Tools::translate('Galleries tree') ?></h2>
				<?php echo Tools::generateGalleryTree($currentGallery) ?>
			</div>

			<div id="galleryContent">
				<div id="galleryToolbar">
					<a href="<?=APPLICATION_URL?>gallery/latest-galleries"><img src="<?=Tools::getImage('newest_galleries.png')?>" title="View the latest galleries added" alt="View the latest galleries added" /></a>
					<a href="<?=APPLICATION_URL?>gallery/latest-photos">View the latest photos added</a>
					<a href="<?=APPLICATION_URL?>gallery/most-viewed-galleries">Go to the most viewed galleries</a>
					<a href="<?=APPLICATION_URL?>gallery/most-viewed-photos">Go to the most viewed photos</a>
					<a href="<?=APPLICATION_URL?>gallery/search">Search</a>
					<a href="<?=APPLICATION_URL?>gallery/zip">Download the gallery as a zip file</a>
				</div>

				<h1 class="galleries"><?php echo $h1 ?></h1>

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