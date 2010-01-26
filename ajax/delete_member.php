<?php
  require_once('../includes/_init.php');
  
  $id = $_POST['id'];
  
  $user = User::find($id);
  
  // update the galleries and videos from this user (give them to the admin)
  $videos = $user->getVideos();
  $galleries = $user->getGallerys();
  $images = $user->getImages();
  $comments = $user->getCommentsphotos();
  $news = $user->getNewss();
  
  foreach ($videos as $video)
  {
    $video->user_id = 1;
    $video->save();
  }
  
  foreach ($galleries as $gallery)
  {
    $gallery->user_id = 1;
    $gallery->save();
  }
  
  foreach ($images as $image)
  {
    $image->user_id = 1;
    $image->save();
  }
  
  foreach ($comments as $comment)
  {
    $comment->user_id = 1;
    $comment->save();
  }
  
  foreach ($news as $n)
  {
    $n->user_id = 1;
    $n->save();
  }
  
  $user->delete();
  
  echo json_encode(array(
    'success' => 1
  ));
?>