<?php
/**
 * Description of Params
 *
 * @author arteau
 */

$GLOBALS["classes"]["Params"] = array("classname" => "Params", "tablename" => "fan_params");
	
class Params extends _Params
{
	public static function set($name, $value)
	{
		$param = Params::findBy('name', $name);

		if (!$param)
		{
			$param = new Params();
			$param->name = $name;
		}

		if (!is_array($value))
			$param->value = $value;
		else
			$param->value = json_encode($value);

		$param->save();
	}

	public static function get($name)
	{
		$params = Params::findBy('name', $name);

		if ($params)
		{
			$json = @json_decode($params->value, true);
			if (!$json)
				return $params->value;
			else
				return $json;
		}

		return null;
	}

	public static function loadAll()
	{
		$tmp = self::getAll();
		$params = array();

		foreach ($params as $conf)
		{
			$tmp[$conf->name] = $conf->value;
		}

		return $params;
	}

	public function initDefault($name, $value)
	{
		$params = Params::findBy('name', $name);

		if (!$params)
			self::set($name, $value);
	}
}
	