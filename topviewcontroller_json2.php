<?php

  header("Content-Type:application/json; charset=UTF-8");
  session_start();
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
  mysql_query('SET NAMES UTF8');



  
  
  $sql = sprintf('SELECT *, (userindi + partnerindi) as total FROM  ld2photos WHERE userid=%d OR userid=%d ORDER BY total DESC, created DESC LIMIT 1',
                 mysql_real_escape_string($_SESSION['mid']),
                 mysql_real_escape_string($_SESSION['pid'])
                 );
  $recordSet = mysql_query($sql) or die(mysql_error());
  $photoname = mysql_fetch_assoc($recordSet);
  
  

 //planのタイトルとidを取得
  
  $sql = sprintf('SELECT * FROM ld2plan WHERE userid=%d OR userid=%d ORDER BY planid DESC LIMIT 1',
                 mysql_real_escape_string($_SESSION['mid']),
                 mysql_real_escape_string($_SESSION['pid'])
                 );
  $recordSet5 = mysql_query($sql) or die(mysql_error());
  $plantitle = mysql_fetch_assoc($recordSet5);

  
  //memebersからもphotoをひいてくる
  
  
  $sql = sprintf('SELECT * FROM ld2members WHERE memberid = %d',
                 mysql_real_escape_string($_SESSION['mid'])
                 );
  $recordSet4 = mysql_query($sql) or die(mysql_error());
  $userphoto2 = mysql_fetch_assoc($recordSet4);
  
  
  $sql = sprintf('SELECT * FROM ld2members WHERE memberid=%d',
                 mysql_real_escape_string($_SESSION['mid'])
                 );
  $recordSet2 = mysql_query($sql) or die(mysql_error());
  $userphoto = mysql_fetch_assoc($recordSet2);
  
  
  
  $sql = sprintf('SELECT * FROM ld2members WHERE memberid=%d',
                 mysql_real_escape_string($_SESSION['pid'])
                 );
  $recordSet3 = mysql_query($sql) or die(mysql_error());
  $partnerphoto = mysql_fetch_assoc($recordSet3);
  
  
  $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d ORDER BY chatid DESC LIMIT 1',
                 
                 mysql_real_escape_string($_SESSION['mid'])
                 );
  $recordSet6 = mysql_query($sql) or die(mysql_error());
  $newmychat = mysql_fetch_assoc($recordSet6);
  
  
  
  $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d ORDER BY chatid DESC LIMIT 1',
                 
                 mysql_real_escape_string($_SESSION['pid'])
                 );
  $recordSet6 = mysql_query($sql) or die(mysql_error());
  $newyourchat = mysql_fetch_assoc($recordSet6);

  $arr = array('filename' => $photoname['filename'], 'title' => $photoname['title'], 'userphoto' => $userphoto2['profilefile'], 'partnerphoto' => $partnerphoto['profilefile'], 'mychat' => $newmychat['chat'], 'yourchat' => $newyourchat['chat']);
  $new_arr = json_encode($arr);
   //echo $new_arr;
     

?>
<?php echo $new_arr; ?>





 