<?php
  require_once('../includes/_init.php');
  
  $content = '';
  if (isset($_POST['lan']))
  {
    $dictionary = Dictionary::findBy('language', $_POST['lan']);
    $data = json_decode($dictionary->data, true);
    /*$i = 0;
    foreach ($data as $key => $value)
    {
      $content .= '<p>
	<label>' . $key . '</label>
	<input type="text" name="' . $key . '" value="" />
      </p>';
      $i++;
    }*/
    echo json_encode(array('text' => '<input type="hidden" name="lan" value="' . $_POST['lan'] . '" />', 'data' => $data));
  }
  else
    echo json_encode(array('text' => Tools::translate('No language selected')));
	