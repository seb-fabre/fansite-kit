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

	function  __construct($classname)
	{
		if (empty($GLOBALS['classes'][$classname]))
			throw new Exception('Class not found : ' . $classname);

		$this->columns = array();
		$this->from = $from;
		$this->joins = array();
		$this->groupBy = array();
		$this->where = array();
		$this->orderBy = array();
		$this->having = array();
		$this->limit = false;
	}

	public function addColumn($name)
	{
		$this->columns []= $column;
	}

	public function addJoin($tablename, $on, $type='INNER JOIN', $joinAlias = false)
	{
		if (empty($joinAlias))
			$joinAlias = $tablename . date('His');

		$joins[$joinAlias] = $type . ' ' . $tablename . ' ON ' . $on;
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

	public function  __toString()
	{
		$sql = '';

		// pre-process if necessary
		if (empty($this->columns))
			$this->columns = array($this->from . '.*');

		if (empty($this->orderBy))
			$this->orderBy = array('id asc');

		// clean and protect every variable to be put in the query
		$this->columns = array_map('mysql_escape_string', $this->columns);
		$this->from = mysql_escape_string($this->from);
		$this->joins = array_map('mysql_escape_string', $this->joins);
		$this->groupBy = array_map('mysql_escape_string', $this->groupBy);
		$this->where = array_map('mysql_escape_string', $this->where);
		$this->orderBy = array_map('mysql_escape_string', $this->orderBy);
		$this->having = array_map('mysql_escape_string', $this->having);
		$this->limit = mysql_escape_string($this->limit);

		// prepare sql
		$sql .= ' SELECT ' . implode(',', $this->columns);

		$sql .= ' FROM ' . $this->from;

		if (!empty($this->joins))
			$sql .= ' ' . implode(' ', $this->joins);

		if (!empty($this->groupBy))
			$sql .= ' WHERE ' . implode(' AND ', $this->groupBy);

		if (!empty($this->where))
			$sql .= ' WHERE ' . implode(' AND ', $this->where);

		if (!empty($this->having))
			$sql .= ' HAVING ' . implode(' AND ', $this->where);

		$sql .= ' ORDER BY ' . $this->orderBy;

		if (!empty($this->limit))
			$sql .= ' LIMIT ' . $this->limit;

		return $sql;
	}
}
