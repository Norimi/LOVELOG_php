<?php
  session_start();
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
  mysql_query('SET NAMES UTF8');

  if(isset($_POST)){
    $sql = sprintf('INSERT INTO ld2plan SET userid=%d, category="%s", title="%s", date="%s", budget=%d, created="%s"',
    mysql_real_escape_string($_REQUEST['userid']),
    mysql_real_escape_string($_REQUEST['category']),
    mysql_real_escape_string($_REQUEST['title']),
    mysql_real_escape_string($_REQUEST['date']),
    mysql_real_escape_string($_REQUEST['budget']),
    date('Y-m-d H:i:s')
    );
    //chatへの新しいプラン情報の挿入
    mysql_query($sql) or die(mysql_error());
    $planidvalue = mysql_insert_id();
    $category = $_POST['category'];
    $title = $_POST['title'];
    $planmade = 'あたらしいプランをたてました。';
    $plantitle = $_REQUEST['title'];
    $chat = sprintf("%s 「%s」",  $planmade, $plantitle);

    $sql2 = sprintf('INSERT INTO ld2chat SET userid=%d, chat="%s", date="%s", planid=%d',
     mysql_real_escape_string($_POST['userid']),
     mysql_real_escape_string($chat),
     date('Y-m-d H:i:s'),
     mysql_real_escape_string($planidvalue)
     );
    mysql_query($sql2) or die(mysql_error());
    }

    if(isset($_REQUEST['url'])){
      foreach($_POST['url'] as $url){
        $sql3 = sprintf('INSERT INTO ld2planurl SET planid=%d, userid=%d, url="%s", created="%s"',
          mysql_real_escape_string($planidvalue),
          mysql_real_escape_string($_POST['userid']),
          mysql_real_escape_string($url),
          date('Y-m-d H:i:s')
          );
        mysql_query($sql3) or die(mysql_error());

      }
    }


  if(isset($_REQUEST['todo'])){
    foreach($_POST['todo'] as $todo){
      $sql4 = sprintf('INSERT INTO ld2plantodo SET planid=%d, userid=%d, todo ="%s", checked="1", created="%s"',
        mysql_real_escape_string($planidvalue),
        mysql_real_escape_string($_POST['userid']),
        mysql_real_escape_string($todo),
        date('Y-m-d H:i:s')
        );
      mysql_query($sql4) or die(mysql_error());
    }

  }

?>


