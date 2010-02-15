<?php
class Form
{
	private $fields;

	public function __construct($fields)
	{
		$this->fields = array(
			'input' => array(),
			'select' => array(),
			'textarea' => array(),
		);
	}

	public function addInput($name)
	{

	}

	public function addSelect($name)
	{

	}

	public function addTextarea($name)
	{

	}

	public function __toString($name)
	{

	}

	public function addFieldset($name)
	{

	}
}