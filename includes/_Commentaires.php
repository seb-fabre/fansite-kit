<?php
/**
 * Description of _Commentaires
 *
 * @author arteau
 */

$GLOBALS["classes"]["Commentaires"] = array("classname" => "_Commentaires", "tablename" => "fan_commentaires");

class _Commentaires extends ArtObject
{
	protected $_fields = array('id', 'date', 'pseudo', 'email', 'comment', 'response');

	protected $_editedFields = array();

	/**
	 * @return Commentaires
	 */
	public static function find($id)
	{
		return parent::find("Commentaires", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Commentaires", array(), $order);
	}

	/**
	 * @return Commentaires
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Commentaires", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Commentaires", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Commentaires");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Commentaires", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Commentaires");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Commentaires", $field, $value, $id);
	}
}
