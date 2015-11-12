<?php
	session_start();
	mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('norimit_lovelog');
	mysql_query('SET NAMES UTF8');
	//招待された方の登録情報をセッションで受け継いだmemberidのところに入れる
	$sql = sprintf('UPDATE ld2members SET email="%s", password="%s", name="%s", created="%s" WHERE memberid=%d',
		mysql_real_escape_string($_SESSION['email']),
		sha1(mysql_real_escape_string($_SESSION['password'])),
		mysql_real_escape_string($_SESSION['name']),
		date('Y-m-d H:i:s'),
		mysql_real_escape_string($_SESSION['foundlover']['memberid'])
	);
	mysql_query($sql) or die(mysql_error());
	    
?>





