<?php
  class Gallery extends _Gallery
  {
    function getSubgalleries()
    {
      return Gallery::search(array(array('gallery_id', $this->id)), 'name');
    }

    function getParentGalleries()
    {
      return Gallery::search(array(array('id', $this->gallery_id)), 'name');
    }

    /**
     * Enter description here...
     *
     * @return Image
     */
    function getRandomImage()
    {
      return reset(Image::search(array(array('gallery_id', $this->id)), 'RAND()', 1));
    }

    public static function getHierarchy($id)
    {
      if ($id == 0)
	return array(0);

      $hierarchy = array();
      $gal = Gallery::find($id)->gallery_id;
      $hierarchy []= $id;
      while (!is_null($gal))
      {
	$hierarchy []= $gal;
	$parent = Gallery::find($gal);
	$gal = $parent->gallery_id;
      }
      $hierarchy []= 0;
      $hierarchy = array_reverse($hierarchy);
      return $hierarchy;
    }

    public function getWebDirectory()
    {
      return '/photos/' . $this->id . '/';
    }

    public function getDirectory()
    {
      return ROOT_PATH . $this->getWebDirectory();
    }

    public function getUrl()
    {
	return '/gallery/' . $this->id . '/' . Tools::cleanLink($this->name) . '">' . $this->name;
    }
  }
  