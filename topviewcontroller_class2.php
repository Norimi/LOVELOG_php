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
    var $plantitle;
    var $userphoto;
    var $partnerphoto;
    var $newmychat;
    var $newyourchat;

    public function setPhotoname($photoname){
      $this->photoname = $photoname;
    }

    public function getPhotoname(){
      return $this->photoname;
    }

    public function setPlantitle($plantitle){
      $this->plantitle = $plantitle;
    }

    public function getPlantitle(){
      return $this->plantitle;
    }

    public function setUserphoto($userphoto){
      $this->userphoto = $userphoto;
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

    public function getNewmychat(){
      return $this->newmychat;
    }

    public function setNewyourchat($newyourchat){
      $this->newyourchat = $newyourchat;
    }

    public function getNewmycaht(){
      return $this->newyourchat;
    }

  }


  //$newid = new MyAndPartnerIds($_SESSION['mid'], $_SESSION['pid']);
  //$newmid = $newid->mid;

  //継承したクラスからスーパークラスのプロパティを呼び出す
  $content = new ContentsFromSql($_SESSION['mid'], $_SESSION['pid']);
  $mid = $content->mid;
  $pid = $content->pid;
  //$newphotoname = $content->queryPhotoname();


  //クラス外でmysqlにアクセスし、クラスのプロパティを定める方法
  $sql = sprintf('SELECT *, (userindi + partnerindi) as total FROM  ld2photos WHERE userid=%d OR userid=%d ORDER BY total DESC, created DESC LIMIT 1',
   mysql_real_escape_string($mid),
   mysql_real_escape_string($pid)
  );
  $recordSet = mysql_query($sql) or die(mysql_error());
  //セッターを呼び出して値をセットする
  $photoname = mysql_fetch_assoc($recordSet);
  $content->setPhotoname($photoname);

  $sql = sprintf('SELECT * FROM ld2plan WHERE userid=%d OR userid=%d ORDER BY planid DESC LIMIT 1',
   mysql_real_escape_string($mid),
   mysql_real_escape_string($pid)
  );
  $recordSet5 = mysql_query($sql) or die(mysql_error());
  $plantitle = mysql_fetch_assoc($recordSet5);
  $content->setPlantitle($plantitle);


  $sql = sprintf('SELECT * FROM ld2members WHERE memberid = %d',
   mysql_real_escape_string($mid)
  );
  $recordSet4 = mysql_query($sql) or die(mysql_error());
  $userphoto = mysql_fetch_assoc($recordSet4);
  $content->setUserphoto($userphoto);


  $sql = sprintf('SELECT * FROM ld2members WHERE memberid=%d',
   mysql_real_escape_string($pid)
  );
  $recordSet3 = mysql_query($sql) or die(mysql_error());
  $partnerphoto = mysql_fetch_assoc($recordSet3);
  $content->setPartnerphoto($partnerphoto);

  
  $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d ORDER BY chatid DESC LIMIT 1',
   mysql_real_escape_string($mid)
  );
  $recordSet6 = mysql_query($sql) or die(mysql_error());
  $newmychat = mysql_fetch_assoc($recordSet6);
  $content->setNewmychat($newmychat);


  $sql = sprintf('SELECT * FROM ld2chat WHERE userid=%d ORDER BY chatid DESC LIMIT 1',
   mysql_real_escape_string($pid)
  );
  $recordSet6 = mysql_query($sql) or die(mysql_error());
  $newyourchat = mysql_fetch_assoc($recordSet6);
  $content->setNewyourchat($newyourchat);


?>




<content>
<filename><?php echo htmlspecialchars($content->photoname['filename'], ENT_QUOTES, 'UTF-8'); ?></filename>
<title><?php echo htmlspecialchars($content->photoname['title'], ENT_QUOTES, 'UTF-8'); ?></title>
<userphoto><?php echo htmlspecialchars($content->userphoto['profilefile'], ENT_QUOTES, 'UTF-8'); ?></userphoto>
<partnerphoto><?php echo htmlspecialchars($content->partnerphoto['profilefile'], ENT_QUOTES, 'UTF-8'); ?></partnerphoto>
<plantitle><?php echo htmlspecialchars($content->plantitle['title'], ENT_QUOTES, 'UTF-8'); ?></plantitle>
<mychat><?php echo htmlspecialchars($content->newmychat['chat'], ENT_QUOTES, 'UTF-8'); ?></mychat>
<yourchat><?php echo htmlspecialchars($content->newyourchat['chat'], ENT_QUOTES, 'UTF-8'); ?></yourchat>
</content>




 