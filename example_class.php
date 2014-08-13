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
      $this->pid = $_SESSION['pid'];
      $this->mid = $_SESSION['mid'];
    }


    //全てのプロパティに対してアクセッサを設定する
    public function setPid(){

      if($pid < 0){

        //partner id が0以下のときexceptionを出す
        throw new ¥InvalidArgumentException(sprintf('partner id must be positive'));
      }

      $this->pid = $pid;
    }

    public function getPid(){

      return $this->pid;

    }

    public function getMid(){

      return $this->mid;
    }


    public function getChatitems(){

      $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d OR userid=%d ORDER BY chatid DESC',
                  mysql_real_escape_string($this->mid),
                  mysql_real_escape_string($this->pid)
                );
      $recordSet = mysql_query($sql) or die(mysql_error());
      $rows = mysql_fetch_assoc($recordSet);
      return $rows;
      
    }
  }
   //この方法では正しく表示できない
  $chatcontents = new chatContents($_SESSION['pid'], $_SESSION['mid']);
  $chatitems = $chatcontents->getChatitems();
 

?>


<body>



<?php
while($chatitems):
?>



<log><?php echo htmlspecialchars($chatitems['chat'], ENT_QUOTES, 'UTF-8'); ?></log>



<?php 
  endwhile;
?>

</body>




