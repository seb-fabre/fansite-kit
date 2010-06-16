<?php
/**
 * Description of _Translation
 *
 * @author arteau
 */

$GLOBALS["classes"]["Translation"] = array("classname" => "_Translation", "tablename" => "fan_translation");

class _Translation extends ArtObject
{
	protected $_fields = array('id', 'context_id', 'context_classname', 'context_field', 'translated_str');

	protected $_editedFields = array();

	/**
	 * @return Translation
	 */
	public static function find($id)
	{
		return parent::find("Translation", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("Translation", array(), $order);
	}

	/**
	 * @return Translation
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("Translation", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("Translation", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("Translation");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("Translation", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("Translation");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("Translation", $field, $value, $id);
	}
}
