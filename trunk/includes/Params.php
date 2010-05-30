<?php
/**
 * Description of Params
 *
 * @author arteau
 */

$GLOBALS["classes"]["Params"] = array("classname" => "Params", "tablename" => "fan_params");
	
class Params extends _Params
{
	public static function setValue($name, $value)
	{
		$Params = Params::findBy('name', $name);

		if (!$Params)
		{
			$Params = new Params();
			$Params->name = $name;
		}

		if (!is_array($value))
			$Params->value = $value;
		else
			$Params->value = json_encode($value);

		$Params->save();
	}

	public static function getValue($name)
	{
		$Params = Params::findBy('name', $name);

		if ($Params)
		{
			return $Params->value;
		}

		return null;
	}

	public static function loadAll()
	{
		$tmp = self::getAll();
		$Paramss = array();

		foreach ($Paramss as $conf)
		{
			$tmp [$conf->name] = $conf->value;
		}

		return $Paramss;
	}
}
	