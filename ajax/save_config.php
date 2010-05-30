<?php
  require_once('../includes/_init.php');
  
  $config = Params::findBy('type', 'active');
  $data = json_decode($config->value);
  
  foreach ($data as $key => $values)
  {
    if (isset($_POST[$key]))
      $data->$key->value = $_POST[$key];
  }
  $config->value = json_encode($data);
  $config->save();
  
  echo json_encode(array('success' => 1));
