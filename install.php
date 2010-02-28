<?php
if (file_exists('includes/_conf.php'))
{
	echo 'This site is already installed.<br/>If you want to reinstall it, please remove the _conf.php file from the includes directory.';
	die;
}

$notInstalled = false;

if (isset($_POST['install']))
{
	$url = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'], 'install'));

	$dbhost = $_POST['db_host'];
	$dbname = $_POST['db_name'];
	$dblogin = $_POST['db_login'];
	$dbpassword = $_POST['db_password'];
	$dbcreate = isset($_POST['db_create']);
	$dbkeeptables = isset($_POST['db_keep_tables']);
	$superadminlogin = $_POST['superadmin_login'];
	$superadminpassword = $_POST['superadmin_password'];
	$superadminemail = $_POST['superadmin_email'];
	$GLOBALS['LANGUAGES']short = $_POST['languages_short'];
	$GLOBALS['LANGUAGES']long = $_POST['languages_long'];

	if (!$dbkeeptables)
	{
		$sql = file_get_contents('scripts/install_database.sql');

		$sql = str_replace('{SUPERADMIN_LOGIN}', mysql_escape_string($superadminlogin), $sql);
		$sql = str_replace('{SUPERADMIN_PASSWORD}', mysql_escape_string($superadminlogin), $sql);
		$sql = str_replace('{SUPERADMIN_EMAIL}', mysql_escape_string($superadminemail), $sql);

		if ($dbcreate)
		{
			$sql = preg_replace('/{CREATE_DATABASE}/', '', $sql);
		}
		else
		{
			$sql = preg_replace('/{CREATE_DATABASE}.*{CREATE_DATABASE}/', '', $sql);
		}
		$sql = str_replace('{DBNAME}', $dbname, $sql);

		if (@mysql_connect($dbhost, $dblogin, $dbpassword))
		{
			foreach (explode(';', $sql) as $query)
			{
				if (trim($query))
				{
					$query .= ';';
					mysql_query($query) or die(mysql_error());
				}
			}

			$_POST['path'] = dirname(__file__) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR;
			require_once('classes/__includes.php');
			require_once('includes' . DIRECTORY_SEPARATOR . 'JSON.php');
			require_once('includes' . DIRECTORY_SEPARATOR . 'class.tools.php');

			$GLOBALS['LANGUAGES']short = array_map('trim', explode("\n", $GLOBALS['LANGUAGES']short));
			$GLOBALS['LANGUAGES']long = array_map('trim', explode("\n", $GLOBALS['LANGUAGES']long));
			$GLOBALS['LANGUAGES'] = array_combine($GLOBALS['LANGUAGES']short, $GLOBALS['LANGUAGES']long);

			if (!isset($GLOBALS['LANGUAGES']['en']))
				$GLOBALS['LANGUAGES']['en'] = 'English';

			Config::setValue('VIDEOS ENABLED', 1);
			Config::setValue('GUESTBOOK ENABLED', 1);
			Config::setValue('REGISTRATIONS ENABLED', 1);
			Config::setValue('LANGUAGES', json_encode($GLOBALS['LANGUAGES']));
			Config::setValue('COUNT LATEST NEWS', 5);
			Config::setValue('COUNT LATEST UPDATES', 10);
			Config::setValue('COUNT NEWS PER PAGE', 0);
		}
		else
		{
			$notInstalled = '<p class="error">Invalid database connection informations.</p>';
		}
	}

	if (!$notInstalled)
	{
		$f = fopen('includes/_conf.php', 'w+');
		fwrite($f, '
	<?php
	    mysql_connect("' . addslashes($dbhost) . '", "' . addslashes($dblogin) . '", "' . addslashes($dbpassword) . '");
	    mysql_select_db("' . addslashes($dbname) . '");
	    define("APPLICATION_URL", "' . $url . '");
	?>');
		fclose($f);

		echo '<center>Installation complete. Please go to the <a href="' . $url . '">Home Page</a></center>';
		die;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>INSTALL</title>

<link href="css/site.css.php" rel="stylesheet" type="text/css" />
<link href="css/cupertino/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>

<style type="text/css">
form span.error, .error {
	color: red;
	float: left;
	margin-left: 10px;
}

form td span.error {
	float: none;
}

form p input {
	float: left;
}

form p {
	float: left;
}

form {
	clear: both;
}
</style>
</head>

<body>
<div id="container">
<h1>Install</h1>

<?php
	if ($notInstalled) echo $notInstalled;
?>

<form action="" method="post" style="margin: 20px;" id="installForm">

	<input type="hidden" name="install" value="1" />

	<b>Please fill in this form in order to configure and install your website</b>

	<fieldset style="margin-bottom: 20px">
		<legend>Database</legend>
		<p>
			<label>Database host : </label><input type="text" name="db_host" id="db_host" value="localhost" />
			<div class="am_formMsgError">The database hostname is mandatory.</div>
		</p>

		<p>
			<label>Database name : </label><input type="text" name="db_name" id="db_name" />
			<div class="am_formMsgError">The database name is mandatory.</div>
		</p>

		<p>
			<label>Database login : </label><input type="text" name="db_login" />
			<div class="am_formMsgError">The database login is mandatory.</div>
		</p>

		<p>
			<label>Database password : </label><input type="text" name="db_password" />
			<div class="am_formMsgError">The database password is mandatory.</div>
		</p>

		<p><input type="radio" value="1" name="db_create" id="db_create_init" checked="checked" /> Create the database and initialize the data (default)</p>
		<p><input type="radio" value="2" name="db_create" id="db_create" /> Just initialize the data (choose this option if the database already exists, but is empty)</p>
		<p><input type="radio" value="3" name="db_create" id="db_keep_tables" /> The database already exists and I want to keep the tables and the data</p>
	</fieldset>

	<fieldset style="margin-bottom: 20px">
		<legend>Superadmin</legend>
		<p class="infos">The superadmin is the first member of the site, and its main administrator. He has access to every part of the site, and he's the only one who can edit the site configuration and create new administrators.</p>
		<p><label>Superamin username :</label><input type="text" name="superadmin_login" /></p>
		<p><label>Superamin password :</label><input type="text" name="superadmin_password" /></p>
		<p><label>Superamin email :</label><input type="text" name="superadmin_email" /></p>
	</fieldset>

	<fieldset style="margin-bottom: 20px">
		<legend>Languages</legend>
		<p class="infos">Choose the languages you want avaiable in your site. This parameter can be changed at any time in the admin area. You will also have to go to the admin area to translate the text displayed in the site (only french and english translations are given).</p>
		<p class="infos">English is the default language, so if you don't put it in the list it will automatically be added.</p>
		<p class="infos">One language per line.</p>
		<table width="100%" style="margin-bottom: 10px">
			<tr>
				<td width="45%" align="center">Language code (ex: "en")</td>
				<td width="45%" align="center">Language label (ex: 'English')</td>
			</tr>
			<tr>
				<td align="center"><textarea name="languages_short" id="languages_short" style="width: 90%; display: block;" rows="5"></textarea></td>
				<td align="center"><textarea name="languages_long" id="languages_long" style="width: 90%; display: block;" rows="5"></textarea></td>
			</tr>
		</table>
	</fieldset>

	<div class="clearer"></div>

	<div class="right"><input type="reset" value="Reset form" /> <input type="button" value="Initialize the site" onclick="initSite()" /></div>

</form>
</div>

<script type="text/javascript">
	$("#db_create").click(function(){
		if ($("#db_create").is(":checked"))
		{
			$("#db_keep_tables").attr("disabled", "disabled");
		}
		else
		{
			$("#db_keep_tables").removeAttr("disabled");
		}
	});

	$("#db_keep_tables").click(function(){
		if ($("#db_keep_tables").is(":checked"))
		{
			$("#db_create").attr("disabled", "disabled");
		}
		else
		{
			$("#db_create").removeAttr("disabled");
		}
	});

	$.validator.addMethod(
		"regexp",
		function(value, element, regexp) {
			var re = new RegExp(regexp);
			return this.optional(element) || re.test(value);
		},
		"Please check your input."
	);

	$.validator.addMethod(
		"languages_count",
		function(value, element) {
			return $('#languages_short').val().split(/\n/).length == $('#languages_long').val().split(/\n/).length;
		},
		"You must have as many language codes must as language labels."
	);

	$('#installForm').validate({
		rules: {
			db_host: {required: true},
			db_name: {required: true, regexp: '^[A-Za-z][A-Za-z0-9_]*$'},
			db_login: {required: true},
			db_password: {required: true},
			superadmin_login: {required: true},
			superadmin_password: {required: true},
			superadmin_email: {required: true, email: true},
			languages_short: {required: true, languages_count: true},
			languages_long: {required: true, languages_count: true}
		},
		messages: {
			db_name: {regexp: "Database name must start with a letter, and can only contain digits, letters and '_'"}
		},
		errorElement: "span"
	});

	function initSite()
	{
		//if (confirm("Are you sure you want to initialize the site ?"))
		{
			$('#installForm').submit();
		}
	}
    </script>
</body>
</html>