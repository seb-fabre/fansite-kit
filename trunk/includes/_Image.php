<?php
/**
 * Description of _Image
 *
 * @author arteau
 */

$GLOBALS["classes"]["Image"] = array("classname" => "_Image", "tablename" => "fan_image");

class _Image extends ArtObject
{
	protected $_data = array('id' => null, 'name' => null, 'fan_gallery_id' => null, 'views' => null, 'date' => null, 'fan_user_id' => null, 'totalnotes' => null, 'totalvotes' => null);

	protected $_editedFields = array();

	/**
	 * @return Image
	 */
	public static function find($id)
	{
		return parent::find("Image", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Image", array(), $order);
	}

	/**
	 * @return Image
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Image", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Image", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Image");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Image", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Image");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Image", $field, $value, $id);
	}

	/**
	 * @return array
	 */
	public function getCommentsphotos()
	{
		return Commentsphoto::search(array(array("fan_image_id", $this->id)));
	}
}
