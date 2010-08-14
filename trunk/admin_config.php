<?php
require_once ('includes/_init.php');

$message = false;

if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']))
{
	header('location: ' . APPLICATION_URL);
}

$title = Tools::translate('Administration');

$headers = array();
$headers['css'] = array(
	'js/jcupload/jquery.jcuploadUI.css',
	'css/colorpicker.css',
);

$headers['js'] = array(
	'js/jquery.simplemodal-1.2.3.js',
	'js/nimda.js',
	'js/jcupload/jquery.jcupload.js',
	'js/jcupload/jquery.jcuploadUI.config.js',
	'js/jcupload/jquery.jcuploadUI.js',
	'js/jquery.form.js',
	'js/colorpicker.js',
	'js/scrolltable.js',
);

Tools::echoHTMLHead($title, $headers);
?>
<body>
<div id="container">
	<?=Tools::echoHeader();?>

	<div id="body" class="body100">
		<h1><?php echo $title ?></h1>

		<?php
			echoFieldsetStart(Tools::translate('Enabled features'));

			echoFieldsetEnd();
		?>
		
	</div>

	<?= Tools::echoFooter(); ?>
</div>
</body>
</html>
