<?php
  require_once('../includes/_init.php');
  
  $id = $_POST['id'];
  
  $user = User::find($id);
  $user->is_admin = 0;
  $user->save();
  
  echo json_encode(array(
    'success' => 1
  ));
