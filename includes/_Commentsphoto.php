<?php
/**
 * Description of _Commentsphoto
 *
 * @author arteau
 */

$GLOBALS["classes"]["Commentsphoto"] = array("classname" => "_Commentsphoto", "tablename" => "fan_commentsphoto");

class _Commentsphoto extends ArtObject
{
	protected $_data = array('id' => null, 'comment' => null, 'fan_user_id' => null, 'fan_image_id' => null, 'date' => null);

	protected $_editedFields = array();

	/**
	 * @return Commentsphoto
	 */
	public static function find($id)
	{
		return parent::find("Commentsphoto", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Commentsphoto", array(), $order);
	}

	/**
	 * @return Commentsphoto
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Commentsphoto", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Commentsphoto", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Commentsphoto");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Commentsphoto", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Commentsphoto");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Commentsphoto", $field, $value, $id);
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return User::find($this->fan_user_id);
	}

	/**
	 * @return Image
	 */
	public function getImage()
	{
		return Image::find($this->fan_image_id);
	}
}
