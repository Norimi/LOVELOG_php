<?php

	mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('norimit_lovelog');
	mysql_query('SET NAMES UTF8');

	$sql= sprintf('DELETE FROM ld2members WHERE memberid=%d't
	mysql_real_escape_string($_POST['userid'])
	);
	mysql_query($sql) or die(mysql_error());
    
?>