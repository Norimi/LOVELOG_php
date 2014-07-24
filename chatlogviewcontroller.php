<?php

    mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('noriming_lovelog');
    mysql_query('SET NAMES UTF8');

	if(isset($_POST)){

		$sql = sprintf('INSERT INTO ld2chat SET chat="%s", userid=%d, indicator=%d, date="%s"',
						mysql_real_escape_string($_POST['chat']),
						mysql_real_escape_string($_POST['userid']),
               　		mysql_real_escape_string($_POST['loveindi']),
						date('Y-m-d H:i:s')
					);
				mysql_query($sql) or die(mysql_error());
	}


?>


