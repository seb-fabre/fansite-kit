<?php
/**
 * Description of Image
 *
 * @author arteau
 */

$GLOBALS["classes"]["Image"] = array("classname" => "Image", "tablename" => "fan_image");
	
class Image extends _Image
{
	function getBigUrl()
  {
		$filename = 'photos/' . $this->gallery_id . '/' . $this->name;

		if (file_exists($GLOBALS['ROOTPATH'] . $filename))
			return APPLICATION_URL . $url;

		return EMPTY_IMAGE_URL;
  }

  function getMediumUrl()
  {
		$filename = 'photos/' . $this->gallery_id . '/normal_' . $this->name;

		if (file_exists($GLOBALS['ROOTPATH'] . $filename))
			return APPLICATION_URL . $url;

		return EMPTY_IMAGE_URL;
  }

  function getSmallUrl()
  {
		$filename = 'photos/' . $this->gallery_id . '/thumb_' . $this->name;

		if (file_exists($GLOBALS['ROOTPATH'] . $filename))
			return APPLICATION_URL . $url;

		return EMPTY_IMAGE_URL;
  }
}
	