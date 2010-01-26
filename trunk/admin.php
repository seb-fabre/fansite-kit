<?php
    require_once('includes/_init.php');
    
    $message = false;
    
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
    {
	header('location: /');
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php require_once(INCLUDE_PATH . '_meta.php'); ?>
    <title><?php echo translate('menu_admin') ?></title>
    
    <link href="/css/site.css.php" rel="stylesheet" type="text/css" />
    <link href="/css/cupertino/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="/css/colorpicker.css" rel="stylesheet" type="text/css" />
    
    <script src="/js/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="/js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
    <script src="/js/jquery.simplemodal-1.2.3.js" type="text/javascript"></script>
    <script src="/js/jquery.form.js" type="text/javascript"></script>
    <script src="/js/colorpicker.js" type="text/javascript"></script>
    <script src="/js/scrolltable.js" type="text/javascript"></script>
    
    <link rel="stylesheet" href="/js/jcupload/jquery.jcuploadUI.css" />
    <script type="text/javascript" src="/js/jcupload/jquery.jcupload.js"></script>
    <script type="text/javascript" src="/js/jcupload/jquery.jcuploadUI.config.js"></script>
    <script type="text/javascript" src="/js/jcupload/jquery.jcuploadUI.js"></script>
    
    <script src="/js/nimda.js" type="text/javascript"></script>
</head>

<body>
    <div id="container">
        <div id="header">
          <img src="/img/banniere.jpg" alt="banniere du site" />
          <?php require_once(INCLUDE_PATH . '_menu.php'); ?>
        </div>
        
        <div id="body" class="body100">
	    <h1><?php echo translate('menu_admin') ?></h1>
	    
	    <p class="linkWithArrow"><a href="javascript:;" onclick="editTranslations()"><?php echo translate('Edit translations') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="editConfig()"><?php echo translate('Edit configuration') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="getVideos()"><?php echo translate('Manage the videos') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="getMembers()"><?php echo translate('Manage the members') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="getGalleries()"><?php echo translate('Manage the galleries') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="getPictures()"><?php echo translate('Manage the pictures') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="getComments()"><?php echo translate('Comments') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="getLinks()"><?php echo translate('Links') ?></a></p>
	    <p class="linkWithArrow"><a href="javascript:;" onclick="getNews()"><?php echo translate('News') ?></a></p>
	    
	    
	    <div class="clearBoth">&nbsp;</div>
        </div>

        <div id="footer">
            <?php require_once(INCLUDE_PATH . '_footer.php'); ?>
        </div>
    </div>
    
    <div id="fenetre">
	<div id="fenetreText"></div>
	<div id="fenetreBottom"></div>
    </div>
    
    <script type="text/javascript">
	var emptyFieldsMsg = "<?php echo addslashes(translate('All the name fields must be filled')) ?>";
	var invalidGallery = "<?php echo addslashes(translate("Invalid gallery selected : you can't select a main category")) ?>";
	var emptyParentMsg = "<?php echo addslashes(translate('You must select a parent gallery for the new gallery')) ?>";
	var emptyPhotosMsg = "<?php echo addslashes(translate('You must choose at least one photo')) ?>";
	
	var deleteMemberStr = "<?php echo addslashes(translate('Are you sure you want to delete this member ?')) ?>";
	var disableMemberStr = "<?php echo addslashes(translate('Are you sure you want to disable this member ?')) ?>";
	var enableMemberStr = "<?php echo addslashes(translate('Are you sure you want to enable this member ?')) ?>";
	
	var isadminMemberStr = "<?php echo addslashes(translate('Are you sure you want to promote this member ?')) ?>";
	var isnotadminMemberStr = "<?php echo addslashes(translate('Are you sure you want to downgrade this member ?')) ?>";
	
	var titleDisableStr = "<?php echo addslashes(translate('disable member')) ?>";
	var titleEnableStr = "<?php echo addslashes(translate('enable member')) ?>";
	var titleMakeAdminStr = "<?php echo addslashes(translate('promote member')) ?>";
	var titleMakeNotAdminStr = "<?php echo addslashes(translate('downgrade member')) ?>";
    </script>
</body>
</html>
