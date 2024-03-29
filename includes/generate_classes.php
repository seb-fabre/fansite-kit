<?php
	$GLOBALS['ROOTPATH'] = str_replace('includes/' . basename(__FILE__), '', str_replace('\\', '/', __FILE__));

	$_GET['quick_init'] = 1;

	require_once($GLOBALS['ROOTPATH'] . 'includes/_init.php');

	$conn = mysql_connect($GLOBALS['conf']['mysql_host'], $GLOBALS['conf']['mysql_login'], $GLOBALS['conf']['mysql_password']);
	$DB = $GLOBALS['conf']['mysql_database'];

	set_time_limit(0);

	$prefixLength = 4;

	mysql_select_db('information_schema', $conn) or die (mysql_error());

	$queryFK = @mysql_query("SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME, TABLE_CONSTRAINTS.TABLE_NAME
  	                      FROM TABLE_CONSTRAINTS, KEY_COLUMN_USAGE
  	                      WHERE TABLE_CONSTRAINTS.CONSTRAINT_NAME=KEY_COLUMN_USAGE.CONSTRAINT_NAME
  	                      AND constraint_type='FOREIGN KEY'
  	                      AND TABLE_CONSTRAINTS.TABLE_SCHEMA='" . $DB . "'");

	$foreignKeys = array();
	$invertForeignKeys = array();
	if ($queryFK)
	{
		while ($res = mysql_fetch_array($queryFK))
		{
			$foreignKeys[$res['TABLE_NAME']][$res['COLUMN_NAME']] = array('table' => $res['REFERENCED_TABLE_NAME'], 'column' => $res['REFERENCED_COLUMN_NAME']);
			$invertForeignKeys[$res['REFERENCED_TABLE_NAME']] []= array($res['REFERENCED_COLUMN_NAME'] => array('table' => $res['TABLE_NAME'], 'column' => $res['COLUMN_NAME']));
		}
	}

	mysql_select_db($DB, $conn);

	$_includes = fopen($GLOBALS['ROOTPATH'] . 'includes/__classes.php', 'w+');
	fwrite($_includes, '<?php
if (!empty($GLOBALS["ROOTPATH"]))
	$relativePath = $GLOBALS["ROOTPATH"] . "includes/";
else
	$relativePath = "./";
');
	fwrite($_includes, 'require_once($relativePath . "ArtObject.php");' . "\n");

	$req = mysql_query('SHOW TABLES;', $conn);

	while ($res = mysql_fetch_array($req))
	{
		$capitalized = str_replace(' ', '', ucwords(str_replace('_', ' ', substr($res[0], $prefixLength))));

		$file = fopen($GLOBALS['ROOTPATH'] . 'includes/_' . $capitalized . '.php', 'w+');

		fwrite($file, '<?php
/**
 * Description of _' . $capitalized . '
 *
 * @author arteau
 */

$GLOBALS["classes"]["' . $capitalized . '"] = array("classname" => "_' . $capitalized . '", "tablename" => "' . $res[0] . '");

class _' . $capitalized . ' extends ArtObject
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

		fwrite($file, '	protected $_fields = array(\'' . implode("', '", $fields) . '\');

	protected $_editedFields = array();

	/**
	 * @return ' . $capitalized . '
	 */
	public static function find($id)
	{
		return parent::find("' . $capitalized . '", $id);
	}

	/**
	 * @return array
	 */
	public static function getAll($order=\'\')
	{
		return parent::search("' . $capitalized . '", array(), $order);
	}

	/**
	 * @return ' . $capitalized . '
	 */
	public static function findBy($field, $value)
	{
		return parent::findBy("' . $capitalized . '", $field, $value);
	}

	/**
	 * @return array
	 */
	public static function search($criteria = array(), $order="", $limit=false, $onlyCount=false)
	{
		return parent::search("' . $capitalized . '", $criteria, $order, $limit, $onlyCount);
	}

	public function save()
	{
		return parent::save("' . $capitalized . '");
	}

	/**
	 * @return int
	 */
	public static function count($criteria = array())
	{
		return parent::count("' . $capitalized . '", $criteria, "", 1, true);
	}

	public function delete()
	{
		parent::delete("' . $capitalized . '");
	}

	/**
	 * @return boolean
	 */
	public static function isUnique($field, $value, $id=false)
	{
		return parent::isUnique("' . $capitalized . '", $field, $value, $id);
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
');
		fclose($file);

//		echo '<code><pre>' . htmlentities(file_get_contents($capitalized . '.php')) . '</pre></code>';

		fwrite($_includes, 'require_once($relativePath . "_' . $capitalized . '.php");' . "\n");

		if (!file_exists($GLOBALS['ROOTPATH'] . 'includes/' . $capitalized . '.php'))
		{
			$file = fopen($GLOBALS['ROOTPATH'] . 'includes/' . $capitalized . '.php', 'w+');

			fwrite($file, '<?php
/**
 * Description of ' . $capitalized . '
 *
 * @author arteau
 */

$GLOBALS["classes"]["' . $capitalized . '"] = array("classname" => "' . $capitalized . '", "tablename" => "' . $res[0] . '");
	
	class ' . $capitalized . ' extends _' . $capitalized . '
	{
	');

			fwrite($file, '}
	');

			fclose($file);

//			echo '<code><pre>' . htmlentities(file_get_contents($capitalized . '.php')) . '</pre></code>';
		}

		fwrite($_includes, 'require_once($relativePath . "' . $capitalized . '.php");' . "\n");
	}
	fclose($_includes);
