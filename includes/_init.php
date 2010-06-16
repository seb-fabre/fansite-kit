<?php
	$GLOBALS['ROOTPATH'] = str_replace('includes/' . basename(__FILE__), '', str_replace('\\', '/', __FILE__));

	session_start();

	header('Content-type: text/html; charset=UTF-8');

	define('INCLUDE_PATH', $GLOBALS['ROOTPATH'] . 'includes/');

	if (empty($_GET['quick_init']) && !file_exists(INCLUDE_PATH . '_conf.php'))
	{
		die("Please run the installation before trying to access any page.");
	}
	
	require_once(INCLUDE_PATH . '_conf.php');

	require_once(INCLUDE_PATH . 'JSON.php');
	require_once(INCLUDE_PATH . 'class.tools.php');
	require_once(INCLUDE_PATH . 'class.query.php');

	$GLOBALS['CURRENT BANNER'] = Tools::getRandomBanner();

	// some files (ex: css) don't need to initialize everything, so stop here
	if (empty($_GET['quick_init']))
	{
		require_once($GLOBALS['ROOTPATH'] . 'includes/__classes.php');

		$languages = Params::get('LANGUAGES');

		if (empty($languages))
		{
			$languages = array('en' => 'English');
			Params::set('LANGUAGES', $languages);
		}

		$GLOBALS['LANGUAGES'] = $languages;

		if (!isset($_SESSION['locale']))
			$lang = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
		else
			$lang = $_SESSION['locale'];

		if (!isset($GLOBALS['LANGUAGES'][$lang]))
			$lang = key($GLOBALS['LANGUAGES']);

		$_SESSION['locale'] = $lang;

		define('DEFAULT_DISCLAIMER', '');

		$dico = false;
		if (file_exists(INCLUDE_PATH . 'lang.php'))
			include_once(INCLUDE_PATH . 'lang.php');

		if (empty($dico))
		{
			$dico = Tools::initDictionary();
		}

		$VALID_IMAGE_EXTENSIONS = array('jpg', 'jpeg');

		if (isset($_SESSION['user_id']))
			$CURRENT_USER = User::find($_SESSION['user_id']);
		else
			$CURRENT_USER = false;
	}

	//define('PHOTOS_SMALL_SIZE', $conf['photos small size']);
	define('PHOTOS_SMALL_SIZE', 120);
	define('PHOTOS_MEDIUM_SIZE', 450);
	define('PHOTOS_LARGE_SIZE', 0);

	define('EMPTY_IMAGE_URL', APPLICATION_URL . 'images/disabled.png');

	$GLOBALS['FooterJS'] = '';
