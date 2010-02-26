<?php
class Form
{
	private static function echoLabel($label)
	{

	}

	public static function echoTextInput($label, $name, $value=false, $params=array())
	{
		$field = $this->fields['input'][$fieldName];

		if ($value !== false)
			$valueStr = 'value="' . $field['value'] . '" ';
		else
			$valueStr = '';

		$paramsStr = Tools::implodeParams($field['params']);

		echo '<input type="text" name="' . $fieldName . '" ' . $valueStr . $paramsStr . ' />';
	}

	public static function getTextInput($inputName,
																			$inputId = false,
	                                    $currentValue = '',
	                                    $options = array(),
	                                    $validation = false,
	                                    $validation_text = false)
	{

		if (empty($options))
			$options = array();

		if (!is_array($options))
			$options = array($options);

		if (!empty($validation))
			$options[] = 'alt="' . htmlspecialchars($validation) . '"';

		if (!empty($validation_text))
			$options[] = 'emsg="' . htmlspecialchars($validation_text) . '"';

		// Set default id if not found
		if (empty($inputId))
			$inputId = $inputName . 'Id';

		return '<input type="text" name="'.$inputName.'" id="' . $inputId . '" ' . implode(" ", $options) . ' value="' . htmlspecialchars($currentValue) . '" />';
	}
}