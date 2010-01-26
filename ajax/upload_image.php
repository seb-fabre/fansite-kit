<?php
require_once('../includes/_init.php');

/**
 * ajouter la possibilité d'uploader un .zip ?
 * attention aux extensions (vérifier avec getimagesize)
 * faire un système de suppression des fichiers anciens (par date ?)
 */
  $timestamp = $_GET['currentTimestamp'];
  $userId = $_GET['userId'];

  if (isset($_FILES["Filedata"])) // test if file was posted
  {
    $file_name = strtolower(basename($_FILES["Filedata"]["name"])); //get lowercase filename
    $matches = false;
   	preg_match('/.*\.([^\.]+)/', $file_name, $matches);
   	$file_ending = $matches[1];

    if (in_array(strtolower($file_ending), $VALID_IMAGE_EXTENSIONS, true) || strtolower($file_ending) == 'zip') { // file filter...
    // ...don't forget that file extension can be fake!

      $dir = ROOT_PATH . 'temporary files/' . $timestamp . '_' . $userId . '/';
      $file = $dir . $file_name;

      if (move_uploaded_file($_FILES['Filedata']['tmp_name'], $file)) // move posted file...
      {
	/*
	TO-DO:
	insert your PHP code to execute when file has been posted
	*/
      }
    }
  }
  else
  {
    /*
    TO-DO:
    insert your PHP code to execute when no file has been posted
    */
  }
?>