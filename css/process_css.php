<?php
	$_GET['quick_init'] = 1;

  require_once ('../includes/_init.php');

  header('Content-type: text/css');

	if (defined('APPLICATION_URL'))
		$url = APPLICATION_URL;
	else
		$url = './';

  if (!empty($_GET['name']))
  {
	  $name = $_GET['name'];
	  $f = $GLOBALS['ROOTPATH'] . 'css/' . $name . '.css';

	  $infos = getimagesize($GLOBALS['ROOTPATH'] . 'images/banniere.jpg');
	  $bannerHeight = $infos[1];

	  if (file_exists($f))
	  {
		  $fp = fopen($f,'r');

		  while($css = fgets($fp))
		  {
		    $css = str_replace('{application_url}', $url, $css);
		    $css = str_replace('{banner_height}', $bannerHeight, $css);
		    echo $css;
		  }

		  fclose($fp);
	  }
	  else
	  {
	  	echo '/* FILE NOT FOUND */';
	  }
	}
  else
  {
  	echo '/* FILE NOT FOUND */';
  }
