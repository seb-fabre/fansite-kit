<?php
/**
 * Description of _Params
 *
 * @author arteau
 */

$GLOBALS["classes"]["Params"] = array("classname" => "_Params", "tablename" => "fan_params");

class _Params extends ArtObject
{
	protected $_fields = array('id', 'name', 'value');

	protected $_editedFields = array();

	/**
	 * @return Params
	 */
	public static function find($id)
	{
		return parent::find("Params", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Params", array(), $order);
	}

	/**
	 * @return Params
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Params", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Params", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Params");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Params", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Params");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Params", $field, $value, $id);
	}
}
