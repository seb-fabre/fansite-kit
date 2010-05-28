<?php
  require_once('../includes/_init.php');
  
  $id = $_SESSION['user_id'];
  $user = User::find($id);
  
  $message = '';
  $success = 0;
  
  if (isset($_POST['oldpwd']) && $_POST['oldpwd'] && isset($_POST['newpwd']) && $_POST['newpwd'] && isset($_POST['confirm']) && $_POST['confirm'])
  {
    $query = mysql_query('SELECT * FROM user WHERE login="' . $user->login . '" AND password=ENCODE("' . $pwd . '", "vaihere")');
    if (mysql_num_rows($query) != 1)
    {
      $message = Tools::translate('Wrong password');
    }
    else if ($_POST['newpwd'] != $_POST['confirm'])
    {
      $message = Tools::translate("The new password does not match the confirmation.");
    }
    else
    {
      $success = 1;
      mysql_query('UPDATE user SET password=ENCODE("' . $_POST['newpwd'] . '", "vaihere") WHERE id="' . $id . '"');
    }
  }
  
  $html = '<fieldset>
    <legend>' . Tools::translate('Change my password') . '</legend>
    <p id="formResult"></p>
    <p><label>' . Tools::translate('Old password') . '</label><input type="text" name="oldpwd" /></p>
    <p><label>' . Tools::translate('New password') . '</label><input type="text" name="newpwd" /></p>
    <p><label>' . Tools::translate('Confirm new password') . '</label><input type="text" name="confirm" /></p>
    </fieldset>
  ';

  echo json_encode(array(
      'text' => $html,
      'bottom' => '<p style="text-align: center">
	  <input type="button" onclick="savePassword()" value="' . Tools::translate('Save the password') . '" />
	  <input type="button" onclick="$.modal.close()" value="' . Tools::translate('Close') . '" />
      </p>'
  ));
