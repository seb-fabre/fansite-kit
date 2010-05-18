<?php
    require_once('includes/_init.php');
    
    $message = false;
    
    if (isset($_SESSION['user_id']))
    {
	header('location: /');
    }
    
    if (isset($_POST['username']) && isset($_POST['pwd']))
    {
        $erreur = false;
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];
        
        if (!$username || !$pwd)
        {
            $message = $dico['conn03'];
            $erreur = true;
        }
        
        if (!$erreur)
        {
            $query = mysql_query('SELECT * FROM user WHERE login="' . $username . '" AND password=ENCODE("' . $pwd . '", "vaihere")');
            if (mysql_num_rows($query) != 1)
            {
                $message = $dico['conn02'];
            }
            else
            {
		$res = mysql_fetch_array($query);
		$_SESSION['user_id'] = $res['id'];
		if ($res['is_admin'] == 1)
		    $_SESSION['is_admin'] = true;
		    
		$message = $dico['conn03'];
            }
        }
	else
	{
	    unset($_SESSION['is_admin']);
	    unset($_SESSION['user_id']);
	}
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php require_once(INCLUDE_PATH . '_meta.php'); ?>
  <title>Lucy Liu fansite by arteau - Page d'accueil - BIENVENUE !!!</title>

  <link href="<?=APPLICATION_URL?>css/site.css.php" rel="stylesheet" type="text/css" />
  <link href="<?=APPLICATION_URL?>css/cupertino/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />

  <script src="<?=APPLICATION_URL?>js/jquery-1.3.2.min.js" type="text/javascript"></script>
  <script src="<?=APPLICATION_URL?>js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
</head>

<body>
    <div id="container">
        <div id="header">
          <img src="<?=APPLICATION_URL?>img/banniere.jpg" alt="banniere du site" />
          <?php require_once(INCLUDE_PATH . '_menu.php'); ?>
        </div>
        
        <div id="body">
	    <h1><?php echo $dico['Connexion des membres'] ?></h1>
	    
	    <?php if ($message): ?>
		<p class="formSuccess"><?php echo $message ?></p>
	    <?php endif; ?>
	    
	    <?php if (!isset($_SESSION['user_id'])): ?>
		<form action="" method="post" class="form500">
		    <fieldset>
			<legend><?php echo $dico['login'] ?></legend>
			<p><label><?php echo $dico['Username'] ?></label><input type="text" name="username" /></p>
			<p><label><?php echo $dico['Password'] ?></label><input type="password" name="pwd" /></p>
			<p class="submit"><input type="submit" value="<?php echo $dico['OK'] ?>" /></p>
		    </fieldset>
		</form>
	    <?php endif; ?>
        </div>
        
        <div class="clearBoth">&nbsp;</div>

        <div id="footer">
            <?php require_once(INCLUDE_PATH . '_footer.php'); ?>
        </div>
    </div>
</body>
</html>
