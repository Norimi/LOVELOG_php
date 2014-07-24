<?php

	mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('noriming_lovelog');
    mysql_query('SET NAMES UTF8');

    if(isset($_POST["indiator"])){

		$sql = sprintf('UPDATE ld2chat SET indicator=%d WHERE chatid=%d',
               mysql_real_escape_string($_POST['indicator']),
               mysql_real_escape_string($_POST['chatid'])
               );
    	mysql_query($sql) or die(mysql_error());

	}

?>