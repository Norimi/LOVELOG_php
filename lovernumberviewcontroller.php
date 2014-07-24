<?php

	//発行されたlovernumberを名前とともに出力する
	header("Content-Type:text/xml; charset=UTF-8");
	session_start();


    mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('noriming_lovelog');
    mysql_query('SET NAMES UTF8');

	$sql = sprintf('SELECT * FROM ld2members WHERE memberid=%d',
	mysql_real_escape_string($_SESSION['pid'])
	);
	$recordSet = mysql_query($sql) or die(mysql_error());
	$pname = mysql_fetch_assoc($recordSet);

?>


<content>
<loverName><?php echo ($pname['name']);?></loverName>
<loverNumber><?php echo htmlspecialchars($_SESSION['lovernumber'], ENT_QUOTES, 'UTF-8'); ?></loverNumber>
</content>




