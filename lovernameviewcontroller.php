<?php
  session_start();

  mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('noriming_lovelog');
  mysql_query('SET NAMES UTF8');

  $sql = sprintf('UPDATE ld2members SET name="%s" WHERE memberid=%d',
  mysql_real_escape_string($_POST['username']),
  mysql_real_escape_string($_SESSION['join']['id'])
  );
  mysql_query($sql) or die(mysql_error());


  $sql2=sprintf('INSERT INTO ld2members SET name="%s", partnerid=%d',
  mysql_real_escape_string($_POST['lovername']),
  mysql_real_escape_string($_SESSION['join']['id'])
  );
  mysql_query($sql2) or die(mysql_error());
  $pid = mysql_insert_id();

  $_SESSION['pid'] = $pid;

  //相手のidをpartneridとして保存
  $sql3 = sprintf('UPDATE ld2members SET partnerid=%d WHERE memberid=%d',
  mysql_real_escape_string($pid),
  mysql_real_escape_string($_SESSION['join']['id'])
  );
  mysql_query($sql3) or die(mysql_error());
      
  //パスキー（ラバーナンバー）を発行してセッションへ
  $passkey = rand(0, 10000);
  $_SESSION['lovernumber'] = $passkey;

  $sql = sprintf('UPDATE ld2members SET passkey=%d WHERE memberid = %d',
                 mysql_real_escape_string($_SESSION['lovernumber']),
                 mysql_real_escape_string($_SESSION['pid'])
                 );
  mysql_query($sql) or die(mysql_error());




?>
