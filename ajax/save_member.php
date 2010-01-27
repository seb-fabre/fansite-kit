<?php
  require_once('../includes/_init.php');

  // load post data
  $id = $_POST['id'];
  $login = $_POST['login'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];
  $email = $_POST['email'];

  $user = User::find($id);
  $results = array();

  if ($user == false)
  {
    $results = array('success' => 0, 'errors' => array(Tools::translate('User not found')));
  }
  else
  {
    $errors = array();
    // check if the username is valid (letters, digits, dashes and spaces)
    if (!Tools::isUsernameValid($login))
    {
      $errors['login'] = Tools::translate('A username can only contain letters, digits, dashes and spaces');
    }

    // check if the email is valid
    if (!Tools::isEmailValid($email))
    {
      $errors['email'] = Tools::translate('This email is invalid');
    }

    // check if the username is available
    $testUser = User::findBy('login', $login);
    if ($testUser && $testUser->id != $user->id)
    {
      $errors['login'] = Tools::translate('This username is already in use');
    }

    if (isset($password) && $password && isset($confirm) && $confirm)
    {
      if ($password != $confirm)
      {
	$errors['password'] = Tools::translate("The new password doesn't match the confirmation");
      }
    }

    if (count($errors) != 0)
    {
      $results = array('success' => 0, 'errors' => $errors);
    }
    else
    {
      $user->login = $login;
      $user->password = $password;
      $user->email = $email;
      $user->save();
      $results = array('success' => 1);
    }
  }

  echo json_encode($results);
?>