<?php

	mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('noriming_lovelog');
	mysql_query('SET NAMES UTF8');

	$sql= sprintf('DELETE FROM ld2plan WHERE planid=%d',
	mysql_real_escape_string($_POST['planid'])
	);
	mysql_query($sql) or die(mysql_error());

?>

