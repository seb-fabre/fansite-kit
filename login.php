<?php
require_once('includes/_init.php');

$message = false;

if (isset($_SESSION['user_id']))
{
	header('location: ' . APPLICATION_URL);
}

if (isset($_POST['username']) && isset($_POST['pwd']))
{
	$erreur = false;
	$username = $_POST['username'];
	$pwd = $_POST['pwd'];

	if (!$username || !$pwd)
	{
		$message = Tools::translate('You must fill your login and password.');
		$erreur = true;
	}

	if (!$erreur)
	{
		$query = new Query('User');
		$query->addWhere('login = ' . Query::quote($username));
		$query->addWhere('password = ENCODE(' . Query::quote($pwd) . ', "vaihere")');

		if ($query->count() != 1)
		{
			$message = Tools::translate('Invalid credentials');
		}
		else
		{
			$user = $query->fetchRow();
			$_SESSION['user_id'] = $user->id;
			if ($user->is_admin == 1)
				$_SESSION['is_admin'] = true;

			$message = Tools::translate('You have been successfully logged in.');
		}
	}
	else
	{
		unset($_SESSION['is_admin']);
		unset($_SESSION['user_id']);
	}
}

$title = Tools::translate('Connexion');

Tools::echoHTMLHead($title);

?>

	<body>
    <div id="body">
			<?= Tools::echoHeader(); ?>

			<div id="content">
				<h1><?=$title?></h1>

				<?php if ($message): ?>
					<p class="formSuccess"><?php echo $message ?></p>
				<?php endif; ?>

				<?php if (!isset($_SESSION['user_id'])): ?>
					<form action="" method="post" class="form500">
						<fieldset>
							<legend><?php echo Tools::translate('login') ?></legend>
							<p><label><?php echo Tools::translate('Username') ?></label><input type="text" name="username" /></p>
							<p><label><?php echo Tools::translate('Password') ?></label><input type="password" name="pwd" /></p>
							<p class="submit"><input type="submit" value="<?php echo Tools::translate('OK') ?>" /></p>
						</fieldset>
					</form>
				<?php endif; ?>
			</div>

			<div class="clearBoth">&nbsp;</div>

			<?php echo Tools::echoFooter(); ?>
    </div>
	</body>
</html>
