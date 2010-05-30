<a href="<?=APPLICATION_URL?>"><?php echo Tools::translate('Home') ?></a>
<a href="<?=APPLICATION_URL?>gallery/"><?php echo Tools::translate('Galleries') ?></a>
<a href="<?=APPLICATION_URL?>videos/"><?php echo Tools::translate('Videos') ?></a>
<a href="<?=APPLICATION_URL?>comments/"><?php echo Tools::translate('Comments') ?></a>
<a href="<?=APPLICATION_URL?>links/"><?php echo Tools::translate('Links') ?></a>
<?php if (!isset($_SESSION['user_id'])): ?>
		<a href="<?=APPLICATION_URL?>login/"><?php echo Tools::translate('Login') ?></a>
		<a href="<?=APPLICATION_URL?>register/"><?php echo Tools::translate('Register') ?></a>
<?php else: ?>
		<a href="<?=APPLICATION_URL?>members/"><?php echo Tools::translate('Members area') ?></a>
		<?php if (isset($_SESSION['is_admin'])): ?>
	<a href="<?=APPLICATION_URL?>admin/"><?php echo Tools::translate('Admin area') ?></a>
		<?php endif; ?>
<?php endif; ?>

<div id="menu_languages">
	<?php
	if (count($GLOBALS['LANGUAGES']) > 1)
	{
		foreach ($GLOBALS['LANGUAGES'] as $code => $label)
		{
			echo '<a href="' . APPLICATION_URL . 'language.php?l=' . $code . '"><img src="/img/languages/' . $code . '.png" alt="' . $label . '" title="' . $label . '" /></a>';
		}
	}
	?>
</div>
