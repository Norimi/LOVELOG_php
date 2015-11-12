<?php
  session_start();
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
  mysql_query('SET NAMES UTF8');
   
  $sql=sprintf('DELETE FROM ld2members WHERE memberid=%d',
    mysql_real_escape_string($_POST['userid'])
  );
  mysql_query($sql) or die(mysql_error());
      
    

  //チャットとカードとコメントを消す
      
  $sql = sprintf('DELETE FROM ld2chat WHERE userid=%d',
   mysql_real_escape_string($_POST['userid'])
  );
  mysql_query($sql) or die(mysql_error());


  $sql = sprintf('DELETE FROM ld2plan WHERE userid=%d',
    mysql_real_escape_string($_POST['userid'])
  );
  mysql_query($sql) or die(mysql_error());


  $sql = sprintf('DELETE FROM ld2photos WHERE userid=%d',
    mysql_real_escape_string($_POST['userid'])
  );
  mysql_query($sql) or die(mysql_error());


  $sql = sprintf('DELETE FROM ld2plantodo WHERE userid=%d',
    mysql_real_escape_string($_POST['userid'])
  );
  mysql_query($sql) or die(mysql_error());

  $sql = sprintf('DELETE FROM ld2planurl WHERE userid=%d',
    mysql_real_escape_string($_POST['userid'])
  );
  mysql_query($sql) or die(mysql_error());
  // セッション変数を全て解除する
  $_SESSION = array();

  // クッキーを削除する
  if (ini_get("session.use_cookies")) {
    //セッションクッキーのパラメーターを取得する
    $params = session_get_cookie_params();
    //クッキーの有効期限を過去に設定してクッキーを削除する
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
  }

  // 最終的に、セッションを破壊する
  session_destroy();
  setcookie('email', '', time()-3600);
  setcookie('password', '', time()-3600);
    
    

?>