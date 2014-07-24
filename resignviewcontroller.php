<?php
  session_start();
  mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('noriming_lovelog');
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

  // セッションを切断するにはセッションクッキーも削除する。
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
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