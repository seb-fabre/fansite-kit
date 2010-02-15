<?php
  class Config extends _Config
  {
  	public static function setValue($key, $value)
  	{
  		$config = Config::findBy('type', $key);

  		if (!$config)
  		{
  			$config = new Config();
  			$config->type = $key;
  		}

  		$config->value = $value;
  		$config->save();
  	}

  	public static function getValue($key)
  	{
  		$config = Config::findBy('type', $key);

  		if ($config)
  		{
  			return $config->value;
  		}

  		return null;
  	}

  	public static function loadAll()
  	{
  		$tmp = self::getAll();
  		$configs = array();

  		foreach ($configs as $conf)
  		{
  			$tmp [$conf->type] = $conf->value;
  		}

  		return $configs;
  	}
  }
?>