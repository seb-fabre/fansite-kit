<?php
  require_once('includes/_init.php');

  $pathinfo = $_SERVER['PATH_INFO'];

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
    $subgalleries = Gallery::search(array(array('gallery_id', NULL)));

  $subgalleries = postSort($subgalleries, 'name');

  if ($gallery)
    $images = $gallery->getImages();
  else
    $images = array();

    if ($gallery)
    {
	$hierarchy = Gallery::getHierarchy($gallery->id);
	unset($hierarchy[0]);
	if (count($hierarchy) == 0)
	    $title = translate('Gallery') . ' - ' . $gallery->name;
	else
	{
	    $title = translate('Gallery');
	    foreach ($hierarchy as $gal)
	    {
		$gal = Gallery::find($gal);
		$title .= ' - ' . $gal->name;
	    }
	}
    }
    else
	$title = translate('Main categories');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php require_once(INCLUDE_PATH . '_meta.php'); ?>
  <title><?php echo $title ?></title>

  <link href="/css/site.css.php" rel="stylesheet" type="text/css" />
  <link href="/css/cupertino/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />

  <script src="/js/jquery-1.3.2.min.js" type="text/javascript"></script>
  <script src="/js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
</head>

<body>
  <div id="container">
    <div id="header">
      <img src="/img/banniere.jpg" alt="banniere du site" />
      <?php require_once(INCLUDE_PATH . '_menu.php'); ?>
    </div>

    <div id="body">
      <div id="galleryTree"><div id="galleryTreeTop"><div id="galleryTreeMiddle">
	<h2><?php echo translate('Galleries tree') ?></h2>
	<?php echo generateGalleryTree(($gallery ? $gallery->id : 0)) ?>
      </div></div></div>

      <div id="galleryContent">
	<h1 class="galleries"><?php if ($gallery) echo $gallery->name; else echo translate('Main categories') ?></h1>

	<?php if (($c = count($subgalleries)) != 0): ?>
	  <div class="subGalleries">
	  <?php
	    $i = 0;
	    foreach ($subgalleries as $gal)
	    {
	      $i++;
	      $img = $gal->getRandomImage();
	      echo '<p>
		<a href="' . $gal->getUrl() . '</a>' .
		($img ? '<img src="' . $img->getSmallUrl() . '" alt="' . cleanLink($img->name) . '" />' : '') .
		'</p> ';
	      if ($i%5 == 0 && $i != 0 && $i != $c)
	      {
		if ($c - $i > 5)
		  echo '<div class="clearBoth">&nbsp;</div></div><div class="subGalleries">';
		else
		  echo '<div class="clearBoth">&nbsp;</div></div><div class="subGalleries subGalleries' . ($c - $i) . '">';
	      }
	      else if ($i == $c)
		echo '<div class="clearBoth">&nbsp;</div>';
	    }
	  ?>
	  </div>
	<?php endif; ?>

	<?php if (count($images) != 0): ?>
	  <div id="galleryImages">
	  <?php
	    foreach ($images as $img)
	    {
	      echo '<a href="/preview/' . $img->id . '/' . cleanLink($img->name) . '"><img src="' . $img->getSmallUrl() . '" alt="' . cleanLink($img->name) . '" /></a> ';
	    }
	  ?>
	  </div>
	<?php endif; ?>

      </div>

      <div class="clearBoth">&nbsp;</div>
    </div>

    <div id="footer">

    </div>
  </div>
</body>
</html>