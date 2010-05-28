<?php
  require_once('../includes/_init.php');

  $id = $_POST['id'];

  $user = User::find($id);

  $html = '<form action="" style="display: none">
    <p><label>' . Tools::translate('Username') . '</label><input type="text" name="login" value="' . $user->login . '" size="50" /></p>
    <p><label>' . Tools::translate('Email') . '</label><input type="text" name="email" value="' . $user->email . '" size="50" /></p>
    <p><label>' . Tools::translate('New password') . '</label><input type="password" name="password" size="50" /></p>
    <p><label>' . Tools::translate('Confirm new password') . '</label><input type="password" name="confirm" size="50" /></p>
    <p class="infos">' . Tools::translate("Leave the password and confirm fields empty if you don't want to change the user's password.") . '</p>
    <p>
      </label><input type="hidden" name="id" value="' . $user->id . '" />
      <input type="button" onclick="saveMember()" value="' . Tools::translate('Save changes') . '" />
      <input type="button" onclick="discardChanges()" value="' . Tools::translate('Discard changes') . '" />
    </p>
  </form>
  ';

  echo json_encode(array(
    'success' => 1,
    'html' => $html
  ));
