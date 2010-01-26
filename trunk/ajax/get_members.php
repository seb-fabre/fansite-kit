<?php
  require_once('../includes/_init.php');
  
  $users = User::getAll('login ASC');
  
  $html = '<div id="small_loading"></div>
    <div id="configForm" style="margin-top:10px;">
    <table cellpadding="0" cellspacing="0" style="width:100%" class="table scroll">
      <thead>
	<tr>
	  <th>' . translate('Username') . '</th>
	  <th class="width100">' . translate('Edit') . '</th>
	  <th class="width100">' . translate('Delete') . '</th>
	  <th class="width100">' . translate('Disable / Enable') . '</th>
	  ' . ($CURRENT_USER->is_superadmin ? '<th class="width100">' . translate('Is admin') . '</th>' : '') . '
	</tr>
      </thead>
      <tbody>';
    
  foreach ($users as $user)
  {
    if ($user->id == $_SESSION['user_id'])
      continue;
    
    $html .= '<tr id="row_' . $user->id . '">
      <td>' . $user->login . '</td>
      <td class="center"><img src="/img/edit.png" onclick="editMember(' . $user->id . ')"  class="pointer" /></td>
      <td class="center"><img src="/img/delete-user-16x16.png" onclick="deleteMember(' . $user->id . ')" class="pointer" title="' . translate('delete member') . '" /></td>';
    if ($user->is_active == 1)
      $html .= '<td class="center"><img src="/img/enabled.png" onclick="disableMember(' . $user->id . ')" class="pointer" title="' . translate('disable member') . '" />';
    else
      $html .= '<td class="center"><img src="/img/disabled.png" onclick="enableMember(' . $user->id . ')" class="pointer" title="' . translate('enable member') . '" />';
    if ($CURRENT_USER->is_superadmin)
    {
      if ($user->is_admin)
	$html .= '<td class="center"><img src="/img/isadmin.png" onclick="isnotadminMember(' . $user->id . ')" class="pointer" title="' . translate('downgrade member') . '" />';
      else
	$html .= '<td class="center"><img src="/img/isnotadmin.png" onclick="isadminMember(' . $user->id . ')" class="pointer" title="' . translate('promote member') . '" />';
    }
    $html .= '</tr>';
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