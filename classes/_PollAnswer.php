<?php 
class _PollAnswer
{
	private $_data = array('id' => null, 'value' => null, 'free' => null);
	
	private $_editedFields = array();
	
	public function __construct($values = array())
	{
		if ($values)
		foreach ($values as $key => $value)
		{
			if (array_key_exists($key, $this->_data))
				$this->_data[$key] = $value;
		}
	}
	
	public static function find($id)
	{
		if (!$id)
			return false;
		
		$req = mysql_query('SELECT * FROM poll_answer WHERE id=' . $id) or die(mysql_error());
		if (mysql_num_rows($req) != 0)
			return new PollAnswer(mysql_fetch_array($req));
		return false;
	}
	
	public static function getAll($order='name ASC')
	{
		return PollAnswer::search();
	}
	
	public static function findBy($field, $value)
	{
		$req = mysql_query('SELECT * FROM poll_answer WHERE ' . $field . ' LIKE "' . $value . '"') or die(mysql_error());
		if (mysql_num_rows($req) != 0)
			return new PollAnswer(mysql_fetch_array($req));
		return false;
	}
	
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		$results = array();
		
		if (!$onlyCount)
			$query = "SELECT * FROM poll_answer";
		else
			$query = "SELECT COUNT(1) AS count FROM poll_answer";
		
		if (count($criteria) != 0)
		{
			$query .= " WHERE ";
			$glu = "";
			foreach ($criteria as $criterion)
			{
				if (count($criterion) == 2)
					$criterion[2] = "=";
				if ($criterion[1] !== NULL)
					$query .= $glu . $criterion[0]	. $criterion[2] . $criterion[1] . " ";
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
			$results [$res['id']] = new PollAnswer($res);
		
		return $results;
	}
	
	public function __get($key)
	{
		if (array_key_exists($key, $this->_data))
			return $this->_data[$key];
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
			$query = 'UPDATE poll_answer SET ';
			
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
			$query = 'INSERT INTO poll_answer(';
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
	}
	
	public static function count()
	{
		return PollAnswer::search(array(), "", 1, true);
	}
	
	public function delete()
	{
		mysql_query("DELETE FROM poll_answer WHERE id=" . $this->id);
	}
}
