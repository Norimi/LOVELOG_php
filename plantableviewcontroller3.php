<?php

  header("Content-Type:text/xml; charset=UTF-8");
  session_start();
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
  mysql_query('SET NAMES UTF8');


  $sql = sprintf('SELECT * FROM ld2plan WHERE userid=%d OR userid=%d ORDER BY date DESC',
   mysql_real_escape_string($_SESSION['mid']),
   mysql_real_escape_string($_SESSION['pid'])
  );
  $recordSet= mysql_query($sql) or die(mysql_error());
    
?>

<body>

<?php
  while($planitems = mysql_fetch_assoc($recordSet)):
  
  $sql= sprintf('SELECT  name FROM ld2members WHERE memberid=%d',
    mysql_real_escape_string($planitems['userid'])
  );
  $recordSet2 = mysql_query($sql) or die(mysql_error());
  $planner = mysql_fetch_assoc($recordSet2);
  
  
  $sql = sprintf('SELECT * FROM ld2planurl WHERE planid=%d ORDER BY urlid ASC',
   mysql_real_escape_string($planitems['planid'])
  );
  $recordSet3 = mysql_query($sql) or die(mysql_error());

  $sql = sprintf ('SELECT * FROM ld2plantodo WHERE planid=%d ORDER BY todoid ASC',
    mysql_real_escape_string($planitems['planid'])
  );
  $recordSet4 = mysql_query($sql) or die(mysq_error());
?>

<content>
<name><?php echo htmlspecialchars($planner['name'], ENT_QUOTES, 'UTF-8'); ?></name>
<category><?php echo htmlspecialchars($planitems['category'], ENT_QUOTES, 'UTF-8'); ?></category>
<title><?php echo htmlspecialchars($planitems['title'], ENT_QUOTES, 'UTF-8'); ?></title>
<date><?php echo htmlspecialchars($planitems['date'], ENT_QUOTES, 'UTF-8'); ?></date>
<budget><?php echo htmlspecialchars($planitems['budget'], ENT_QUOTES, 'UTF-8'); ?></budget>
<created><?php echo htmlspecialchars($planitems['created'], ENT_QUOTES, 'UTF-8'); ?></created>
<planid><?php echo htmlspecialchars($planitems['planid'], ENT_QUOTES, 'UTF-8'); ?></planid>
<userid><?php echo htmlspecialchars($planitems['userid'], ENT_QUOTES, 'UTF-8');?></userid>


<?php
  while($planurl = mysql_fetch_assoc($recordSet3)):
?>

<url><?php echo htmlspecialchars($planurl['url'], ENT_QUOTES, 'UTF-8'); ?></url>
<urlid><?php echo htmlspecialchars($planurl['urlid'], ENT_QUOTES, 'UTF-8'); ?></urlid>

<?php
  endwhile;
?>




<?php
  while($plantodo = mysql_fetch_assoc($recordSet4)):
?>

<todo><?php echo htmlspecialchars($plantodo['todo'], ENT_QUOTES, 'UTF-8'); ?></todo>
<todoid><?php echo htmlspecialchars($plantodo['todoid'], ENT_QUOTES, 'UTF-8'); ?></todoid>
<checked><?php echo htmlspecialchars($plantodo['checked'], ENT_QUOTES, 'UTF-8');?></checked>


<?php
  endwhile;
?>




</content>

<?php
  endwhile;
?>

</body>