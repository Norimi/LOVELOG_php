<?php
  //photoindicator.phpとphotoviewcontroller.phpをひとつに
  //写真につけられたインジケーターの値をサーバーに挿入する
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
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

  if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
    
    $userid = $_POST['userid'];
    $extension = $_POST['extension'];
    $image = date('YmdHis') .$userid .$extension;
    //エラーをチェックしてファイル名をつくる。userid?を入れる。
     move_uploaded_file($_FILES["upfile"]["tmp_name"], "./photo_uploaded/" .$image);  

    //DLするときのためファイル情報をServerに入れる
    $sql = sprintf('INSERT INTO ld2photos SET userid=%d, title="%s",filename="%s", created="%s"',
      mysql_real_escape_string($_POST['userid']),
      mysql_real_escape_string($_POST['title']),
      mysql_real_escape_string($image),
      date('Y-m-d H:i:s')
    );
    mysql_query($sql) or die(mysql_error());
    
    //chatにメッセージを挿入
    $message='あたらしい写真を投稿しました。';
    $phototitle = $_POST['title'];
    $chat = sprintf("%s 「%s」", $message, $phototitle);
    $sql = sprintf('INSERT INTO ld2chat SET userid=%d, chat="%s",date="%s"',
     mysql_real_escape_string($_POST['userid']),
     mysql_real_escape_string($chat),
     date('Y-m-d H:i:s')
    );
    mysql_query($sql) or die(mysql_error());

  }

