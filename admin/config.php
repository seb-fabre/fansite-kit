<?php
require_once ('../includes/_init.php');

$message = false;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
{
	header('location: /');
}

$title = Tools::translate('menu_admin');

$headers = array();
$headers['css'] = array(
	'css/cupertino/jquery-ui-1.7.2.custom.css',
	'css/colorpicker.css',
);

$headers['js'] = array(
	'js/jquery-ui-1.7.2.custom.min.js',
	'js/jquery.simplemodal-1.2.3.js',
	'js/nimda.js',
	'js/jquery.form.js',
	'js/colorpicker.js',
);

Tools::echoHTMLHead($title, $headers);
?>
<body>
<div id="container">
	<?=Tools::echoHeader();?>

	<div id="body" class="body100">
		<h1><?php echo Tools::translate('Edit site configuration')?></h1>



		<div class="clearBoth">&nbsp;</div>
	</div>

	<?php echoFooter() ?>
</div>
</body>
</html>
