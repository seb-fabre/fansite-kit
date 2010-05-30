<?php
/**
 * Description of _Video
 *
 * @author arteau
 */

$GLOBALS["classes"]["Video"] = array("classname" => "_Video", "tablename" => "fan_video");

class _Video extends ArtObject
{
	protected $_data = array('id' => null, 'name' => null, 'date' => null, 'fan_user_id' => null, 'resolution' => null, 'duree' => null, 'description' => null, 'views' => null, 'totalnotes' => null, 'totalvotes' => null, 'extras' => null, 'category' => null);

	protected $_editedFields = array();

	/**
	 * @return Video
	 */
	public static function find($id)
	{
		return parent::find("Video", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Video", array(), $order);
	}

	/**
	 * @return Video
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Video", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Video", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Video");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Video", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Video");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Video", $field, $value, $id);
	}
}
