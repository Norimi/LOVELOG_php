<?php

	header("Content-Type:text/xml; charset=UTF-8");
	session_start();

    mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('noriming_lovelog');
    mysql_query('SET NAMES UTF8');

    //indicatorが多い順で書き出す
    $sql = sprintf('SELECT *, (userindi + partnerindi) as total FROM  ld2photos WHERE userid=%d OR userid=%d ORDER BY total DESC, created DESC',
	   mysql_real_escape_string($_SESSION['mid']),
	   mysql_real_escape_string($_SESSION['pid'])
	 );
    $recordSet = mysql_query($sql) or die(mysql_error());
?>

<body>


<?php
while($photos = mysql_fetch_assoc($recordSet)):
?>

<content>
<url><?php echo htmlspecialchars($photos['filename'], ENT_QUOTES, 'UTF-8'); ?></url>
<title><?php echo htmlspecialchars($photos['title'], ENT_QUOTES, 'UTF-8'); ?></title>
<photoid><?php echo htmlspecialchars($photos['photoid'], ENT_QUOTES, 'UTF-8'); ?></photoid>
<userid><?php echo htmlspecialchars($photos['userid'], ENT_QUOTES, 'UTF-8'); ?></userid>
<myindicator><?php echo htmlspecialchars($photos['userindi'], ENT_QUOTES, 'UTF-8'); ?></myindicator>
<partnerindicator><?php echo htmlspecialchars($photos['partnerindi'], ENT_QUOTES, 'UTF-8'); ?></partnerindicator>
</content>


<?php
endwhile;
?>


</body>

