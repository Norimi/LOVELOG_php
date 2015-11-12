<?php

  header("Content-Type:text/xml; charset=UTF-8");
  session_start();
  mysql_connect('mysql1.webcrow-php.netowl.jp', 'norimit_user', 'withlovelogbear') or die(mysql_error());
  mysql_select_db('norimit_lovelog');
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

  class PlansFromSql extends MyAndPartnerIds {

    var $planitems;
    var $planner;
    var $planurl;
    var $plantodo;

    public function setPlanitems($planitems){
      $this->planitems = $planitems;

    }

    public function getPlanitems(){
      return $this->planitems;
    }

    public function setPlanner($planner){
      $this->planner = $planner;
    }

    public function getPlanner(){
      return $this->planner;
    }

    public function setPlanurl($planurl){
      $this->planurl = $planurl;
    }

    public function getPlanurl(){
      return $this->planurl;
    }

    public function setPlantodo($plantodo){
      $this->plantodo = $plantodo;
    }

    public function getPlantodo(){
      return $this->plantodo;
    }

  }

  $plan = new PlansFromSql($_SESION['mid'],$_SESSION['pid']);
  $mid = $plan->mid;
  $pid = $plan->pid;

  //名前のテーブルとリレーションを張る
  $sql = sprintf('SELECT * FROM ld2plan,ld2members WHERE (userid=%d OR userid=%d) AND (ld2plan.userid = ld2members.memberid) ORDER BY date DESC',
   mysql_real_escape_string($mid),
   mysql_real_escape_string($pid)
  );
  $recordZ = mysql_query($sql) or die(mysql_error());
    
?>

<body>

<?php

  while($planitems = mysql_fetch_assoc($recordZ)):
  
  
  $sql = sprintf('SELECT * FROM ld2planurl WHERE planid=%d ORDER BY urlid ASC',
   mysql_real_escape_string($planitems['planid'])
  );
  $recordSet3 = mysql_query($sql) or die(mysql_error());

  $sql = sprintf ('SELECT * FROM ld2plantodo WHERE planid=%d ORDER BY todoid ASC',
    mysql_real_escape_string($planitems['planid'])
  );
  $recordSet4 = mysql_query($sql) or die(mysq_error());
?>

<content>
<name><?php echo htmlspecialchars($planitems['name'], ENT_QUOTES, 'UTF-8'); ?></name>
<category><?php echo htmlspecialchars($planitems['category'], ENT_QUOTES, 'UTF-8'); ?></category>
<title><?php echo htmlspecialchars($planitems['title'], ENT_QUOTES, 'UTF-8'); ?></title>
<date><?php echo htmlspecialchars($planitems['date'], ENT_QUOTES, 'UTF-8'); ?></date>
<budget><?php echo htmlspecialchars($planitems['budget'], ENT_QUOTES, 'UTF-8'); ?></budget>
<created><?php echo htmlspecialchars($planitems['created'], ENT_QUOTES, 'UTF-8'); ?></created>
<planid><?php echo htmlspecialchars($planitems['planid'], ENT_QUOTES, 'UTF-8'); ?></planid>
<userid><?php echo htmlspecialchars($planitems['userid'], ENT_QUOTES, 'UTF-8');?></userid>


<?php
  while($planurl = mysql_fetch_assoc($recordSet3)):
?>

<url><?php echo htmlspecialchars($planurl['url'], ENT_QUOTES, 'UTF-8'); ?></url>
<urlid><?php echo htmlspecialchars($planurl['urlid'], ENT_QUOTES, 'UTF-8'); ?></urlid>

<?php
  endwhile;
?>




<?php
  while($plantodo = mysql_fetch_assoc($recordSet4)):
?>

<todo><?php echo htmlspecialchars($plantodo['todo'], ENT_QUOTES, 'UTF-8'); ?></todo>
<todoid><?php echo htmlspecialchars($plantodo['todoid'], ENT_QUOTES, 'UTF-8'); ?></todoid>
<checked><?php echo htmlspecialchars($plantodo['checked'], ENT_QUOTES, 'UTF-8');?></checked>


<?php
  endwhile;
?>




</content>

<?php
  endwhile;
?>

</body>