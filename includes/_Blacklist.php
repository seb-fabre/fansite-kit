<?php
/**
 * Description of _Blacklist
 *
 * @author arteau
 */

$GLOBALS["classes"]["Blacklist"] = array("classname" => "_Blacklist", "tablename" => "fan_blacklist");

class _Blacklist extends ArtObject
{
	protected $_fields = array('email');

	protected $_editedFields = array();

	/**
	 * @return Blacklist
	 */
	public static function find($id)
	{
		return parent::find("Blacklist", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Blacklist", array(), $order);
	}

	/**
	 * @return Blacklist
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Blacklist", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Blacklist", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Blacklist");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Blacklist", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Blacklist");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Blacklist", $field, $value, $id);
	}
}
