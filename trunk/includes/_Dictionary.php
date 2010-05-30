<?php
/**
 * Description of _Dictionary
 *
 * @author arteau
 */

$GLOBALS["classes"]["Dictionary"] = array("classname" => "_Dictionary", "tablename" => "fan_dictionary");

class _Dictionary extends ArtObject
{
	protected $_data = array('id' => null, 'language' => null, 'data' => null);

	protected $_editedFields = array();

	/**
	 * @return Dictionary
	 */
	public static function find($id)
	{
		return parent::find("Dictionary", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Dictionary", array(), $order);
	}

	/**
	 * @return Dictionary
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Dictionary", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Dictionary", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Dictionary");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Dictionary", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Dictionary");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Dictionary", $field, $value, $id);
	}
}
