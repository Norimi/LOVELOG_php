<?php 

	header("Content-Type:text/xml; charset=UTF-8"); 
	session_start();

    
    mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('noriming_lovelog');
    mysql_query('SET NAMES UTF8');

	$sql = sprintf('SELECT name FROM ld2members WHERE memberid=%d',
	    mysql_real_escape_string($_SESSION['foundlover']['memberid'])
	 );
	$recordSet2 = mysql_query($sql) or die(mysql_error());
    $username = mysql_fetch_assoc($recordSet2);


	$sql = sprintf('SELECT name FROM ld2members WHERE memberid=%d',
		mysql_real_escape_string($_SESSION['foundlover']['partnerid'])
	);

	$recordSet = mysql_query($sql)or die(mysql_error());
	$lovername  = mysql_fetch_assoc($recordSet);

?>

<content>
<username><?php echo htmlspecialchars($username['name'], ENT_QUOTES, 'UTF-8');?></username>
<lovername><?php echo htmlspecialchars($lovername['name'], ENT_QUOTES, 'UTF-8'); ?></lovername>
</content>
