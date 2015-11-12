<?php

	header("Content-Type:text/xml; charset=UTF-8"); 
	session_start();
	mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
	mysql_select_db('norimit_lovelog');
	mysql_query('SET NAMES UTF8');
    

	$sql = sprintf('SELECT * FROM ld2members WHERE memberid=%d',
		mysql_real_escape_string($_SESSION['pid'])
	);
	$recordSet = mysql_query($sql) or die(mysql_error());
	$pemail = mysql_fetch_assoc($recordSet);

	if($pemail['email']){
		$flag = 1;
	}

?>



<content>
<lovername><?php echo htmlspecialchars($pemail['name'], ENT_QUOTES, 'UTF-8'); ?></lovername>

<flag><?php
    if($pemail['email']):
    ?>ok<?php
        endif;
        ?>
</flag>
</content>

