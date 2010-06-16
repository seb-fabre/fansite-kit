<?php
/**
 * Description of _SpamComm
 *
 * @author arteau
 */

$GLOBALS["classes"]["SpamComm"] = array("classname" => "_SpamComm", "tablename" => "fan_spam_comm");

class _SpamComm extends ArtObject
{
	protected $_fields = array('texte');

	protected $_editedFields = array();

	/**
	 * @return SpamComm
	 */
	public static function find($id)
	{
		return parent::find("SpamComm", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("SpamComm", array(), $order);
	}

	/**
	 * @return SpamComm
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("SpamComm", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("SpamComm", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("SpamComm");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("SpamComm", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("SpamComm");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("SpamComm", $field, $value, $id);
	}
}
