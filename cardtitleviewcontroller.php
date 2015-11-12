<?php

    mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
    mysql_select_db('norimit_lovelog');
    mysql_query('SET NAMES UTF8');


    if(isset($_POST)){

      $sql = sprintf('INSERT INTO ld2cards SET message="%s", title="%s", cardname="%s", userid=%d, date="%s"',
      mysql_real_escape_string($_REQUEST['message']),
      mysql_real_escape_string($_REQUEST['title']),
      mysql_real_escape_string($_REQUEST['cardname']),
      mysql_real_escape_string($_REQUEST['userid']),
      date('Y-m-d H:i:s')
    );

    mysql_query($sql)or die(mysql_error());


    //chatの方への出力        
    $chat = 'あたらしいカードを贈りました。';
    $sql = sprintf('INSERT INTO ld2chat SET userid=%d, chat="%s", date="%s"',
                           mysql_real_escape_string($_POST['userid']),
                           mysql_real_escape_string($chat),
                           date('Y-m-d H:i:s')
                           );
    mysql_query($sql) or die(mysql_error());  


  }

?>