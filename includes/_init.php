<?php
    session_start();

    header('Content-type: text/html; charset=UTF-8');

    define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    define('INCLUDE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR);

    $_POST['path'] = ROOT_PATH . 'classes' . DIRECTORY_SEPARATOR;
    
    if (!file_exists(ROOT_PATH . 'includes' . DIRECTORY_SEPARATOR . '_conf.php'))
    {
        die("Please run the installation before trying to access any page.");
    }
    
    require_once(ROOT_PATH . 'includes' . DIRECTORY_SEPARATOR . '_conf.php');

    require_once(ROOT_PATH . 'includes' . DIRECTORY_SEPARATOR . 'JSON.php');
    require_once(ROOT_PATH . 'includes' . DIRECTORY_SEPARATOR . '_functions.php');
    require_once(ROOT_PATH . 'classes' . DIRECTORY_SEPARATOR . '__includes.php');
    
    $config = json_decode(Config::findBy('type', 'active')->value, true);

    $LANGUAGES = $config['languages'];

    if (!isset($_SESSION['l']))
	$lang = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
    else
	$lang = $_SESSION['l'];

    if (!isset($LANGUAGES[$lang]))
	$lang = key($LANGUAGES);

    $_SESSION['l'] = $lang;

    $dico = Dictionary::findBy('language', $lang);

    if ($dico)
    {
	$dico = json_decode($dico->data, true);
    }
    else
    {
        $dico = Dictionary::findBy('language', 'en');
        $dico = json_decode($dico->data, true);

        if (!$dico)
            die(Tools::translate('Dictionary not found'));
    }

    $VALID_IMAGE_EXTENSIONS = array('jpg', 'jpeg');

    // define the constants

    //define('PHOTOS_SMALL_SIZE', $conf['photos small size']);
    define('PHOTOS_SMALL_SIZE', 150);
    define('PHOTOS_MEDIUM_SIZE', 450);
    define('PHOTOS_LARGE_SIZE', 0);
    
    define('VIDEOS_ENABLED', $config['videos']['value']);
    define('COMMENTS_ENABLED', $config['comments']['value']);
    define('REGISTER_ENABLED', $config['register']['value']);

    if (isset($_SESSION['user_id']))
	$CURRENT_USER = User::find($_SESSION['user_id']);
    else
	$CURRENT_USER = false;
?>