<?php
  $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
  
  require_once('includes/_init.php');
  
  $l = $_GET['l'];
  
  if (!in_array($l, $GLOBALS['LANGUAGES']))
    $lang = reset($GLOBALS['LANGUAGES']);
  
  $_SESSION['l'] = $l;
  
  header('location: ' . $referer);
?>