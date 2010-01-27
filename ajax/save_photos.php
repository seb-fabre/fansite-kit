<?php
	require_once ('../includes/_init.php');
	require_once (ROOT_PATH . 'includes/pclzip.lib.php');

	$errors = '';
	$gallery = Gallery::find($_POST ['parent_id']);

	if (!$gallery || $gallery->has_images == 0)
	{
		$errors = Tools::translate('Invalid gallery selected.');

		echo json_encode(array('success' => 0, 'errors' => $errors));
	}
	else
	{
		$dir = ROOT_PATH . 'temporary files/' . $_SESSION ['timestamp'] . '_' . $_SESSION ['user_id'] . '/';
		$galleryDir = $gallery->getDirectory();

		// list the files in the directory
		$files = array();
		if ($handle = opendir($dir))
		{
			while (false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != "..")
				{
					$matches = false;
					preg_match('/.*\.([^\.]+)/', $file, $matches);
					// filter the files : keep the images and the archives
					if (!$matches || count($matches) <= 1)
						continue;

					if (in_array($matches [1], $VALID_IMAGE_EXTENSIONS))
					{
						$files [] = $file;
					}
					else if ($matches [1] == 'zip') // unzip the archives if there are any
					{
						Tools::extractPhotosFromZip($file, $dir, $galleryDir, $files);
					}
				}
			}
			closedir($handle);
		}

		echo count($files);

		$validPhotos = 0;
		// for each photo
		foreach ($files as $photo)
		{
			// check it's really an image
			$infos = @getimagesize($dir . $photo);

			if ($infos == false)
				continue;

			// insert the photo in the database
			$image = new Image();
			$image->name = $photo;
			$image->gallery_id = $gallery->id;
			$image->views = 0;
			$image->date = date('Y-m-d');
			$image->user_id = $_SESSION ['user_id'];
			$image->totalnotes = 0;
			$image->totalvotes = 0;
			$image->save();

			// move the file in the correct directory, rename it with it's id
			rename($dir . $photo, $galleryDir . $image->id);

			// resize the photo
			/*resizePhoto($photo, 'thumb_' . $photo, PHOTOS_SMALL_SIZE);
			resizePhoto($photo, 'normal_' . $photo, PHOTOS_MEDIUM_SIZE);
			if (PHOTOS_LARGE_SIZE != 0)
				resizePhoto($photo, $photo, PHOTOS_LARGE_SIZE);*/
		}

		echo json_encode(array('success' => 1, 'message' => Tools::translate('The gallery was created successfully.')));
	}
?>