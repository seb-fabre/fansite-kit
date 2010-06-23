<?php
/**
 * Description of Gallery
 *
 * @author arteau
 */

$GLOBALS["classes"]["Gallery"] = array("classname" => "Gallery", "tablename" => "fan_gallery");
	
class Gallery extends _Gallery
{
	protected $classname = 'Gallery';

	public function __construct($values = array(), $updateFields = true)
	{
		parent::__construct($values, $updateFields);
	}

	function getSubgalleries()
	{
		$query = new Query('Gallery');
		$query->addJoin('fan_translation', 'context_id=fan_gallery.id
																				AND context_classname=' . Tools::quote('Gallery') . '
																				AND locale=' . Tools::quote($_SESSION['locale']));
		$query->addWhere('fan_gallery_id = ' . Tools::quote($this->id));
		$query->addOrderBy('fan_translation.translated_str');

		return $query->fetchAll();
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
		$galleryIds = Gallery::getHierarchy($this->id);

		if (empty($galleryIds))
			return array();

		return reset(Image::search(array(array('fan_gallery_id', $galleryIds, 'IN')), 'RAND()', 1));
	}

	public static function getHierarchy($id)
	{
		$query = new Query('Gallery');
		$query->addJoin('fan_translation', 'context_id=fan_gallery.id
																				AND context_classname=' . Tools::quote('Gallery') . '
																				AND locale=' . Tools::quote($_SESSION['locale']));
		$query->addWhere('ancestors LIKE ' . Tools::quote('%,' . $id . ','));
		$query->addOrderBy('fan_translation.translated_str');

		$galleries = $query->fetchAll();

		$ids = array();
		foreach ($galleries as $aGallery)
			$ids []= $aGallery->id;

		return $ids;
	}

	public function getParents($returnIdsOnly = false)
	{
		$ancestors = $this->getValue('ancestors');

		$ancestors{0} = '(';
		$ancestors{strlen($ancestors)-1} = ')';

		$query = new Query('Gallery');
		$query->addJoin('fan_translation', 'context_id=fan_gallery.id
																				AND context_classname=' . Tools::quote('Gallery') . '
																				AND locale=' . Tools::quote($_SESSION['locale']));
		$query->addWhere('fan_gallery.id IN ' . $ancestors);

		$galleries = $query->fetchAll();

		$results = array();
		
		if ($returnIdsOnly)
			foreach ($galleries as $aGallery)
				$results []= $aGallery->id;
		else
			foreach ($galleries as $aGallery)
				$results []= $aGallery;

		return $results;
	}

	public function getWebDirectory()
	{
		return APPLICATION_URL . 'photos/' . $this->id . '/';
	}

	public function getDirectory()
	{
		return $GLOBALS['ROOTPATH'] . $this->getWebDirectory();
	}

	public function getUrl()
	{
		return APPLICATION_URL . 'gallery/' . $this->id . '/' . Tools::cleanLink($this->getTranslatedValue('name'));
	}

	public function getLink()
	{
		return '<a href="' . $this->getUrl() . '">' . $this->getTranslatedValue('name') . '</a>';
	}

	public static function getLatest($n)
	{
		$query = new Query('Gallery');
		$query->addOrderBy('date', 'desc');
		$query->setLimit($n);

		return $query->fetchAll();
	}

	public static function getTop($n)
	{
		$query = new Query('Gallery');
		$query->addOrderBy('views', 'desc');
		$query->setLimit($n);

		return $query->fetchAll();
	}

	/**
	 *
	 * @param Query $query
	 */
	public static function addDefaultQueryClauses(&$query)
	{
		$query->addJoin('fan_translation', 'context_id=fan_gallery.id
																				AND context_classname=' . Tools::quote('Gallery') . '
																				AND locale=' . Tools::quote($_SESSION['locale']));
		$query->addColumn('fan_translation.name');
		$query->addColumn('fan_translation.description');
	}
}
	