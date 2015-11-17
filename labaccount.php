<?php

  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
  mysql_query('SET NAMES UTF8');


  if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    
    $userid = $_POST['userid'];
    $extension = $_POST['extension'];
    $image = date('YmdHis') .$userid .$extension;
    //エラーをチェックしてファイル名をつくる。useridを入れる。
    move_uploaded_file($_FILES["upfile"]["tmp_name"], "./profile_photos/" .$image);     
    $sql = sprintf('UPDATE ld2members SET profilefile="%s" WHERE memberid=%d',
      mysql_real_escape_string($image),
      mysql_real_escape_string($_POST['userid'])
      );
    mysql_query($sql) or die(mysql_error());
  }
        
?>