<?php
/**
 * Description of _News
 *
 * @author arteau
 */

$GLOBALS["classes"]["News"] = array("classname" => "_News", "tablename" => "fan_news");

class _News extends ArtObject
{
	protected $_fields = array('id', 'date', 'fan_user_id');

	protected $_editedFields = array();

	/**
	 * @return News
	 */
	public static function find($id)
	{
		return parent::find("News", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order='')
	{
		return parent::search("News", array(), $order);
	}

	/**
	 * @return News
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("News", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("News", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("News");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("News", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("News");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("News", $field, $value, $id);
	}
}
