<?php
header("Content-Type:text/xml; charset=UTF-8");
session_start();

    
    mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('noriming_lovelog');
    mysql_query('SET NAMES UTF8');


    
$sql = sprintf('SELECT * FROM ld2cards WHERE userid=%d OR userid=%d ORDER BY cardid DESC',
mysql_real_escape_string($_SESSION['pid']),
               mysql_real_escape_string($_SESSION['mid'])
               );
$recordSet = mysql_query($sql) or die(mysql_error());


?>

<body>

<?php

while($carditems = mysql_fetch_assoc($recordSet)):


?>




<content>
<title><?php echo htmlspecialchars($carditems['title'], ENT_QUOTES, 'UTF-8'); ?></title>
<message><?php echo htmlspecialchars($carditems['message'], ENT_QUOTES, 'UTF-8');?></message>
<cardname><?php echo htmlspecialchars($carditems['cardname'], ENT_QUOTES, 'UTF-8');?></cardname>
<userid><?php echo htmlspecialchars($carditems['userid'], ENT_QUOTES, 'UTF-8'); ?></userid>
</content>


<?php 
endwhile;
?>

</body>







