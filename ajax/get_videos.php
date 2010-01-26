<?php
  require_once('../includes/_init.php');
  
  $videos = Video::getAll('name ASC');
  
  $html = '<div id="small_loading"></div>
    <div id="configForm" style="margin-top:10px;">
    <table cellpadding="0" cellspacing="0" style="width:100%" class="table scroll">
      <thead>
	<tr>
	  <th>' . translate('Title') . '</th>
	  <th class="width100">' . translate('Edit') . '</th>
	  <th class="width100">' . translate('Delete') . '</th>
	</tr>
      </thead>
      <tbody>';
    
  foreach ($videos as $video)
  {
    if ($video->id == $_SESSION['user_id'])
      continue;
    
    $html .= '<tr id="row_' . $video->id . '">
      <td>' . $video->name . '</td>
      <td class="center"><img src="/img/edit.png" onclick="editVideo(' . $video->id . ')"  class="pointer" /></td>
      <td class="center"><img src="/img/film_delete.png" onclick="deleteVideo(' . $video->id . ')" class="pointer" title="' . translate('delete member') . '" /></td>
    </tr>';
  }
  $html .= '
      </tbody>
    </table>
  </div>';
  
  echo json_encode(array(
    'text' => $html,
    'bottom' => '<p style="text-align: center">
      <input type="button" onclick="$.modal.close()" value="' . translate('Close') . '" />
    </p>'
  ));
?>