<?php
	session_start();

	header('Content-type: text/html; charset=UTF-8');

	define('ROOT_PATH', str_replace('includes/'.basename(__FILE__), '', str_replace('\\', '/', __FILE__)));
	define('INCLUDE_PATH', ROOT_PATH . 'includes/');

	$_POST['path'] = ROOT_PATH . 'classes/';

	if (!file_exists(ROOT_PATH . 'includes/_conf.php'))
	{
		die("Please run the installation before trying to access any page.");
	}

	require_once(ROOT_PATH . 'includes/_conf.php');

	require_once(ROOT_PATH . 'includes/JSON.php');
	require_once(ROOT_PATH . 'includes/class.tools.php');

	require_once(ROOT_PATH . 'classes/__includes.php');

	$LANGUAGES = Config::getValue('languages');

	if (!isset($_SESSION['l']))
		$lang = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
	else
		$lang = $_SESSION['l'];

	if (!isset($LANGUAGES[$lang]))
		$lang = key($LANGUAGES);

	$_SESSION['l'] = $lang;

	define('DEFAULT_DISCLAIMER', '');

	$dico = false;
	if (file_exists(ROOT_PATH . 'includes/lang.php'))
		include_once(ROOT_PATH . 'includes/lang.php');

	if (empty($dico))
	{
		$dico = Tools::initDictionary();
	}

	$VALID_IMAGE_EXTENSIONS = array('jpg', 'jpeg');

	//define('PHOTOS_SMALL_SIZE', $conf['photos small size']);
	define('PHOTOS_SMALL_SIZE', 150);
	define('PHOTOS_MEDIUM_SIZE', 450);
	define('PHOTOS_LARGE_SIZE', 0);

	if (isset($_SESSION['user_id']))
		$CURRENT_USER = User::find($_SESSION['user_id']);
	else
		$CURRENT_USER = false;
?>