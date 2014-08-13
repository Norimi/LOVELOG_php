<?php

  header("Content-Type:text/xml; charset=UTF-8");
  session_start();

  mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('noriming_lovelog');
  mysql_query('SET NAMES UTF8');
  
  class chatContents{

    //プロパティの設定
    var $pid;
    var $mid;
    var $chatitems;
    var $mysum;
    var $psum;
    var $writer;

    function __construct($pid, $mid){
      $this->pid = $pid;
      $this->mid = $mid;
    }


    private function getChatitems(){

      $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d OR userid=%d ORDER BY chatid DESC',
                  mysql_real_escape_string($mid),
                  mysql_real_escape_string($pid)
                );
      $recordSet = mysql_query($sql) or die(mysql_error());
      return mysql_fetch_assoc($recordSet);

    }

    private function getMyindicator(){

      //パートナーが与えたindicatorの値がユーザーに付与される値となるので注意
      $sql = sprintf('SELECT SUM(indicator) FROM ld2chat WHERE userid=%d',
                   mysql_real_escape_string($pid)
                   );
      $recordSet3 = mysql_query($sql) or die(mysql_error());
      return mysql_fetch_assoc($recordSet3);

    }

    private function getPartnerindicator(){


      $sql = sprintf('SELECT SUM(indicator) FROM ld2chat WHERE userid=%d',
                   mysql_real_escape_string($_SESSION['mid'])
                   );
      $recordSet4 = mysql_query($sql) or die(mysql_error());
      return mysql_fetch_assoc($recordSet4);
    }

  //呼び出しの位置はここでいいか確認する
  $chatcontents = new chatContents($_SESSION[$pid], $_SESSION[$mid]);
  $chatitems = $chatcontents->getChat();
  $mysum = $chatcontents->getMyindicator();
  $psum = $chatcontents->getPartnerindicator();


  }

    
  
?>


<body>



<?php

class Writers{

  var $writer;

  //chatitemsを公開必要か

  function getWriters($userid){
    $sql = sprintf('SELECT name FROM ld2members WHERE memberid=%d',
                   mysql_real_escape_string($chatitems['userid'])
                   );
    $recordSet2 = mysql_query($sql) or die(mysql_error());
    return mysql_fetch_assoc($recordSet2);

  }
}

while($chatitems):
$writer = new Writers($chatitems['userid']);
  
?>

<content>
<chatid><?php echo htmlspecialchars($chatitems['chatid'], ENT_QUOTES, 'UTF-8'); ?></chatid>
<name><?php echo htmlspecialchars($writer['name'], ENT_QUOTES, 'UTF-8'); ?></name>
<userid><?php echo htmlspecialchars($chatitems['userid'], ENT_QUOTES, 'UTF-8'); ?></userid>
<log><?php echo htmlspecialchars($chatitems['chat'], ENT_QUOTES, 'UTF-8'); ?></log>
<date><?php echo htmlspecialchars($chatitems['date'], ENT_QUOTES, 'UTF-8'); ?></date>
<planid><?php echo htmlspecialchars($chatitems['planid'], ENT_QUOTES, 'UTF-8'); ?></planid>
<heartindi><?php echo htmlspecialchars($chatitems['indicator'], ENT_QUOTES, 'UTF-8'); ?></heartindi>
<mysum><?php echo htmlspecialchars($mysum['SUM(indicator)'], ENT_QUOTES, 'UTF-8'); ?></mysum>
<psum><?php echo htmlspecialchars($psum['SUM(indicator)'], ENT_QUOTES, 'UTF-8'); ?></psum>
</content>

<?php 
  endwhile;
?>

</body>




