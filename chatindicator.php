<?php

	  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('norimit_lovelog');
    mysql_query('SET NAMES UTF8');

    if(isset($_POST["indiator"])){

  		$sql = sprintf('UPDATE ld2chat SET indicator=%d WHERE chatid=%d',
                 mysql_real_escape_string($_POST['indicator']),
                 mysql_real_escape_string($_POST['chatid'])
                 );
    	mysql_query($sql) or die(mysql_error());

	   }

?>