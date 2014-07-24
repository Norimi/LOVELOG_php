<?php

  mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('noriming_lovelog');
  mysql_query('SET NAMES UTF8');


 　//ユーザーアカウントの写真ファイルをアップロード
  if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
          
    $userid = $_POST['userid'];
    $extension = $_POST['extension'];
    $image = date('YmdHis') .$userid .$extension;

   
    //エラーをチェックしてファイル名をつくる。ファイル名とuserid?を入れる。
    move_uploaded_file($_FILES["upfile"]["tmp_name"], "./profile_photos/" .$image);    

    $sql = sprintf('UPDATE ld2members SET profilefile="%s" WHERE memberid=%d',
                    mysql_real_escape_string($image),
                    mysql_real_escape_string($_POST['userid'])
     );
    mysql_query($sql) or die(mysql_error());

}
        
?>