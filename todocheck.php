<?php

	mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('noriming_lovelog');
	mysql_query('SET NAMES UTF8');

	if(isset($_POST['checked'])){
	$sql = sprintf('UPDATE ld2plantodo SET checked=100 WHERE todoid=%d',
	mysql_real_escape_string($_POST['checked'])
	);
	mysql_query($sql) or die(mysql_error());
	}


	if(isset($_POST['unchecked'])){
	$sql = sprintf('UPDATE ld2plantodo SET checked=1 WHERE todoid=%d',
	mysql_real_escape_string($_POST['unchecked'])
	);
	mysql_query($sql) or die(mysql_error());
	}

?>