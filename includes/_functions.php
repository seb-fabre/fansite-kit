<?php
	function getDisclaimer()
	{
		$dis = translate('disclaimer');
		$dis = str_replace('{count_images}', Image::count(), $dis);
		$dis = str_replace('{count_videos}', Video::count(), $dis);
		return $dis;
	}

	function cleanLink($url)
	{
		$url = urlencode($url);
		$url = str_replace('+', '-', $url);
		$url = preg_replace('/-+/', '-', $url);
		return strtolower($url);
	}

	function postSortFunction($x, $y)
	{
		return strcmp($x->$GLOBALS['postSortFunction_field'], $y->$GLOBALS['postSortFunction_field']) > 0;
	}

	function postSort($values, $field)
	{
		$GLOBALS['postSortFunction_field'] = $field;
		uasort($values, 'postSortFunction');
		unset($GLOBALS['postSortFunction_field']);
		return $values;
	}

	function generateGalleryTree($id)
	{
		$GLOBALS['hierarchy'] = Gallery::getHierarchy($id);
		$html = browseGalleryTree(0);
		unset($GLOBALS['hierarchy']);
		return $html;
	}

	function browseGalleryTree($i)
	{
		$hierarchy = $GLOBALS['hierarchy'];

		$id = $hierarchy[$i];

		$dir = '<ul class="galleryTree">';

		if ($id == '0')
			$galleries = Gallery::search(array(array('gallery_id', NULL)));
		else
			$galleries = Gallery::search(array(array('gallery_id', $id)));
		$galleries = postSort($galleries, 'name');

		foreach ($galleries as $gal)
		{
			if (isset($hierarchy[$i+1]) && $gal->id === $hierarchy[$i+1])
				$dir .= '<li class="directory collapsed"><a href="/gallery/' . $gal->id . '/' . cleanLink($gal->name) . '" class="active">' . $gal->name . '</a>' . browseGalleryTree($i + 1) . '</li>';
			else
				$dir .= '<li class="directory collapsed"><a href="/gallery/' . $gal->id . '/' . cleanLink($gal->name) . '">' . $gal->name . '</a></li>';
		}
		$dir .= '</ul>';
		return $dir;
	}

	function listGalleryTree($id)
	{
		$galleries = Gallery::search(array(array('gallery_id', $id)));
		$galleries = postSort($galleries, 'name');
		$html = '<ul class="galleryTree" id="galleryTree' . (!is_null($id) ? $id . '" style="display: none' : 0) . '">';

		foreach ($galleries as $gal)
		{
			$html .= '<li class="directory collapsed' . ($gal->has_images ? ' hasImages' : '') . '"><a id="linkToGallery' . $gal->id . '" href="javascript:;" onclick="selectGallery(' . $gal->id . ')">' . $gal->name . '</a></li>';
		}
		$html .= '</ul>';
		return $html;
	}

	function translate($string)
	{
		global $dico;
		if (isset($dico[$string]))
			return $dico[$string];
		return $string;
	}

	if (!function_exists('json_decode'))
	{
		function json_decode($content, $assoc=false)
		{
			if ($assoc)
				$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
			else
				$json = new Services_JSON;
			return $json->decode($content);
		}
	}

	if (!function_exists('json_encode'))
	{
		function json_encode($content)
		{
			$json = new Services_JSON;
			return $json->encode($content);
		}
	}

	function isUsernameValid($login)
	{
		return preg_match('/^[a-zA-Z0-9_\- ]+$/', $login);
	}

	function isEmailValid($email)
	{
		return preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email);
	}

	function extractPhotosFromZip($zipFile, $sourceDir, $destDir, &$files = array())
	{
		$zip = new PclZip($sourceDir . $zipFile);
		$zip->extract(PCLZIP_OPT_PATH, $sourceDir);

		$list = $zip->listContent();
		foreach ($list as $item)
			$files []= $item['filename'];
	}

	function isTitleValid($title)
	{
		return strpos($title, '"') === false;
	}
	
	function echoHTMLHead()
	{
		echo <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/site.css.php" rel="stylesheet" type="text/css" />
    <title>Jaime Ray Newman fansite by arteau - Page d'accueil - BIENVENUE !!!</title>
    <script src="/js/jquery-1.3.2.min.js" type="text/javascript"></script>
</head>
HTML;
	}
	
	function echoFooter()
	{
		echo <<<HTML
<div id="footer">
      
</div>
HTML;
	}
?>