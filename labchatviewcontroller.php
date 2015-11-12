<?php

  header("Content-Type:text/xml; charset=UTF-8");
  session_start();
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
  mysql_query('SET NAMES UTF8');



  if($_SESSION['page']){
        
    $page = $_SESSION['page'];
    $_SESSION['page'] = null;

  } else {

    $page = 30;
        
  }



  $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d OR userid=%d ORDER BY chatid DESC LIMIT %d',
    mysql_real_escape_string($_SESSION['mid']),
    mysql_real_escape_string($_SESSION['pid']),
                   $page
  );
  $recordSet = mysql_query($sql) or die(mysql_error());
      
    
    //ここで、photoの分もあつめてまとめる
    //自分に与えられたものから
   
  $sql = sprintf('SELECT SUM(indicator) FROM ld2chat WHERE userid=%d',
    mysql_real_escape_string($_SESSION['mid'])
  );
  $recordSet3 = mysql_query($sql) or die(mysql_error());
  $mysum = mysql_fetch_assoc($recordSet3);

  $sql = sprintf('SELECT SUM(partnerindi) FROM ld2photos WHERE userid=%d',
    mysql_real_escape_string($_SESSION['mid'])
  );
  $recordSet4 = mysql_query($sql) or die(mysql_error());
  $myphotosum = mysql_fetch_assoc($recordSet4);
  
  
  
  $sql = sprintf('SELECT SUM(indicator) FROM ld2chat WHERE userid=%d',
   mysql_real_escape_string($_SESSION['pid'])
  );
  $recordSet5 = mysql_query($sql) or die(mysql_error());
  $psum = mysql_fetch_assoc($recordSet5);
  
  
  $sql = sprintf('SELECT SUM(partnerindi) FROM ld2photos WHERE userid=%d',
   mysql_real_escape_string($_SESSION['pid'])
  );
  $recordSet4 = mysql_query($sql) or die(mysql_error());
  $pphotosum = mysql_fetch_assoc($recordSet4);
  
?>


<body>


<?php

  while($chatitems = mysql_fetch_assoc($recordSet)):
    //ひとつずつに対してphotoをdlする
  $sql = sprintf('SELECT profilefile FROM ld2members WHERE memberid=%d',
    mysql_real_escape_string($chatitems['userid'])
  );
  $recordSet2 = mysql_query($sql) or die(mysql_error());
  $userphoto = mysql_fetch_assoc($recordSet2);

?>

<content>
<chatid><?php echo htmlspecialchars($chatitems['chatid'], ENT_QUOTES, 'UTF-8'); ?></chatid>
<name><?php echo htmlspecialchars($writer['name'], ENT_QUOTES, 'UTF-8'); ?></name>
<userid><?php echo htmlspecialchars($chatitems['userid'], ENT_QUOTES, 'UTF-8'); ?></userid>
<log><?php echo htmlspecialchars($chatitems['chat'], ENT_QUOTES, 'UTF-8'); ?></log>
<photo><?php echo htmlspecialchars($userphoto['profilefile'], ENT_QUOTES, 'UTF-8'); ?></photo>
<date><?php echo htmlspecialchars($chatitems['date'], ENT_QUOTES, 'UTF-8'); ?></date>
<planid><?php echo htmlspecialchars($chatitems['planid'], ENT_QUOTES, 'UTF-8'); ?></planid>
<heartindi><?php echo htmlspecialchars($chatitems['indicator'], ENT_QUOTES, 'UTF-8'); ?></heartindi>
<mysum><?php echo htmlspecialchars($mysum['SUM(indicator)'], ENT_QUOTES, 'UTF-8'); ?></mysum>
<psum><?php echo htmlspecialchars($psum['SUM(indicator)'], ENT_QUOTES, 'UTF-8'); ?></psum>
<myphotosum><?php echo htmlspecialchars($myphotosum['SUM(partnerindi)'], ENT_QUOTES, 'UTF-8'); ?></myphotosum>
<pphotosum><?php echo htmlspecialchars($pphotosum['SUM(partnerindi)'], ENT_QUOTES, 'UTF-8'); ?></pphotosum>
</content>

<?php 
endwhile;
?>

</body>




