<?php
/**
 * Description of _Gallery
 *
 * @author arteau
 */

$GLOBALS["classes"]["Gallery"] = array("classname" => "_Gallery", "tablename" => "fan_gallery");

class _Gallery extends ArtObject
{
	protected $_fields = array('id', 'name', 'date', 'views', 'fan_user_id', 'fan_gallery_id', 'has_images');

	protected $_editedFields = array();

	/**
	 * @return Gallery
	 */
	public static function find($id)
	{
		return parent::find("Gallery", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Gallery", array(), $order);
	}

	/**
	 * @return Gallery
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Gallery", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Gallery", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Gallery");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Gallery", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Gallery");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Gallery", $field, $value, $id);
	}

	/**
	 * @return Gallery
	 */
	public function getGallery()
	{
		return Gallery::find($this->fan_gallery_id);
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return User::find($this->fan_user_id);
	}

	/**
	 * @return array
	 */
	public function getGallerys()
	{
		return Gallery::search(array(array("fan_gallery_id", $this->id)));
	}

	/**
	 * @return array
	 */
	public function getImages()
	{
		return Image::search(array(array("fan_gallery_id", $this->id)));
	}
}
