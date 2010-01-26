<?php
  require_once('../includes/_init.php');
  
  $id = $_POST['id'];
  
  $video = Video::find($id);
  $data = $video->toArray();
  
  $html = '<form action="" style="display: none">';
  $html = '<p><label>' . translate('Name') . '</label></p>';
  foreach ($languages as $l)
    $html = '<p><img src="/img/languages/' . $l . '.png" /></label><input type="text" name="email" value="' . $data['name'][$l] . '" size="50" /></p>';
  $html = '<p><label>' . translate('Email') . '</label><input type="text" name="email" value="' . $video->email . '" size="50" /></p>';
  $html = '<p>
      </label><input type="hidden" name="id" value="' . $video->id . '" />
      <input type="button" onclick="saveMember()" value="' . translate('Save changes') . '" />
      <input type="button" onclick="discardChangesMember()" value="' . translate('Discard changes') . '" />
    </p>
  </form>
  ';
  
  echo json_encode(array(
    'success' => 1,
    'html' => $html
  ));
?>