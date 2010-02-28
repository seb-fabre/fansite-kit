<?php
  require_once('../includes/_init.php');

  $id = $_POST['id'];

  $news = News::find($id);
  $data = $news->toArray();
 	$titles = json_decode($data['title'], true);
 	$texts = json_decode($data['text'], true);

  $html = '<form action="" style="display: none">';
  $html .= '<p><label>' . Tools::translate('Date') . '</label><input type="text" name="date" value="' . $news->date . '" size="50" /></p>';
  $glu = '';
  foreach ($GLOBALS['LANGUAGES'] as $lang)
  {
	  $html .= $glu;
  	$html .= '<h3>' . $lang . '</h3>';
	  $html .= '<p><label>' . Tools::translate('Title') . '</label><input type="text" name="title[' . $lang . ']" value="' . $titles[$lang] . '" size="50" /></p>';
	  $html .= '<p><label>' . Tools::translate('Text') . '</label><textarea name="text[' . $lang . ']" value="' . $texts[$lang] . '" size="50" /></p>';
	  $glu = '<br/><hr/><br/>';
  }
  $html .= '<p>
      </label><input type="hidden" name="id" value="' . $news->id . '" />
      <input type="button" onclick="saveNews()" value="' . Tools::translate('Save changes') . '" />
      <input type="button" onclick="discardChanges()" value="' . Tools::translate('Discard changes') . '" />
    </p>
  </form>
  ';

  echo json_encode(array(
    'success' => 1,
    'html' => $html
  ));
?>