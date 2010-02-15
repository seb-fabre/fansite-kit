<?php
class _Gallery
{
	protected $_data = array('id' => null, 'name' => null, 'date' => null, 'views' => null, 'user_id' => null, 'gallery_id' => null, 'has_images' => null);

	protected $_editedFields = array();

	public function __construct($values = array())
	{
		if ($values)
		foreach ($values as $key => $value)
		{
			if (array_key_exists($key, $this->_data))
				$this->_data[$key] = $value;
		}
	}

	/**
	 * @return Gallery
	 */
	public static function find($id)
	{
		if (!$id)
			return false;

		$req = mysql_query('SELECT * FROM gallery WHERE id=' . $id) or die(mysql_error());
		if (mysql_num_rows($req) != 0)
			return new Gallery(mysql_fetch_array($req));
		return false;
	}

	/**
	 * @return array
	 */
	public static function getAll($order='name ASC')
	{
		return Gallery::search(array(), $order);
	}

	/**
	 * @return Gallery
	 */
	public static function findBy($field, $value)
	{
		$req = mysql_query('SELECT * FROM gallery WHERE ' . $field . ' LIKE "' . $value . '"') or die(mysql_error());
		if (mysql_num_rows($req) != 0)
			return new Gallery(mysql_fetch_array($req));
		return false;
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		$results = array();

		if (!$onlyCount)
			$query = "SELECT * FROM gallery";
		else
			$query = "SELECT COUNT(1) AS count FROM gallery";

		if (count($criteria) != 0)
		{
			$query .= " WHERE ";
			$glu = "";
			foreach ($criteria as $criterion)
			{
				if (!isset($criterion[2]))
					$criterion[2] = "=";
				if ($criterion[1] !== NULL)
					$query .= $glu . $criterion[0]	. $criterion[2] . '"' . mysql_escape_string($criterion[1]) . "\" ";
				else
					$query .= $glu . $criterion[0]	. " IS NULL ";
				$glu = "AND ";
			}
		}

		if ($onlyCount)
		{
			$query = mysql_query($query);
			$res = mysql_fetch_array($query);
			return $res["count"];
		}

		if ($order != "")
			$query .= " ORDER BY " . $order;
		if ($limit)
			$query .= " LIMIT " . $limit;

		$req = mysql_query($query);
		while ($res = mysql_fetch_array($req))
			$results [$res['id']] = new Gallery($res);

		return $results;
	}

	public function __get($key)
	{
		if (array_key_exists($key, $this->_data))
		{
			$j = @json_decode($this->_data[$key], true);
			if ($j !== false && is_array($j) && isset($j[$_SESSION["l"]]))
				return utf8_encode($j[$_SESSION["l"]]);
			else
				return utf8_encode($this->_data[$key]);
		}
		return false;
	}

	public function __set($key, $value)
	{
		if (array_key_exists($key, $this->_data))
			if ($this->_data[$key] != $value)
			{
				$this->_editedFields []= $key;
				$this->_data[$key] = $value;
			}
	}

	public function save()
	{
		unset($this->_editedFields['id']);

		if (count($this->_editedFields) == 0)
			return;

		if ($this->_data['id'])
		{
			$query = 'UPDATE gallery SET ';

			$glu = '';
			foreach ($this->_editedFields as $field)
			{
				$query .= $glu . $field . '="' . addslashes($this->_data[$field]) . '"';
				$glu = ', ';
			}
			$query .= ' WHERE id=' . $this->id;
		}
		else
		{
			$query = 'INSERT INTO gallery(';
			$glu = '';
			foreach ($this->_editedFields as $field)
			{
				$query .= $glu . $field;
				$glu = ', ';
			}
			$query .= ') VALUES("';
			$glu = '';
			foreach ($this->_editedFields as $field)
			{
				$query .= $glu . addslashes($this->_data[$field]);
				$glu = '", "';
			}
			$query .= '")';
		}
		mysql_query($query) or die (mysql_error());

		$id = mysql_insert_id();
		$this->_editedFields = array();
		$new = Gallery::find($id);
		$data = $new->toArray();
		$this->_data = $data;
		foreach ($data as $key => $value)
			$this->$key = $value;
	}

	/**
	 * @return int
	 */
	public static function count()
	{
		return Gallery::search(array(), "", 1, true);
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return $this->_data;
	}

	public function delete()
	{
		mysql_query("DELETE FROM gallery WHERE id=" . $this->id);
	}

	/**
	 * @return Gallery
	 */
	public function getGallery()
	{
		return Gallery::find($this->gallery_id);
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return User::find($this->user_id);
	}

	/**
	 * @return array
	 */
	public function getGallerys()
	{
		return Gallery::search(array(array("gallery_id", $this->id)));
	}

	/**
	 * @return array
	 */
	public function getImages()
	{
		return Image::search(array(array("gallery_id", $this->id)));
	}
}
?>