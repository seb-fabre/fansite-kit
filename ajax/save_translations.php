<?php
  require_once('../includes/_init.php');
  
  $content = '';
  if (isset($_POST['lan']))
  {
    $dictionary = Dictionary::findBy('language', $_POST['lan']);
    $data = json_decode($dictionary->data);
    
    foreach ($data as $key => $value)
    {
      if (isset($_POST[$key]))
	$data->$key = $_POST[$key];
    }
    $dictionary->data = json_encode($data);
    $dictionary->save();
    
    echo json_encode(array('text' => ''));
  }
  else
    echo json_encode(array('text' => Tools::translate('No language selected')));
