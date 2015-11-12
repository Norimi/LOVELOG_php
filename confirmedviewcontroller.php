<?php


	session_start();
	mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('norimit_lovelog');
	mysql_query('SET NAMES UTF8');

	if(isset($_POST)){

		$sql= sprintf('INSERT INTO ld2members SET email="%s", password="%s", created="%s"',
					mysql_real_escape_string($_SESSION['join']['email']),
					sha1(mysql_real_escape_string($_SESSION['join']['password'])),
					date('Y-m-d H:i:s')
					);
		mysql_query($sql) or die(mysql_error());
		$myid = mysql_insert_id();

		//発行されたidをセッションに挿入して後の登録APIに反映させる
		$_SESSION['join']['id'] = $myid;
    
}

?>

