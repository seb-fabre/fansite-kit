<div id="menu">
  <a href="/"><?php echo translate('Home') ?></a>
  <a href="/gallery/"><?php echo translate('Galleries') ?></a>
  <a href="/videos/"><?php echo translate('Videos') ?></a>
  <a href="/comments/"><?php echo translate('Comments') ?></a>
  <a href="/links/"><?php echo translate('Links') ?></a>
  <?php if (!isset($_SESSION['user_id'])): ?>
      <a href="/login/"><?php echo translate('Login') ?></a>
      <a href="/register/"><?php echo translate('Register') ?></a>
  <?php else: ?>
      <a href="/members/"><?php echo translate('Members area') ?></a>
      <?php if (isset($_SESSION['is_admin'])): ?>
	  <a href="/admin/"><?php echo translate('Admin area') ?></a>
      <?php endif; ?>
  <?php endif; ?>
  
  <div id="menu_languages">
    <?php
    if (count($LANGUAGES) > 1)
    {
      foreach ($LANGUAGES as $code => $label)
      {
	echo '<a href="/language.php?l=' . $code . '"><img src="/img/languages/' . $code . '.png" alt="' . $label . '" title="' . $label . '" /></a>';
      }
    }
    ?>
  </div>
</div>
