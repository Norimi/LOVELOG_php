<?php

  //クラスを使用してOOPする
  header("Content-Type:text/xml; charset=UTF-8");
  session_start();

  mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('noriming_lovelog');
  mysql_query('SET NAMES UTF8');


  class MyAndPartnerIds{

    var $mid;
    var $pid;
   
    public function __construct($mid, $pid)
    {
      $this->mid = $_SESSION['mid'];
      $this->pid = $_SESSION['pid'];

    }

    public function setPid(){
      $this->pid = $pid;
    }

    public function getPid(){
      return $this->pid;
    }

    public function setMid(){
      $this->mid = $mid;
    }
    public function getMid(){
      return $this->mid;
    }
  }




  class ContentsFromSql extends MyAndPartnerIds {

    var $photoname;

    public function setPhotoname($photoname){
      $this->photoname = $photoname;
    }

    public function getPhotoname(){
      return $this->photoname;
    }


  

   

  }


  $newid = new MyAndPartnerIds($_SESSION['mid'], $_SESSION['pid']);
  $newmid = $newid->mid;
  $content = new ContentsFromSql($_SESSION['mid'], $_SESSION['pid']);
  //$newphotoname = $content->queryPhotoname();



    $sql = sprintf('SELECT *, (userindi + partnerindi) as total FROM  ld2photos WHERE userid=%d OR userid=%d ORDER BY total DESC, created DESC LIMIT 1',
     mysql_real_escape_string($newmid),
     mysql_real_escape_string($_SESSION['pid'])
    );
    $recordSet = mysql_query($sql) or die(mysql_error());
    //セッターを呼び出して値をセットする
    $photoname = mysql_fetch_assoc($recordSet);

   
   

  // $photoname2 = $content->queryPhotoname();

   //echo 'こんにちは';

   //echo $_SESSION['pid'];
  // print $photoname2;
?>




<content>
<month>
<?php
echo '2008年', '10月', '7日', '<br />';
?>
</month>

<filename><?php echo htmlspecialchars($photoname['title'], ENT_QUOTES, 'UTF-8'); ?></filename>
<title><?php echo htmlspecialchars($content->phototitle, ENT_QUOTES, 'UTF-8'); ?></title>
</content>




 