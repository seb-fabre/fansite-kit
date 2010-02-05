<?php
class Tools
{
	/**
	 * Returns the disclaimer displayed on the home page
	 *
	 * @return string
	 */
	static function getDisclaimer()
	{
		$dis = Tools::translate('disclaimer');
		$dis = str_replace('{count_images}', Image::count(), $dis);
		$dis = str_replace('{count_videos}', Video::count(), $dis);
		return $dis;
	}

	/**
	 * Remove all bad characters from an url or encode it
	 *
	 * @param string $url
	 * @return string
	 */
	static function cleanLink($url)
	{
		$url = urlencode($url);
		$url = str_replace('+', '-', $url);
		$url = preg_replace('/-+/', '-', $url);
		return strtolower($url);
	}

	static function postSortFunction($x, $y)
	{
		return strcmp($x->$GLOBALS['postSortFunction_field'], $y->$GLOBALS['postSortFunction_field']) > 0;
	}

	/**
	 * Function called after sorting arrays
	 *
	 * @param array $values
	 * @param string $field
	 * @return array
	 */
	static function postSort($values, $field)
	{
		$GLOBALS['postSortFunction_field'] = $field;
		uasort($values, 'postSortFunction');
		unset($GLOBALS['postSortFunction_field']);
		return $values;
	}

	/**
	 * Initialization function to browse the hierarchy of galleries
	 *
	 * @param int $id
	 * @return string the html code of the gallery tree
	 */
	static function generateGalleryTree($id)
	{
		$GLOBALS['hierarchy'] = Gallery::getHierarchy($id);
		$html = Tools::browseGalleryTree(0);
		unset($GLOBALS['hierarchy']);
		return $html;
	}

	/**
	 * Recursive function to browse the hierarchy of galleries
	 *
	 * @param int $i the id of the parent gallery where to start browsing
	 * @return string the html code of the gallery tree
	 */
	static function browseGalleryTree($i)
	{
		$hierarchy = $GLOBALS['hierarchy'];

		$id = $hierarchy[$i];

		$dir = '<ul class="galleryTree">';

		if ($id == '0')
			$galleries = Gallery::search(array(array('gallery_id', NULL)));
		else
			$galleries = Gallery::search(array(array('gallery_id', $id)));
		$galleries = Tools::postSort($galleries, 'name');

		foreach ($galleries as $gal)
		{
			if (isset($hierarchy[$i+1]) && $gal->id === $hierarchy[$i+1])
				$dir .= '<li class="directory collapsed"><a href="/gallery/' . $gal->id . '/' . Tools::cleanLink($gal->name) . '" class="active">' . $gal->name . '</a>' . Tools::browseGalleryTree($i + 1) . '</li>';
			else
				$dir .= '<li class="directory collapsed"><a href="/gallery/' . $gal->id . '/' . Tools::cleanLink($gal->name) . '">' . $gal->name . '</a></li>';
		}
		$dir .= '</ul>';
		return $dir;
	}

	/**
	 * Generate the hierarchy of children galleries of a given gallery
	 *
	 * @param int $id the id of the parent gallery
	 * @return string the html code of the gallery tree
	 */
	static function listGalleryTree($id)
	{
		$galleries = Gallery::search(array(array('gallery_id', $id)));
		$galleries = Tools::postSort($galleries, 'name');
		$html = '<ul class="galleryTree" id="galleryTree' . (!is_null($id) ? $id . '" style="display: none' : 0) . '">';

		foreach ($galleries as $gal)
		{
			$html .= '<li class="directory collapsed' . ($gal->has_images ? ' hasImages' : '') . '"><a id="linkToGallery' . $gal->id . '" href="javascript:;" onclick="selectGallery(' . $gal->id . ')">' . $gal->name . '</a></li>';
		}
		$html .= '</ul>';
		return $html;
	}

	/**
	 * Returns the translation of a string, if it exists
	 * if no translation found, return the original string
	 *
	 * @param string $string
	 * @return string
	 */
	static function translate($string)
	{
		global $dico;
		if (isset($dico[$string]))
			return $dico[$string];
		return $string;
	}


	/**
	 * Returns true if the parameter is a valid username
	 *
	 * @param string $login
	 * @return boolean
	 */
	static function isUsernameValid($login)
	{
		return preg_match('/^[a-zA-Z0-9_\- ]+$/', $login);
	}


	/**
	 * Returns true if the parameter is a valid email
	 *
	 * @param string $email
	 * @return boolean
	 */
	static function isEmailValid($email)
	{
		return preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email);
	}

	/**
	 * Extract photos from a zip archive
	 *
	 * @param string $zipFile
	 * @param strig $sourceDir
	 * @param string $destDir
	 * @param array $files
	 */
	static function extractPhotosFromZip($zipFile, $sourceDir, $destDir, &$files = array())
	{
		$zip = new PclZip($sourceDir . $zipFile);
		$zip->extract(PCLZIP_OPT_PATH, $sourceDir);

		$list = $zip->listContent();
		foreach ($list as $item)
			$files []= $item['filename'];
	}

	/**
	 * Returns true if the parameter is a valid title
	 *
	 * @param string $title
	 * @return boolean
	 */
	static function isTitleValid($title)
	{
		return strpos($title, '"') === false;
	}

	/**
	 * Print the html head (<head>, <title>, <metas>...)
	 *
	 * @param string $title
	 */
	static function echoHTMLHead($title, $additionalHtml=array())
	{
		$additionalJs = '';
		$additionalCss = '';
		$additionalMetas = '';

		if (isset($additionalHtml['js']))
			foreach ($additionalHtml['js'] as $file)
			{
				$additionalJs .= '<script src="' . APPLICATION_URL . $file . '" type="text/javascript"></script>';
			}

		if (isset($additionalHtml['css']))
			foreach ($additionalHtml['css'] as $file)
			{
				$additionalCss .= '<link href="' . APPLICATION_URL . $file . '" rel="stylesheet" type="text/css" />';
			}

		if (isset($additionalHtml['meta']))
			foreach ($additionalHtml['meta'] as $httpEquiv => $content)
			{
				$additionalMetas .= '<meta http-equiv="' . $httpEquiv . '" content="' . $content . '" />';
			}


		echo <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/css/site.css.php" rel="stylesheet" type="text/css" />
    <title>$title</title>
    <script src="/js/jquery-1.3.2.min.js" type="text/javascript"></script>

    $additionalCss
    $additionalJs
    $additionalMetas
</head>
HTML;
	}

	/**
	 * Print the html footer
	 *
	 */
	static function echoFooter()
	{
		echo <<<HTML
<div id="footer">

</div>
HTML;
	}

	/**
	 * Reindex an array, using a field as keys
	 *
	 * @param array $values the array of values to reindex
	 * @param string $field the field to reindex by
	 * @return array
	 */
	static function reindexBy($values, $field)
	{
		$tmp = array();
		foreach ($values as $value)
		{
			if (isset($value[$field]))
				$tmp[$value[$field]] = $value;
			else
				$tmp []= $value;
		}
		return $tmp;
	}
}

/**
 * Define function json_decode if the json module is disabled
 */
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

/**
 * Define function json_decode if the json module is disabled
 */
if (!function_exists('json_encode'))
{
	function json_encode($content)
	{
		$json = new Services_JSON;
		return $json->encode($content);
	}
}
?>