<?php
/**
 * Description of _Liens
 *
 * @author arteau
 */

$GLOBALS["classes"]["Liens"] = array("classname" => "_Liens", "tablename" => "fan_liens");

class _Liens extends ArtObject
{
	protected $_data = array('id' => null, 'url' => null, 'texte_alt' => null, 'image' => null, 'text' => null);

	protected $_editedFields = array();

	/**
	 * @return Liens
	 */
	public static function find($id)
	{
		return parent::find("Liens", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Liens", array(), $order);
	}

	/**
	 * @return Liens
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Liens", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Liens", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Liens");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Liens", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Liens");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Liens", $field, $value, $id);
	}
}
