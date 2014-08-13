<?php

  //クラスを使用してOOPする

  header("Content-Type:text/xml; charset=UTF-8");
  session_start();

  mysql_connect('mysql712.xserver.jp', 'noriming_lovelog', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('noriming_lovelog');
  mysql_query('SET NAMES UTF8');


  class MyAndPartenrIds{

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


  class ContentsFromSql extends MyAndPartnerIds{

    var $photoname;
    var $phototitle;
    var $plantitle;
    var $userphoto2;
    var $partnerphoto;
    var $newmychat;
    var $newyourchat;


    public function setPhotoname($photoname){
      $this->photoname = $photoname;
    }

    public function getPhotoname(){
      return $this->photoname;
    }

    public function setPhototitle($phototitle){
      $this->phototitle = $phototitle;
    }

    public function getPhotoname(){
      return $this->phototitle;
    }

    public function setPlantitle($plantitle){
      $this->plantitle = $plantitle;

    }

    public function getPlantitle(){
      return $plantitle->plantitle;
    }

    public function setUserphoto2($userphoto2){
      $this->userphoto2 = $userphoto2;
    }

    public function getUserphoto2(){
      return $this->userphoto2;
    }

    public function setPartnerphoto($partnerphoto){
      $this->partnerphoto = $partnerphoto;
    }

    public function getPartnerphoto(){
      return $this->partnerphoto;
    }

    public function setNewmychat($newmychat){
      $this->newmychat = $newmychat;
    }

    public function getNewmycaht(){
      return $this->newmychat;
    }

    public function setNewyourchat($newyourchat){
      $this->newyourchat = $newyourchat;
    }

    public function getNewyourchat(){
      return $this->newyourchat;
    }
  }


  private function queryPhotoname(){

  $sql = sprintf('SELECT *, (userindi + partnerindi) as total FROM  ld2photos WHERE userid=%d OR userid=%d ORDER BY total DESC, created DESC LIMIT 1',
   mysql_real_escape_string($mid),
   mysql_real_escape_string($pid)
  );
  $recordSet = mysql_query($sql) or die(mysql_error());
  //セッターを呼び出して値をセットする
  $record = mysql_fetch_assoc($recordSet);
  $this->setPhotoname($record['filename']);
  $this->setPhototitle($record['title']);

  }
  
  private function queryPlantitle(){
  //planのタイトルとidを取得
  $sql = sprintf('SELECT * FROM ld2plan WHERE userid=%d OR userid=%d ORDER BY planid DESC LIMIT 1',
   mysql_real_escape_string($mid),
   mysql_real_escape_string($pid)
  );
  $recordSet5 = mysql_query($sql) or die(mysql_error());
  $record = mysql_fetch_assoc($recordSet5);
  $this->setPlantitle($record['title']);

  }
    
  private function queryUserphoto2(){
  $sql = sprintf('SELECT * FROM ld2members WHERE memberid = %d',
   mysql_real_escape_string($mid)
  );
  $recordSet4 = mysql_query($sql) or die(mysql_error());
  $record = mysql_fetch_assoc($recordSet4);
  $this->setUserphoto2($record['profilefile']);
  }
  

  private function queryPartnerphoto(){
  $sql = sprintf('SELECT * FROM ld2members WHERE memberid=%d',
   mysql_real_escape_string($_SESSION['pid'])
  );
  $recordSet3 = mysql_query($sql) or die(mysql_error());
  $record = mysql_fetch_assoc($recordSet3);
  $this->setPartnerphoto($record['profilefile']);
  }
  
  private function queryNewmychat(){
  $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d ORDER BY chatid DESC LIMIT 1',
   mysql_real_escape_string($_SESSION['mid'])
  );
  $recordSet6 = mysql_query($sql) or die(mysql_error());
  $record = mysql_fetch_assoc($recordSet6);
  $this->setNewmychat($record['chat']);
  }

  private function queryNewyourchat(){
  $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d ORDER BY chatid DESC LIMIT 1',
   mysql_real_escape_string($_SESSION['pid'])
  );
  $recordSet6 = mysql_query($sql) or die(mysql_error());
  $record = mysql_fetch_assoc($recordSet6);
  $this->setNewyourchat($record['chat']);
  }

  $content = new ContentsFromSql($_SESSION['mid'], $_SESSION['pid']);

?>


<content>

<filename><?php echo htmlspecialchars($content->photoname, ENT_QUOTES, 'UTF-8'); ?></filename>
<title><?php echo htmlspecialchars($content->phototitle, ENT_QUOTES, 'UTF-8'); ?></title>
<userphoto><?php echo htmlspecialchars($content->userphoto2, ENT_QUOTES, 'UTF-8'); ?></userphoto>
<partnerphoto><?php echo htmlspecialchars($content->partnerphoto, ENT_QUOTES, 'UTF-8'); ?></partnerphoto>
<plantitle><?php echo htmlspecialchars($content->plantitle, ENT_QUOTES, 'UTF-8'); ?></plantitle>
<mychat><?php echo htmlspecialchars($content->newmychat, ENT_QUOTES, 'UTF-8'); ?></mychat>
<yourchat><?php echo htmlspecialchars($content->newyourchat, ENT_QUOTES, 'UTF-8'); ?></yourchat>
</content>




 