<?php
  require_once('../includes/_init.php');

  $news = News::getAll('date DESC');

  $html = '<div id="small_loading"></div>
    <div id="configForm">
    <table cellpadding="0" cellspacing="0" style="width:100%" class="table scroll">
      <thead>
	<tr>
	  <th class="width100">' . translate('Date') . '</th>
	  <th>' . translate('Title') . '<br/>' . translate('Text') . '</th>
	  <th class="width50">' . translate('Edit') . '</th>
	  <th class="width50">' . translate('Delete') . '</th>
	</tr>
      </thead>
      <tbody>';

  foreach ($news as $n)
  {
    $html .= '<tr id="row_' . $n->id . '">
      <td class="smaller">' . $n->date . '</td>
      <td class="smaller">' . $n->title . '</td>
      <td class="center"><img src="/img/edit.png" onclick="editNews(' . $n->id . ')"  class="pointer" title="' . translate('edit this news') . '" /></td>
      <td class="center"><img src="/img/delete.png" onclick="deleteNews(' . $n->id . ')" class="pointer" title="' . translate('delete this news') . '" /></td>';
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