<?php
if (!empty($GLOBALS["ROOTPATH"]))
	$relativePath = $GLOBALS["ROOTPATH"] . "includes/";
else
	$relativePath = "./";
require_once($relativePath . "ArtObject.php");
require_once($relativePath . "_Blacklist.php");
require_once($relativePath . "Blacklist.php");
require_once($relativePath . "_Commentaires.php");
require_once($relativePath . "Commentaires.php");
require_once($relativePath . "_Commentsphoto.php");
require_once($relativePath . "Commentsphoto.php");
require_once($relativePath . "_Dictionary.php");
require_once($relativePath . "Dictionary.php");
require_once($relativePath . "_Gallery.php");
require_once($relativePath . "Gallery.php");
require_once($relativePath . "_Image.php");
require_once($relativePath . "Image.php");
require_once($relativePath . "_Liens.php");
require_once($relativePath . "Liens.php");
require_once($relativePath . "_News.php");
require_once($relativePath . "News.php");
require_once($relativePath . "_Params.php");
require_once($relativePath . "Params.php");
require_once($relativePath . "_Referrer.php");
require_once($relativePath . "Referrer.php");
require_once($relativePath . "_SpamComm.php");
require_once($relativePath . "SpamComm.php");
require_once($relativePath . "_Translation.php");
require_once($relativePath . "Translation.php");
require_once($relativePath . "_User.php");
require_once($relativePath . "User.php");
require_once($relativePath . "_Video.php");
require_once($relativePath . "Video.php");
