<?php 
class Image extends _Image
{
  function getBigUrl()
  {
  return '/photos/' . $this->gallery_id . '/' . $this->name;
  }
  
  function getMediumUrl()
  {
  return '/photos/' . $this->gallery_id . '/normal_' . $this->name;
  }
  
  function getSmallUrl()
  {
  return '/photos/' . $this->gallery_id . '/thumb_' . $this->name;
  }
}
?>