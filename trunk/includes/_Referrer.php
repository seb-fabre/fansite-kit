<?php
/**
 * Description of _Referrer
 *
 * @author arteau
 */

$GLOBALS["classes"]["Referrer"] = array("classname" => "_Referrer", "tablename" => "fan_referrer");

class _Referrer extends ArtObject
{
	protected $_fields = array('url', 'cpt');

	protected $_editedFields = array();

	/**
	 * @return Referrer
	 */
	public static function find($id)
	{
		return parent::find("Referrer", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Referrer", array(), $order);
	}

	/**
	 * @return Referrer
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Referrer", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Referrer", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Referrer");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Referrer", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Referrer");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Referrer", $field, $value, $id);
	}
}
