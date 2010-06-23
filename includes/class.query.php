<?php
/**
 * Description of classquery
 *
 * @author arteau
 */
class Query {

	private $columns;
	private $from;
	private $joins;
	private $groupBy;
	private $where;
	private $orderBy;
	private $having;
	private $limit;
	private $classname;

	function  __construct($classname, $addClassDefaultClauses = false)
	{
		if (empty($GLOBALS['classes'][$classname]))
			throw new Exception('Class not found : ' . $classname);

		$this->columns = array();
		$this->from = $GLOBALS['classes'][$classname]['tablename'];
		$this->joins = array();
		$this->groupBy = array();
		$this->where = array();
		$this->orderBy = array();
		$this->having = array();
		$this->limit = false;
		$this->classname = $classname;

		if ($addClassDefaultClauses && is_callable(array($classname, 'addDefaultQueryClauses')))
			call_user_func_array(array($classname, 'addDefaultQueryClauses'),
														 array($this));
	}

	public function addColumn($column)
	{
		$this->columns []= $column;
	}

	public function addJoin($tablename, $on, $type='INNER JOIN', $joinAlias = false)
	{
		if (empty($joinAlias))
			$joinAlias = $tablename . date('His');

		$this->joins[$joinAlias] = $type . ' ' . $tablename . ' ON ' . $on;
	}

	public function addGroupBy($groupBy)
	{
		$this->groupBy []= $groupBy;
	}

	public function addWhere($where)
	{
		$this->where []= $where;
	}

	public function addOrderBy($orderBy, $ascOrDesc = 'asc')
	{
		$ascOrDesc = strtolower($ascOrDesc);

		if ($ascOrDesc != 'asc' && $ascOrDesc != 'desc')
			$ascOrDesc = 'asc';

		$this->orderBy []= $orderBy . ' ' . $ascOrDesc;
	}

	public function addHaving($having)
	{
		$this->having []= $having;
	}

	public function setLimit($limit, $offset = 0)
	{
		if (!empty($offset))
			$this->limit = $offset . ',' . $limit;
		else
			$this->limit = $limit;
	}

	public function debug()
	{
		return '<br/><pre style="text-align: left">' . $this->toString("\n") . '</pre>';
	}

	public function  __toString()
	{
		return $this->toString();
	}

	public function toString($sep = '')
	{
		$sql = '';

		// pre-process if necessary
		if (empty($this->columns))
			$this->columns = array($this->from . '.*');

		if (empty($this->orderBy))
			$this->orderBy = array('id asc');

		// clean and protect every variable to be put in the query
		$this->from = mysql_escape_string($this->from);
		$this->limit = mysql_escape_string($this->limit);

		// prepare sql
		$sql .= ' SELECT ' . implode(',', $this->columns) . $sep;

		$sql .= ' FROM ' . $this->from . $sep;

		if (!empty($this->joins))
			$sql .= ' ' . implode(' ' . $sep, $this->joins) . $sep;

		if (!empty($this->groupBy))
			$sql .= ' WHERE ' . implode(' AND ', $this->groupBy) . $sep;

		if (!empty($this->where))
			$sql .= ' WHERE ' . implode(' AND ', $this->where) . $sep;

		if (!empty($this->having))
			$sql .= ' HAVING ' . implode(' AND ', $this->where) . $sep;

		$sql .= ' ORDER BY ' . implode(', ', $this->orderBy) . $sep;

		if (!empty($this->limit))
			$sql .= ' LIMIT ' . $this->limit;

		return $sql;
	}

	public function fetchAll()
	{
		$req = Tools::mysqlQuery($this->toString());

		$results = array();

		while ($res = mysql_fetch_array($req))
		{
			$results []= new $GLOBALS['classes'][$this->classname]['classname']($res);
		}

		return $results;
	}
}
