<?php

	session_start();
	mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('norimit_lovelog');
	mysql_query('SET NAMES UTF8');

	$sql = sprintf('UPDATE ld2members SET name="%s", email="%s", password="%s" WHERE memberid=%d',
					mysql_real_escape_string($_POST['name']),
					mysql_real_escape_string($_POST['email']),
					sha1(mysql_real_escape_string($_POST['password'])),
					mysql_real_escape_string($_POST['id'])
				);
	mysql_query($sql) or die(mysql_error());


?>