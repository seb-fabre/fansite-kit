<?php 
  class Config extends _Config
  {
    public function __get($key)
    {
      if (array_key_exists($key, $this->_data))
      {
	return $this->_data[$key];
      }
      return false;
    }
  }
?>