<?php
    mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('norimit_lovelog');
    mysql_query('SET NAMES UTF8');    

	if(isset($_POST['chat'])){
		$sql = sprintf('INSERT INTO ld2chat SET chat="%s", userid=%d, indicator=%d, date="%s"',
						mysql_real_escape_string($_POST['chat']),
						mysql_real_escape_string($_POST['userid']),
						mysql_real_escape_string($_POST['loveindi']),
               date('Y-m-d H:i:s')
               );
		mysql_query($sql) or die(mysql_error());
	}


?>


