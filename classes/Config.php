<?php
  class Config extends _Config
  {
  	public static function setValue($name, $value)
  	{
  		$config = Config::findBy('name', $name);

  		if (!$config)
  		{
  			$config = new Config();
  			$config->name = $name;
  		}
			
			if (!is_array($value))
	  		$config->value = $value;
			else
	  		$config->value = json_encode($value);

  		$config->save();
  	}

  	public static function getValue($name)
  	{
  		$config = Config::findBy('name', $name);

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
  			$tmp [$conf->name] = $conf->value;
  		}

  		return $configs;
  	}
  }
