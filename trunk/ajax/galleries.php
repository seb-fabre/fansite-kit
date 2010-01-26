<?php
  include_once('../includes/_init.php');
  
  function browse($i)
  {
    global $hierarchy;
    
    $id = $hierarchy[$i];
    
    $dir['html'] = '<ul class="jqueryFileTree" style="display: none;">';
    
    if ($id == '0')
    {
      $galleries = Gallery::search(array(array('gallery_id', NULL)));
    }
    else
    {
      $galleries = Gallery::search(array(array('gallery_id', $id)));
    }
    $galleries = postSort($galleries, 'name');
    
    foreach ($galleries as $gal)
    {
      if (isset($hierarchy[$i+1]) && $gal->id === $hierarchy[$i+1])
      {
	$dir['html'] .= '<li class="directory collapsed"><a href="#" rel="/gallery/' . $gal->id . '/' . cleanLink($gal->name) . '" class="active">' . $gal->name . '</a>' . browse($i + 1) . '</li>';
      }
      else
	$dir['html'] .= '<li class="directory collapsed"><a href="#" rel="/gallery/' . $gal->id . '/' . cleanLink($gal->name) . '">' . $gal->name . '</a></li>';
    }
    $dir['html'] .= '</ul>';
    return $dir['html'];
  }

  $dir = array();
  $dir['error'] = 0;
  
  $id = $_POST['dir'];
  
  $hierarchy = Gallery::getHierarchy($id);
  
  $dir['html'] = browse(0);
    
  echo json_encode($dir);
    /*
?>
{"error":0,"html":"<ul class=\"jqueryFileTree\" style=\"display: none;\"><li class=\"directory collapsed\"><a href=\"#\" rel=\"\/home\/storage\/extern\/\">extern<\/a><\/li><li class=\"directory collapsed\"><a href=\"#\" rel=\"\/home\/storage\/music\/\">music<\/a><\/li><li class=\"directory collapsed\"><a href=\"#\" rel=\"\/home\/storage\/pictures\/\">pictures<\/a><\/li><li class=\"directory collapsed\"><a href=\"#\" rel=\"\/home\/storage\/video\/\">video<\/a><\/li><\/ul>"}
<?php */