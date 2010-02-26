<?php
	$conn = mysql_connect('localhost', 'root', '');
	$DB = 'lucy';

	set_time_limit(0);

	$prefixLength = 0;

	mysql_select_db('information_schema', $conn) or die (mysql_error());

	$queryFK = mysql_query("SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME, TABLE_CONSTRAINTS.TABLE_NAME
  	                      FROM TABLE_CONSTRAINTS, KEY_COLUMN_USAGE
  	                      WHERE TABLE_CONSTRAINTS.CONSTRAINT_NAME=KEY_COLUMN_USAGE.CONSTRAINT_NAME
  	                      AND constraint_type='FOREIGN KEY'
  	                      AND TABLE_CONSTRAINTS.TABLE_SCHEMA='" . $DB . "'") or die (mysql_error());

	$foreignKeys = array();
	$invertForeignKeys = array();
	while ($res = mysql_fetch_array($queryFK))
	{
		$foreignKeys[$res['TABLE_NAME']][$res['COLUMN_NAME']] = array('table' => $res['REFERENCED_TABLE_NAME'], 'column' => $res['REFERENCED_COLUMN_NAME']);
		$invertForeignKeys[$res['REFERENCED_TABLE_NAME']] []= array($res['REFERENCED_COLUMN_NAME'] => array('table' => $res['TABLE_NAME'], 'column' => $res['COLUMN_NAME']));
	}

	mysql_select_db($DB, $conn);

	$_includes = fopen('__includes.php', 'w+');
	fwrite($_includes, '<?php
if (isset($_POST["path"]))
	$relativePath = $_POST["path"];
else
	$relativePath = "./";
');

	$req = mysql_query('SHOW TABLES;', $conn);

	while ($res = mysql_fetch_array($req))
	{
		$capitalized = str_replace(' ', '', ucwords(str_replace('_', ' ', substr($res[0], $prefixLength))));

		$file = fopen('_' . $capitalized . '.php', 'w+');

		fwrite($file, '<?php
class _' . $capitalized . '
{
');
		$fields = array();

		$q = mysql_query('SHOW COLUMNS FROM ' . $res[0] . ';', $conn);
		while ($r = mysql_fetch_array($q))
		{
			$fields []= $r[0];
			if (substr($r[0], 0, $prefixLength) != 'pr_')
				$n = str_replace(' ', '', ucwords(str_replace('_', ' ', $r[0])));
			else
				$n = str_replace(' ', '', ucwords(str_replace('_', ' ', substr($r[0], $prefixLength))));
		}
		fwrite($file, '	protected $_data = array(\'' . implode("' => null, '", $fields) . '\' => null);

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
	 * @return ' . $capitalized . '
	 */
	public static function find($id)
	{
		if (!$id)
			return false;

		$req = mysql_query(\'SELECT * FROM ' . $res[0] . ' WHERE id=\' . $id) or die(mysql_error());
		if (mysql_num_rows($req) != 0)
			return new ' . $capitalized . '(mysql_fetch_array($req));
		return false;
	}

	/**
	 * @return array
	 */
	public static function getAll($order=\'\')
	{
		return ' . $capitalized . '::search(array(), $order);
	}

	/**
	 * @return ' . $capitalized . '
	 */
	public static function findBy($field, $value)
	{
		$req = mysql_query(\'SELECT * FROM ' . $res[0] . ' WHERE \' . $field . \' LIKE "\' . $value . \'"\') or die(mysql_error());
		if (mysql_num_rows($req) != 0)
			return new ' . $capitalized . '(mysql_fetch_array($req));
		return false;
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		$results = array();

		if (!$onlyCount)
			$query = "SELECT * FROM ' . $res[0] . '";
		else
			$query = "SELECT COUNT(1) AS count FROM ' . $res[0] . '";

		if (count($criteria) != 0)
		{
			$query .= " WHERE ";
			$glu = "";
			foreach ($criteria as $criterion)
			{
				if (!isset($criterion[2]))
					$criterion[2] = "=";
				if ($criterion[1] !== NULL)
					$query .= $glu . $criterion[0]	. $criterion[2] . \'"\' . mysql_escape_string($criterion[1]) . "\" ";
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
			$results [$res[\'id\']] = new ' . $capitalized . '($res);

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
		unset($this->_editedFields[\'id\']);

		if (count($this->_editedFields) == 0)
			return;

		if ($this->_data[\'id\'])
		{
			$query = \'UPDATE ' . $res[0] . ' SET \';

			$glu = \'\';
			foreach ($this->_editedFields as $field)
			{
				$query .= $glu . $field . \'="\' . addslashes($this->_data[$field]) . \'"\';
				$glu = \', \';
			}
			$query .= \' WHERE id=\' . $this->id;
		}
		else
		{
			$query = \'INSERT INTO ' . $res[0] . '(\';
			$glu = \'\';
			foreach ($this->_editedFields as $field)
			{
				$query .= $glu . $field;
				$glu = \', \';
			}
			$query .= \') VALUES("\';
			$glu = \'\';
			foreach ($this->_editedFields as $field)
			{
				$query .= $glu . addslashes($this->_data[$field]);
				$glu = \'", "\';
			}
			$query .= \'")\';
		}
		mysql_query($query) or die (mysql_error());

		$id = mysql_insert_id();
		$this->_editedFields = array();
		$new = ' . $capitalized . '::find($id);
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
		return ' . $capitalized . '::search(array(), "", 1, true);
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
		mysql_query("DELETE FROM ' . $res[0] . ' WHERE id=" . $this->id);
	}
');
		if (isset($foreignKeys[$res[0]]))
		foreach ($foreignKeys[$res[0]] as $foreignKey => $infos)
		{
			$cap = str_replace(' ', '', ucwords(str_replace('_', ' ', substr($infos['table'], $prefixLength))));
			$capName = str_replace(' ', '', ucwords(str_replace('_', ' ', substr($foreignKey, $prefixLength, -3))));
			fwrite($file, '
	/**
	 * @return ' . $cap . '
	 */
	public function get' . $capName . '()
	{
		return ' . $cap . '::find($this->' . $foreignKey . ');
	}
');
		}
		if (isset($invertForeignKeys[$res[0]]))
		foreach ($invertForeignKeys[$res[0]] as $foreignKeys)
		foreach ($foreignKeys as $foreignKey => $infos)
		{
			$cap = str_replace(' ', '', ucwords(str_replace('_', ' ', substr($infos['table'], $prefixLength))));
			$capName = str_replace(' ', '', ucwords(str_replace('_', ' ', substr($foreignKey, $prefixLength, -3))));
			fwrite($file, '
	/**
	 * @return array
	 */
	public function get' . $cap . 's()
	{
		return ' . $cap . '::search(array(array("' . $infos['column'] . '", $this->' . $foreignKey . ')));
	}
');
		}

		fwrite($file, '}
?>');
		fclose($file);

		echo '<code><pre>' . htmlentities(file_get_contents($capitalized . '.php')) . '</pre></code>';

		fwrite($_includes, 'require_once($relativePath . "_' . $capitalized . '.php");' . "\n");

		if (!file_exists($capitalized . '.php'))
		{
			$file = fopen($capitalized . '.php', 'w+');

			fwrite($file, '<?php
	class ' . $capitalized . ' extends _' . $capitalized . '
	{
	');

			fwrite($file, '}
	?>');

			fclose($file);

			echo '<code><pre>' . htmlentities(file_get_contents($capitalized . '.php')) . '</pre></code>';
		}

		fwrite($_includes, 'require_once($relativePath . "' . $capitalized . '.php");' . "\n");
	}
	fwrite($_includes, '?>');
	fclose($_includes);
?>