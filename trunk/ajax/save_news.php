<?php
  require_once('../includes/_init.php');

  // load post data
  $id = $_POST['id'];
  $titles = $_POST['title'];
  $texts = $_POST['text'];
  $date = $_POST['date'];

  $news = News::find($id);
  $results = array();

  if ($news == false)
  {
    $results = array('success' => 0, 'errors' => array(translate('User not found')));
  }
  else
  {
    $errors = array();


    foreach ($titles as $lang => $title)
	    // check if the username is valid (letters, digits, dashes and spaces)
	    if (!isTitleValid($title))
	    {
	      $errors['title'][$lang] = translate('A title can not contain double quotes');
	    }

    if (count($errors) != 0)
    {
      $results = array('success' => 0, 'errors' => $errors);
    }
    else
    {
      $news->title = json_encode($titles);
      $news->text = json_encode($texts);
      $news->date = $date;
      $news->save();
      $results = array('success' => 1);
    }
  }

  echo json_encode($results);
?>