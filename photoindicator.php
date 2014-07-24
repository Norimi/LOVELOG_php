<?php

  //写真につけられたインジケーターの値をサーバーに挿入する
  mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('noriming_lovelog');
  mysql_query('SET NAMES UTF8');

  if($_POST['myphoto']==0){
    //パートナーがアップロードした写真の場合
    $sql = sprintf('UPDATE ld2photos SET partnerindi=%d WHERE photoid=%d',
     mysql_real_escape_string($_POST['indicator']),
     mysql_real_escape_string($_POST['photoid'])
    );
    mysql_query($sql) or die(mysql_error());

  } else {
  　　//ユーザーがアップロードした写真の場合(myphoto=1)
    $sql = sprintf('UPDATE ld2photos SET userindi=%d WHERE photoid=%d',
     mysql_real_escape_string($_POST['indicator']),
     mysql_real_escape_string($_POST['photoid'])
    );
    mysql_query($sql) or die(mysql_error());
  }

?>