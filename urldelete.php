<?php

	mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('norimit_lovelog');
	mysql_query('SET NAMES UTF8');

	$sql= sprintf('DELETE FROM ld2planurl WHERE urlid=%d',
	mysql_real_escape_string($_POST['urlid'])
	);
	mysql_query($sql) or die(mysql_error());

?>

