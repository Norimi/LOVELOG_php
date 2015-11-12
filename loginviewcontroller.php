<?php


  header("Content-Type:text/xml; charset=UTF-8");
  session_start();
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
  mysql_query('SET NAMES UTF8');

  
  $sql = sprintf('SELECT * FROM ld2members WHERE email="%s" AND password="%s"',
   mysql_real_escape_string($_POST['email']),
   sha1(mysql_real_escape_string($_POST['password']))
  );
  $recordSet = mysql_query($sql) or die(mysql_error());
  $_SESSION['founduser'] = mysql_fetch_assoc($recordSet);
  $partnerid = $_SESSION['founduser']['partnerid'];
  

  $sql = sprintf('SELECT name FROM ld2members WHERE memberid=%d',
   mysql_real_escape_string($partnerid)
  );
  $recordSet2 = mysql_query($sql) or die(mysql_error());
  $_SESSION['partnername'] = mysql_fetch_assoc($recordSet2);
  
    
?>

<content>

<id><?php echo htmlspecialchars($_SESSION['founduser']['memberid']); ?></id>
<pid><?php echo htmlspecialchars($_SESSION['founduser']['partnerid']); ?></pid>
<mname><?php echo htmlspecialchars($_SESSION['founduser']['name']); ?></mname>
<memail><?php echo htmlspecialchars($_SESSION['founduser']['email']); ?></memail>
<pname><?php echo htmlspecialchars($_SESSION['partnername']['name']); ?></pname>

</content>